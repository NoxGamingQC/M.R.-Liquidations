@extends('layouts.app')
@section('title', 'My Cart')
@section('content')

@if(count($shoppingCart) > 0)
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">Item</th>
                <th class="text-center" scope="col">Quantity</th>
                <th class="text-center" scope="col">Price</th>
                <th class="text-center" scope="col">Remove</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shoppingCart as $key => $item)
                <tr>
                    <th class="text-center" scope="row">{{$key + 1}}</th>
                    <td class="text-center">{{$item->name}}</td>
                    <td class="text-center">{{$item->quantity}}</td>
                    <td class="text-center">{{$item->price}}$</td>
                    <td class="text-center"><a class="btn btn-danger btn-sm"><i class="fa fa-times" area-hidden="true"></i></a></td>
                </tr>
            @endforeach
            <tr>
                <th class="" scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th class="text-center no-border" scope="row"></th>
                <td class="text-center no-border"></td>
                <td class="text-right no-border"><b>Total - </b></td>
                <td class="text-center no-border"><b>{{$total}}$</b></td>
                <td class="text-center no-border"></td>
            </tr>
            <tr>
                <th class="text-center no-border" scope="row"></th>
                <td class="text-center no-border"></td>
                <td class="text-right no-border"><b>TPS -</b></td>
                <td class="text-center no-border"><b>{{number_format($total * 0.05, 2)}}$</b></td>
                <td class="text-center no-border"></td>
            </tr>
            <tr>
                <th class="text-center no-border" scope="row"></th>
                <td class="text-center no-border"></td>
                <td class="text-right no-border"><b>TVQ -</b></td>
                <td class="text-center no-border"><b>{{number_format($total * 0.09975, 2)}}$</b></td>
                <td class="text-center no-border"></td>
            </tr>
            <tr>
                <th class="text-center no-border" scope="row"></th>
                <td class="text-center no-border"></td>
                <td class="text-right no-border"><b>Grand total -</b></td>
                <td class="text-center no-border"><b>{{number_format($total + ($total * 0.05) + ($total * 0.09975), 2)}}$</b></td>
                <td class="text-center no-border"></td>
            </tr>
        </tbody>
    </table>
@else
    <div class="col-md-12 text-center">
        <h3>No content in cart</h3>
    </div>
@endif

@endsection