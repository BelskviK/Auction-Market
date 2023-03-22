<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Lot;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    public function index(){
        $lots = Lot::with('category')->where('is_active', true)->orderBy('name', 'asc')->get();
        $categories = Category::withCount(['lots' => function ($query) {
            $query->where('is_active', true);
        }])
        ->orderByDesc('lots_count')
        ->paginate(10);
        return response(view("navbar\categories\index" , compact('categories', 'lots')));
    }


    //create category
    public function addCategory(Request $request){
        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required'=>'Empty field',
            ]    
        );
    
        $category = Category::withTrashed()->where('name', $request->name)->first();
        if ($category && $category->deleted_at === null) {
            // If category with the same name already exists and is active, return an error
            return response()->json([
                'status'=>'error',
                'message'=>'Category already exists',
            ], 422);
        }
    
        if ($category) {
            // If category with the same name already exists, update the existing record
            $category->deleted_at = null;
            $category->save();
    
            return response()->json([
                'status'=>'success',
            ]);
        } else {
            // Otherwise, create a new category
            $category = new Category();
            $category->name = $request->name;
            $category->save();
    
            return response()->json([
                'status'=>'success',
            ]);
        }
    }


    //update category
    public function updateCategory(Request $request){
        $request->validate(
            [
                'up_name' => 'required|unique:categories,name,'.$request->up_id,
            ],
            [
                'up_name.required'=>'Empty Field',
                'up_name.unique'=>'Category Already Exists',
            ]    
        );
        Category::where('id',$request->up_id)->update([
            'name'=>$request->up_name,
        ]);
        return response()->json([
            'status'=>'success',
        ]);
    }

    
    //delete category
    public function deleteCategory(Request $request){
        Category::find($request->category_id)->delete();
        return response()->json([
            'status'=>'success',
        ]);

    }


    //Undo delete category with toastr
    public function undoDelete(Request $request)
    {
        $category = Category::withTrashed()->find($request->category_id);
        
        if ($category) {
            $category->restore();
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found',
            ]);
        }
    }


    //search category
    public function searchCategory(Request $request){
        $categories = Category::where('name', 'like', '%'.$request->search_string.'%')
            ->orderBy('id','asc')
            ->paginate(10);
    
        $html = view('navbar\categories\search',compact('categories'))->render();
    
        if($categories->count() >= 1){
            return response()->json([
                'html' => $html,
            ]);
        }else{
            return response()->json([
                'status' => 'nothing_found',
            ]);
        }
        
    }
    
    

}
