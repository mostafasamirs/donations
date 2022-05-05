<?php

namespace App\Http\Controllers\Admin;

use App\Models\chairty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\CharityRepository;
use App\Http\Requests\Charity\CharityStoreRequest;
use App\Http\Requests\Charity\CharityUpdateRequest;

class ChairtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CharityRepository $CharityRepository)
    {
        $this->CharityRepository = $CharityRepository;
        $this->middleware('permission:show-role', ['only' => ['index', 'show']]);
        $this->middleware('permission:add-role', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $charities = $this->CharityRepository->GetAll($request);
        return view('admin.charities.index', compact('charities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.charities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharityStoreRequest $request)
    {
        $this->CharityRepository->Create($request);
        return redirect()->route('charities.index')->with('toast_success', __('Created Successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\chairty  $chairty
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $charity = $this->CharityRepository->Show($id);
        return view('admin.charities.show', compact('charity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chairty  $chairty
     * @return \Illuminate\Http\Response
     */
    public function edit(chairty $charity)
    {
        return view('admin.charities.edit', compact('charity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\chairty  $chairty
     * @return \Illuminate\Http\Response
     */
    public function update(CharityUpdateRequest $request, chairty $charity)
    {
        $this->CharityRepository->Update($request, $charity);
        return redirect()->route('charities.index')->with('toast_success', __('Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chairty  $chairty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->CharityRepository->Delete($id);
        return redirect()->route('charities.index')->with('toast_success', __('Deleted Successfully.'));
    }
}
