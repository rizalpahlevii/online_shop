<?php

use App\Courier;
use App\Store_courier;

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

if (!function_exists('set_checked_courier')) {
    function set_checked_courier($store_id, $courier_id)
    {
        $courier = Courier::all();
        $storeCourier = Store_courier::where('store_id', $store_id)->where('courier_id', $courier_id)->get();
        if ($storeCourier->count() > 0) {
            $output = 'checked';
        } else {
            $output = '';
        }
        return $output;
    }
}
