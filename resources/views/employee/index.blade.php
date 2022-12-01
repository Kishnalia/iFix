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
        <table id="etable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Employee ID</th>
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
            <tbody id="ebody">
            </tbody>
        </table>
    </div>
    </div>

    <div class="modal fade" id="eModal" role="dialog" style="display:none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create New Employee</h4>
                </div>
                    <div class="modal-body">
                        <form id="eform" action="#" method="#" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" class="form-control id" id="employee_id" name="employee_id">
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
                                <label for="roles" class="control-label" id="roles">Role:</label>
                                <select id="roles" name="roles"  class="form-control">
                                    <option value="Employee">Employee</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="img_path" class="control-label" id="limage">Image:</label>
                                <input type="file" class="form-control" id="img_path" name="uploads">
                            </div>
                        </form>
                    </div>
                <div class="modal-footer" id="btnss">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button id="eSubmit" type="submit" class="btn btn-primary">Save</button>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="editEmployeeModal" role="dialog" style="display:none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Employee</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <form id="editform" action="#" method="PUT" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="eemployee_id" class="control-label">Employee ID:</label>
                                <input type="text" class="form-control" id="eemployee_id" name="eemployee_id" disabled>
                            </div>
                            <div class="form-group">
                                <label for="etitle" class="control-label">Title:</label>
                                <input type="text" class="form-control" id="etitle" name="etitle">
                            </div>
                            <div class="form-group">
                                <label for="efname" class="control-label">First Name:</label>
                                <input type="text" class="form-control" id="efname" name="efname">
                            </div>
                            <div class="form-group">
                                <label for="elname" class="control-label">Last Name:</label>
                                <input type="text" class="form-control" id="elname" name="elname">
                            </div>
                            <div class="form-group">
                                <label for="eaddressline" class="control-label">Addressline:</label>
                                <input type="text" class="form-control " id="eaddressline" name="eaddressline">
                            </div>
                            <div class="form-group">
                                <label for="etown" class="control-label">Town:</label>
                                <input type="text" class="form-control" id="etown" name="etown">
                            </div>
                            <div class="form-group">
                                <label for="ezipcode" class="control-label">Zipcode:</label>
                                <input type="text" class="form-control " id="ezipcode" name="ezipcode">
                            </div>
                            <div class="form-group">
                                <label for="ephone" class="control-label">Phone:</label>
                                <input type="text" class="form-control " id="ephone" name="ephone">
                            </div>
                            {{-- <div class="form-group">
                                <label for="euploads" class="control-label">Image:</label>
                                <input type="file" class="form-control" id="euploads" name="euploads">
                            </div> --}}
                        </form>
                    </div>
                <div class="modal-footer" id="btnss">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button id="eUpdate" type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection
