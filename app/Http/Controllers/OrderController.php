<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setStatusPattern = Auth::user()->status_pattern;

        // dd($setStatusPattern);

        $statusPatterns = DB::table('status_patterns')
        ->select('status', 'status_name')
        ->where('status_pattern', $setStatusPattern)
        ->get();

        $orders = DB::table('orders')
                    ->leftJoin('status_patterns', 'orders.status', '=', 'status_patterns.status')
                    ->select('orders.*', 'status_patterns.status_name')
                    ->orderby("status")
                    ->get();
        // dd($statusPatterns);

        return view('order.index',['orders'=>$orders],['statusPatterns'=>$statusPatterns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();
    
        return response()->json(['message' => '更新成功']);
    }
        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function partialList()
    {
        $orders = DB::table('orders')
            ->leftJoin('status_patterns', 'orders.status', '=', 'status_patterns.status')
            ->orderBy('status')
            ->orderBy('created_at',"desc")
            ->select('orders.*', 'status_patterns.status_name')
            ->get();

        $statusPatterns = DB::table('status_patterns')->where('status_pattern', 0)->get();

        return view('order.orders_table', compact('orders', 'statusPatterns'));
}

}
