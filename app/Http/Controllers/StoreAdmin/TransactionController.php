<?php

namespace App\Http\Controllers\StoreAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Store;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class TransactionController extends Controller
{
    protected $path;
    protected $store;
    protected $user;

    function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $this->user = Auth::user();
            $this->store = Store::where('user_id', $user->id)->first();
            view()->share('store', Store::where('user_id', $user->id)->first());
            return $next($request);
        });
        $this->path = 'storeadmin.pages.';
    }

    public function index()
    {
        $query = Transaction::with('member', 'courier', 'store')
            ->where('store_id', '=', $this->store->id);
        if (Input::get('payment_status')) {
            $state = Input::get('payment_status');
            if ($state != "all") {
                $query->whereHas('invoice', function ($qw) use ($state) {
                    $qw->where('payment_status', '=', $state);
                });
            }
        }
        if (Input::get('transaction_status')) {
            $state2 = Input::get('transaction_status');
            if ($state2 != "all") {
                $query->where('transaction_status', '=', $state2);
            }
        }
        $transactions = $query->get();
        return view($this->path . 'transaction.index', compact('transactions'));
    }
    public function detail($id)
    {
        $transaction = Transaction::with('transactionAddress', 'member', 'transactionCourier', 'courier', 'store', 'invoice', 'transactionDetail', 'transactionDetail.product', 'transactionDetail.product.category', 'store.payment')->where('store_id', '=', $this->store->id)->where('id', '=', $id)->first();
        return view($this->path . 'transaction.detail', compact('transaction'));
    }
    public function changePaymentStatus(Request $request)
    {
        $status = $request->status;
        $transaction_id = $request->transaction_id;
        $invoice1 = Invoice::where('transaction_id', '=', $transaction_id)->first();
        $invoice = Invoice::find($invoice1->id);
        if ($request->status == "paid") {
            $invoice->payment_date = Carbon::now();
        }
        $invoice->payment_status = $status;
        if ($invoice->save()) {
            return 'success';
        } else {
            return 'error';
        }
    }
    public function changeTransactionStatus(Request $request)
    {
        $transaction = Transaction::find($request->transaction_id);
        $transaction->transaction_status = $request->status;
        if ($request->status == "in_shipping") {
            $transaction->receipt_number = $request->receipt_number;
        }
        if ($transaction->save()) {
            return 'success';
        } else {
            return 'error';
        }
    }
}
