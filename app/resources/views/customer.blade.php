@extends('layouts.app')
@section('content')
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="page-title">
            <h3>Cusotmer
                <a class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addModal"
                    ><i class="fas fa-user-shield"></i>
                    Add New</a>
            </h3>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <table width="100%" class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($customers as $customer)
                        <tr>
                       
                             <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->mobile }}</td>
                            <td>{{ $customer->address }}</td>
                            <td class="text-end">
                                
                                <a  class="btn btn-outline-info btn-rounded editpost"  id="editmodal" data-id="{{ $customer->id }}" ><i class="fas fa-pen" ></i></a>
                                <a  class="btn btn-outline-danger btn-rounded " id="deletePost" data-id="{{ $customer->id }}"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>
                         @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <!------------------------------------------ ADD MODAL  ---------------------------------------------------------->
        <div class="col-lg-12">
            <div class="card">
                <!-- <div class="card-header">Modal Form</div>
                                <div class="card-body text-center"> -->
                <!-- <h5 class="card-title">Example popup signin form</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Launch form</button> -->
                <div class="modal fade" id="addModal" role="dialog" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title ">Customer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                              
                                <form id="addForm">
                                
                                    @csrf
                                     <div class="mb-3">
                                        <label  class="form-label">Name</label>
                                        <input type="text" name="name" id="username" placeholder="Enter Name"
                                            class="form-control">
                                    </div>
                                     <div class="mb-3">
                                        <label  class="form-label">Mobile No</label>
                                        <input type="text" name="mobileno" id="mobile"placeholder="Enter Mobile"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label">Email</label>
                                        <input type="text" name="email" id="email"placeholder="Enter Address"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label">GST</label>
                                        <input type="text" name="gst" id="gst" placeholder="Enter GST"
                                            class="form-control">
                                    </div>
                                     <div class="mb-3">
                                        <label  class="form-label">Address</label>
                                        <textarea  class="form-control" id="address" rows="5" cols="50">

                                        </textarea>
                                        <!-- <input type="text" name="gst" placeholder="Enter GST"
                                            class="form-control"> -->
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success  float-end" id="add" >Add</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------------------------ END OF ADD MODAL  ---------------------------------------------------------->

         <!------------------------------------------ EDIT MODAL  ---------------------------------------------------------->
         <div class="col-lg-12">
            <div class="card">
                <!-- <div class="card-header">Modal Form</div>
                                <div class="card-body text-center"> -->
                <!-- <h5 class="card-title">Example popup signin form</h5>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Launch form</button> -->
                <div class="modal fade editModal" id="editmodal" role="dialog" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Customer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                              
                                <form id="editForm" accept-charset="utf-8">
                                    @csrf
                                     <div class="mb-3">
                                        <label  class="form-label">Name</label>
                                        <input type="text" name="name"  id="name1"placeholder="Enter Name"
                                            class="form-control">
                                    </div>
                                     <div class="mb-3">
                                        <label  class="form-label">Mobile No</label>
                                        <input type="text" name="mobileno" id="mobile1" placeholder="Enter Mobile"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label">Email</label>
                                        <input type="email" name="email" id="email1" placeholder="Enter Address"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label">GST</label>
                                        <input type="text" name="gst" id="gst1" placeholder="Enter GST"
                                            class="form-control">
                                    </div>
                                     <div class="mb-3">
                                        <label  class="form-label">Address</label>
                                        <textarea  class="form-control" id="address1"rows="5" cols="50">

                                        </textarea>
                                        <!-- <input type="text" name="gst" placeholder="Enter GST"
                                            class="form-control"> -->
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success  float-end update" id="update">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!------------------------------------------END OF EDIT MODAL  ---------------------------------------------------------->

    </div>
</div>
</div>



@endsection