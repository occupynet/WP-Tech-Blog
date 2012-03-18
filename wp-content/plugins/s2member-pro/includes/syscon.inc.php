<?php
/**
* System configuration for s2Member Pro.
*
* **WARNING:** This is a system configuration file, please DO NOT EDIT this file directly.
* 	Instead, use the plugin options panel in WordPress® to override these settings.
*
* Copyright: © 2009-2011
* {@link http://www.websharks-inc.com/ WebSharks, Inc.}
* ( coded in the USA )
*
* This WordPress® plugin ( s2Member Pro ) is comprised of two parts:
*
* o (1) Its PHP code is licensed under the GPL license, as is WordPress®.
* 	You should have received a copy of the GNU General Public License,
* 	along with this software. In the main directory, see: /licensing/
* 	If not, see: {@link http://www.gnu.org/licenses/}.
*
* o (2) All other parts of ( s2Member Pro ); including, but not limited to:
* 	the CSS code, some JavaScript code, images, and design;
* 	are licensed according to the license purchased.
* 	See: {@link http://www.s2member.com/prices/}
*
* Unless you have our prior written consent, you must NOT directly or indirectly license,
* sub-license, sell, resell, or provide for free; part (2) of the s2Member Pro Module;
* or make an offer to do any of these things. All of these things are strictly
* prohibited with part (2) of the s2Member Pro Module.
*
* Your purchase of s2Member Pro includes free lifetime upgrades via s2Member.com
* ( i.e. new features, bug fixes, updates, improvements ); along with full access
* to our video tutorial library: {@link http://www.s2member.com/videos/}
*
* @package s2Member
* @since 1.0
*/
if(realpath(__FILE__) === realpath($_SERVER["SCRIPT_FILENAME"]))
	exit("Do not access this file directly.");
/*
Determine the directory.
*/
$GLOBALS["WS_PLUGIN__"]["s2member_pro"]["c"]["dir"] = dirname(dirname(__FILE__));
/*
Determine the base directory name.
*/
$GLOBALS["WS_PLUGIN__"]["s2member_pro"]["c"]["dir_base"] = basename(dirname(dirname(__FILE__)));
/*
Determine full URL to the directory this plugin resides in.
*/
$GLOBALS["WS_PLUGIN__"]["s2member_pro"]["c"]["dir_url"] = (stripos(__FILE__, WP_CONTENT_DIR) !== 0) ? /* Have to assume plugins dir? */
plugins_url("/".basename(dirname(dirname(__FILE__)))) : /* Otherwise, this gives it a chance to live anywhere in the content dir. */
content_url(preg_replace("/^(.*?)\/".preg_quote(basename(WP_CONTENT_DIR), "/")."/", "", str_replace(DIRECTORY_SEPARATOR, "/", dirname(dirname(__FILE__)))));
/*
Determine correct ``plugin_basename()`` here. WordPress® has a few issues with its ``plugin_basename()`` function across different platforms.
*/
$GLOBALS["WS_PLUGIN__"]["s2member_pro"]["c"]["plugin_basename"] = basename(dirname($GLOBALS["WS_PLUGIN__"]["s2member_pro"]["l"]))."/".basename($GLOBALS["WS_PLUGIN__"]["s2member_pro"]["l"]);
/*
Turn upsells & donations off in menu pages of back-end adminstrative panels.
*/
$GLOBALS["WS_PLUGIN__"]["s2member"]["c"]["menu_pages"] = array_merge($GLOBALS["WS_PLUGIN__"]["s2member"]["c"]["menu_pages"], array("upsell-pro" => false));
/*
Configure checksum time for both of the syscon.inc.php files.
*/
$GLOBALS["WS_PLUGIN__"]["s2member"]["c"]["checksum"] = $GLOBALS["WS_PLUGIN__"]["s2member"]["c"]["checksum"] + filemtime(__FILE__);
/*
Configure the number of Membership Levels being used on this installation.
*/
if(defined("MEMBERSHIP_LEVELS") && is_numeric(MEMBERSHIP_LEVELS))
	if(MEMBERSHIP_LEVELS >= $GLOBALS["WS_PLUGIN__"]["s2member"]["c"]["min_levels"] && MEMBERSHIP_LEVELS <= $GLOBALS["WS_PLUGIN__"]["s2member"]["c"]["max_levels"])
		$GLOBALS["WS_PLUGIN__"]["s2member"]["c"]["levels"] = (int)MEMBERSHIP_LEVELS;
/*
Add some new default options for the Pro Module.
*/
if(!function_exists("ws_plugin__s2member_pro_default_options"))
	{
		add_filter("ws_plugin__s2member_default_options", "ws_plugin__s2member_pro_default_options");
		/**
		* Configures default options array for s2Member Pro.
		*
		* **WARNING:** This is a system configuration function, please DO NOT EDIT this function directly.
		* 	Instead, use the plugin options panel in WordPress® to override these settings.
		*
		* @package s2Member
		* @since 1.0
		*
		* @param array $default_options Expects an array of default options passed in by the Filter.
		* @return array Merged with default options from the s2Member Framework.
		* 	All Pro options should be prefixed with `pro_`.
		*/
		function ws_plugin__s2member_pro_default_options($default_options = array())
			{
				$pro_default_options = array( /* Defaults for the Pro Module. */
				/**/
				"pro_signup_email_recipients" => '"%%full_name%%" <%%payer_email%%>',/**/
				"pro_signup_email_subject" => _x("Congratulations! ( your membership has been approved )", "s2member-front", "s2member"),/**/
				"pro_signup_email_message" => sprintf(_x("Thanks %%%%first_name%%%%! Your membership has been approved.\n\n%%%%item_name%%%%\n\nSubscr. ID: %%%%subscr_id%%%%\nCharges today: $%%%%initial%%%%\nRecurring charges: $%%%%recurring/regular_cycle%%%%\n\nYour Username/Password will arrive shortly, in a separate email. If you have any trouble, please feel free to contact us.\n\nBest Regards,\n%s", "s2member-front", "s2member"), get_bloginfo("name")),/**/
				/**/
				"pro_sp_email_recipients" => '"%%full_name%%" <%%payer_email%%>',/**/
				"pro_sp_email_subject" => _x("Thank You! ( instructions for access )", "s2member-front", "s2member"),/**/
				"pro_sp_email_message" => sprintf(_x("Thanks %%%%first_name%%%%!\n\n%%%%item_name%%%%\n\nTransaction ID: %%%%txn_id%%%%\nCharges today: $%%%%amount%%%%\n\nYour order can be retrieved here:\n%%%%sp_access_url%%%%\n( link expires in %%%%sp_access_exp%%%% )\n\nIf you have any trouble, please feel free to contact us.\n\nBest Regards,\n%s", "s2member-front", "s2member"), get_bloginfo("name")),/**/
				/**/
				"pro_coupon_codes" => "", /* There are NO Coupon Codes by default. */ "pro_default_tax" => "0.0%", "pro_tax_rates" => "",/**/
				"pro_affiliate_coupon_code_tracking_urls" => "", /* A line-delimited list of Coupon Code tracking URLs. */
				"pro_affiliate_coupon_code_suffix_chars" => "-A:", /* Chars indicating an Affiliate Coupon Code suffix. */
				"pro_login_welcome_page_otos" => "", /* A line-delimited list of Login Welcome Page offers. */
				/**/
				"pro_gateways_enabled" => array("paypal"), /* Defaults to PayPal® Pro. */
				"pro_paypal_checkout_rdp" => "0", "pro_paypal_return_template_header" => "",/**/
				"pro_alipay_seller_email" => "", "pro_alipay_partner_id" => "", "pro_alipay_security_code" => "", "pro_alipay_return_template_header" => "",/**/
				"pro_authnet_api_login_id" => "", "pro_authnet_api_trans_key" => "", "pro_authnet_api_salt_key" => "", "pro_authnet_sandbox" => "0",/**/
				"pro_ccbill_client_id" => "", "pro_ccbill_client_sid" => "0000", "pro_ccbill_form_name" => "", "pro_ccbill_dl_user" => "", "pro_ccbill_dl_pass" => "", "pro_ccbill_dl_cancellations" => "0", "pro_ccbill_salt_key" => "", "pro_ccbill_return_template_header" => "",/**/
				"pro_clickbank_username" => "", "pro_clickbank_clerk_key" => "", "pro_clickbank_developer_key" => "", "pro_clickbank_secret_key" => "", "pro_clickbank_return_template_header" => "",/**/
				"pro_google_merchant_id" => "", "pro_google_merchant_key" => "", "pro_google_sandbox" => "0",/**/
				/**/
				"pro_recaptcha_public_key" => "", "pro_recaptcha_private_key" => "");
				/**/
				return array_merge($default_options, $pro_default_options);
			}
	}
/*
Check/validate default options for the Pro Module.
*/
if(!function_exists("ws_plugin__s2member_pro_options_before_checksum"))
	{
		add_filter("ws_plugin__s2member_options_before_checksum", "ws_plugin__s2member_pro_options_before_checksum");
		/**
		* Configures options array; while handling s2Member Pro options.
		*
		* **WARNING:** This is a system configuration function, please DO NOT EDIT this function directly.
		* 	Instead, use the plugin options panel in WordPress® to override these settings.
		*
		* @package s2Member
		* @since 1.0
		*
		* @param array $options Expects an array of options, by reference, passed in by the Filter.
		* 	``$GLOBALS["WS_PLUGIN__"]["s2member"]["o"]``, by reference.
		* @return array Merged with options from the s2Member Framework.
		* 	All Pro options should be prefixed with `pro_`.
		*/
		function ws_plugin__s2member_pro_options_before_checksum(&$options = array())
			{
				$pro_default_options = ws_plugin__s2member_pro_default_options();
				/*
				Backward compatibility for "pro_paypal_default_tax"; renamed in v1.3.
				*/
				if(isset($options["pro_paypal_default_tax"]))
					$options["pro_default_tax"] = $options["pro_paypal_default_tax"];
				/*
				Backward compatibility for "pro_paypal_tax_rates"; renamed in v1.3.
				*/
				if(isset($options["pro_paypal_tax_rates"]))
					$options["pro_tax_rates"] = $options["pro_paypal_tax_rates"];
				/*
				Backward compatibility for "pro_other_gateways_enabled"; renamed in v1.5.
				*/
				if(isset($options["pro_other_gateways_enabled"]) && is_array($options["pro_other_gateways_enabled"]))
					$options["pro_gateways_enabled"] = array_unique(array_merge($options["pro_other_gateways_enabled"], $pro_default_options["pro_gateways_enabled"]));
				/**/
				foreach($options /* $GLOBALS["WS_PLUGIN__"]["s2member"]["o"] */ as $key => &$value)
					{
						if(isset($pro_default_options[$key]) || preg_match("/^pro_/", $key))
							{
								if(!isset($pro_default_options[$key]))
									unset($GLOBALS["WS_PLUGIN__"]["s2member"]["o"][$key]);
								/**/
								else if(preg_match("/^pro_(?:signup|sp)_email_recipients$/", $key) && !is_string($value))
									$value = $pro_default_options[$key];
								/**/
								else if(preg_match("/^pro_(?:signup|sp)_email_(?:subject|message)$/", $key) && (!is_string($value) || !strlen($value)))
									$value = $pro_default_options[$key];
								/**/
								else if(preg_match("/^pro_(?:coupon_codes|affiliate_coupon_code_(?:tracking_urls|suffix_chars))$/", $key) && (!is_string($value) || !strlen($value)))
									$value = $pro_default_options[$key];
								/**/
								else if($key === "pro_default_tax" && (!is_string($value) || !strlen($value)))
									$value = $pro_default_options[$key];
								/**/
								else if($key === "pro_tax_rates" && (!is_string($value) || !strlen($value)))
									$value = $pro_default_options[$key];
								/**/
								else if($key === "pro_login_welcome_page_otos" && (!is_string($value) || !strlen($value)))
									$value = $pro_default_options[$key];
								/**/
								else if($key === "pro_gateways_enabled" && !is_array($value))
									$value = $pro_default_options[$key];
								/**/
								else if($key === "pro_paypal_checkout_rdp" && (!is_string($value) || !is_numeric($value)))
									$value = $pro_default_options[$key];
								/**/
								else if($key === "pro_paypal_return_template_header" && (!is_string($value) || !strlen($value)))
									$value = $pro_default_options[$key];
								/**/
								else if(preg_match("/^pro_alipay_(?:seller_email|partner_id|security_code|return_template_header)$/", $key) && (!is_string($value) || !strlen($value)))
									$value = $pro_default_options[$key];
								/**/
								else if(preg_match("/^pro_authnet_(?:api_login_id|api_trans_key|api_salt_key)$/", $key) && (!is_string($value) || !strlen($value)))
									$value = $pro_default_options[$key];
								/**/
								else if(preg_match("/^pro_ccbill_(?:client_id|client_sid|form_name|dl_user|dl_pass|dl_cancellations|salt_key|return_template_header)$/", $key) && (!is_string($value) || !strlen($value)))
									$value = $pro_default_options[$key];
								/**/
								else if(preg_match("/^pro_clickbank_(?:username|clerk_key|developer_key|secret_key|return_template_header)$/", $key) && (!is_string($value) || !strlen($value)))
									$value = $pro_default_options[$key];
								/**/
								else if(preg_match("/^pro_google_(?:merchant_id|merchant_key)$/", $key) && (!is_string($value) || !strlen($value)))
									$value = $pro_default_options[$key];
								/**/
								else if(preg_match("/^pro_(?:google|authnet)_sandbox$/", $key) && (!is_string($value) || !is_numeric($value)))
									$value = $pro_default_options[$key];
								/**/
								else if(preg_match("/^pro_recaptcha_(?:public|private)_key$/", $key) && (!is_string($value) || !strlen($value)))
									$value = $pro_default_options[$key];
							}
					}
				/**/
				return $options; /* $GLOBALS["WS_PLUGIN__"]["s2member"]["o"] by reference. */
			}
	}
?>