<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $customers = Customers::all();

    // Return to the view with data
    return view('customer', compact('customers'));
       
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
            'name' => 'required',
            'email' => 'required|email|unique:customer,email',
        ]);

        $customer = new Customers;
        $customer->name = $request->name;
        $customer->email =$request->email;
        $customer->mobile = $request->mobile;
        $customer->address = $request->address;

$customer->save();

        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    //  dd($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($customer)
    {
  
        $customer = Customers::findOrFail($customer);
        return response()->json($customer);
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
    public function destroy($customer)

    {
        // dd($customer);
     
         $customer = Customers::findOrFail($customer);
         $customer->delete();
        return response()->json([
    'success' => true,
    'message' => 'Deleted successfully',
    'redirect' => route('customer.index')  // Send the route as a value
]);
    }
}