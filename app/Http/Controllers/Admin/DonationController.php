<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\kiosk;
use App\Models\Deposit;
use App\Models\Donator;
use App\Models\Donation;
use App\Repository\DonatorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\DonationRepository;
use App\Http\Requests\Donations\DonationStoreRequest;
use App\Http\Requests\Donations\DonationUpdateRequest;

class DonationController extends Controller
{
    public function __construct(DonationRepository $DonationRepository)
    {
        $this->DonationRepository = $DonationRepository;
        $this->middleware('permission:show-donation', ['only' => ['index', 'show']]);
        $this->middleware('permission:add-donation', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-donation', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-donation', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $donations = $this->DonationRepository->GetAll($request);
        return view('admin.donations.index', compact('donations'));

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
        $Donators = Donator::where('id',auth()->user()->id)->get();
        return view('admin.donations.create',compact('users','kiosks','Donators'));
    }

    public function receipt($id)
    {
        $donation = Donation::find($id);
        return view('admin.donations.receipt', ['donation' => $donation]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->DonationRepository->Create($request);
        return redirect()->route('donations.index')->with('toast_success', __('Created Successfully.'));

    }

    public function storeAjax(DonationStoreRequest $request)
    {
        if (isset($request->id))
            $data['donator_id'] = $request->id;
        //add donator if not found
        if ($request->id == "" && $request->mobile !="") {
            $donator = DonatorRepository::Create(['mobile' => $request->mobile, 'name' => $request->name]);
            $request->id = $donator->id;
        }
        $object = $this->DonationRepository->Create($request);
        return response([200, 'data' => $object]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation = $this->DonationRepository->Show($id);
        return view('admin.donations.show', compact('donation'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        $users = User::whereNotIn('type', ['admin'])->whereNotNull('id')->select(['name', 'id'])->get();
        $kiosks = kiosk::select(['name', 'id'])->whereNotNull('id')->get();
        $Deposits = Deposit::whereNotNull('id')->get();

        return view('admin.donations.edit',compact('users','kiosks','Deposits','donation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(DonationUpdateRequest $request, Donation $donation)
    {
        $this->DonationRepository->Update($request, $donation);
        return redirect()->route('donations.index')->with('toast_success', __('Updated Successfully.'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->DonationRepository->Delete($id);
        return redirect()->route('donations.index')->with('toast_success', __('Deleted Successfully.'));
    }
}
