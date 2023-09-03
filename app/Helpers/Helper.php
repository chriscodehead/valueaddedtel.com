<?php

/**
 * this function returns the correct postion if given a number
 * @param  integer $number
 * @return string number and suffix(postion of number)
 */
if (!function_exists('position')) {
    function position($number)
    {
        $suffixes = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
        if (($number % 100) >= 11 && ($number % 100) <= 13) {
            return $number . 'th';
        } else {
            return $number . $suffixes[$number % 10];
        }
    }
}

if(!function_exists('status')) {
    function status(bool $status, string $message = "", array $data = []) : array {
        return compact('status', 'message', 'data');
    }
}

if(!function_exists('jsonify')) {
    function jsonify(array $arr = []) : object {
        return json_decode(json_encode($arr));
    }
}
