<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\kiosk;
use Illuminate\Http\Request;
use App\Repository\KiosKRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\kiosk\kioskStoreRequest;
use App\Http\Requests\kiosk\kioskUpdateRequest;

class KioskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(KiosKRepository $KiosKRepository)
    {
        $this->KiosKRepository = $KiosKRepository;
        $this->middleware('permission:show-kiosk', ['only' => ['index', 'show']]);
        $this->middleware('permission:add-kiosk', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-kiosk', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-kiosk', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $kiosks = $this->KiosKRepository->GetAll($request);
        return view('admin.kiosk.index',compact('kiosks'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users = User::whereNotIn('type', ['admin'])->whereNotNull('id')->select(['name', 'id'])->get();
        return view('admin.kiosk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(kioskStoreRequest $request ,kiosk  $kiosks)
    {
        $this->KiosKRepository->Create($request,$kiosks);
        return redirect()->route('kiosks.index')->with('toast_success', __('Created Successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kiosk  $kiosk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kiosk = $this->KiosKRepository->Show($id);
        return view('admin.kiosk.show',compact('kiosk'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kiosk  $kiosk
     * @return \Illuminate\Http\Response
     */
    public function edit(kiosk $kiosk)
    {
        // $users = User::all();
        return view('admin.kiosk.edit',compact('kiosk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kiosk  $kiosk
     * @return \Illuminate\Http\Response
     */
    public function update(kioskUpdateRequest $request, kiosk $kiosk)
    {
        $this->KiosKRepository->Update($request,$kiosk);
        return redirect()->route('kiosks.index')->with('toast_success', __('Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kiosk  $kiosk
     * @return \Illuminate\Http\Response
     */
    public function destroy(kiosk $kiosk)
    {
        $kiosk = $this->KiosKRepository->Delete($kiosk);
        return redirect()->route('kiosks.index')->with('toast_success', __('Deleted Successfully.'));
    }
}
