<?php

namespace App\Helpers;

class Helper
{
    public static function startsWith($haystack, $needle) {
    	return (substr($haystack, 0, strlen($needle)) === $needle);
	}

	public static function endsWith($haystack, $needle) {
	    return (strlen($needle) == 0 || substr($haystack, -strlen($needle)) === $needle);
	}
}