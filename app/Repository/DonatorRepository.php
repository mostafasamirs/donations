<?php
namespace App\Repository;
use App\Models\chairty;
use App\Models\Donator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Donators\DonatorStoreRequest;
use App\Http\Requests\Donators\DonatorUpdateRequest;


class DonatorRepository
{

    public function GetAll(Request $request)
    {
        $type =  Auth::user()->type;
        if ($type == 'admin' || $type =='supervisor') {
            return Donator::where(function ($q) use ($request) {
                return $q->when($request->search, function ($query)  use ($request) {
                    return $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('phone', 'like', '%'  . $request->search . '%')
                        ->orWhere('amount', 'like', '%'  . $request->search . '%');
                });
            })->whereNotNull('id')->paginate(20);
        }else{
            return Donator::where(function ($q) use ($request) {
                return $q->when($request->search, function ($query)  use ($request) {
                    return $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('phone', 'like', '%'  . $request->search . '%')
                        ->orWhere('amount', 'like', '%'  . $request->search . '%');
                });
            })->whereNotNull('id')->where('id',auth()->user()->id)->paginate(20);
        }
    }

    public function Create(Array $params)
    {
        return Donator::create($params);
    }

    public function Show($id)
    {
        $type =  Auth::user()->type;
        if ($type == 'admin' || $type =='supervisor') {
            return Donator::findOrFail($id);
        }else{
            return Donator::where('id',auth()->user()->id)->findOrFail($id);
        }
    }

    public function Update(DonatorUpdateRequest $request, Donator $donator)
    {
        if ($request->phone === null) {
            $phone = $request->name;
        }else{
            $phone = $request->phone;
        }
        return $donator->update(array_merge($request->validated(),['mobile'=> $phone]));
    }

    public function SearchByMobile(Request $request)
    {
        return Donator::where('mobile', '=', $request->mobile)->first();
    }

    public function Delete($id)
    {
        return Donator::findOrFail($id)->delete();
    }

}
