<div class="form-group">
	<label class="control-label">Status</label>
	<select class="form-control" name="status">
		<option <?= (int)$setting_data['status'] == '0' ? 'selected' : '' ?> value="0">Disabled</option>
		<option <?= (int)$setting_data['status'] == '1' ? 'selected' : '' ?> value="1">Enabled</option>
	</select>
</div>
<div class="form-group">
	<label class="control-label"><span data-toggle="tooltip" title="" data-original-title="Enter your Shop ID provided by Yandex">Shop ID</span></label>
	<input class="form-control" name="shop_id" value="<?= $setting_data['shop_id'] ?>">
</div>
<div class="form-group">
	<label class="control-label"><span data-toggle="tooltip" title="" data-original-title="Enter your Secret Key provided by Yandex">Secret Key</span></label>
	<input class="form-control" name="secret_key" value="<?= $setting_data['secret_key'] ?>">
</div>
<?php 
		$business_currency =  array(
			'USD' => 'United States Dollars',
			'EUR' => 'Euro',
			'GBP' => 'United Kingdom Pounds',
			'DZD' => 'Algeria Dinars',
			'ARP' => 'Argentina Pesos',
			'AUD' => 'Australia Dollars',
			'ATS' => 'Austria Schillings',
			'BSD' => 'Bahamas Dollars',
			'BBD' => 'Barbados Dollars',
			'BEF' => 'Belgium Francs',
			'BMD' => 'Bermuda Dollars',
			'BRR' => 'Brazil Real',
			'BGL' => 'Bulgaria Lev',
			'CAD' => 'Canada Dollars',
			'CLP' => 'Chile Pesos',
			'CNY' => 'China Yuan Renmimbi',
			'CYP' => 'Cyprus Pounds',
			'CSK' => 'Czech Republic Koruna',
			'DKK' => 'Denmark Kroner',
			'NLG' => 'Dutch Guilders',
			'XCD' => 'Eastern Caribbean Dollars',
			'EGP' => 'Egypt Pounds',
			'FJD' => 'Fiji Dollars',
			'FIM' => 'Finland Markka',
			'FRF' => 'France Francs',
			'DEM' => 'Germany Deutsche Marks',
			'XAU' => 'Gold Ounces',
			'GRD' => 'Greece Drachmas',
			'HKD' => 'Hong Kong Dollars',
			'HUF' => 'Hungary Forint',
			'ISK' => 'Iceland Krona',
			'INR' => 'India Rupees',
			'IDR' => 'Indonesia Rupiah',
			'IEP' => 'Ireland Punt',
			'ILS' => 'Israel New Shekels',
			'ITL' => 'Italy Lira',
			'JMD' => 'Jamaica Dollars',
			'JPY' => 'Japan Yen',
			'JOD' => 'Jordan Dinar',
			'KRW' => 'Korea (South) Won',
			'LBP' => 'Lebanon Pounds',
			'LUF' => 'Luxembourg Francs',
			'MYR' => 'Malaysia Ringgit',
			'MXP' => 'Mexico Pesos',
			'NLG' => 'Netherlands Guilders',
			'NZD' => 'New Zealand Dollars',
			'NOK' => 'Norway Kroner',
			'PKR' => 'Pakistan Rupees',
			'XPD' => 'Palladium Ounces',
			'PHP' => 'Philippines Pesos',
			'XPT' => 'Platinum Ounces',
			'PLZ' => 'Poland Zloty',
			'PTE' => 'Portugal Escudo',
			'ROL' => 'Romania Leu',
			'RUB' => 'Russia Rubles',
			'SAR' => 'Saudi Arabia Riyal',
			'XAG' => 'Silver Ounces',
			'SGD' => 'Singapore Dollars',
			'SKK' => 'Slovakia Koruna',
			'ZAR' => 'South Africa Rand',
			'KRW' => 'South Korea Won',
			'ESP' => 'Spain Pesetas',
			'XDR' => 'Special Drawing Right (IMF)',
			'SDD' => 'Sudan Dinar',
			'SEK' => 'Sweden Krona',
			'CHF' => 'Switzerland Francs',
			'TWD' => 'Taiwan Dollars',
			'THB' => 'Thailand Baht',
			'TTD' => 'Trinidad and Tobago Dollars',
			'TRL' => 'Turkey Lira',
			'VEB' => 'Venezuela Bolivar',
			'ZMK' => 'Zambia Kwacha',
			'EUR' => 'Euro',
			'XCD' => 'Eastern Caribbean Dollars',
			'XDR' => 'Special Drawing Right (IMF)',
			'XAG' => 'Silver Ounces',
			'XAU' => 'Gold Ounces',
			'XPD' => 'Palladium Ounces',
			'XPT' => 'Platinum Ounces',
		);
		?>
		<div class="form-group">
			<label  class="control-label"><?= __('admin.business_currency') ?></label>
			<select name="payment_currency" class="form-control" >
				<?php foreach ($business_currency as $c => $name) { ?>
					<option <?= $setting_data['payment_currency'] == $c ? 'selected="selected"' : '' ?> value="<?= $c ?>"><?= $name ?></option>
				<?php } ?>
			</select>
		</div>
<div class="form-group">
	<label class="control-label">Order Status</label>
	<select name="order_status" class="form-control">
		<?php foreach ($order_status as $order_status_id => $name) { ?>
			<?php if ($order_status_id == $setting_data['order_status']) { ?>
				<option value="<?php echo $order_status_id; ?>" selected="selected"><?= $name ?></option>
			<?php } else { ?>
				<option value="<?php echo $order_status_id; ?>"><?= $name ?></option>
			<?php } ?>
		<?php } ?>
	</select>
</div>

<div class="form-group">
	<label class="control-label">Pending Status</label>
	<select name="pending_status" class="form-control">
		<?php foreach ($order_status as $order_status_id => $name) { ?>
			<?php if ($order_status_id == $setting_data['pending_status']) { ?>
				<option value="<?php echo $order_status_id; ?>" selected="selected"><?= $name ?></option>
			<?php } else { ?>
				<option value="<?php echo $order_status_id; ?>"><?= $name ?></option>
			<?php } ?>
		<?php } ?>
	</select>
</div>

<div class="form-group">
	<label class="control-label">Canceled Status</label>
	<select name="canceled_status" class="form-control">
		<?php foreach ($order_status as $order_status_id => $name) { ?>
			<?php if ($order_status_id == $setting_data['canceled_status']) { ?>
				<option value="<?php echo $order_status_id; ?>" selected="selected"><?= $name ?></option>
			<?php } else { ?>
				<option value="<?php echo $order_status_id; ?>"><?= $name ?></option>
			<?php } ?>
		<?php } ?>
	</select>
</div>

<div class="form-group">
	<label class="control-label">Failed Status</label>
	<select name="failed_status" class="form-control">
		<?php foreach ($order_status as $order_status_id => $name) { ?>
			<?php if ($order_status_id == $setting_data['failed_status']) { ?>
				<option value="<?php echo $order_status_id; ?>" selected="selected"><?= $name ?></option>
			<?php } else { ?>
				<option value="<?php echo $order_status_id; ?>"><?= $name ?></option>
			<?php } ?>
		<?php } ?>
	</select>
</div>