<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hid = Auth::user()->hid;

        $items = DB::table('items')
                    ->select("id","hid","sort","item_name_ja","stock",'visible')
                    ->where("hid",$hid)
                    ->orderBy("sort")
                    ->get();
        // dd($items);

        return view('item.index',['items'=>$items]);
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
        $id = $request->input('id');
    
        // IDがあれば更新、なければ新規登録
        $item = $id ? Item::find($id) : new Item();
    
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }
    
        $item->item_name_ja = $request->input('item_name_ja');
        $item->item_name_en = $request->input('item_name_en');
        $item->stock = $request->input('stock');
        $item->visible = $request->input('visible');
        $item->hid = $request->input('hid');
        $item->i_name = $request->input('i_name');
    
        // sort を自動セット（新規登録時のみ）
        if (!$id) {
            $maxSort = \DB::table('items')
                ->where('hid', $item->hid)
                ->max('sort');
            $item->sort = $maxSort ? $maxSort + 1 : 1;
        }
    
        $item->save();
    
        return response()->json($item);
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        // 該当IDのItemを取得
        $item = Item::find($id);
    
        // データがあればJSONで返す
        if ($item) {
            return response()->json($item);
        }else{
            return response()->json("新規作成");

        }
    
        // なければエラーレスポンス
        // return response()->json(['error' => 'Item not found'], 404);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(s $s)
    {
        //
    }

    public function sortUpdate(Request $request)
    {
        foreach ($request->items as $item) {
            DB::table('items')
                ->where('id', $item['id'])
                ->update(['sort' => $item['sort']]);
        }
    
        return response()->json(['message' => '並び順を更新しました']);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, s $s)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Item::find($id);
    
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }
    
        $item->delete();
    
        return response()->json(['message' => '削除しました', 'id' => $id]);
    }}
