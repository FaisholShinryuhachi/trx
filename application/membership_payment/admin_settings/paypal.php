<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label><?= __('admin.paypal_api_username') ?></label>
			<input name="api_username" class="form-control" value="<?php echo $setting_data['api_username']; ?>">
		</div>
		<div class="form-group">
			<label><?= __('admin.paypal_api_password') ?></label>
			<input name="api_password" class="form-control" value="<?php echo $setting_data['api_password']; ?>">
		</div>
		<div class="form-group">
			<label><?= __('admin.paypal_api_signature') ?></label>
			<input name="api_signature" class="form-control" value="<?php echo $setting_data['api_signature']; ?>">
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
			'RUR' => 'Russia Rubles',
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
			<label  class="control-label"><?= __('admin.mode') ?></label>
			<div class="">
				<div class="radio-inline">
					<label>
						<input type="radio" name="payment_mode"  value="live" <?php echo $setting_data['payment_mode'] == 'live' ? 'checked' : '' ?> >
						<?= __('admin.live') ?>
					</label>
				</div>
				<div class="radio-inline">
					<label>
						<input type="radio" name="payment_mode"  value="sandbox" <?php echo $setting_data['payment_mode'] == 'sandbox' ? 'checked' : '' ?> >
						<?= __('admin.sandbox') ?>
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="well">
			<div class="form-group">
				<label class="control-label">Denied Status</label>
				<div class="">
					<select name="denied_status_id" class="form-control">
						<?php foreach ($status_list as $status_id => $name) { ?>
							<?php if ($status_id == $setting_data['denied_status_id']) { ?>
								<option value="<?php echo $status_id; ?>" selected="selected"><?= $name ?></option>
							<?php } else { ?>
								<option value="<?php echo $status_id; ?>"><?= $name ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label">Pending Status</label>
				<div class="">
					<select name="pending_status_id" class="form-control">
						<?php foreach ($status_list as $status_id => $name) { ?>
							<?php if ($status_id == $setting_data['pending_status_id']) { ?>
								<option value="<?php echo $status_id; ?>" selected="selected"><?= $name ?></option>
							<?php } else { ?>
								<option value="<?php echo $status_id; ?>"><?= $name ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label">Processing Status</label>
				<div class="">
					<select name="processing_status_id" class="form-control">
						<?php foreach ($status_list as $status_id => $name) { ?>
							<?php if ($status_id == $setting_data['processing_status_id']) { ?>
								<option value="<?php echo $status_id; ?>" selected="selected"><?= $name ?></option>
							<?php } else { ?>
								<option value="<?php echo $status_id; ?>"><?= $name ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label">Success Status</label>
				<div class="">
					<select name="success_status_id" class="form-control">
						<?php foreach ($status_list as $status_id => $name) { ?>
							<?php if ($status_id == $setting_data['success_status_id']) { ?>
								<option value="<?php echo $status_id; ?>" selected="selected"><?= $name ?></option>
							<?php } else { ?>
								<option value="<?php echo $status_id; ?>"><?= $name ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label">Canceled Status</label>
				<div class="">
					<select name="canceled_status_id" class="form-control">
						<?php foreach ($status_list as $status_id => $name) { ?>
							<?php if ($status_id == $setting_data['canceled_status_id']) { ?>
								<option value="<?php echo $status_id; ?>" selected="selected"><?= $name ?></option>
							<?php } else { ?>
								<option value="<?php echo $status_id; ?>"><?= $name ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>