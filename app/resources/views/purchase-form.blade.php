@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container">
        <div class="page-title">
            <h3>Users
                <!-- <a href="roles.html" class="btn btn-sm btn-outline-primary float-end"><i class="fas fa-plus-circle"></i> Add</a> -->
                <a href="{{route('purchase.index')}}" class="btn btn-sm btn-outline-info float-end me-1"><i
                        class="fas fa-angle-left"></i> <span class="btn-header">Return</span></a>
            </h3>
        </div>
   
            <!-- <select class="form-control itemName" onchange id="itemName" name="itemName" style="width:250px;">
                <option class="form-control" value="">Select Customers</option>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}" data-name="{{ $customer->name }}">
                    {{ $customer->name }}
                </option>
                @endforeach
            </select>
            <input class="form-control" type="text" id="itemGst"> -->
             <div class="box-body">
                <table width="100%" class="table table-hover">
                    <thead>
                     
                    </thead>
                    <tbody>
          <td> 
               <select class="form-control "  id="itemName" name="itemName" >
                <option class="form-control" value="">Select Customers</option>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}" data-name="{{ $customer->name }}">
                    {{ $customer->name }}
                </option>
                @endforeach
            </select>
        </td> 
            <td>
            <input style="width:200px;"class="form-control" type="date" id="itemGst"></td>
    </tbody>
</table>

        <div class="box box-primary">
            <div class="box-body">
                <table width="100%" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item Name</th>
                            <th>GST</th>
                            <!-- <th>HSN</th>
                            <th>Unit</th> -->
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>CGST</th>
                            <th>SGST</th>
                            <!-- <th>IGST</th> -->
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="itemsTableBody">

                    </tbody>
                    <tbody>

                        <!-- <tr>
                                <td><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></td>
                        </tr> -->
                        <tr>
                            <td>1</td>
                            <td>
                                <select class="form-control itemName" onchange id="itemName" name="itemName"
                                    style="width:250px;">
                                    <option class="form-control" value="">Select Item</option>
                                    @foreach($items as $item)
                                    <option value="{{ $item->itemname }}" data-gst="{{ $item->gst }}"
                                        data-rate="{{ $item->rate }}" data-name="{{ $item->itemname }}">
                                        {{ $item->itemname }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input class="form-control" type="text" id="itemGst"></td>
                            <!-- <td><input class="form-control" type="text" id="itemHsn"></td>
                            <td><input class="form-control" type="text" id="itemUnit"></td> -->
                            <td><input class="form-control" type="text" id="itemQty"></td>
                            <td><input class="form-control" type="text" id="itemRate"></td>
                            <td><input class="form-control" type="text" id="itemAmount"></td>
                            <td><input class="form-control" type="text" id="itemCgst"></td>
                            <td><input class="form-control" type="text" id="itemSgst"></td>
                            <!-- <td><input class="form-control"type="text" id="itemIgst"></td> -->
                            <td><input class="form-control" type="text" id="itemTotalAmount"></td>

                            <td><button class="btn btn-primary add-new"><i class="fas fa-plus"></i></button></td>


                        </tr>

                    </tbody>
                </table>
            </div>



            <div class="container row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <table class="table  dataTable no-footer">
                        <thead>
                            <tr>
                                <th>

                                    <label>Narration</label>
                                    <textarea class="form-control" name="narration" type="text" rows=2></textarea>

                                </th>
                            </tr>
                        </thead>
                    </table>

                </div>
                <div class="col-md-2 col-sm-2 col-xs-12"></div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <table class="table " style="width:400px;height:40px ! important;">
                        <thead>
                            <!-- <tr>
                             <th colspan=2 >
                                    <td><button class="btn btn-primary add-new">Add New</button></td>
                             </th>
                         </tr> -->
                            <tr>
                                <th style="font-size:14px;">Total Quantity</th>
                                <th style="text-align:right;"></th>
                                <td><input style="height:10px;" class="form-control form-control-sm" id="totalQty"
                                        type="text" readonly></td>

                            </tr>
                            <tr>
                                <th style="font-size:14px;">Sub Total</th>
                                <th style="text-align:right;"></th>
                                <td><input style="height:10px;" class="form-control form-control-sm" id="subTotal"
                                        type="text" readonly></td>

                            </tr>
                            <tr>
                                <th style="font-size:14px;">CGST</th>
                                <th style="text-align:right;"></th>
                                <td><input style="height:10px;" class="form-control form-control-sm" id="totalCgst"
                                        type="text" readonly></td>

                            </tr>
                            <tr>
                                <th style="font-size:14px;">SGST</th>
                                <th style="text-align:right;"></th>
                                <td><input style="height:10px;" class="form-control form-control-sm" id="totalSgst"
                                        type="text" readonly></td>

                            </tr>
                            <!-- <tr >
                             <th style="font-size:14px;">IGST</th>
                             <th style="text-align:right;"></th>
                             <td><input style="height:10px;" class="form-control form-control-sm"   id="igst"  type="text" readonly></td>

                         </tr> -->
                            <tr>
                                <th style="font-size:14px;">Total GST</th>
                                <th style="text-align:right;"></th>
                                <td><input style="height:10px;" class="form-control form-control-sm" id="totalGst"
                                        type="text" readonly></td>

                            </tr>
                            <!-- <tr >
                             <th style="font-size:14px;">Round Off</th>
                             <th style="text-align:right;"></th>
                             <td><input style="height:10px;" class="form-control form-control-sm " type="text" readonly></td>

                         </tr> -->
                            <tr>
                                <th>Total Amount</th>
                                <th style="text-align:right;"></th>
                                <td><input style="height:10px;" class="form-control form-control-sm" id="totalAmount"
                                        type="text" readonly></td>

                            </tr>

                        </thead>
                    </table><br><br>
                    <button type="submit" class="btn mb-2 btn-info pull-right">
                        <span class="text">Save</span>
                        <!-- <span class="text" >Saving...
                         <i class="fa fa-spin fa-spinner" id="spin"></i>
                     </span> -->
                    </button>
                    <button type="button" class="btn mb-2 btn-secondary pull-right">Cancel</button>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- <div class="panel panel-default">
     <div class="panel-body p-0">
         <div class="row">
             <div class="col-md-6 col-sm-6 col-xs-12">
                 <table class="table  dataTable no-footer">
                     <thead>
                         <tr>
                             <th style="font-size:14px;">
                               
                                     <label>Narration</label>
                                     <textarea name="narration"  type="text"
                                         rows=2></textarea>
                                
                             </th>
                         </tr>
                     </thead>
                 </table>

             </div>
             <div class="col-md-2 col-sm-2 col-xs-12"></div>
             <div class="col-md-4 col-sm-4 col-xs-12">
                 <table class="table b-t b-b dataTable no-footer">
                     <thead>
                         <tr>
                             <th colspan=2 >
                                 <a > Add New +</a>
                             </th>
                         </tr>
                         <tr>
                             <th>Total Quantity</th>
                             <th style="text-align:right;"></th>
                         </tr>
                         <tr >
                             <th>Sub Total</th>
                             <th style="text-align:right;"></th>
                         </tr>
                         <tr >
                             <th>CGST</th>
                             <th style="text-align:right;"></th>
                         </tr>
                         <tr >
                             <th>SGST</th>
                             <th style="text-align:right;"></th>
                         </tr>
                         <tr >
                             <th>IGST</th>
                             <th style="text-align:right;"></th>
                         </tr>
                         <tr >
                             <th>Total GST</th>
                             <th style="text-align:right;"></th>
                         </tr>
                         <tr >
                             <th>Round Off</th>
                             <th style="text-align:right;"></th>
                         </tr>
                         <tr >
                             <th>Total Amount</th>
                             <th style="text-align:right;"></th>
                         </tr>

                     </thead>
                 </table><br><br>
                 <button type="submit" class="btn m-b-xs w-xs btn-info m-r-10 pull-right">
                     <span class="text" >Save</span>
                     <span class="text" >Saving...
                         <i class="fa fa-spin fa-spinner" id="spin"></i>
                     </span>
                 </button>
                 <button type="button" 
                     class="btn m-b-xs w-xs btn-accent m-r-10 pull-right">Cancel</button>

             </div>
         </div>
     </div>
 </div>
  -->
@endsection