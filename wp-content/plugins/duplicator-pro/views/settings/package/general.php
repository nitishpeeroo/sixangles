<?php
defined("ABSPATH") or die("");

$max_execution_time			= ini_get("max_execution_time");
$max_execution_time			= empty($max_execution_time) ? 30 : $max_execution_time;
$max_worker_cap_in_sec		= (int) (0.7 * (float) $max_execution_time);
$is_zip_available			= (DUP_PRO_Zip_U::getShellExecZipPath() != null);
$is_shellexec_on			= DUP_PRO_Shell_U::isShellExecEnabled();
$beta_display				= '';// ($global->debug_beta) ? '' : 'display:none;';
$phpdump_chunkopts			= array("20", "100", "500", "1000", "2000");
$package_ui_created			= is_numeric($global->package_ui_created) ? $global->package_ui_created : 1;

$_REQUEST['_package_mysqldump_path'] = isset($_REQUEST['_package_mysqldump_path']) ? $_REQUEST['_package_mysqldump_path'] : '';

//SAVE RESULTS
if (isset($_POST['action']) && $_POST['action'] == 'save') {
	check_admin_referer($nonce_action);

	//VISUAL
	$global->package_ui_created			 = isset($_REQUEST['package_ui_created']) ? (int) $_REQUEST['package_ui_created'] : 1;

	//DATABASE
	$enable_mysqldump					 = isset($_REQUEST['_package_dbmode']) && $_REQUEST['_package_dbmode'] == 'mysql' ? "1" : "0";
	$global->package_mysqldump			 = $enable_mysqldump ? 1 : 0;
	$global->package_phpdump_qrylimit	 = isset($_REQUEST['_package_phpdump_qrylimit']) ? (int) $_REQUEST['_package_phpdump_qrylimit'] : 100;
	$global->package_mysqldump_path		 = trim($_REQUEST['_package_mysqldump_path']);

	//ARCHIVE
	DUP_PRO_U::initStorageDirectory();
	$global->archive_compression = isset($_REQUEST['archive_compression']) ? (bool) $_REQUEST['archive_compression'] : true;
	$prelim_build_mode = (int) $_REQUEST['archive_build_mode'];

	if (!$is_zip_available && ($prelim_build_mode == DUP_PRO_Archive_Build_Mode::Shell_Exec)) {
		// Something has changed which invalidates Shell exec so move it to ZA
		$global->archive_build_mode = DUP_PRO_Archive_Build_Mode::ZipArchive;
	} else {
		$global->archive_build_mode = $prelim_build_mode;
	}

	$global->ziparchive_mode		= isset($_REQUEST['ziparchive_mode']) ? (int) $_REQUEST['ziparchive_mode'] : 0;
	$global->ziparchive_validation	= isset($_REQUEST['ziparchive_validation']);
	if (isset($_REQUEST['ziparchive_chunk_size_in_mb'])) {
		$global->ziparchive_chunk_size_in_mb = (int) $_REQUEST['ziparchive_chunk_size_in_mb'];
	}

	//PROCESSING
	$global->max_package_runtime_in_min	 = (int) $_REQUEST['max_package_runtime_in_min'];
	$global->server_load_reduction		 = (int) $_REQUEST['server_load_reduction'];
	$global->php_max_worker_time_in_sec	 = $_REQUEST['php_max_worker_time_in_sec'];

	$action_updated = $global->save();
    $sglobal->save();
	$global->adjust_settings_for_system();
}

$mysqlDumpPath				= DUP_PRO_DB::getMySqlDumpPath();
$mysqlDumpFound				= ($mysqlDumpPath) ? true : false;

?>

<?php if ($action_updated) : ?>
	<div id="message" class="updated below-h2"><p><?php echo $action_response; ?></p></div>
	<br/>
<?php endif; ?>


<form id="dup-settings-form" action="<?php echo self_admin_url('admin.php?page=' . DUP_PRO_Constants::$SETTINGS_SUBMENU_SLUG); ?>" method="post" data-parsley-validate>
<?php wp_nonce_field($nonce_action); ?>
<input type="hidden" name="action" value="save">
<input type="hidden" name="page"   value="<?php echo DUP_PRO_Constants::$SETTINGS_SUBMENU_SLUG ?>">
<input type="hidden" name="tab"   value="package">

<!-- ===============================
VISUAL -->
<h3 class="title"><?php DUP_PRO_U::_e("Visual") ?> </h3>
<hr size="1" />
<table class="form-table">
	<tr valign="top">
		<th scope="row"><label><?php DUP_PRO_U::_e("Created Format"); ?></label></th>
		<td>
			<select name="package_ui_created" id="package_ui_created">
				<!-- YEAR -->
				<optgroup label="<?php DUP_PRO_U::_e("By Year"); ?>">
					<option value="1">Y-m-d H:i &nbsp;	[2000-01-05 12:00]</option>
					<option value="2">Y-m-d H:i:s		[2000-01-05 12:00:01]</option>
					<option value="3">y-m-d H:i &nbsp;	[00-01-05   12:00]</option>
					<option value="4">y-m-d H:i:s		[00-01-05   12:00:01]</option>
				</optgroup>
				<!-- MONTH -->
				<optgroup label="<?php DUP_PRO_U::_e("By Month"); ?>">
					<option value="5">m-d-Y H:i  &nbsp; [01-05-2000 12:00]</option>
					<option value="6">m-d-Y H:i:s		[01-05-2000 12:00:01]</option>
					<option value="7">m-d-y H:i  &nbsp; [01-05-00   12:00]</option>
					<option value="8">m-d-y H:i:s		[01-05-00   12:00:01]</option>
				</optgroup>
				<!-- DAY -->
				<optgroup label="<?php DUP_PRO_U::_e("By Day"); ?>">
					<option value="9"> d-m-Y H:i &nbsp;	[05-01-2000 12:00]</option>
					<option value="10">d-m-Y H:i:s		[05-01-2000 12:00:01]</option>
					<option value="11">d-m-y H:i &nbsp;	[05-01-00	12:00]</option>
					<option value="12">d-m-y H:i:s		[05-01-00	12:00:01]</option>
				</optgroup>
			</select>
			<p class="description">
				<?php DUP_PRO_U::_e("The date format shown in the 'Created' column on the Packages screen."); ?>
			</p>
		</td>
	</tr>
</table>

<!-- ===============================
DATABASE -->
<h3 class="title"><?php DUP_PRO_U::_e("Database") ?> </h3>
<hr size="1" />
<table class="form-table">
	<tr>
		<th scope="row"><label><?php DUP_PRO_U::_e("SQL Script"); ?></label></th>
		<td>

			<div class="engine-radio <?php echo ($is_shellexec_on) ? '' : 'engine-radio-disabled'; ?>">
				<input type="radio" name="_package_dbmode" value="mysql" id="package_mysqldump" <?php echo DUP_PRO_UI::echoChecked($global->package_mysqldump); ?>  onclick="DupPro.UI.SetDBEngineMode();" />
				<label for="package_mysqldump"><?php DUP_PRO_U::_e("Mysqldump"); ?> <small><?php DUP_PRO_U::_e("(recommended)"); ?></small></label> &nbsp; &nbsp; &nbsp;
			</div>

			<div class="engine-radio">
				<input type="radio" name="_package_dbmode" id="package_phpdump" value="php" <?php echo DUP_PRO_UI::echoChecked(!$global->package_mysqldump); ?>  onclick="DupPro.UI.SetDBEngineMode();"  />
				<label for="package_phpdump"><?php DUP_PRO_U::_e("PHP Code"); ?></label>
			</div>
			<br style="clear:both"/><br/>


			<!-- SHELL EXEC  -->
			<div class="engine-sub-opts" id="dbengine-details-1" style="display:none">
				
				<!-- MYSQLDUMP IN-ACTIVE -->
				<?php if (! $is_shellexec_on) : ?>

					<div class="dup-feature-notfound">
						<?php
							DUP_PRO_U::_e("In order to use mysqldump the PHP function shell_exec needs to be enabled. This server currently does not allow "
								. "<a href='http://php.net/manual/en/function.shell-exec.php' target='_blank'>shell_exec</a> to run. ");
							DUP_PRO_U::_e("Please contact your host or server admin to enable this feature. For a list of approved providers that support shell_exec ");
							echo "<a href='https://snapcreek.com/wordpress-hosting/' target='_blank'>" . DUP_PRO_U::__("click here") . "</a>.  The 'PHP Code' setting will be used "
								. "until this issue is resolved by your hosting provider.";
						?>
					</div><br/>

				<!-- MYSQLDUMP ACTIVE -->
				<?php else : ?>

						<?php if ( $mysqlDumpFound) : ?>
							<div class="dup-feature-found">
								<i class="fa fa-check-circle"></i>
								<?php DUP_PRO_U::_e("Successfully Found:"); ?> &nbsp;
								<i><?php echo $mysqlDumpPath ?></i>
							</div><br/>
						<?php else : ?>
							<div class="dup-feature-notfound">
								<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<?php
									DUP_PRO_U::_e('The mysqldump program was not found at its default location or the custom path below.  Please enter a valid path where mysqldump can run. ');
									DUP_PRO_U::_e("If the problem persist contact your server admin for the correct path. For a list of approved providers that support mysqldump ");
									echo "<a href='https://snapcreek.com/wordpress-hosting/' target='_blank'>" . DUP_PRO_U::__("click here") . "</a>.";
								?>
							</div><br/>
						<?php endif; ?>

						<label><?php DUP_PRO_U::_e("Custom Path"); ?></label>
						<i class="fa fa-question-circle"
							data-tooltip-title="<?php DUP_PRO_U::_e("mysqldump"); ?>"
							data-tooltip="<?php DUP_PRO_U::_e('An optional path to the mysqldump program.  Add a custom path if the path to mysqldump is not properly detected or needs to be changed.   For all paths including Windows use a forward slash.'); ?>"></i>
						<br/>
						<input class="wide-input" type="text" name="_package_mysqldump_path" id="_package_mysqldump_path" value="<?php echo $global->package_mysqldump_path; ?>"  placeholder="<?php DUP_PRO_U::_e("/usr/bin/mypath/mysqldump.exe"); ?>" />
						<br/>
				<?php endif; ?>

				
			</div>

			<!-- PHP OPTION -->
			<div class="engine-sub-opts" id="dbengine-details-2" style="display:none">
				<label for="_package_phpdump_qrylimit"><?php DUP_PRO_U::_e("Query Limit Size"); ?></label>
				<i style="margin-right:7px" class="fa fa-question-circle"
				   data-tooltip-title="<?php DUP_PRO_U::_e("PHP Query Limit Size"); ?>"
				   data-tooltip="<?php DUP_PRO_U::_e('A higher limit size will speed up the database build time, however it will use more memory.  If your host has memory caps start off low.'); ?>"></i>
				<select name="_package_phpdump_qrylimit" id="_package_phpdump_qrylimit">
					<?php
						foreach ($phpdump_chunkopts as $value) {
							$selected = ( $global->package_phpdump_qrylimit == $value ? "selected='selected'" : '' );
							echo "<option {$selected} value='{$value}'>".number_format($value).'</option>';
						}
					?>
				</select>
			</div>

		</td>
	</tr>
</table>

<!-- ===============================
ARCHIVE -->
<h3 class="title"><?php DUP_PRO_U::_e("Archive") ?> </h3>
<hr size="1" />
<table class="form-table">
	<tr>
		<th scope="row">
			<label><?php DUP_PRO_U::_e("Compression"); ?></label>
		</th>
		<td>
			<input type="radio" name="archive_compression" id="archive_compression_off" value="0" <?php echo DUP_PRO_UI::echoChecked($global->archive_compression == false); ?> />
			<label for="archive_compression_off"><?php DUP_PRO_U::_e("Off"); ?></label> &nbsp;
			<input type="radio" name="archive_compression"  id="archive_compression_on" value="1" <?php echo DUP_PRO_UI::echoChecked($global->archive_compression == true); ?>  />
			<label for="archive_compression_on"><?php DUP_PRO_U::_e("On"); ?></label>
			<i style="margin-right:7px;" class="fa fa-question-circle"
				data-tooltip-title="<?php DUP_PRO_U::_e("Shell Exec Archive Compression:"); ?>"
				data-tooltip="<?php DUP_PRO_U::_e('Controls archive compression. This setting can be toggled when using ZipArchive on a PHP 7+ system or Shell Exec Zip.'); ?>"></i>
		</td>
	</tr>
	<tr>
		<th scope="row"><label><?php DUP_PRO_U::_e("Engine Mode"); ?></label></th>
		<td>
			<div class="engine-radio <?php echo ($is_zip_available) ? '' : 'engine-radio-disabled'; ?>">
				<input onclick="DupPro.UI.SetArchiveOptionStates();" type="radio" name="archive_build_mode" id="archive_build_mode1"
					   value="<?php echo DUP_PRO_Archive_Build_Mode::Shell_Exec; ?>"
					   <?php echo DUP_PRO_UI::echoChecked($global->archive_build_mode == DUP_PRO_Archive_Build_Mode::Shell_Exec); ?> />
				<label for="archive_build_mode1"><?php DUP_PRO_U::_e("Shell Zip"); ?></label>
				<?php if (! $is_zip_available):  ?>
					
				<?php endif; ?>
			</div>

			<div class="engine-radio">
				<input onclick="DupPro.UI.SetArchiveOptionStates();" type="radio" name="archive_build_mode" id="archive_build_mode2"  value="<?php echo DUP_PRO_Archive_Build_Mode::ZipArchive; ?>" <?php echo DUP_PRO_UI::echoChecked($global->archive_build_mode == DUP_PRO_Archive_Build_Mode::ZipArchive); ?> />
				<label for="archive_build_mode2"><?php DUP_PRO_U::_e("ZipArchive"); ?></label>
			</div>

			<div class="engine-radio">
				<input onclick="DupPro.UI.SetArchiveOptionStates();" type="radio" name="archive_build_mode" id="archive_build_mode3"  value="<?php echo DUP_PRO_Archive_Build_Mode::DupArchive; ?>" <?php echo DUP_PRO_UI::echoChecked($global->archive_build_mode == DUP_PRO_Archive_Build_Mode::DupArchive); ?> />
				<label for="archive_build_mode3">
					<?php DUP_PRO_U::_e("DupArchive"); ?>
					<i style='color:maroon'>(<?php DUP_PRO_U::_e("new"); ?>)</i>
				</label>
			</div>
			<br style="clear:both"/>

			<!-- SHELL EXEC  -->
			<div class="engine-sub-opts" id="engine-details-1" style="display:none">
				<p class="description" >
					<?php
						if ($is_zip_available) {
							DUP_PRO_U::_e('The "Shell Zip" mode allows Duplicator to use the servers internal zip command.');
							echo '<br/>';
							DUP_PRO_U::_e('When available this mode is recommended over the PHP "ZipArchive" mode.');
						} else {
							$problem_fixes	= DUP_PRO_Zip_U::getShellExecZipProblems();
							$shell_tooltip	= '<i style="color:maroon"><i class="fa fa-exclamation-triangle"></i> ';
							$shell_tooltip .= DUP_PRO_U::__("This server is not configured to support the Shell Zip engine - please re-configure server or use ZipArchive "
								. "or DupArchive.</i><br/> Shell Zip is <a href='https://snapcreek.com/duplicator/docs/faqs-tech/#faq-package-030-q' target='_blank'>recommended</a> "
								. "over ZipArchive when available.<br/>");

							//Show possible solutions for some linux setups
							if (count($problem_fixes) > 0 && ((strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN'))) {
								$shell_tooltip .= DUP_PRO_U::__("To make 'Shell Zip' available, ask your host to:<br/>");
								$i = 1;
								foreach ($problem_fixes as $problem_fix) {
									$shell_tooltip .= "{$i}. {$problem_fix->fix}<br/>";
									$i++;
								}
								$shell_tooltip .= '<br/>';
							} 
							echo "{$shell_tooltip}";
							DUP_PRO_U::_e("For a list of supported hosting providers <a href='https://snapcreek.com/wordpress-hosting/' target='_blank'>click here</a>.");
						}
					?>
				</p>
			</div>

			<!-- ZIP ARCHIVE  -->
			<div class="engine-sub-opts" id="engine-details-2" style="display:none; padding-top:20px">
				<label>Mode:</label>
				<select  name="ziparchive_mode" id="ziparchive_mode"  onchange="DupPro.UI.setZipArchiveMode();">
					<option <?php echo DUP_PRO_UI::echoSelected($global->ziparchive_mode == DUP_PRO_ZipArchive_Mode::Multithreaded); ?> value="<?php echo DUP_PRO_ZipArchive_Mode::Multithreaded ?>">
						<?php DUP_PRO_U::_e("Multi-Threaded"); ?>
					</option>
					<option <?php echo DUP_PRO_UI::echoSelected($global->ziparchive_mode == DUP_PRO_ZipArchive_Mode::SingleThread); ?> value="<?php echo DUP_PRO_ZipArchive_Mode::SingleThread ?>">
						<?php DUP_PRO_U::_e("Single-Threaded"); ?>
					</option>
				</select>

				<div id="dpro-ziparchive-mode-st">
					<input type="checkbox" id="ziparchive_validation" name="ziparchive_validation" <?php echo DUP_PRO_UI::echoChecked($global->ziparchive_validation); ?>>
					<label for="ziparchive_validation">Enable file validation</label>
				</div>

				<div id="dpro-ziparchive-mode-mt">
					<label><?php DUP_PRO_U::_e("Buffer Size"); ?></label>
					<input style="width:40px;"
						   data-parsley-required data-parsley-errors-container="#ziparchive_chunk_size_error_container" data-parsley-min="5" data-parsley-type="number"
						   type="text" name="ziparchive_chunk_size_in_mb" id="ziparchive_chunk_size_in_mb" value="<?php echo $global->ziparchive_chunk_size_in_mb; ?>" />
					<label><?php DUP_PRO_U::_e('MB'); ?></label>
					<i style="margin-right:7px" class="fa fa-question-circle"
						data-tooltip-title="<?php DUP_PRO_U::_e("PHP ZipArchive"); ?>"
						data-tooltip="<?php DUP_PRO_U::_e('The buffer size only applies to multi-threaded requests.  The buffer indicates how large an archive will get before a close is registered with the ZipArchive call.  Higher values are faster but can be more unstable based on the hosts max_execution time.'); ?>"></i>
					<div id="ziparchive_chunk_size_error_container" class="duplicator-error-container"></div>
				</div>
			</div>

			<!-- DUPARCHIVE -->
			<div class="engine-sub-opts" id="engine-details-3" style="display:none">
				<p class="description" style="max-width:750px">
					<?php
						DUP_PRO_U::_e('Creates an archive in custom DupArchive format.  Recommended for large sites or sites on constrained servers.');
						echo '<br/>';
						DUP_PRO_U::_e('<b>Note:</b> This option is only applies to manual builds.  Scheduled builds will still use Shell Zip or ZipArchive even when DupArchive '
							. 'is selected.');
					?>
				</p>
			</div>

		</td>
	</tr>
</table>


<!-- ===============================
PROCESSING -->
<h3 class="title"><?php DUP_PRO_U::_e("Processing") ?> </h3>
<hr size="1" />
<table class="form-table">
	<tr>
		<th scope="row"><label><?php DUP_PRO_U::_e("Server Throttle"); ?></label></th>
		<td>
			<input type="radio" name="server_load_reduction" value="<?php echo DUP_PRO_Email_Build_Mode::No_Emails; ?>" <?php echo DUP_PRO_UI::echoChecked($global->server_load_reduction == DUP_PRO_Server_Load_Reduction::None); ?> />
			<label for="server_load_reduction"><?php DUP_PRO_U::_e("Off"); ?></label> &nbsp;
			<input type="radio" name="server_load_reduction" value="<?php echo DUP_PRO_Server_Load_Reduction::A_Bit; ?>" <?php echo DUP_PRO_UI::echoChecked($global->server_load_reduction == DUP_PRO_Server_Load_Reduction::A_Bit); ?> />
			<label for="server_load_reduction"><?php DUP_PRO_U::_e("Low"); ?></label> &nbsp;
			<input type="radio" name="server_load_reduction"  value="<?php echo DUP_PRO_Server_Load_Reduction::More; ?>" <?php echo DUP_PRO_UI::echoChecked($global->server_load_reduction == DUP_PRO_Server_Load_Reduction::More); ?> />
			<label for="server_load_reduction"><?php DUP_PRO_U::_e("Medium"); ?></label> &nbsp;
			<input type="radio" name="server_load_reduction"  value="<?php echo DUP_PRO_Server_Load_Reduction::A_Lot ?>" <?php echo DUP_PRO_UI::echoChecked($global->server_load_reduction == DUP_PRO_Server_Load_Reduction::A_Lot); ?> />
			<label for="server_load_reduction"><?php DUP_PRO_U::_e("High"); ?></label> &nbsp;
			<p class="description"><?php  DUP_PRO_U::_e("Throttle to prevent resource complaints on budget hosts. The higher the value the slower the backup.");  ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label><?php DUP_PRO_U::_e("Max Build Time"); ?></label></th>
		<td>
			<input style="float:left;display:block;margin-right:6px;" data-parsley-required data-parsley-errors-container="#max_package_runtime_in_min_error_container" data-parsley-min="0" data-parsley-type="number" class="narrow-input" type="text" name="max_package_runtime_in_min" id="max_package_runtime_in_min" value="<?php echo $global->max_package_runtime_in_min; ?>" />
			<p style="margin-left:4px;"><?php DUP_PRO_U::_e('Minutes'); ?></p>
			<div id="max_package_runtime_in_min_error_container" class="duplicator-error-container"></div>
			<p class="description">  <?php DUP_PRO_U::_e('Max build and storage time until package is auto-cancelled. Set to 0 for no limit.'); ?>  </p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label><?php DUP_PRO_U::_e("Max Worker Time"); ?></label></th>
		<td>
			<input style="float:left;display:block;margin-right:6px;" data-parsley-required data-parsley-errors-container="#php_max_worker_time_in_sec_error_container" data-parsley-min="10" data-parsley-type="number" class="narrow-input" type="text" name="php_max_worker_time_in_sec" id="php_max_worker_time_in_sec" value="<?php echo $global->php_max_worker_time_in_sec; ?>" />
			<p style="margin-left:4px;"><?php DUP_PRO_U::_e('Seconds'); ?></p>
			<div id="php_max_worker_time_in_sec_error_container" class="duplicator-error-container"></div>
			<p class="description">
				<?php
				DUP_PRO_U::_e("Lower is more reliable but slower. Recommended max is $max_worker_cap_in_sec sec based on PHP setting 'max_execution_time'.");
				?>
			</p>
		</td>
	</tr>
</table><br/>

<p class="submit" style="margin: 20px 0px 0xp 5px;">
	<br/><input type="submit" name="submit" id="submit" class="button-primary" value="<?php DUP_PRO_U::_e('Save Package Settings') ?>" style="display: inline-block;" />
</p>
</form>

<script>
jQuery(document).ready(function ($)
{
	DupPro.UI.setZipArchiveMode = function ()
	{
		$('#dpro-ziparchive-mode-st, #dpro-ziparchive-mode-mt').hide();
		if ($('#ziparchive_mode').val() == 0) {
			$('#dpro-ziparchive-mode-mt').show();
		} else {
			$('#dpro-ziparchive-mode-st').show();
		}
	}

	DupPro.UI.SetArchiveOptionStates = function()
	{
		var php70 = <?php DUP_PRO_UI::echoBoolean(DUP_PRO_U::PHP70()); ?>;
		var isShellZipSelected   = $('#archive_build_mode1').is(':checked');
		var isZipArchiveSelected = $('#archive_build_mode2').is(':checked');
		var isDupArchiveSelected = $('#archive_build_mode3').is(':checked');

		if(isShellZipSelected || isDupArchiveSelected) {
			$("[name='archive_compression']").prop('disabled', false);
			$("[name='ziparchive_mode']").prop('disabled', true);
		} else {
			$("[name='ziparchive_mode']").prop('disabled', false);
			if(php70) {
				 $("[name='archive_compression']").prop('disabled', false);
			 } else {
				 $('#archive_compression_on').prop('checked', true);
				$("[name='archive_compression']").prop('disabled', true);
			}
		}

		$('#engine-details-1, #engine-details-2, #engine-details-3').hide();
		switch (true) {
			case isShellZipSelected		: $('#engine-details-1').show(); break;
			case isZipArchiveSelected	: $('#engine-details-2').show(); break;
			case isDupArchiveSelected	: $('#engine-details-3').show(); break;

		}

		DupPro.UI.setZipArchiveMode();
	}

	DupPro.UI.SetDBEngineMode = function()
	{
		var isMysqlDump	= $('#package_mysqldump').is(':checked');
		var isPHPMode	= $('#package_phpdump').is(':checked');

		$('#dbengine-details-1, #dbengine-details-2').hide();
		switch (true) {
			case isMysqlDump : $('#dbengine-details-1').show(); break;
			case isPHPMode	 : $('#dbengine-details-2').show(); break;
		}
	}

	//INIT
	$('#package_ui_created').val(<?php echo $package_ui_created ?>);
    DupPro.UI.SetArchiveOptionStates();
	DupPro.UI.SetDBEngineMode();

});
</script>
