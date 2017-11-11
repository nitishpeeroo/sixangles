<?php defined("ABSPATH") or die(""); ?>
<!-- ================================================================
SERVER
================================================================ -->
<div class="details-title">
	<i class="fa fa-hdd-o"></i> <?php DUP_PRO_U::_e("Setup"); ?>
	<div class="dup-more-details" title="<?php DUP_PRO_U::_e('Show Diagnostics');?>">
		<a href="?page=duplicator-pro-tools&tab=diagnostics" target="_blank"><i class="fa fa-microchip"></i></a>
	</div>
</div>

<!-- ==========================
SYSTEM (PHP) SETTINGS -->
<div class="scan-item">
	<div class='title' onclick="DupPro.Pack.toggleScanItem(this);">
		<div class="text"><i class="fa fa-caret-right"></i> <?php DUP_PRO_U::_e('System');?></div>
		<div id="data-srv-php-all"></div>
	</div>
	<div class="info">
	<?php
		//WEB SERVER
		$web_servers = implode(', ', $GLOBALS['DUPLICATOR_PRO_SERVER_LIST']);
		echo '<span id="data-srv-php-websrv"></span>&nbsp;<b>' . DUP_PRO_U::__('Web Server') . ":</b>&nbsp; '{$_SERVER['SERVER_SOFTWARE']}' <br/>";
		echo '<small>';
		DUP_PRO_U::_e("Supported web servers:");
		echo "{$web_servers}";
		echo '</small>';

		//PHP VERSION
		echo '<hr size="1" /><span id="data-srv-php-version"></span>&nbsp;<b>' . DUP_PRO_U::__('PHP Version') . "</b> <br/>";
		echo '<small>';
		DUP_PRO_U::_e('The minimum PHP version supported by Duplicator is 5.2.9, however it is highly recommended to use PHP 5.3 or higher for improved stability.');
		echo "&nbsp;<i><a href='http://php.net/ChangeLog-5.php' target='_blank'>[" . DUP_PRO_U::__('details') . "]</a></i>";
		echo '</small>';

		//OPEN_BASEDIR
		$test = ini_get("open_basedir");
		echo '<hr size="1" /><span id="data-srv-php-openbase"></span>&nbsp;<b>' . DUP_PRO_U::__('PHP Open Base Dir') . ":</b>&nbsp; '{$test}' <br/>";
		echo '<small>';
		DUP_PRO_U::_e('Issues might occur when [open_basedir] is enabled. Work with your server admin to disable this value in the php.ini file if you’re having issues building a package.');
		echo "&nbsp;<i><a href='http://www.php.net/manual/en/ini.core.php#ini.open-basedir' target='_blank'>[" . DUP_PRO_U::__('details') . "]</a></i><br/>";
		echo '</small>';

		//MAX_EXECUTION_TIME
		$test = (set_time_limit(0)) ? 0 : ini_get("max_execution_time");
		echo '<hr size="1" /><span id="data-srv-php-maxtime"></span>&nbsp;<b>' . DUP_PRO_U::__('PHP Max Execution Time') . ":</b>&nbsp; '{$test}' <br/>";
		echo '<small>';
		printf(DUP_PRO_U::__('Issues might occur for larger packages when the [max_execution_time] value in the php.ini is too low.  The minimum recommended timeout is "%1$s" seconds or higher. An attempt is made to override this value if the server allows it.  A value of 0 (recommended) indicates that PHP has no time limits.'), DUPLICATOR_PRO_SCAN_TIMEOUT);
		echo "&nbsp;<i><a href='http://www.php.net/manual/en/info.configuration.php#ini.max-execution-time' target='_blank'>[" . DUP_PRO_U::__('details') . "]</a></i>";
		echo '</small>';

		//MYSQLI
		echo '<hr size="1" /><span id="data-srv-php-mysqli"></span>&nbsp;<b>' . DUP_PRO_U::__('MySQLi') . "</b> <br/>";
		echo '<small>';
		DUP_PRO_U::_e('Creating the package does not require the mysqli module.  However the installer file requires that the PHP module mysqli be installed on the server it is deployed on.');
		echo "&nbsp;<i><a href='http://php.net/manual/en/mysqli.installation.php' target='_blank'>[" . DUP_PRO_U::__('details') . "]</a></i>";
		echo '</small>';

		if ($Package->contains_storage_type(DUP_PRO_Storage_Types::Dropbox)) {
			//OPENSSL
			echo '<hr size="1" /><span id="data-srv-php-openssl"></span>&nbsp;<b>'.DUP_PRO_U::__('Open SSL').'</b> ';
			echo '<br/><small>';
			DUP_PRO_U::_e('Dropbox storage requires an HTTPS connection. On windows systems enable "extension=php_openssl.dll" in the php.ini configuration file.  ');
			DUP_PRO_U::_e('On Linux based systems check for the --with-openssl[=DIR] flag.');
			echo "&nbsp;<i><a href='http://php.net/manual/en/openssl.installation.php' target='_blank'>[".DUP_PRO_U::__('details')."]</a></i>";
			echo '</small>';

			if ($global->dropbox_transfer_mode == DUP_PRO_Dropbox_Transfer_Mode::FOpen_URL) {
				//FOpen
				$test = DUP_PRO_Server::isURLFopenEnabled();
				echo '<hr size="1" /><span id="data-srv-php-allowurlfopen"></span>&nbsp;<b>'.DUP_PRO_U::__('Allow URL Fopen').":</b>&nbsp; '{$test}' <br/>";
				echo '<small>';
				DUP_PRO_U::_e('Dropbox communications requires that [allow_url_fopen] be set to 1 in the php.ini file.');
				echo "&nbsp;<i><a href='http://php.net/manual/en/filesystem.configuration.php#ini.allow-url-fopen' target='_blank'>[".DUP_PRO_U::__('details')."]</a></i><br/>";
				echo '</small>';
			} else if ($global->dropbox_transfer_mode == DUP_PRO_Dropbox_Transfer_Mode::cURL) {
				//FOpen
				$test = DUP_PRO_Server::isCurlEnabled() ? DUP_PRO_U::__('True') : DUP_PRO_U::__('False');
				echo '<hr size="1" /><span id="data-srv-php-curlavailable"></span>&nbsp;<b>'.DUP_PRO_U::__('cURL Available').":</b>&nbsp; '{$test}' <br/>";
				echo '<small>';
				DUP_PRO_U::_e('Dropbox communications requires that extension=php_curl.dll be present in the php.ini file.');
				echo "&nbsp;<i><a href='http://php.net/manual/en/curl.installation.php' target='_blank'>[".DUP_PRO_U::__('details')."]</a></i><br/>";
				echo '</small>';
			}
		}
	?>
	</div>
</div>


<!-- ======================
WP SETTINGS -->
<div class="scan-item scan-item-last">
	<div class='title' onclick="DupPro.Pack.toggleScanItem(this);">
		<div class="text"><i class="fa fa-caret-right"></i> <?php DUP_PRO_U::_e('WordPress');?></div>
		<div id="data-srv-wp-all"></div>
	</div>
	<div class="info">
	<?php
		//VERSION CHECK
		echo '<span id="data-srv-wp-version"></span>&nbsp;<b>' . DUP_PRO_U::__('WordPress Version') . ":</b>&nbsp; '{$wp_version}' <br/>";
		echo '<small>';
		printf(DUP_PRO_U::__('It is recommended to have a version of WordPress that is greater than %1$s.  Older version of WordPress can lead to migration issues and are a  '
			. 'security risk.  If possible please update your WordPress site to the latest version.'), DUPLICATOR_PRO_SCAN_MIN_WP);
		echo '</small>';

		//CORE FILES
		echo '<hr size="1" /><span id="data-srv-wp-core"></span>&nbsp;<b>' . DUP_PRO_U::__('Core Files') . "</b> <br/>";
		echo '<small>';
		DUP_PRO_U::_e("If the scanner is unable to locate the wp-config.php file in the root directory, then you will need to manually copy it to its new location.");
		echo '</small>';

		//CACHE DIR
		$cache_path = $cache_path = DUP_PRO_U::safePath(WP_CONTENT_DIR) . '/cache';
		$cache_size = DUP_PRO_U::byteSize(DUP_PRO_IO::getDirSize($cache_path));
		echo '<hr size="1" /><span id="data-srv-wp-cache"></span>&nbsp;<b>' . DUP_PRO_U::__('Cache Path') . ":</b>&nbsp; '{$cache_path}' ({$cache_size}) <br/>";
		echo '<small>';
		DUP_PRO_U::_e("Cached data will lead to issues at install time and increases your archive size. It is recommended to empty your cache directory at build time. Use caution when removing data from the cache directory. If you have a cache plugin review the documentation for how to empty it; simply removing files might cause errors on your site. The cache size minimum threshold is currently set at ");
		echo DUP_PRO_U::byteSize(DUPLICATOR_PRO_SCAN_CACHESIZE) . '.';
		echo '</small>';

		//MULTISITE NETWORK;
		$license_type = DUP_PRO_License_U::getLicenseType();
		$is_mu   = is_multisite();

		//Normal Site
		if (!$is_mu) {
			echo '<hr size="1" /><span><div class="dup-scan-good"><i class="fa fa-check"></i></div></span>&nbsp;<b>'.DUP_PRO_U::__('Multisite: N/A')."</b> <br/>";
			echo '<small>';
			DUP_PRO_U::_e('Multisite was not detected on this site. It is currently configured as a standard WordPress site.');
			echo "&nbsp;<i><a href='https://codex.wordpress.org/Create_A_Network' target='_blank'>[".DUP_PRO_U::__('details')."]</a></i>";
			echo '</small>';
		}
		//MU Gold
		else if ($is_mu && $license_type == DUP_PRO_License_Type::BusinessGold) {
			echo '<hr size="1" /><span><div class="dup-scan-good"><i class="fa fa-check"></i></div></span>&nbsp;<b>'.DUP_PRO_U::__('Multisite: Detected')."</b> <br/>";
			echo '<small>';
			DUP_PRO_U::_e('This license level has full access to all Multisite Plus+ features.');
			echo '</small>';
		}
		//MU Personal, Freelancer
		else {
			if ($license_type == DUP_PRO_License_Type::Personal) {
				$license_type_text = DUP_PRO_U::__('Personal');
			} else {
				$license_type_text = DUP_PRO_U::__('Freelancer');
			}

			echo '<hr size="1" /><span><div class="dup-scan-warn"><i class="fa fa-exclamation-triangle"></i></div></span>&nbsp;<b>'.DUP_PRO_U::__('Multisite: Detected')."</b> <br/>";
			echo '<small>';
			DUP_PRO_U::_e("Duplicator Pro is at the $license_type_text license level which permits backing up or migrating an entire Multisite network.<br/><br/>");
			DUP_PRO_U::_e('If you wish add the ability to install a subsite as a standalone site then the license must be upgraded to Business or Gold before building a package. ');
			echo "&nbsp;<i><a href='https://snapcreek.com/dashboard/' target='_blank'>[".DUP_PRO_U::__('upgrade')."]</a></i>";
			echo '</small>';
		}
	?>
	</div>
</div>

<script>
(function($)
{
	//Ints the various server data responses from the scan results
	DupPro.Pack.intServerData= function(data)
	{
		$('#data-srv-php-websrv').html(DupPro.Pack.setScanStatus(data.SRV.PHP.websrv));
		$('#data-srv-php-openbase').html(DupPro.Pack.setScanStatus(data.SRV.PHP.openbase));
		$('#data-srv-php-maxtime').html(DupPro.Pack.setScanStatus(data.SRV.PHP.maxtime));
		$('#data-srv-php-mysqli').html(DupPro.Pack.setScanStatus(data.SRV.PHP.mysqli));
		$('#data-srv-php-openssl').html(DupPro.Pack.setScanStatus(data.SRV.PHP.openssl));
		$('#data-srv-php-allowurlfopen').html(DupPro.Pack.setScanStatus(data.SRV.PHP.allowurlfopen));
		$('#data-srv-php-curlavailable').html(DupPro.Pack.setScanStatus(data.SRV.PHP.curlavailable));
		$('#data-srv-php-version').html(DupPro.Pack.setScanStatus(data.SRV.PHP.version));
		$('#data-srv-php-all').html(DupPro.Pack.setScanStatus(data.SRV.PHP.ALL));

		$('#data-srv-wp-version').html(DupPro.Pack.setScanStatus(data.SRV.WP.version));
		$('#data-srv-wp-core').html(DupPro.Pack.setScanStatus(data.SRV.WP.core));
		$('#data-srv-wp-cache').html(DupPro.Pack.setScanStatus(data.SRV.WP.cache));
		$('#data-srv-wp-all').html(DupPro.Pack.setScanStatus(data.SRV.WP.ALL));
	}
})(jQuery);
</script>