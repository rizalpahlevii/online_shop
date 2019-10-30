<?php

if (!function_exists('DummyFunction')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function DummyFunction()
    { }
}
if (!function_exists('convertDate')) {
    function convertDate($date)
    {
        $dateEx = explode('-', $date);

        $month = $dateEx[0];
        $susun = $dateEx[1] . ' ' . date('F', mktime(0, 0, 0, $month)) . ' ' . $dateEx[2];
        return $susun;
    }
}

if (!function_exists('set_active')) {
    function set_active($uri, $output = 'active')
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($uri)) {
                return $output;
            }
        }
    }
}
