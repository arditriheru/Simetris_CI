<?php
/**
 * Helpher untuk menampilkan identitas aplikasi
 *
 * @package CodeIgniter
 * @category Helpers
 * @author Ardi Tri Heru (arditriheruh@gmail.com)
 * @link https://github.com/arditriheru
 */

if (!function_exists('getTopTitle')) {
	function getTopTitle(){
		$getTopTitle = "SIMETRIS | RSKIA Rachmi";
		return $getTopTitle;
	}
}

if (!function_exists('getCopyright')) {
	function getCopyright(){
		$getCopyright = "Copyright &#169; <script type='text/javascript'>var creditsyear = new Date();document.write(creditsyear.getFullYear());</script></b> <a expr:href='data:blog.homepageUrl'><data:blog.title/></a> <a href='https://arditriheru.github.io/' target='blank'> Ardi Tri Heru</a>";
		return $getCopyright;
	}
}

if (!function_exists('getVersion')) {
	function getVersion(){
		$getVersion = "Version 2.0 CI";
		return $getVersion;
	}
}

?>