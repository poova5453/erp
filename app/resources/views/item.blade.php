@extends('layouts.app')
@section('content')
@if(session('success'))
<script>
    window.addEventListener('DOMContentLoaded', () => {
        showToast("{{ session('success') }}", true);
    });
</script>
@endif
<!------ toast------>
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
    <div id="toastMessage" class="toast align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body" id="toast-body">

            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>


<!------ toast end------>
<div class="content">
    <div class="container">
        <div class="page-title">
            <h3>Item master
                <a class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-user-shield"></i>
                    Add New</a>
            </h3>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <table width="100%" class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th>Itemcode</th>
                            <th>ItemName</th>
                            <th>Gst</th>
                            <th>Rate</th>
                            

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>

                            <td>{{ $item->itemcode }}</td>
                            <td>{{ $item->itemname }}</td>
                            <td>{{ $item->gst }}</td>
                            <td>{{ $item->rate }}</td>

                            <td class="text-end">

                                <a class="btn btn-outline-info btn-rounded editpost" id="editmodal" data-id="{{ $item->id }}"><i class="fas fa-pen"></i></a>
                                <a class="btn btn-outline-danger btn-rounded " id="deletePost" data-id="{{ $item->id }}"><i class="fas fa-trash"></i></a>

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
                                <h5 class="modal-title ">Item Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">

                                <form id="addForm">

                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">ItemName</label>
                                        <input type="text" name="itemname" id="itemname" placeholder="Enter ItemName"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Item Code</label>
                                        <input type="text" name="itemcode" id="itemcode" placeholder="Enter item code"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Gst</label>
                                        <input type="text" name="gst" id="gst" placeholder="Enter Gst"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Rate</label>
                                        <input type="text" name="rate" id="rate" placeholder="Enter Rate"
                                            class="form-control">
                                    </div>
                                    

                                    <div class="mb-3">
                                        <button type="button" class="btn btn-success  float-end" id="add">Add</button>
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

                                <form>
                                    @csrf
                                        <div class="mb-3">
                                              <input type="text" name="id1" id="id1" placeholder="Enter Name"
                                        class="form-control" vlaue="">
                                            <label class="form-label">ItemName</label>
                                            <input type="text" name="itemname1" id="itemname1" placeholder="Enter ItemName"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Item Code</label>
                                            <input type="text" name="itemcode1" id="itemcode1" placeholder="Enter item code"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gst</label>
                                            <input type="text" name="gst1" id="gst1" placeholder="Enter Gst"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Rate</label>
                                            <input type="text" name="rate1" id="rate1" placeholder="Enter Rate"
                                                class="form-control">
                                        </div>
                                        <!-- <input type="text" name="gst" placeholder="Enter GST"
                                            class="form-control"> -->
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-success  float-end update" id="update">Update</button>
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