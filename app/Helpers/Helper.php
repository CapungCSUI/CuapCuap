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

	public static function appendZero($value, $digits) {		
		for ($i = 1; $i <= $digits; $i++) {
			if ($value < 10 ** $i) {
				$ret = '';
				for ($j = 1; $j <= $digits - $i; $j++) {
					$ret = $ret . '0';
				}
				$ret = $ret . $value;

				return $ret;
			}
		}

		return $value;
	}
}