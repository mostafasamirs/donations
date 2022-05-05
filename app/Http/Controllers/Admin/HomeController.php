<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deposit;
use App\Models\Donation;
use App\Models\kiosk;
use App\Models\User;
use App\Models\Shift;
use App\Repository\DepositRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     // $this->middleware('isadmin');
    //     // $this->middleware('permission:show-dashboard', ['only' => ['index']]);
    // }


    public function index()
    {
        if (Auth::user()->type != 'employee') {
            return Redirect::to('admin/dashboard');
        }
        return view('admin.dashboard_donations');
    }

    public function dashboard()
    {
        $deposit = Deposit::sum('amount');
        $donation = Donation::sum('amount');
        $kiosks = kiosk::all();
        return view('admin.dashboard', ['deposit' => $deposit, 'donation' => $donation, 'kiosks' => $kiosks]);
    }


    public function lang(Request $request)
    {
        $lang = $request->lang;
        $user = User::where('id', Auth::user()->id)->first();
        if($lang == 'en'){
            $user->update(['lang'=> 'en']);
        }else{
            $user->update(['lang'=> 'ar']);
        }
        return redirect()->back();
    }




}
