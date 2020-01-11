<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ShipmentExport implements FromView
{
    protected $filter;
    public function __construct($params)
    {
        $this->filter = $params;
    }
    public function view(): View
    {
        $reports = Transaction::with('transactionAddress', 'transactionCourier', 'member')->where('store_id', $this->filter['store_id'])->get();
        return view('storeadmin.pages.report.shipment_excel', [
            'transactions' => $reports->get()
        ]);
    }
}
