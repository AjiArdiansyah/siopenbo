<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Customer;
use App\Villa;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::get();
        $customer   = Customer::get();
        $villa      = Villa::get();
        if(Auth::user()->level == 'user')
        {
            $datas = Transaksi::where('status', 'pinjam')
                                ->where('customer_id', Auth::user()->customer->id)
                                ->get();
        } else {
            $datas = Transaksi::where('status', 'pinjam')->get();
        }
        return view('home', compact('transaksi', 'customer', 'villa', 'datas'));
    }
}
