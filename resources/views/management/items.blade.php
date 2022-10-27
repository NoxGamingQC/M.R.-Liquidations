@extends('layouts.app', ['forceTitle' => true])
@section('title', trans('management.item_management'))
@section('content')
@section('forceTitle', false)
@include('modals.add_item')

<div class="row">
    <div class="col-md-9">
        <h1>{{trans('management.item_management')}}</h1>
    </div>
    <div class="col-md-3 text-right">
        <h1><button type="button" class=" btn-add-item btn btn-success" data-toggle="modal" data-target="#addItemModal"><i class="fa fa-plus" aria-hidden="true"></i></button></h1>
    </div>
    <div class="col-md-12">
        <hr />
    </div>
</div>
<div class="col-md-12 table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>#</th>
            <th>{{trans('store.name')}}</th>
            <th>{{trans('store.description')}}</th>
            <th class="text-center">{{trans('store.price')}}</th>
            <th class="text-center">{{trans('store.stock')}}</th>
            <th class="text-center">{{trans('store.isAvailable')}}</th>
            <th class="text-center">{{trans('store.isHidden')}}</th>
            <th class="text-center">{{trans('general.view')}}</th>
            <th class="text-center">{{trans('general.edit')}}</th>
        </tr>
        @foreach($items as $key => $item)
            <tr>
                <td class="text-center">{{$item->id}}</td>
                <td class="limit-text-length" title="{{$item->name}}">{{$item->name}}</td>
                <td class="limit-text-length" title="{{$item->description}}">{{$item->description}}</td>
                <td class="text-center">{{$item->price}}</td>
                <td class="text-center {{($item->stock > 0) ? 'success' : 'danger'}}">{{$item->stock}}</td>
                <td class="text-center {{$item->isAvailable ? 'success' : 'danger'}}">{{$item->isAvailable ? trans('general.yes') : trans('general.no')}}</td>
                <td class="text-center {{$item->isHidden ? 'danger' : 'success'}}">{{$item->isHidden ? trans('general.yes') : trans('general.no')}}</td>
                <td class="text-center"><a class="btn btn-primary btn-sm" href="/store/item/{{$item->id}}"><i class="fa fa-eye" area-hidden="true"></i></a></td>
                <td class="text-center"><a class="btn btn-warning btn-sm" href="/management/item/{{$item->id}}"><i class="fa fa-pencil" area-hidden="true"></i></a></td>
            </tr>
        @endforeach
    </table>
</div>
@stop