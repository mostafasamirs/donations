<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\kiosk;
use App\Models\Shift;
use Illuminate\Http\Request;
use App\Repository\ShiftRepository;
use App\Http\Controllers\Controller;
use App\Repository\CharityRepository;
use App\Http\Requests\Shifts\ShiftStoreRequest;
use App\Http\Requests\Shifts\ShiftUpdateRequest;

class ShiftController extends Controller
{
    public function __construct(ShiftRepository $ShiftRepository)
    {
        $this->ShiftRepository = $ShiftRepository;

        $this->middleware('permission:show-shift', ['only' => ['index', 'show']]);
        $this->middleware('permission:add-shift', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-shift', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-shift', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shifts = $this->ShiftRepository->GetAll($request);
        return view('admin.shifts.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shifts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShiftStoreRequest $request ,Shift $Shifts)
    {
        $this->ShiftRepository->Create($request,$Shifts);
        return redirect()->route('shifts.index')->with('toast_success', __('start shift Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shift = $this->ShiftRepository->Show($id);
        return view('admin.shifts.show', compact('shift'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        return view('admin.shifts.edit', compact('shift'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(ShiftUpdateRequest $request, Shift $shift)
    {
        $this->ShiftRepository->Update($request, $shift);
        return redirect()->route('shifts.index')->with('toast_success', __('Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->ShiftRepository->Delete($id);
        return redirect()->route('shifts.index')->with('toast_success', __('Deleted Successfully.'));
    }

    public function endshift(Request $request, $id)
    {
        $shift = Shift::findOrFail($id);
        $shift->update(array_merge([
            'end_time'=> $request->end_time,
            'user_id'=> $request->user_id,
            // 'kiosk_id'=> $request->kiosk_id,
        ]));

        return redirect()->route('logout')->with('toast_success', __('end shift Successfully'));

    }




}
