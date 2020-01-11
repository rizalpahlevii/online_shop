<?php

namespace App\Exports;

use App\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class TransactionExport implements FromView
{
    protected $filter;
    public function __construct($params)
    {
        $this->filter = $params;
    }
    public function view(): View
    {
        $transactions = Transaction::with('invoice', 'transactionAddress', 'transactionDetail.product.category', 'transactionCourier', 'store', 'member', 'courier')->where('store_id', $this->filter['store_id']);
        $transactions->whereMonth('date', $this->filter['month']);
        $transactions->whereYear('date', $this->filter['year']);
        return view('storeadmin.pages.report.transaction_excel', [
            'transactions' => $transactions->get()
        ]);
    }
}
