@extends('layouts.welcome')
@section('title', 'Welcome')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="title text-right text-primary">819-989-0867</h2>
        </div>
        <div class="col-md-12 text-center">
            <img src="/img/logo.png" class="img-fluid" style="max-width: 100%;" />
            <h1 class="title text-primary" style="">{{trans('general.slogan')}}</h1>
        </div>
        <div class="col-md-offset-6 col-md-6 text-center">
            <h3 class="title text-primary"><b>{{trans('general.fast_delivery')}}</b></h3>
        </div>
        <div class="col-md-6 text-center">
            <h3 class="title text-primary"><b>{{trans('general.warranty_30')}}</b></h3>
        </div>
        <div class="col-md-6 text-center">
            <br />
            <br />
        </div>
        <div class="col-md-12 text-center">
            <a class="btn btn-primary title disabled" href="/{{app()->getLocale()}}/store" style="font-size: 50px; padding:2%; padding-left:5%; padding-right: 5%" disabled>{{trans('general.store')}}</a>
        </div>
    </div>
</div>
@stop