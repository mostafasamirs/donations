<?php

namespace App\Http\Controllers\Admin;

use App\Models\Donator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\DonatorRepository;
use App\Http\Requests\Donators\DonatorStoreRequest;
use App\Http\Requests\Deposits\DonationStoreRequest;
use App\Http\Requests\Donators\DonatorUpdateRequest;

class DonatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(DonatorRepository $DonatorRepository)
    {
        $this->DonatorRepository = $DonatorRepository;
        $this->middleware('permission:show-donator', ['only' => ['index', 'show']]);
        $this->middleware('permission:add-donator', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-donator', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-donator', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $donators = $this->DonatorRepository->GetAll($request);
        return view('admin.donators.index', compact('donators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.donators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonatorStoreRequest $request)
    {
        $this->DonatorRepository->Create($request);
        return redirect()->route('donators.index')->with('toast_success', __('Created Successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donator = $this->DonatorRepository->Show($id);
        return view('admin.donators.show', compact('donator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function edit(Donator $donator)
    {
        return view('admin.donators.edit', compact('donator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function update(DonatorUpdateRequest $request, Donator $donator)
    {
        $this->DonatorRepository->Update($request, $donator);
        return redirect()->route('donators.index')->with('toast_success', __('Updated Successfully.'));
    }

    public function SearchByMobile(Request $request)
    {
        $donator = $this->DonatorRepository->SearchByMobile($request);
        if ($donator == null)
            return 404;
        return response($donator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donator  $donator
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->DonatorRepository->Delete($id);
        return redirect()->route('donators.index')->with('toast_success', __('Deleted Successfully.'));
    }
}
