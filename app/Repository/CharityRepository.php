<?php
namespace App\Repository;
use App\Models\chairty;
use Illuminate\Http\Request;
use App\Http\Requests\category\categoryStoreRequest;
use App\Http\Requests\category\categoryUpdateRequest;


class CharityRepository
{

    public function GetAll(Request $request)
    {
        return chairty::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query)  use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%'  . $request->search . '%')
                    ->orWhere('amount', 'like', '%'  . $request->search . '%');
            });
        })->whereNotNull('id')->paginate(20);
    }

    public function Create(categoryStoreRequest $request)
    {
        return chairty::create($request->validated());
    }

    public function Show($id)
    {
        return chairty::findOrFail($id);
    }

    public function Update(categoryUpdateRequest $request, chairty $charity)
    {
        return $charity->update($request->validated());
    }

    public function Delete($id)
    {
        return chairty::findOrFail($id)->delete();
    }

}
