@extends('layouts.base')
@section('body')
@extends('layouts.app')

<div class="container">
   <style> 
        .modal-dialog{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style> 

    <!-- <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#itemModal">Add<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-info btn-lg" id="customerbtn">Customer<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button> -->
    
    <div class="table-responsive">
        <table id="itable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Service ID</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="ibody">
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="itemModal" role="dialog" style="display:none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Service</h4>
            </div>
                <div class="modal-body">
                    <form id="iform" action="#" method="#" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control id" id="service_id" name="service_id">
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="form-group">
                            <label for="price" class="control-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="form-group">
                            <label for="img_path" class="control-label">Image</label>
                            <input type="file" class="form-control" id="img_path" name="uploads">
                        </div>
                    </form>
                </div>
            <div class="modal-footer" id="btnss">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button id="itemSubmit" type="submit" class="btn btn-primary">Save</button>
                <button id="itemUpdate" type="submit" class="btn btn-primary">Update</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="editItemModal" role="dialog" style="display:none">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
            <form id="ayform" method ="PUT" action="#" enctype="multipart/form-data">
                <input type="hidden">
                <div class="form-group">
                    <label for="sservice_id" class="control-label">Service ID:</label>
                    <input type="text" class="form-control" id="sservice_id" name="sservice_id" disabled >
                </div>
                <div class="form-group">
                    <label for="sdescription" class="control-label">Description:</label>
                    <input type="text" class="form-control" id="sdescription" name="sdescription" >
                </div>
                <div class="form-group">
                    <label for="sprice" class="control-label">Price:</label>
                    <input type="text" class="form-control" id="sprice" name="sprice">
                </div>
                {{-- <div class="form-group"> 
                    <label for="simg_path" class="control-label">Image:</label>
                    <input type="file" class="form-control" id="simg_path" name="uploads" >
                </div> --}}
            </form>
        </div>
        <div class="modal-footer">
            
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            <button id="updatebtnItem" type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</div>
</div>
@endsection