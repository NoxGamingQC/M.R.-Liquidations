
@if (Session::has('success'))
    <div class="row alert alert-dismissible" role="alert">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="col-md-9">
                        <strong>{{trans('general.success')}} - </strong> {{ session('success') }}
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if (Session::has('error'))
    <div class="row alert alert-dismissible" role="alert">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-body">
                    <div class="col-md-9">
                        <strong>{{trans('general.error')}} - </strong> {{ session('error') }}
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if (Session::has('warning'))
    <div class="row alert alert-dismissible" role="alert">
        <div class="col-md-12">
            <div class="panel panel-warning">
                <div class="panel-body">
                    <div class="col-md-9">
                        <strong>{{trans('general.warning')}} - </strong> {{ session('warning') }}
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if (Session::has('info'))
    <div class="row alert alert-dismissible" role="alert">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-body">
                    <div class="col-md-9">
                        <strong>{{trans('general.info')}} - </strong> {{ session('info') }}
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif