<?php
namespace App\Repository;
use App\Models\Shift;
use App\Models\chairty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Shifts\ShiftStoreRequest;
use App\Http\Requests\Shifts\ShiftUpdateRequest;

class ShiftRepository
{

    public function GetAll(Request $request)
    {
        $type =  Auth::user()->type;
        if ($type == 'admin' || $type =='supervisor') {
            return Shift::whereHas('users',function ($q) use ($request) {
                return $q->when($request->search, function ($query)  use ($request) {
                    return $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('phone', 'like', '%'  . $request->search . '%');
                        // ->orWhere('amount', 'like', '%'  . $request->search . '%');
                });
            })->whereNotNull('id')->paginate(20);
        }else{
            return Shift::whereHas('users',function ($q) use ($request) {
                return $q->when($request->search, function ($query)  use ($request) {
                    return $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('phone', 'like', '%'  . $request->search . '%');
                        // ->orWhere('amount', 'like', '%'  . $request->search . '%');
                });
            })->whereNotNull('id')->where('id',auth()->user()->id)->paginate(20);

        }
    }

    public function Create(ShiftStoreRequest $request , Shift $Shifts)
    {
        // if ($Shifts->end_time === null) {
        //     return Shift::firstOrNew($request->validated());
        // } else {
        //     return Shift::create($request->validated());
        // }
         return Shift::create($request->validated());

    }

    public function Show($id)
    {
        $type =  Auth::user()->type;
        if ($type == 'admin' || $type =='supervisor') {
            return Shift::findOrFail($id);
        }else{
            return Shift::where('id',auth()->user()->id)->findOrFail($id);
        }
    }

    public function Update(ShiftUpdateRequest $request, Shift $Shifts)
    {
        return $Shifts->update($request->validated());
    }

    public function Delete($id)
    {
        return Shift::findOrFail($id)->delete();
    }

}
