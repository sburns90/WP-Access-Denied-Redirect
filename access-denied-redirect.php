<?php
/*
   Plugin Name: Access Denied Redirect
   Plugin URI: http://www.StephenBurns.net
   Description: Redirect users to the login page when they normally would receive an access denied message. ONLY enable on the PRIMARY site of a multisite install.
   Version: 1.0
   Author: Stephen Burns
   Author URI: http://www.StephenBurns.net/
   License: GPL2
*/
?>
<?php
function ad_rtl() {

	function get_current_url(){
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$domainName = $_SERVER['HTTP_HOST'];
		$currentPath = $_SERVER["REQUEST_URI"];
		return $protocol.$domainName.$currentPath;
	}
	
	function master_dashboard_url(){
		$master_dash_url=get_site_url('1', '/wp-admin/my-sites.php');
		return $master_dash_url;
	}

	$currentURL=get_current_url();
	$url=master_dashboard_url();

	if ($currentURL==$url) {
		wp_redirect(home_url('/login'));
		exit;
	}
}
if (!is_super_admin()){
	ad_rtl();
}
?>
