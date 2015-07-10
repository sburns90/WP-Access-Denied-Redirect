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
/*  Copyright 2014 Stephen Burns (stephen@StephenBurns.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
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
