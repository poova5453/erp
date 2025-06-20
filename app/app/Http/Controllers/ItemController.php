<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;   

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $items = Items::all();

    // Return to the view with data
    return view('item','purchase-form', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'itemname' => 'required',
            'itemcode' => 'required',
            'gst' => 'required|numeric',
            'rate' => 'required|numeric',
        ]);

        $item = new Items;
        $item->itemname = $request->itemname;
        $item->itemcode = $request->itemcode;
        $item->gst = $request->gst;
        $item->rate = $request->rate;

        $item->save();

       return response()->json([
            'redirect' => route('item.index')
        ]);
    }

   public function getItems()
{
    $items = Items::all(); // or customize the query as needed
    return view('purchase-form', compact('items'));
}
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Items::findOrFail($id);
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $item = Items::findOrFail($id);
    $item->itemname = $request->itemname;
    $item->itemcode = $request->itemcode;
    $item->gst = $request->gst;
    $item->rate = $request->rate;
    $item->save();

    return response()->json([
            'redirect' => route('item.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Items::findOrFail($id);
        $item->delete();

        return response()->json([
            'redirect' => route('item.index')
        ]);
    }
}
