@extends('layouts.base')
@extends('layouts.app')

@section('body')
<div class="container">
    <style> 
        .modal-dialog{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style> 

    <div class="container">
        <table id="ctable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Title</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Addressline</th>
                    <th>Town</th>
                    <th>Zipcode</th>
                    <th>Phone</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="cbody">
            </tbody>
        </table>
    </div>
    </div>

    <div class="modal fade" id="cModal" role="dialog" style="display:none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create New Customer</h4>
                </div>
                    <div class="modal-body">
                        <form id="cform" action="#" method="#" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" class="form-control id" id="customer_id" name="customer_id">
                            </div>
                            <div class="form-group">
                                <label for="title" class="control-label">Title:</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="fname" class="control-label">First Name:</label>
                                <input type="text" class="form-control" id="fname" name="fname">
                            </div>
                            <div class="form-group">
                                <label for="lname" class="control-label">Last Name:</label>
                                <input type="text" class="form-control" id="lname" name="lname">
                            </div>
                            <div class="form-group">
                                <label for="addressline" class="control-label">Addressline:</label>
                                <input type="text" class="form-control " id="addressline" name="addressline">
                            </div>
                            <div class="form-group">
                                <label for="town" class="control-label">Town:</label>
                                <input type="text" class="form-control " id="town" name="town">
                            </div>
                            <div class="form-group">
                                <label for="zipcode" class="control-label">Zipcode:</label>
                                <input type="text" class="form-control " id="zipcode" name="zipcode">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="control-label">Phone:</label>
                                <input type="text" class="form-control " id="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label" id="lemail">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label" id="lpassword">Password:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <div class="form-group">
                                <label for="img_path" class="control-label" id="limage">Image:</label>
                                <input type="file" class="form-control" id="img_path" name="uploads">
                            </div>
                        </form>
                    </div>
                <div class="modal-footer" id="btnss">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button id="bSubmit" type="submit" class="btn btn-primary">Save</button>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="editCustomerModal" role="dialog" style="display:none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Customer</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <form id="editform" action="#" method="PUT" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="ccustomer_id" class="control-label">Customer ID:</label>
                                <input type="text" class="form-control" id="ccustomer_id" name="ccustomer_id" disabled>
                            </div>
                            <div class="form-group">
                                <label for="ctitle" class="control-label">Title:</label>
                                <input type="text" class="form-control" id="ctitle" name="ctitle">
                            </div>
                            <div class="form-group">
                                <label for="cfname" class="control-label">First Name:</label>
                                <input type="text" class="form-control" id="cfname" name="cfname">
                            </div>
                            <div class="form-group">
                                <label for="clname" class="control-label">Last Name:</label>
                                <input type="text" class="form-control" id="clname" name="clname">
                            </div>
                            <div class="form-group">
                                <label for="caddressline" class="control-label">Addressline:</label>
                                <input type="text" class="form-control " id="caddressline" name="caddressline">
                            </div>
                            <div class="form-group">
                                <label for="ctown" class="control-label">Town:</label>
                                <input type="text" class="form-control" id="ctown" name="ctown">
                            </div>
                            <div class="form-group">
                                <label for="czipcode" class="control-label">Zipcode:</label>
                                <input type="text" class="form-control " id="czipcode" name="czipcode">
                            </div>
                            <div class="form-group">
                                <label for="cphone" class="control-label">Phone:</label>
                                <input type="text" class="form-control " id="cphone" name="cphone">
                            </div>
                            <div class="form-group">
                                <label for="cuploads" class="control-label">Image:</label>
                                <input type="file" class="form-control" id="cuploads" name="cuploads">
                            </div>
                        </form>
                    </div>
                <div class="modal-footer" id="btnss">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button id="bUpdate" type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

@endsection
