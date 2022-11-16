<?php
/**
 * Woocommerce Settings for Mastersoft Address.
 **/
if (!class_exists('WC_Mastersoft_Settings_Tab')) {

    class WC_Mastersoft_Settings_Tab
    {

        /**
         * Bootstraps the class and hooks required actions & filters.
         */
        public static function init()
        {
            add_filter('woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50);
            add_action('woocommerce_settings_tabs_mastersoft_settings_tab', __CLASS__ . '::settings_tab');
            add_action('woocommerce_update_options_mastersoft_settings_tab', __CLASS__ . '::update_settings');
        }

        /**
         * Add a new settings tab to the WooCommerce settings tabs array.
         */
        public static function add_settings_tab($settings_tabs)
        {
            $settings_tabs['mastersoft_settings_tab'] = __('Mastersoft Address', 'woocommerce-mastersoft-settings-tab');
            return $settings_tabs;
        }

        /**
         * Uses the WooCommerce admin fields API to output settings via @see woocommerce_admin_fields() function.
         */
        public static function settings_tab()
        {
            woocommerce_admin_fields(self::get_settings());
        }

        /**
         * Uses the WooCommerce options API to save settings via @see woocommerce_update_options() function.
         */
        public static function update_settings()
        {
            woocommerce_update_options(self::get_settings());
        }

        /**
         * Get all the settings for this plugin for @see woocommerce_admin_fields() function.
         */
        public static function get_settings()
        {
            $settings = array(
                //General/Address section
                'section_title' => array(
                    'title'       => __('Mastersoft Address', 'woocommerce-mastersoft-settings-tab'),
                    'type'        => 'title',
                    'desc'        => 'Get started with a FREE Trial licence key - https://hosted.mastersoftgroup.com/console/#/.',
                    'id'          => 'wc_mastersoft_settings_tab_section_title'
                ),
                'console_button' => array(
                    'title'       => __('Log in or sign up now'),
                    'name'        => __('Get your Licence Key'),
                    'type'        => 'button',
                    'desc'        => __('Get your Licence Key now', 'woocommerce-mastersoft-settings-tab'),
                    'class'       => 'button-primary',
                    'id'          => 'wc_mastersoft_settings_tab_console_button',
                    'desc_tip'    => true,
                    'custom_attributes' => array(
                        'onclick' => "window.open('https://hosted.mastersoftgroup.com/console/#/signUp', '_blank')"
                    )
                ),
                'licence_key' => array(
                    'title'       => __('Licence Key', 'woocommerce-mastersoft-settings-tab'),
                    'type'        => 'text',
                    'desc'        => __('Must be in [username-without-domain:password] format.', 'woocommerce-mastersoft-settings-tab'),
                    'id'          => 'wc_mastersoft_settings_tab_licence_key',
                    'placeholder' => 'Get your Licence Key'
                ),
                'url' => array(
                    'title'       => __('URL', 'woocommerce-mastersoft-settings-tab'),
                    'type'        => 'text',
                    'desc'        => __('Default value if empty/blank: https://hosted.mastersoftgroup.com.', 'woocommerce-mastersoft-settings-tab'),
                    'id'          => 'wc_mastersoft_settings_tab_url',
                    'default'     => 'https://hosted.mastersoftgroup.com'
                ),
                'widget_layout' => array(
                    'title'       => __('Address Layout Options', 'woocommerce-mastersoft-settings-tab'),
                    'type'        => 'textarea',
                    'desc'        => __('Address layout options. Must be in valid JSON format. Choose "OPTIMISED" layout to replace detailed address fields with single address line. Preconfigured and default value: { "layout": "DEFAULT" }.'),
                    'id'          => 'wc_mastersoft_settings_tab_widget_layout',
                    'default'     => '{ "layout": "DEFAULT" }'
                ),
                'widget_options' => array(
                    'title'       => __('Default Widget Options', 'woocommerce-mastersoft-settings-tab'),
                    'type'        => 'textarea',
                    'desc'        => __('Must be in valid JSON format - http://developer.mastersoftgroup.com/harmony/api/object/address.html#FeatureOption. Preconfigured and default value: { "singleLineHitNumber": 5, "caseType": "TITLE" }.', 'woocommerce-mastersoft-settings-tab'),
                    'id'          => 'wc_mastersoft_settings_tab_widget_options',
                    'default'     => '{ "singleLineHitNumber": 5, "caseType": "TITLE" }'
                ),
                'widget_options_au' => array(
                    'title'       => __('Widget Options for AUSTRALIA', 'woocommerce-mastersoft-settings-tab'),
                    'type'        => 'textarea',
                    'desc'        => __('Must be in valid JSON format. If the same key is in the Default Widget Options, the value here will take precedence for AUSTRALIA. Preconfigured and default value: { "sot": "GNAF" }.', 'woocommerce-mastersoft-settings-tab'),
                    'id'          => 'wc_mastersoft_settings_tab_widget_options_au',
                    'default'     => '{ "sot": "GNAF" }'
                ),
                'widget_options_nz' => array(
                    'type'        => 'textarea',
                    'title'       => __('Widget Options for NEW ZEALAND', 'woocommerce-mastersoft-settings-tab'),
                    'desc'        => __('Must be in valid JSON format. If the same key is in the Default Widget Options, the value here will take precedence for NEW ZEALAND. Note: to populate the Region, sot must be "NZAD" and exposeAttributes must be "1". Preconfigured and default value: { "sot": "NZAD", "exposeAttributes": "1" }.', 'woocommerce-mastersoft-settings-tab'),
                    'id'          => 'wc_mastersoft_settings_tab_widget_options_nz',
                    'default'     => '{ "sot": "NZAD", "exposeAttributes": "1" }'
                ),
                'widget_options_enhanced_state' => array(
                    'title'      => __('Enhanced State/County/Region', 'woocommerce-mastersoft-settings-tab'),
                    'type'       => 'checkbox',
                    'desc'       => __('Enable this setting to make use of our comprehensive collection of state/county/region or the equivalent.', 'woocommerce-mastersoft-settings-tab'),
                    'id'         => 'wc_mastersoft_settings_tab_widget_options_enhanced_state',
                    'default'    => 'no'
                ),
                'section_end' => array(
                    'type'       => 'sectionend',
                    'id'         => 'wc_mastersoft_settings_tab_section_end'
                ),
                //Business Lookup section
                'section_title_biz' => array(
                    'title'       => __('Business Lookup', 'woocommerce-mastersoft-settings-tab'),
                    'type'        => 'title',
                    'id'          => 'wc_mastersoft_settings_tab_section_title_biz'
                ),
                'widget_options_business_enabled' => array(
                    'title'      => __('Business Lookup', 'woocommerce-mastersoft-settings-tab'),
                    'type'       => 'checkbox',
                    'desc'       => __('Enable business lookup.', 'woocommerce-mastersoft-settings-tab'),
                    'id'         => 'wc_mastersoft_settings_tab_widget_options_business_enabled',
                    'default'    => 'no'
                ),
                'widget_options_business' => array(
                    'title'      => __('Widget Options for Business Lookup', 'woocommerce-mastersoft-settings-tab'),
                    'type'       => 'textarea',
                    'desc'       => __('Must be in valid JSON format. If the same key is in the Default Widget Options, the value here will take precedence for Business Lookup. Preconfigured and default value: { "caseType": "TITLE", "hits": 5, "taxStatus": "", "bnStatus": "", "state": ["NSW","VIC","QLD","ACT","SA","WA","NT"], "nameTypes": ["MN","BN","TRD","OTN","LGL","DGR"] }', 'woocommerce-mastersoft-settings-tab'),
                    'id'         => 'wc_mastersoft_settings_tab_widget_options_business',
                    'default'    => '{ "caseType": "TITLE", "hits": 5, "taxStatus": "", "bnStatus": "", "state": ["NSW","VIC","QLD","ACT","SA","WA","NT"], "nameTypes": ["MN","BN","TRD","OTN","LGL","DGR"] }'
                ),
                'widget_options_business_display_retrieved_name' => array(
                    'title'      => __('Display Main/Legal Entity Name', 'woocommerce-mastersoft-settings-tab'),
                    'type'       => 'checkbox',
                    'desc'       => __('Enable this setting if you wish to populate main/legal entity name which might be different from the entity\'s alias name entered by user.', 'woocommerce-mastersoft-settings-tab'),
                    'id'         => 'wc_mastersoft_settings_tab_widget_options_business_display_retrieved_name',
                    'default'    => 'no'
                ),
                'section_end_biz' => array(
                    'type'       => 'sectionend',
                    'id'         => 'wc_mastersoft_settings_tab_section_end_biz'
                ),
                //Email Validation section
                'section_title_email' => array(
                    'title'       => __('Email Validation', 'woocommerce-mastersoft-settings-tab'),
                    'type'        => 'title',
                    'id'          => 'wc_mastersoft_settings_tab_section_title_email'
                ),
                'widget_options_email_enabled' => array(
                    'title'      => __('Email Validation', 'woocommerce-mastersoft-settings-tab'),
                    'type'       => 'checkbox',
                    'desc'       => __('Enable email validation.'),
                    'id'         => 'wc_mastersoft_settings_tab_widget_options_email_enabled',
                    'default'    => 'no'
                ),
                'widget_options_email' => array(
                    'title'      => __('Widget Options for Email Validation', 'woocommerce-mastersoft-settings-tab'),
                    'type'       => 'textarea',
                    'desc'       => __('Must be in valid JSON format. If the same key is in the Default Widget Options, the value here will take precedence for email validation. Preconfigured and default value: { "sot": "VE_ALL", "options": [ "FORMAT", "BLOCKLIST", "DOMAIN", "MAILSERVER", "MAILBOX" ] }.', 'woocommerce-mastersoft-settings-tab'),
                    'id'         => 'wc_mastersoft_settings_tab_widget_options_email',
                    'default'    => '{ "sot": "VE_ALL", "options": [ "FORMAT", "BLOCKLIST", "DOMAIN", "MAILSERVER", "MAILBOX" ] }'
                ),
                'section_end_email' => array(
                    'type'       => 'sectionend',
                    'id'         => 'wc_mastersoft_settings_tab_section_end_email'
                ),
                //Phone Validation section
                'section_title_phone' => array(
                    'title'       => __('Phone Validation', 'woocommerce-mastersoft-settings-tab'),
                    'type'        => 'title',
                    'id'          => 'wc_mastersoft_settings_tab_section_title_phone'
                ),
                'widget_options_phone_enabled' => array(
                    'title'      => __('Phone Validation', 'woocommerce-mastersoft-settings-tab'),
                    'type'       => 'checkbox',
                    'desc'       => __('Enable phone validation.'),
                    'id'         => 'wc_mastersoft_settings_tab_widget_options_phone_enabled',
                    'default'    => 'no'
                ),
                'section_end_phone' => array(
                    'type'       => 'sectionend',
                    'id'         => 'wc_mastersoft_settings_tab_section_end_phone'
                )
            );
            return apply_filters('wc_mastersoft_settings_tab_settings', $settings);
        }
    }
}
function mastersoft_add_admin_field_button($value)
{
    $option_value = (array) WC_Admin_Settings::get_option($value['id']);
    $description = WC_Admin_Settings::get_field_description($value);

?>
<tr valign="top">
    <th scope="row" class="titledesc">
        <label for="<?php echo esc_attr($value['id']); ?>">
            <?php echo esc_html($value['title']); ?>
        </label>
        <?php echo $description['tooltip_html']; ?>
    </th>

    <td class="forminp forminp-<?php echo sanitize_title($value['type']) ?>">
        <input name="<?php echo esc_attr($value['name']); ?>" id="<?php echo esc_attr($value['id']); ?>"
            type="button" style="<?php echo esc_attr($value['css']); ?>"
            value="<?php echo esc_attr($value['name']); ?>" class="<?php echo esc_attr($value['class']); ?>"
            onclick="<?php echo $value['custom_attributes']['onclick']; ?>" />
        <?php echo $description['description']; ?>
    </td>
</tr>
<?php
}

add_action('woocommerce_admin_field_button', 'mastersoft_add_admin_field_button');

WC_Mastersoft_Settings_Tab::init();

    ?>