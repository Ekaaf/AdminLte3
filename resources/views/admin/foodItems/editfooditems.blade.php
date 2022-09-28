@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Food Items</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Food Items</a></li>
                        <li class="breadcrumb-item active">Add Food Items</li>
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
                            <h3 class="card-title">Add User</h3>
                        </div>

                        <div class="card-body">
                            @include('admin.layout.message')
                            <form method="post" action="{{URL::to('admin/fooditems/update')}}/{{$item->id}}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="">Select</option>
                                        @foreach($category as $cat)
                                        <option value="1" <?php if($item->category_id == $cat->id) echo "selected"; ?>>{{$cat->category}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{$item->title}}" placeholder="Enter title" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea id="description" name="description" class="form-control" required>{{$item->description}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price" value="{{$item->price}}" required>
                                </div>

                                <img src="{{URL::to($item->image)}}" class="img-fluid" style="width:200px" id="showpreview">
                                <br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>

                                    <input type="file" class="form-control" id="image" name="image" onchange="$('#showpreview').remove();">
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
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
</script>
@endsection