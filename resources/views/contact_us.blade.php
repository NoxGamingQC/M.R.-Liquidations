@extends('layouts.app')
@section('title', 'Welcome')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{trans('contact_us.contact_us')}}</h1>
            <hr />
        </div>
        <div class="col-md-12">
            <label>{{trans('contact_us.name')}} *</label>
            <input class="form-control" type="text" placeholder="{{trans('contact_us.name_placeholder')}}">
            
            <label>{{trans('contact_us.email')}} *</label>
            <input class="form-control" type="text" placeholder="{{trans('contact_us.email_placeholder')}}">
            
            <label>{{trans('contact_us.object')}}</label>
            <input class="form-control" type="text" placeholder="{{trans('contact_us.object_placeholder')}}">
            
            <label>{{trans('contact_us.message')}} *</label>
            <textarea class="form-control" type="text" placeholder="{{trans('contact_us.message_placeholder')}}"></textarea>

            <br />
            <input class="btn btn-primary form-control" type="button" value="{{trans('general.send')}}"/>
        </div>
        <div class="col-md-12">
            <br />
        </div>
    </div>
</div>
@stop