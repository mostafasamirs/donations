<?php
namespace App\Repository;
use App\Models\User;
use App\Models\kiosk;
use App\Models\Category;
use App\Models\User_kiosk;
use Illuminate\Http\Request;
use App\Http\Requests\category\categoryStoreRequest;
use App\Http\Requests\category\categoryUpdateRequest;

class CategoryRepository
{

    public function GetAll(Request $request)
    {
        return Category::where(function ($q) use ($request) {
            return $q->when($request->search, function ($query)  use ($request) {
                return $query->where('name', 'like', '%' . $request->search . '%');
            });
        })->whereNotNull('id')->paginate(10);
    }

    public function Create(categoryStoreRequest $request , Category $categories)
    {
        // dd($request->user_id);
      $categories = Category::create($request->validated());
    //   $kiosks->users()->sync($request->user_id);
    }

    public function Show($id)
    {
        return Category::findOrFail($id);
    }

    public function Update(categoryUpdateRequest $request, Category $category)
    {
        return $category->update($request->validated());
        // $kiosk->users()->sync($request->user_id);
    }

    public function Delete(Category $category)
    {
        $category->delete();
        return;
    }

}
