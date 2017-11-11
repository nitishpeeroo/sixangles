<?phpdefined("ABSPATH") or die("");

/**
 * Used to display notices in the WordPress Admin area
 * This class takes advantage of the 'admin_notice' action.
 *
 * Standard: PSR-2
 * @link http://www.php-fig.org/psr/psr-2
 *
 * @package DUP_PRO
 * @subpackage classes/ui
 * @copyright (c) 2017, Snapcreek LLC
 * @license	https://opensource.org/licenses/GPL-3.0 GNU Public License
 *
 */
class DUP_PRO_UI_Notice
{

    /**
     * Shows a display message in the wp-admin if any reserved files are found
     *
     * @return null
     */
    public static function showReservedFilesNotice()
    {
        $dpro_active = is_plugin_active('duplicator-pro/duplicator-pro.php');
        $dup_perm    = current_user_can('manage_options');
        if (!$dpro_active || !$dup_perm) return;

        //Hide free error message if Pro is active
        if (is_plugin_active('duplicator/duplicator.php')) {
            echo "<style>div#dup-global-error-reserved-files {display:none}</style>";
        }

        $screen = get_current_screen();
        if (!isset($screen)) return;

        if (DUP_PRO_Server::hasInstallFiles()) {
			
            $on_active_tab = isset($_GET['tab']) && $_GET['tab'] == 'diagnostics' ? true : false;
            echo '<div class="updated notice" id="dpro-global-error-reserved-files"><p>';

			//On Diagnostics > Cleanup Page
            if ($screen->id == 'duplicator-pro_page_duplicator-pro-tools' && $on_active_tab) {

				$title = DUP_PRO_U::__('This site has been successfully migrated!');
				$msg1  = DUP_PRO_U::__('Please complete this final step:');
				$msg2  = DUP_PRO_U::__('This message will be removed after all installer files are removed.  Installer files must be removed to maintain a secure site.<br/>'
									. 'Click the link above or button below to remove all installer files and complete the migration.');
				
				echo "<b class='pass-msg'><i class='fa fa-check-circle'></i> {$title}</b> <br/> {$msg1} <br/>";
				@printf("<a href='javascript:void(0)' onclick='jQuery(\"#dpro-remove-installer-files-btn\").click()'>%s</a><br/>", DUP_PRO_U::__('Remove Installation Files Now!'));
				echo "<div class='pass-msg'>{$msg2}</div>";
				
			//All other Pages
            } else {

				$title = DUP_PRO_U::__('Migration Almost Complete!');
				$msg   = DUP_PRO_U::__('Reserved Duplicator Pro installation files have been detected in the root directory.  Please delete these installation files to '
						. 'avoid security issues. <br/> Go to: Tools > Diagnostics > Stored Data > and click the "Remove Installation Files" button');

				$nonce = wp_create_nonce('duplicator_pro_cleanup_page');
				$url   = self_admin_url('admin.php?page=duplicator-pro-tools&tab=diagnostics&_wpnonce='.$nonce);
				echo "<b>{$title}</b><br/> {$msg}";
				@printf("<br/><a href='{$url}'>%s</a>", DUP_PRO_U::__('Take me there now!'));
            }
            echo "</p></div>";
        }
    }
}