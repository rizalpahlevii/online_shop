<?php

use App\Courier;
use App\Store_courier;

if (!function_exists('convertDate')) {
    function convertDate($date)
    {
        $dateEx = explode('-', $date);
        $month = $dateEx[0];
        $susun = $dateEx[2] . ' ' . date('F', mktime(0, 0, 0, $month)) . ' ' . $dateEx[2];
        dd($dateEx, $month, $susun);
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
if (!function_exists('payment_label')) {
    function payment_label($status, $id)
    {
        switch ($status) {
            case 'unpaid':
                $ret = '<p class="tag tag-warning" data-kode="' . $id . '">Unpaid</p>';
                break;
            case 'waiting_confirmation':
                $ret = '<p class="tag tag-info" data-kode="' . $id . '">Waiting Confirmation</p>';
                break;
            case 'paid':
                $ret = '<p class="tag tag-success" data-kode="' . $id . '">Paid</p>';
                break;
            case 'rejected':
                $ret = '<p class="tag tag-danger" data-kode="' . $id . '">Rejected</p>';
                break;
            default:
                $ret = 'Not found';
        }
        return $ret;
    }
}

if (!function_exists('transaction_label')) {
    function transaction_label($status, $id)
    {
        switch ($status) {
            case 'proccess':
                $ret = '<p class="tag tag-warning" data-kode="' . $id . '">Procces</p>';
                break;
            case 'shipped':
                $ret = '<p class="tag tag-info" data-kode="' . $id . '">Shipped</p>';
                break;
            case 'in_shipping':
                $ret = '<p class="tag tag-danger" data-kode="' . $id . '">In Shipping</p>';
                break;
            case 'arrived':
                $ret = '<p class="tag tag-info" data-kode="' . $id . '">Arrived</p>';
                break;
            default:
                $ret = 'Not found';
        }
        return $ret;
    }
}
