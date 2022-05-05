<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\kiosk;
use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\DepositRepository;
use App\Http\Requests\Deposits\DepositStoreRequest;
use App\Http\Requests\Deposits\DepositUpdateRequest;

class DepositController extends Controller
{
    public function __construct(DepositRepository $DepositRepository)
    {
        $this->DepositRepository = $DepositRepository;
        $this->middleware('permission:show-deposit', ['only' => ['index', 'show']]);
        $this->middleware('permission:add-deposit', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-deposit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-deposit', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $deposits = $this->DepositRepository->GetAll($request);
        return view('admin.deposits.index', compact('deposits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereNotIn('type', ['admin'])->whereNotNull('id')->select(['name', 'id'])->get();
        $kiosks = kiosk::select(['name', 'id'])->whereNotNull('id')->get();
        return view('admin.deposits.create', compact('users', 'kiosks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepositStoreRequest $request, Deposit $deposits)
    {
        $this->DepositRepository->Create($request, $deposits);
        return redirect()->route('deposits.index')->with('toast_success', __('Created Successfully.'));
    }

    public function storeAjax(DepositStoreRequest $request)
    {
        $deposite = $this->DepositRepository->Create($request);
        return response($deposite);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deposit = $this->DepositRepository->Show($id);
        return view('admin.deposits.show', compact('deposit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $users = User::whereNotIn('type',['admin'])->whereNotNull('id')->select(['name','id'])->get();
        $deposit = Deposit::findOrFail($id);
        $users = User::all();
        $kiosks = kiosk::select(['name', 'id'])->whereNotNull('id')->get();
        return view('admin.deposits.edit', compact('users', 'kiosks', 'deposit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function update(DepositUpdateRequest $request, Deposit $deposit)
    {
        $this->DepositRepository->Update($request, $deposit);
        return redirect()->route('deposits.index')->with('toast_success', __('Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->DepositRepository->Delete($id);
        return redirect()->route('deposits.index')->with('toast_success', __('Deleted Successfully.'));
    }
}
