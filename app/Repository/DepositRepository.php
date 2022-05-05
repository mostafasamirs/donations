<?php
namespace App\Repository;
use App\Models\Deposit;
use App\Models\kiosk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Charity\CharityStoreRequest;
use App\Http\Requests\Charity\CharityUpdateRequest;
use App\Http\Requests\Deposits\DepositStoreRequest;
use App\Http\Requests\Deposits\DepositUpdateRequest;


class DepositRepository
{

    public function GetAll(Request $request)
    {
        $type =  Auth::user()->type;
        if ($type == 'admin' || $type =='supervisor') {
            return Deposit::whereHas('users',function ($q) use ($request) {
                return $q->when($request->search, function ($query)  use ($request) {
                    return $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('amount', 'like', '%'  . $request->search . '%')
                        ->orWhere('date', 'like', '%'  . $request->search . '%');
                });
            })->whereNotNull('id')->paginate(20);
        }else{
            return Deposit::whereHas('users',function ($q) use ($request) {
                return $q->when($request->search, function ($query)  use ($request) {
                    return $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('amount', 'like', '%'  . $request->search . '%')
                        ->orWhere('date', 'like', '%'  . $request->search . '%');
                });
            })->whereNotNull('id')->where('id',auth()->user()->id)->paginate(20);
        }

    }

    public function Create(DepositStoreRequest $request)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;
        $data['kiosk_id'] = $user->kiosk_id;
        $data['kiosk_id'] = $user->kiosk_id;
        $data['amount'] = $request->amount;
        $data['date'] = $request->date;
        if ($request->image) {
            $data['image'] = Storage::disk('local')->put('', $request->image);
        }
        $deposit = Deposit::create($data);
        $kiosk = kiosk::find($user->kiosk_id);
        $kiosk->amount -= $request->amount;
        $kiosk->update();
        $deposit->kiosk_amount = $kiosk->amount;
        return $deposit;
    }

    public function Show($id)
    {
        $type =  Auth::user()->type;
        if ($type == 'admin' || $type =='supervisor') {
            return Deposit::findOrFail($id);
        }else{
            return Deposit::where('id',auth()->user()->id)->findOrFail($id);
        }
    }

    public function Update(DepositUpdateRequest $request, Deposit $deposit)
    {
        $deposit->update($request->validated());
        if ($request->hasFile('image')) {
            if (file_exists(public_path() . '/storage/imagedeposits' . '/' . $deposit->image)) {
                if (Storage::exists('public/imagedeposits/' . $deposit->image)) {
                    Storage::delete('public/imagedeposits/' . $deposit->image);
                }
            }
            $fileExt            = $request->image->getClientOriginalExtension();
            $fileNameNew        = uniqid() . time() . '.' . $fileExt;
            $request->image->storeAs('public/imagedeposits/', $fileNameNew);
            $fileNew        = 'storage/imagedeposits/'.$fileNameNew;
            $deposit->image = $fileNew;
            $deposit->update();
        }else{
            $fileNew =   $deposit->image;
        }
        return $deposit;
    }

    public function Delete($id)
    {
        return Deposit::findOrFail($id)->delete();
    }

}
