<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LotBidLog;
use App\Models\Lot;
use App\Models\Category;
use Illuminate\Http\Response;

class BidController extends Controller
{   //stores bid when user is entering bid amount and name
    public function store(Request $request, Lot $lot)
    {
        $request->validate([
            'bid_amount' => 'required|numeric',
            'bidder_name' => 'required|string',
        ]);

        $bidLog = new LotBidLog();
        $bidLog->lot_id = $lot->id;
        $bidLog->bid_amount = $request['bid_amount'];
        $bidLog->bidder_name = $request['bidder_name'];
        $bidLog->save();

        return response()->json([
            'status'=>'success',
        ]);
    }


    //show bid
    public function show(): Response
    {  
        $categories=Category::all();
        $bids = LotBidLog::all();
        $content = view('navbar\bids\index', compact('bids','categories'))->render();
        return new Response($content);
    }


    //delete lot
    public function delete(Request $request){
        LotBidLog::find($request->bid_id)->delete();
        return response()->json([
            'status'=>'success',
        ]);
    
    }
}
