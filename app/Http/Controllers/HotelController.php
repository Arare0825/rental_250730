<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Hotel;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hid = Auth::user()->hid;
        $info = DB::table('hotels')
                ->where('hid',$hid)
                ->first();

        // dd($info);

        return view("hotel.index",['info'=>$info]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $hotel = Hotel::where('hid', $request->input('hid'))->first();
    
        if (!$hotel) {
            return response()->json(['message' => 'ホテルが見つかりません'], 404);
        }
    
        $hotel->open_time = $request->input('open_time');
        $hotel->close_time = $request->input('close_time');
        $hotel->allday_active = $request->boolean('allday_active');
        $hotel->explain_text_ja = $request->input('explain_text_ja');
        $hotel->explain_text_en = $request->input('explain_text_en');
        $hotel->order_text_ja = $request->input('order_text_ja');
        $hotel->order_text_en = $request->input('order_text_en');
        $hotel->save();
    
        return response()->json(['message' => '保存成功']);
    }    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
