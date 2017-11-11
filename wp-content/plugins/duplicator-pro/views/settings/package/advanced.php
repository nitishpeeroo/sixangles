<?php
defined("ABSPATH") or die("");

$_REQUEST['ajax_protocol'] = isset($_REQUEST['ajax_protocol']) ? $_REQUEST['ajax_protocol'] : 'admin';
$_REQUEST['lock_mode']     = isset($_REQUEST['lock_mode'])     ? $_REQUEST['lock_mode']     : 0;

//SAVE RESULTS
if (isset($_POST['action']) && $_POST['action'] == 'save') {
	check_admin_referer($nonce_action);

	//ADVANCED
	$global->lock_mode					 = (int) $_REQUEST['lock_mode'];
	$global->json_mode					 = (int) $_REQUEST['json_mode'];

	$global->ajax_protocol				 = $_REQUEST['ajax_protocol'];
	$global->custom_ajax_url			 = $_REQUEST['custom_ajax_url'];
	$global->clientside_kickoff			 = isset($_REQUEST['_clientside_kickoff']);

    // Auto setting the max package runtime in case of client kickoff is turned off and the max package runtime is less than 180 minutes - 3 hours
	if($global->clientside_kickoff && $global->max_package_runtime_in_min < 180 ) {
		$global->max_package_runtime_in_min = 180;
	}

    $global->basic_auth_enabled			 = isset($_REQUEST['_basic_auth_enabled']) ? 1 : 0;
	if ($global->basic_auth_enabled == true) {
		$global->basic_auth_user	 = trim($_REQUEST['basic_auth_user']);
		$sglobal->basic_auth_password = $_REQUEST['basic_auth_password'];
	} else {
		$global->basic_auth_user	 = '';
		$sglobal->basic_auth_password = '';
	}
	$global->basic_auth_enabled	 = isset($_REQUEST['_basic_auth_enabled']) ? 1 : 0;
	$global->installer_base_name = isset($_REQUEST['_installer_base_name']) ? $_REQUEST['_installer_base_name'] : 'installer.php';

	$action_updated = $global->save();
    $sglobal->save();

	$global->adjust_settings_for_system();
}

?>

<!-- ===============================
ADVANCED SETTINGS -->
<form id="dup-settings-form" action="<?php echo self_admin_url('admin.php?page=' . DUP_PRO_Constants::$SETTINGS_SUBMENU_SLUG . "&section={$section}"); ?>" method="post" data-parsley-validate>
    <?php wp_nonce_field($nonce_action); ?>
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="page"   value="<?php echo DUP_PRO_Constants::$SETTINGS_SUBMENU_SLUG ?>">
    <input type="hidden" name="tab"   value="package">

    <?php if ($action_updated) : ?>
        <div id="message" class="updated below-h2"><p><?php echo $action_response; ?></p></div><br/>
    <?php endif; ?>

    <h3 class="title"><?php DUP_PRO_U::_e("Advanced") ?> </h3>
    <hr size="1" />
	<p class="description" style="color:maroon">
		<?php DUP_PRO_U::_e("Do not modify advanced settings unless you know the expected result or have talked to support."); ?>
	</p>
    <table class="form-table">
		<tr>
            <th scope="row"><label><?php DUP_PRO_U::_e("Thread Lock"); ?></label></th>
            <td>
                <input type="radio" name="lock_mode" value="<?php echo DUP_PRO_Thread_Lock_Mode::Flock; ?>" <?php echo DUP_PRO_UI::echoChecked($global->lock_mode == DUP_PRO_Thread_Lock_Mode::Flock); ?> />
                <label for="lock_mode"><?php DUP_PRO_U::_e("File"); ?></label> &nbsp;
                <input type="radio" name="lock_mode" value="<?php echo DUP_PRO_Thread_Lock_Mode::SQL_Lock; ?>" <?php echo DUP_PRO_UI::echoChecked($global->lock_mode == DUP_PRO_Thread_Lock_Mode::SQL_Lock); ?> />
                <label for="lock_mode"><?php DUP_PRO_U::_e("SQL"); ?></label> &nbsp;
            </td>
        </tr>
		<tr>
            <th scope="row"><label><?php DUP_PRO_U::_e("JSON"); ?></label></th>
            <td>
                <input type="radio" name="json_mode" value="<?php echo DUP_PRO_JSON_Mode::PHP; ?>" <?php echo DUP_PRO_UI::echoChecked($global->json_mode == DUP_PRO_JSON_Mode::PHP); ?> />
                <label for="json_mode"><?php DUP_PRO_U::_e("PHP"); ?></label> &nbsp;
                <input type="radio" name="json_mode" value="<?php echo DUP_PRO_JSON_Mode::Custom; ?>" <?php echo DUP_PRO_UI::echoChecked($global->json_mode == DUP_PRO_JSON_Mode::Custom); ?> />
                <label for="json_mode"><?php DUP_PRO_U::_e("Custom"); ?></label> &nbsp;
            </td>
        </tr>
		<tr>
            <th scope="row"><label><?php DUP_PRO_U::_e("Ajax"); ?></label></th>
            <td>
                <input type="radio" name="ajax_protocol" value="admin" <?php echo DUP_PRO_UI::echoChecked($global->ajax_protocol == 'admin'); ?> />
                <label for="ajax_protocol"><?php DUP_PRO_U::_e("Auto"); ?></label> &nbsp;
                <input type="radio" name="ajax_protocol" value="http" <?php echo DUP_PRO_UI::echoChecked($global->ajax_protocol == 'http'); ?> />
                <label for="ajax_protocol"><?php DUP_PRO_U::_e("HTTP"); ?></label> &nbsp;
                <input type="radio" name="ajax_protocol"  value="https" <?php echo DUP_PRO_UI::echoChecked($global->ajax_protocol == 'https'); ?> />
                <label for="ajax_protocol"><?php DUP_PRO_U::_e("HTTPS"); ?></label> &nbsp;
                <input type="radio" name="ajax_protocol"  value="custom" <?php echo DUP_PRO_UI::echoChecked($global->ajax_protocol == 'custom'); ?> />
                <label for="ajax_protocol"><?php DUP_PRO_U::_e("Custom URL:"); ?></label> &nbsp;
                <input style="width:353px" type="text"id="custom_ajax_url" name="custom_ajax_url" placeholder="<?php DUP_PRO_U::_e('Consult support before changing.'); ?>" value="<?php echo $global->custom_ajax_url; ?>" />
                <p class="description">
					<?php DUP_PRO_U::_e("Used to kick off build worker. Only change if packages get stuck at start of build."); 	?>
                </p>
            </td>
        </tr>
		<tr valign="top">
            <th scope="row"><label><?php DUP_PRO_U::_e('Client-side Kickoff'); ?></label></th>
            <td>
                <input type="checkbox" name="_clientside_kickoff" id="_clientside_kickoff" <?php DUP_PRO_UI::echoChecked($global->clientside_kickoff); ?> />
                <label for="_clientside_kickoff"><?php DUP_PRO_U::_e("Enabled") ?> </label><br/>
				<p class="description">
					<?php DUP_PRO_U::_e('Initiate package build from client. Only check this if instructed to by Snap Creek support.'); ?>
                </p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><label><?php DUP_PRO_U::_e("Basic Auth"); ?></label></th>
            <td>
                <input type="checkbox" name="_basic_auth_enabled" id="_basic_auth_enabled" <?php DUP_PRO_UI::echoChecked($global->basic_auth_enabled); ?> />
                <label for="_basic_auth_enabled"><?php DUP_PRO_U::_e("Enabled") ?> </label><br/>
                <input style="margin-top:8px;width:200px;" class="wide-input" autocomplete="off"  placeholder="<?php DUP_PRO_U::_e('User'); ?>" type="text" name="basic_auth_user" id="basic_auth_user" value="<?php echo $global->basic_auth_user; ?>" />
                <input id='auth_password' autocomplete="off" style="width:200px;" class="wide-input"  placeholder="<?php DUP_PRO_U::_e('Password'); ?>" type="password" name="basic_auth_password" id="basic_auth_password" value="<?php echo $sglobal->basic_auth_password; ?>" />
                <label for="auth_password">
                    <i class="dpro-edit-info">
                        <input type="checkbox" onclick="DupPro.UI.TogglePasswordDisplay(this.checked, 'auth_password');" /> <?php DUP_PRO_U::_e('Show Password') ?>
                    </i>
                </label>
            </td>
        </tr>
		<tr valign="top">
            <th scope="row"><label><?php DUP_PRO_U::_e('Installer Name'); ?></label></th>
            <td>
               <input type="text" name="_installer_base_name" id="_installer_base_name" value="<?php echo $global->installer_base_name; ?>"
					  data-parsley-required
					  data-parsley-minlength="10"
					  data-parsley-errors-container="#installer_base_name_error_container" />
				<div id="installer_base_name_error_container" class="duplicator-error-container"></div>
				<p class="description">
					<?php DUP_PRO_U::_e('The base name of the installer file. Only change if host prevents using installer.php'); ?>
                </p>
            </td>
        </tr>
    </table>

    <p class="submit" style="margin: 20px 0px 0xp 5px;">
        <br/><input type="submit" name="submit" id="submit" class="button-primary" value="<?php DUP_PRO_U::_e('Save Package Settings') ?>" style="display: inline-block;" />
    </p>
</form>