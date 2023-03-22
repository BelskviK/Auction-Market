<?php
 
namespace App\Http\Controllers;

 
use App\Models\Category;
use App\Models\Lot;
use Illuminate\Http\Request;
 
class LotController extends Controller
{
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index(Lot $lot)
    {
        $categories = Category::all();
        $lots = Lot::orderBy('name', 'asc')->paginate(10);
        return response(view("navbar\lots\index" , compact('lots','categories')));
    }

    
    //create lot
    public function addLot(Request $request){
        $request->validate(
            [
                'name' => 'required',
                'cogs' => 'integer',
            ],
            [
                'name.required'=>'Name Required',
                'cogs.integer'=>'Please enter Price ',
            ]    
        );
    
        $lot = Lot::withTrashed()->where('name', $request->name)->first();
        if ($lot && $lot->deleted_at === null) {
            // If lot with the same name already exists and is active, return an error
            return response()->json([
                'status'=>'error',
                'message'=>'Lot already exists',
            ], 422);
        }
    
        if ($lot) {
            // If lot with the same name already exists, update the existing record
            $lot->cogs = $request->cogs;
            $lot->deleted_at = null;
            $lot->save();
    
            return response()->json([
                'status'=>'success',
            ]);
        } else {
           // Otherwise, create a new lot
            $lot = new Lot();
            $lot->name = $request->name;
            $lot->cogs = $request->cogs;
            $lot->category_id = $request->category; // set category_id instead of category
            $lot->description = $request->description;

            $lot->save();

            return response()->json([
                'status'=>'success',
            ]);

        }
    }

    
    //update lot
    public function updateLot(Request $request){
        $request->validate(
            [
                'up_name' => 'required|unique:lots,name,'.$request->up_id,
            ],
            [
                'up_name.required'=>'Name Required',
                'up_name.unique'=>'Lot Already Exists',
                'up_cogs.integer'=>'Please enter Price',
            ]    
        );
        Lot::where('id',$request->up_id)->update([
            'name'=>$request->up_name,
            'cogs'=>$request->up_cogs,
            'description'=>$request->up_description,
            'category_id'=>$request->up_category,
            'is_active'=>$request->up_is_active,
        ]);
        return response()->json([
            'status'=>'success',
        ]);
    }


    //delete lot
    public function deleteLot(Request $request){
        Lot::find($request->lot_id)->delete();
        return response()->json([
            'status'=>'success',
        ]);

    }

    //Undo delete lot with toastr
    public function undoDelete(Request $request)
    {
        $lot = Lot::withTrashed()->find($request->lot_id);
        if ($lot) {
            $lot->restore();
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Lot not found',
            ]);
        }
    }


    //search lot
    public function searchLot(Request $request){
        $query = Lot::query()->orderBy('name', 'asc');

        // search by lot name or COGS
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%'.$request->search_string.'%')
            ->orWhere('cogs', 'like', '%'.$request->search_string.'%');
        });

        // search for lots with no category assigned
        if ($request->search_string == 'no category') {
            $query->whereDoesntHave('category');
        }

        // search by category name
        $query->orWhereHas('category', function ($q) use ($request) {
            $q->where('name', 'like', '%'.$request->search_string.'%');
        });

        // paginate the results
        $lots = $query->orderBy('id', 'asc')->paginate(10);

        // render the view and return the response
        $html = view('navbar\lots\search', compact('lots'))->render();
        
        if ($lots->count() >= 1) {
            return response()->json([
                'html' => $html,
            ]);
        } else {
            return response()->json([
                'status' => 'nothing_found',
            ]);
        }  
    }

    //filter lots
    public function filterLots(Request $request)
    {
        $selectedLots = $request->get('lots');
    
        $lots = Lot::query();
    
        if (!empty($selectedLots)) {
            $lots->whereIn('category_id', $selectedLots);
        }
    
        $lots = $lots->orderBy('name', 'asc')->get();
    
        return view('navbar\lots\search', compact('lots'))->render();
    }
    
    

    //search lot price range
    public function priceRange(Request $request){
        $query = Lot::query()->orderBy('name', 'asc');

        // search by lot price range from
        if ($request->has('search_price_from')) {
            $query->where('cogs', '>=', $request->search_price_from);
        }

        // search by lot price range to
        if ($request->has('search_price_to')) {
            $query->where('cogs', '<=', $request->search_price_to);
        }

        // paginate the results
        $lots = $query->orderBy('id', 'asc')->paginate(10);

        // render the view and return the response
        $html = view('navbar\lots\search', compact('lots'))->render();

        if ($lots->count() >= 1) {
            return response()->json([
                'html' => $html,
            ]);
        } else {
            return response()->json([
                'status' => 'nothing_found',
            ]);
        }  
    }


    
    


    
    

    
}