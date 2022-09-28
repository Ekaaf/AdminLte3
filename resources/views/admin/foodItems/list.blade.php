@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Items</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Items</a></li>
                        <li class="breadcrumb-item active">Item List</li>
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
                            <h3 class="card-title">Items List</h3>
                            <a href="{{URL::to('admin/fooditems/add')}}" class="btn btn-success" style="float: right;">
			                    <i class="fa fa-plus-square"></i>&nbsp
			                    Add Item
			                </a>
                        </div>

                        <div class="card-body">
                            @include('admin.layout.message')
                            <table class="table table-bordered" id="table">
								<thead>
									<tr>
										<th style="width: 10px">#</th>
										<th>Category</th>
										<th>Item Name</th>
										<th>Description</th>
                                        <th>Price</th>
                                        <th>Image</th>
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
        getAllitems();
    });
    function getAllitems(){
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
                "url": './fooditemslist',
                "type": 'POST',
                // "data": function ( d ) {
                //     d.current_semester = $('#current_semester').val();
                    
                // },
            },
            "columns": [
                { "data": "0" },
                { "data": "category" },
                { "data": "title" },
                { "data": "description" },
                { "data": "price" },
                { "data": "image",
                  "render": function ( data, type, full, meta ) {
                    return '<img src="../'+data+'" class="img-fluid" alt="Responsive image" style="width:200px;">';
                  }
                },
                { "data": "id",
                  "render": function ( data, type, full, meta ) {
                    var buttons = "";
                        buttons += "<a href=\"fooditems/edit/"+data+"\"><button class=\"btn btn-xs btn-info\"><i class=\"fa fa-edit\"></i>&nbsp Edit</button></a>";
                        buttons += "&nbsp<button class=\"btn btn-xs btn-danger\" onclick=\"deleteItem("+data+")\"><i class=\"fa fa-trash\"></i>&nbsp Delete</button>"
                    return buttons;
                  }
                }
            ]
        });
    }


    function deleteItem(id){
        var txt;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (confirm("Are you sure you want to delete ? ") == true) {
            $.ajax({
                type: 'POST',
                url: 'fooditems/delete/'+id,
                data: {
                  id : id
                },
                dataType: 'text',
            })
            .done(function (data) {
                if(data){
                    alert("Successfully Deleted");
                    getAllitems();
                }
                else{
                    alert("Sorry, something went wrong")
                }
            });
        }
        
        
    }
</script>
@endsection