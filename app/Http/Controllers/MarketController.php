<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\Category;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {   $categories =Category::all();
        $lots = Lot::with('category')->where('is_active', true)->orderBy('name', 'asc')->get();

        return view('navbar\market\index', compact('lots','categories'));
    }
    

    // search lot
    public function searchActiveLot(Request $request){
        
        $query = Lot::where('is_active', $request->is_active);

        // search by lot name or COGS
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%'.$request->search_string.'%')
            ->orWhere('cogs', 'like', '%'.$request->search_string.'%')
            ->orWhere('description', 'like', '%'.$request->search_string.'%');
        });

        // search by category name
        $query->orWhereHas('category', function ($q) use ($request) {
            $q->where('name', 'like', '%'.$request->search_string.'%')
              ->where('is_active', 1); // Add this line to filter lots by their "is_active" status
        });
        

        // paginate the results
        $lots = $query->orderBy('name', 'asc')->paginate(10);

        // render the view and return the response
        $html = view('navbar\market\search', compact('lots'))->render();

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

    //filter lots with category checkbox
    public function filterLots(Request $request)
    {
        $selectedCategories = $request->get('categories');

        if (!empty($selectedCategories)) {
            $lots = Lot::where('is_active', 1)
                ->whereIn('category_id', $selectedCategories)
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $lots = Lot::where('is_active', 1)
                ->orderBy('name', 'asc')
                ->get();
        }

        return view('navbar\market\search', compact('lots'))->render();
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
        $html = view('navbar\market\search', compact('lots'))->render();

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
