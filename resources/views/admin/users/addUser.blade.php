@extends('admin.layout.master')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active">Add User</li>
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
                            <form method="post" action="{{URL::to('admin/users/save')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Enter email" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Confirm Password</label>
                                    <input type="password" class="form-control" id="con_password" name="con_password" placeholder="Confirm Password" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role</label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="">Select</option>
                                        <option value="1" <?php if(old('role') == 1) echo "selected"; ?>>Admin</option>
                                        <option value="2" <?php if(old('role') == 2) echo "selected"; ?>>User</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
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