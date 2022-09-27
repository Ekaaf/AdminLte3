@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active">User List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">User List</h3>
                            <a href="{{URL::to('admin/users/add')}}" class="btn btn-success" style="float: right;">
			                    <i class="fa fa-plus-square"></i>&nbsp
			                    Add User
			                </a>
                        </div>

                        <div class="card-body">
                            @include('admin.layout.message')
                            <table class="table table-bordered" id="table">
								<thead>
									<tr>
										<th style="width: 10px">#</th>
										<th>Email</th>
										<th>Role</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
	$(document).ready(function(){
        getAllUsers();
    });
    function getAllUsers(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table= $('#table').DataTable( {
            "processing": true,
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            "pageLength": 10,
            "serverSide": true,
            "destroy" :true,
            "ajax": {
                "url": './userlist',
                "type": 'POST',
                // "data": function ( d ) {
                //     d.current_semester = $('#current_semester').val();
                    
                // },
            },
            "columns": [
                { "data": "0" },
                { "data": "email" },
                { "data": "role" },
                { "data": "id",
                  "render": function ( data, type, full, meta ) {
                    var buttons = "";
                        buttons += "<a href=\"users/edit/"+data+"\"><button class=\"btn btn-xs btn-info\"><i class=\"fa fa-edit\"></i>&nbsp Edit</button></a>";
                        buttons += "&nbsp<button class=\"btn btn-xs btn-danger\" onclick=\"deleteUser("+data+")\"><i class=\"fa fa-trash\"></i>&nbsp Delete</button>"
                    return buttons;
                  }
                }
            ]
        });
    }
</script>
@endsection