<?php
/**
 * Admin notices for Loqate AU NZ Address.
 **/
if (!class_exists('WC_Mastersoft_Admin_Notices')) {

    class WC_Mastersoft_Admin_Notices
    {

        public function init()
        {

            function mastersoft_add_admin_notices()
            {
                $settings_url = get_admin_url() . 'admin.php?page=wc-settings&tab=mastersoft_settings_tab';
                $current_tab = $_GET['tab'];
                $licence_key = get_option('wc_mastersoft_settings_tab_licence_key');

                if (empty($licence_key)) {
                    if ($current_tab === 'mastersoft_settings_tab') {
?>
                        <div class="notice notice-error">
                            <p><strong>Licence Key is mandatory.</strong> Please log in or sign up to get your Licence Key.</p>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div id="mastesoft_admin_notices" class="notice notice-success is-dismissible">
                            <strong>Almost done!</strong> Configure <strong>Loqate AU NZ Address</strong>
                            <button class="button-primary" onclick="location.href='<?php echo $settings_url; ?>'" style="margin:10px;">
                                Set up your account
                            </button>
                        </div>
                        <?php
                    }
                }
            }

            add_action('admin_notices', 'mastersoft_add_admin_notices');
        }
    }
}

$wc_mastersoft_admin_notices = new WC_Mastersoft_Admin_Notices();
$wc_mastersoft_admin_notices->init();

                        ?>