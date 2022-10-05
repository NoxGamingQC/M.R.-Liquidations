@extends('layouts.app')
@section('title', trans('general.contact_us'))
@section('content')


<div class="col-md-12">
    <label>{{trans('contact_us.name')}} *</label>
    <input class="form-control input-lg disabled" type="text" placeholder="{{trans('contact_us.name_placeholder')}}" disabled>
    
    <label>{{trans('contact_us.email')}} *</label>
    <input class="form-control input-lg disabled" type="text" placeholder="{{trans('contact_us.email_placeholder')}}" disabled>
    
    <label>{{trans('contact_us.object')}}</label>
    <input class="form-control input-lg disabled" type="text" placeholder="{{trans('contact_us.object_placeholder')}}" disabled>
    
    <label>{{trans('contact_us.message')}} *</label>
    <textarea class="form-control input-lg disabled" type="text" placeholder="{{trans('contact_us.message_placeholder')}}" disabled></textarea>

    <br />
    <input class="btn btn-primary form-control disabled" type="button" value="{{trans('general.send')}}" disabled />
</div>
<div class="col-md-12">
    <br />
</div>
@stop