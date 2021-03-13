<tr>
  <td align="center" style="padding:30px;background: transparent" >
    <table width="604" style="background-color:#fff; margin:0 auto; border-collapse:collapse; border-spacing: 0 !important; border-radius: 20px !important;filter: drop-shadow(5px 4px 13px rgba(0,0,0,0.1));">
      <td align="center" bgcolor="#fff"  style="padding:10px 0 10px 0; border-top-left-radius: 20px !important; border-top-right-radius: 20px !important;">
        <a href="<?= $base_url ?>" target="_blank" style="color:#128ced; text-decoration:none;outline:0;">
          <?php
            $logo = base_url(trim($emailsetting['logo']) ? 'assets/images/site/'.$emailsetting['logo'] : 'assets/images/no_image_available.png');
          ?>
          <img alt="" src="<?= $logo ?>" style='width: 288px;' border="0">
        </a>
      </td>
      <tr>
        <td align="center">
          <table width="550" style="margin:0 auto; border-spacing: 0 !important">
            <tr>
              <td align="left" style="font-family:'Roboto', Arial !important">
                <?php echo $html ?>
              </td>
            </tr>
          </td>
        </tr>


