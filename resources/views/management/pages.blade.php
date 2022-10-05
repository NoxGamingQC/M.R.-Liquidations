@extends('layouts.app')
@section('title', trans('management.pages'))
@section('content')

@foreach ($pages as $key => $value)
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-1 text-center">
                    <label>{{trans('management.slug')}}: </label>
                </div>
                <div class="col-md-3 text-center">
                    <input type="text" class="form-control disabled" value="{{$value->slug}}" disabled>
                </div>
                <div class="col-md-4 text-center">
                    <label>{{trans('management.inMaintenance')}}: </label>
                    <input id="inMaintenance-{{$value->id}}" type="checkbox" {{$value->inMaintenance ? 'checked' : ''}}>
                </div>
                <div class="col-md-4 text-center">
                    <button id="{{$value->id}}" type="button" class="btn btn-success submit-pages disabled" disabled><i class="fa fa-save" area-hidden="true"></i></button>
                </div>
            </div>
            <hr />
        </div>
    </div>
@endforeach
@stop