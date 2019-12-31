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

if (!function_exists('set_selected_month')) {
    function set_selected_month($value)
    {
        if (!empty($_GET['month'])) {
            if ($_GET['month'] == $value) {
                $status = 'selected';
            } else {
                $status = '';
            }
        } else {
            $status = '';
        }
        return $status;
    }
}

if (!function_exists('set_selected_year')) {
    function set_selected_year($value)
    {
        if (!empty($_GET['year'])) {
            if ($_GET['year'] == $value) {
                $status = 'selected';
            } else {
                $status = '';
            }
        } else {
            $status = '';
        }
        return $status;
    }
}
if (!function_exists('show_status_transaction')) {
    function show_status_transaction($transaction_status)
    {
        $status = [
            [
                'id' => 1,
                'status' => 'proccess',
                'show' => 'Proccess',
                'icon' => 'fa fa-check'
            ],
            [
                'id' => 2,
                'status' => 'shipped',
                'show' => 'Shipped',
                'icon' => 'fa fa-user'
            ],
            [
                'id' => 3,
                'status' => 'in_shipping',
                'show' => 'In Shipping',
                'icon' => 'fa fa-truck'
            ],
            [
                'id' => 4,
                'status' => 'arrived',
                'show' => 'Arrived',
                'icon' => 'fa fa-box'
            ]
        ];
        $search = array_search($transaction_status, array_column($status, 'status'));
        $html = '';
        foreach ($status as $key => $row) {
            if ($search >= $key) {
                $html .= '<div class="step active">
                            <span class="icon"> <i class="' . $row['icon'] . '"></i> </span>
                            <span class="text">' . $row['show'] . '</span>
                        </div>';
            } else {
                $html .= '<div class="step">
                            <span class="icon"> <i class="' . $row['icon'] . '"></i> </span>
                            <span class="text">' . $row['show'] . '</span>
                        </div>';
            }
        }
        return $html;
    }
}
if (!function_exists('show_status_fe')) {
    function show_status_fe($status)
    {
        switch ($status) {
            case 'unpaid':
                $html = '<span class="badge badge-light">Unpaid</span>';
                break;
            case 'paid':
                $html = '<span class="badge badge-success">Paid</span>';
                break;
            case 'waiting_confirmation':
                $html = '<span class="badge badge-warning">Waiting Confirmation</span>';
                break;
            case 'rejected':
                $html = '<span class="badge badge-danger">rejected</span>';
                break;

            default:
                $html = '<span class="badge badge-dark">Default</span>';

                break;
        }
        return $html;
    }
}
if (!function_exists('rupiah')) {
    function rupiah($angka)
    {
        $result = "Rp " . number_format($angka, 2, ',', '.');
        return $result;
    }
}
