<?php

// use google\appengine\api\cloud_storage\CloudStorageTools;

if (!function_exists('getCss')) {
	function getCss($gs_filename) {		
		$bucket = env('GS_BUCKET', 'ratemycanteen');
		$fileName = "gs://${bucket}/css/${gs_filename}";
		return "https://storage.googleapis.com/${bucket}/css/${gs_filename}";
		// return CloudStorageTools::getPublicUrl($fileName, false);
	}
}

if (!function_exists('getJs')) {
	function getJs($gs_filename) {
		$bucket = env('GS_BUCKET', 'ratemycanteen');
		$fileName = "gs://${bucket}/js/${gs_filename}";
		// return CloudStorageTools::getPublicUrl($fileName, false);
		return "https://storage.googleapis.com/${bucket}/js/${gs_filename}";
	}
}

if (!function_exists('getFonts')) {
	function getFonts($gs_filename) {
		$bucket = env('GS_BUCKET', 'ratemycanteen');
		$fileName = "gs://${bucket}/fonts/${gs_filename}";
		// return CloudStorageTools::getPublicUrl($fileName, false);
		return "https://storage.googleapis.com/${bucket}/fonts/${gs_filename}";
	}
}

if (!function_exists('getImg')) {
	function getImg($gs_filename) {
		$bucket = env('GS_BUCKET', 'ratemycanteen');
		$fileName = "gs://${bucket}/img/${gs_filename}";
		// return CloudStorageTools::getPublicUrl($fileName, false);
		return "https://storage.googleapis.com/${bucket}/img/${gs_filename}";
	}
}