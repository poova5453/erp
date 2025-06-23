<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchases; 
use App\Models\Customers; 

use App\Models\Items; // Adjust namespace as needed

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $purchase = Purchases::all();

    // Return to the view with data
    return view('purchase', compact('purchase'));
    }

   public function showForm()
{
    $items = Items::all(); // Or customize the fields you want
    $customers = Customers::all();
    return view('purchase-form', compact('items','customers'));
}
    // public function create()
    // {
    //      $items = Items::all(); // Adjust namespace as needed
    //    return view('purchase-form', compact('items'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
