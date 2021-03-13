<?php	
class Version_changes_model extends MY_Model{

	// function for call onetime to setup new changes after update
	public function update_changes() {
		// update database from sql file from root directory
		$this->import_database_changes();

		// create versions.php file with update version number
		$this->update_version_details();

		// clear image cache folders
		$this->clear_image_cache_folders();

		// set default as selected theme 
		$this->set_default_theme();

		// delete unnecessary files from script
		$this->unlink_unnecessory_files();

		$this->session->sess_destroy();
		$this->output->delete_cache(base_url());
	}

	public function update_version_details(){
	    if(!defined('SCRIPT_VERSION') || SCRIPT_VERSION != $this->config->item('app_version')) {
     		$version = "<?php \n";
     		$version .= "define('SCRIPT_VERSION', '".$this->config->item('app_version')."'); \n";
    		file_put_contents(FCPATH."/install/version.php", $version);
	    }
	}

	private function import_database_changes(){
		// generate backup of existing database before migrate to new version
		$this->load->dbutil();
		$prefs = array(
			'format'        => 'txt',
			'filename'      => $this->db->database,
			'add_drop'      => true,
			'add_insert'    => true,
			'newline'       => "\n"
		);
		$backup =& $this->dbutil->backup($prefs);
		$db_name = 'database_backup_'.time().'.sql';
		$bk_path = 'application/backup/'.$db_name;
		$this->load->helper('file');
		write_file($bk_path, $backup);

		// migrate database to new version
		$templine = '';
		$mysql_updates = "database_update_".$this->config->item('app_version').".sql";
		$file = fopen($mysql_updates,"r");
		while(! feof($file))
		{
			$line = fgets($file);
			if (substr($line, 0, 2) == '--' || $line == '')
			continue;
			$templine .= $line;
			if (substr(trim($line), -1, 1) == ';') {
				try {
					$this->db->db_debug = false;
					if(!@$this->db->query($templine)) {
						log_message('error', $this->db->error());
					}
				} catch (\Throwable $th) {
					log_message('error', $th->getMessage());
				}
				$templine = '';
			}
		}
		fclose($file);
		rename($mysql_updates, "application/backup/".$mysql_updates);
	}

	private function set_default_theme() {
		$this->db->query("UPDATE `setting` SET `setting_value`= 0 WHERE `setting_type`='store' AND `setting_key`='theme'");
	}

	private function unlink_unnecessory_files() {
		$deprecated_files = [
			FCPATH."assets/login/login/js/analytics.js",
			FCPATH."assets/vertical/assets/images/flags/Indian_flag.jpg",
			FCPATH."assets/vertical/assets/images/flags/french_flag.jpg",
			FCPATH."assets/vertical/assets/images/flags/germany_flag.jpg",
			FCPATH."assets/vertical/assets/images/flags/italy_flag.jpg",
			FCPATH."assets/vertical/assets/images/flags/russia_flag.jpg",
			FCPATH."assets/vertical/assets/images/flags/spain_flag.jpg",
			FCPATH."assets/vertical/assets/images/flags/us_flag.jpg",
		];

		foreach($deprecated_files as $file) {
			if(is_file($file)) unlink($file);
		}
	}

	private function clear_image_cache_folders() {

		$folder_path = [];

		$folder_path[] =  FCPATH."assets/image_cache/cache/assets/images/form/favi/";

		$folder_path[] =  FCPATH."assets/image_cache/cache/assets/images/payments/";

		$folder_path[] =  FCPATH."assets/image_cache/cache/assets/images/product/upload/thumb/";

		$folder_path[] =  FCPATH."assets/image_cache/cache/assets/images/site/";

		$folder_path[] =  FCPATH."assets/image_cache/cache/assets/images/themes/";

		$folder_path[] =  FCPATH."assets/image_cache/cache/assets/images/wallet-icon/";

		$folder_path[] =  FCPATH."assets/image_cache/cache/assets/vertical/assets/images/users/";

		foreach ($folder_path as $key => $value) {

			$files = glob($value.'/*');

			foreach($files as $file) { 

				if(is_file($file))  unlink($file);  

			}

		}

	}
}