<h4 class="ai1ec-section-title"><?php _e( 'Event location details', AI1EC_PLUGIN_NAME ); ?></h4>
<table class="ai1ec-form ai1ec-location-form">
	<tbody>
		<tr>
			<td class="ai1ec-first">
				<label for="ai1ec_venue">
					<?php _e( 'Venue name:', AI1EC_PLUGIN_NAME ); ?>
				</label>
			</td>
			<td>
				<input type="text" name="ai1ec_venue" id="ai1ec_venue" value="<?php echo $venue; ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="ai1ec_address">
					<?php _e( 'Address:', AI1EC_PLUGIN_NAME ); ?>
				</label>
			</td>
			<td>
				<input type="text" name="ai1ec_address" id="ai1ec_address" value="<?php echo $address; ?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="ai1ec_google_map">
					<?php _e( 'Show Google Map:', AI1EC_PLUGIN_NAME ); ?>
				</label>
			</td>
			<td>
				<input type="checkbox" value="1" name="ai1ec_google_map" id="ai1ec_google_map" <?php echo $google_map; ?> />
			</td>
		</tr>
	</tbody>
</table>
<div class="ai1ec_box_map <?php if( $show_map ) echo 'ai1ec_box_map_visible' ?>">
	<div id="ai1ec_map_canvas"></div>
</div>
<input type="hidden" name="ai1ec_city" 				id="ai1ec_city" 				value="<?php echo $city; ?>" />
<input type="hidden" name="ai1ec_province" 		id="ai1ec_province" 		value="<?php echo $province; ?>" />
<input type="hidden" name="ai1ec_postal_code" id="ai1ec_postal_code"	value="<?php echo $postal_code; ?>" />
<input type="hidden" name="ai1ec_country" 		id="ai1ec_country" 			value="<?php echo $country; ?>" />
