<?php
namespace App\Repository;
use App\Models\User;
use App\Models\kiosk;
use App\Models\User_kiosk;
use Illuminate\Http\Request;
use App\Http\Requests\kiosk\kioskStoreRequest;
use App\Http\Requests\kiosk\kioskUpdateRequest;


class KiosKRepository
{

    public function GetAll(Request $request)
    {
        return kiosk::all();
    }

    public function Create(kioskStoreRequest $request , kiosk $kiosks)
    {
        // dd($request->user_id);
      $kiosks = kiosk::create($request->validated());
    //   $kiosks->users()->sync($request->user_id);
    }

    public function Show($id)
    {
        return kiosk::findOrFail($id);
    }

    public function Update(kioskUpdateRequest $request, kiosk $kiosk)
    {
        return $kiosk->update($request->validated());
        // $kiosk->users()->sync($request->user_id);
    }

    public function Delete(kiosk $kiosk)
    {
        $kiosk->delete();
        $kiosk->users()->detach();
        return;
    }

}
