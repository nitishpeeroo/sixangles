<?phpdefined("ABSPATH") or die("");
wp_enqueue_script('dup-handlebars');
require_once(DUPLICATOR_PRO_PLUGIN_PATH . '/classes/entities/class.global.entity.php');
require_once(DUPLICATOR_PRO_PLUGIN_PATH . '/assets/js/javascript.php');
require_once(DUPLICATOR_PRO_PLUGIN_PATH . '/views/inc.header.php');
require_once(DUPLICATOR_PRO_PLUGIN_PATH . '/classes/class.scan.check.php');
require_once(DUPLICATOR_PRO_PLUGIN_PATH . '/classes/ui/class.ui.dialog.php');

global $wp_version;
global $wpdb;

$action_response	= null;

$txt_found			= DUP_PRO_U::__("Found");
$txt_not_found		= DUP_PRO_U::__("Removed");

$view_state			= DUP_PRO_UI_ViewState::getArray();
$ui_css_srv_panel	= (isset($view_state['dup-settings-diag-srv-panel']) && $view_state['dup-settings-diag-srv-panel']) ? 'display:block' : 'display:none';
$ui_css_opts_panel	= (isset($view_state['dup-settings-diag-opts-panel']) && $view_state['dup-settings-diag-opts-panel']) ? 'display:block' : 'display:none';
$installer_files	= DUP_PRO_Server::getInstallerFiles();
$orphaned_filepaths	= DUP_PRO_Server::getOrphanedPackageFiles();
$scan_run			= (isset($_POST['action']) && $_POST['action'] == 'duplicator_recursion') ? true :false;
$archive_file		 = (isset($_GET['package'])) ? esc_html($_GET['package']) : '';
$archive_path		 = empty($archive_file) ? '' : DUPLICATOR_PRO_WPROOTPATH . $archive_file;
$long_installer_path = (isset($_GET['installer_name'])) ? DUPLICATOR_PRO_WPROOTPATH . esc_html($_GET['installer_name']) : '';

//POST BACK
$action_updated = null;
$_REQUEST['action'] = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'display';

if (isset($_REQUEST['action']))
{
    switch ($_REQUEST['action'])
    {
        case 'duplicator_pro_tools' :
			$action_response = DUP_PRO_U::__('Plugin settings reset.');
            break;
        case 'duplicator_pro_ui_view_state' :
			$action_response = DUP_PRO_U::__('View state settings reset.');
            break;
        case 'duplicator_pro_package_active' :
			$action_response = DUP_PRO_U::__('Active package settings reset.');
            break;
        case 'installer' :
			$action_response = DUP_PRO_U::__('Installer file cleanup ran!');
			$css_hide_msg = 'div#dpro-global-error-reserved-files {display:none}';
            break;
		case 'purge-orphans':
			$action_response = DUP_PRO_U::__('Cleaned up orphaned package files!');
			break;
        case 'tmp-cache':
            DUP_PRO_Package::tmp_cleanup(true);
            $action_response = DUP_PRO_U::__('Build cache removed.');
            break;
    }
}
?>

<style>
    <?php echo isset($css_hide_msg) ? $css_hide_msg : ''; ?>
	div#message {margin:0px 0px 10px 0px}
    td.dpro-settings-diag-header {background-color:#D8D8D8; font-weight: bold; border-style: none; color:black}
    table.widefat th {font-weight:bold; }
    table.widefat td {padding:2px 2px 2px 8px; }
    table.widefat td:nth-child(1) {width:10px;}
    table.widefat td:nth-child(2) {padding-left: 20px; width:100% !important}
    textarea.dup-opts-read {width:100%; height:40px; font-size:12px}
	button.dpro-store-fixed-btn {min-width: 155px; text-align: center}
    div.success {color:#4A8254}
    div.failed {color:red}
    table.dpro-reset-opts td:first-child {font-weight: bold}
    table.dpro-reset-opts td {padding:4px}
	div#dpro-tools-delete-moreinfo {display: none; padding: 5px 0 0 20px; border:1px solid #dfdfdf;  border-radius: 5px; padding:10px; margin:5px; width:98% }
	div#dpro-tools-delete-orphans-moreinfo {display: none; padding: 5px 0 0 20px; border:1px solid #dfdfdf;  border-radius: 5px; padding:10px; margin:5px; width:98% }

	/*PHP_INFO*/
	div#dpro-phpinfo {padding:10px 5px;}
    div#dpro-phpinfo table {padding:1px; background:#dfdfdf; -webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px; width:100% !important; box-shadow:0 8px 6px -6px #777;}
    div#dpro-phpinfo td, th {padding:3px; background:#fff; -webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px;}
    div#dpro-phpinfo tr.h img {display:none;}
    div#dpro-phpinfo tr.h td {background:none;}
    div#dpro-phpinfo tr.h th {text-align:center; background-color:#efefef;}
    div#dpro-phpinfo td.e {font-weight:bold}
</style>

<form id="dup-settings-form" action="<?php echo self_admin_url('admin.php?page=duplicator-pro-tools&tab=diagnostics'); ?>" method="post">
    <?php wp_nonce_field('duplicator_pro_settings_page'); ?>
    <input type="hidden" id="dup-settings-form-action" name="action" value="">
    <br/>

    <?php if (!empty($action_response)) : ?>
        <div id="message" class="updated below-h2"><p><?php echo $action_response; ?></p>
		<?php if ($_REQUEST['action'] != 'display') : ?>
			<?php if ($_REQUEST['action'] == 'installer') : ?>
				<?php
				$html = "";

				foreach ($installer_files as $filename => $path) {
					if (is_file($path)) {
						DUP_PRO_IO::deleteFile($path);
					} else if (is_dir($path)) {
                        // Extra protection to ensure we only are deleting the installer directory
                        if(DUP_PRO_STR::contains($path, 'dpro-installer')) {
                            if(file_exists("{$path}/archive.cfg")) {
                                DUP_PRO_IO::deleteTree($path);
                            } else {
                                DUP_PRO_LOG::trace("Was going to delete {$path} but archive.cfg doesn't exist!");
                            }
                        }
                        else {
                            DUP_PRO_LOG::trace("Attempted to delete $path but it isn't the dpro-installer directory!");
                        }
					}

					echo (file_exists($path))
						? "<div class='failed'><i class='fa fa-exclamation-triangle'></i> {$txt_found} - {$path}  </div>"
						: "<div class='success'> <i class='fa fa-check'></i> {$txt_not_found} - {$path}	</div>";
				}

				//No way to know exact name of archive file except from installer.
				//The only place where the package can be remove is from installer
				//So just show a message if removing from plugin.
				if (!empty($archive_path)) {
					$path_parts	 = pathinfo($archive_path);
					$path_parts	 = (isset($path_parts['extension'])) ? $path_parts['extension'] : '';
					if ((($path_parts == "zip") || ($path_parts == "daf")) && !is_dir($archive_path)) {
						@unlink($archive_path);
						$html .= (file_exists($archive_path))
							? "<div class='failed'><i class='fa fa-exclamation-triangle'></i> {$txt_found} - {$archive_path}  </div>"
							: "<div class='success'> <i class='fa fa-check'></i> {$txt_not_found} - {$archive_path}	</div>";
					} else {
						$html .= "<div class='failed'>Does not exist or unable to remove archive file.  Please validate that an archive file exists.</div>";
					}
				} else {
					$html .= '<div><br/>It is recommended to remove your archive file from the root of your WordPress install.  This may need to be removed manually if it exists.</div>';
				}

				//Long Installer Check
				if (!empty($long_installer_path) && $long_installer_path != $installer_files['installer.php']) {
					$path_parts	 = pathinfo($long_installer_path);
					$path_parts	 = (isset($path_parts['extension'])) ? $path_parts['extension'] : '';
					if ($path_parts == "php" && !is_dir($long_installer_path)) {
						@unlink($long_installer_path);
						$html .= (file_exists($long_installer_path))
								? "<div class='failed'><i class='fa fa-exclamation-triangle'></i> {$txt_found} - {$long_installer_path}  </div>"
								: "<div class='success'> <i class='fa fa-check'></i> {$txt_not_found} - {$long_installer_path}	</div>";
					}
				}

				echo $html;
				?>
				<br/>

				<i>
					<?php DUP_PRO_U::_e('If the installation files did not successfully get removed, then you WILL need to remove them manually') ?>. <br/>
					<?php DUP_PRO_U::_e('Please remove all installation files to avoid leaving open security issues on your server') ?>. <br/><br/>
				</i>
			<?php elseif ($_REQUEST['action'] == 'purge-orphans') :?>
				<?php
				$html = "";

				foreach($orphaned_filepaths as $filepath) {
					@unlink($filepath);
					echo (file_exists($filepath))
						? "<div class='failed'><i class='fa fa-exclamation-triangle'></i> {$filepath}  </div>"
						: "<div class='success'> <i class='fa fa-check'></i> {$filepath} </div>";
				}

				echo $html;
				$orphaned_filepaths		= DUP_PRO_Server::getOrphanedPackageFiles();
				?>
				<br/>

				<i><?php DUP_PRO_U::_e('If any orphaned files didn\'t get removed then delete them manually') ?>. <br/><br/></i>
			<?php endif; ?>
		<?php endif; ?>
        </div>
    <?php endif; ?>

   

   







	
	<?php
		include_once 'inc.data.php';
		include_once 'inc.settings.php';
		include_once 'inc.validator.php';
		include_once 'inc.phpinfo.php';
	?>




</form>

<script>
    jQuery(document).ready(function ($) {

        DupPro.Settings.DeleteOption = function (anchor) {
            var key = $(anchor).text();
            var result = confirm('<?php DUP_PRO_U::_e("Delete this option value", "wpduplicator"); ?> [' + key + '] ?');
            if (!result)
                return;

            jQuery('#dup-settings-form-action').val(key);
            jQuery('#dup-settings-form').submit();
        };


        DupPro.Tools.removeOrphans = function () {
            window.location = '?page=duplicator-pro-tools&tab=diagnostics&action=purge-orphans';
        };

		DupPro.Tools.removeInstallerFiles = function () {
            window.location = '<?php echo "?page=duplicator-pro-tools&tab=diagnostics&action=installer&package={$archive_file}&installer_name={$long_installer_path}"; ?>';
        };


        DupPro.Tools.ClearBuildCache = function () {
			<?php
			$msg = DUP_PRO_U::__('This process will remove all build cache files.  Be sure no packages are currently building or else they will be cancelled.');
			?>
            var result = true;
            var result = confirm('<?php echo $msg ?>');
            if (!result)
                return;
            window.location = '?page=duplicator-pro-tools&tab=diagnostics&action=tmp-cache';
        };



		DupPro.Tools.Recursion = function()
		{
			var result = confirm('<?php DUP_PRO_U::_e('This will run the scan validation check.  This may take several minutes.\nDo you want to Continue?'); ?>');
			if (! result) 	return;

			jQuery('#dup-settings-form-action').val('duplicator_recursion');
			jQuery('#scan-run-btn').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> Running Please Wait...');
			jQuery('#dup-settings-form').submit();
		}

		<?php
			if ($scan_run) {
				echo "$('#duplicator-scan-results-1').html($('#duplicator-scan-results-2').html())";
			}
		?>

    });
</script>