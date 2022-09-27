@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {!! session('success') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('flash_success'))
<div class="alert alert-success alert-dismissible fade in" role="alert" id="successMessage">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading" style="margin-bottom: 0px !important;">{!! session('flash_success') !!}</h4>
</div>
@endif

@if(session('error') || isset($error))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {!! session('error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('flash_error'))
<div class="alert alert-danger alert-dismissible fade in" role="alert" id="successMessage">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading" style="margin-bottom: 0px !important;">{!! session('flash_error') !!}</h4>
</div>
@endif

@if(session('info'))
<div class="alert alert-warning info-dismissible fade in" role="alert" >
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading" style="margin-bottom: 0px !important;">{!! session('info') !!}</h4>
</div>
@endif

@section('modal-error')
@if($errors->get('error_modal', null) == true)

    <div style="display: block;" class="modal modal-danger fade in" id="pop-modal-danger">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <h4 class="modal-title"></h4>
                    </button>
                </div>
                <div class="modal-body">
                    {{$errors->get('error_modal')[0]}}
                </div>
                <div class="modal-footer">
                    <button onclick="document.getElementById('pop-modal-danger').style.display ='none'"; type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection


@if (count($errors) > 0 and $errors->get('error_modal', null) == false)
    <!-- <div class="alert alert-danger">
        <strong>Whoops!</strong> There were problems with input:
        <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div> -->
@endif