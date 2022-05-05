<?php
namespace App\Repository;
use App\Models\Donation;
use App\Models\kiosk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Donations\DonationStoreRequest;
use App\Http\Requests\Donations\DonationUpdateRequest;


class DonationRepository
{

    public function GetAll(Request $request)
    {
        $type =  Auth::user()->type;
        if ($type == 'admin' || $type =='supervisor') {
            return Donation::whereHas('users',function ($q) use ($request) {
                return $q->when($request->search, function ($query)  use ($request) {
                    return $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('phone', 'like', '%'  . $request->search . '%')
                        ->orWhere('amount', 'like', '%'  . $request->search . '%');
                });
            })->whereNotNull('id')->paginate(20);
        }else{
            return Donation::whereHas('users',function ($q) use ($request) {
                return $q->when($request->search, function ($query)  use ($request) {
                    return $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('phone', 'like', '%'  . $request->search . '%')
                        ->orWhere('amount', 'like', '%'  . $request->search . '%');
                });
            })->whereNotNull('id')->where('id',auth()->user()->id)->paginate(20);
        }
    }

    public function Create(DonationStoreRequest $request)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;
        $data['kiosk_id'] = $user->kiosk_id;
        $data['amount'] = $request->amount;
        $data['category_id'] = $request->category_id;
        $data['type'] = $request->type;
        if ($request->type == 'visa')
            $data['number'] = $request->number;
        if (isset($request->id))
            $data['donator_id'] = $request->id;
        $donation = Donation::create($data);

        $kiosk = kiosk::find($user->kiosk_id);
        $kiosk->amount += $request->amount;
        $kiosk->transactions++;
        $kiosk->update();
        $donation->kiosk_transactions = $kiosk->transactions;
        $donation->kiosk_amount = $kiosk->amount;
        return $donation;
    }

    public function Show($id)
    {
        $type =  Auth::user()->type;
        if ($type == 'admin' || $type =='supervisor') {
            return Donation::findOrFail($id);
        }else{
            return Donation::where('id',auth()->user()->id)->findOrFail($id);
        }
    }

    public function Update(DonationUpdateRequest $request, Donation $donation)
    {
        return $donation->update($request->validated());
    }

    public function Delete($id)
    {
        return Donation::findOrFail($id)->delete();
    }

}
