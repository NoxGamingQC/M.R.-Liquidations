@extends('layouts.app')
@section('title', trans('management.item_management'))
@section('content')


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
            <th class="text-center">{{trans('general.delete')}}</th>
        </tr>
        @foreach($items as $key => $item)
            <tr>
                <td class="text-center">{{$item->id}}</td>
                <td class="limit-text-length">{{$item->name}}</td>
                <td class="limit-text-length">{{$item->description}}</td>
                <td class="text-center">{{$item->price}}</td>
                <td class="text-center">{{$item->stock}}</td>
                <td class="text-center">{{$item->isAvailable ? trans('general.yes') : trans('general.no')}}</td>
                <td class="text-center">{{$item->isHidden ? trans('general.yes') : trans('general.no')}}</td>
                <td class="text-center"><a class="btn btn-primary btn-sm" href="/store/item/{{$item->id}}"><i class="fa fa-eye" area-hidden="true"></i></a></td>
                <td class="text-center"><a class="btn btn-warning btn-sm" href="/management/item/{{$item->id}}"><i class="fa fa-pencil" area-hidden="true"></i></a></td>
                <td class="text-center"><a class="btn btn-danger btn-sm disabled" href="#" disabled><i class="fa fa-times" area-hidden="true"></i></a></td>
            </tr>
        @endforeach
    </table>
</div>
@stop