@extends('layouts.app')
@section('title', 'Welcome')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Boutique</h1>
            <hr />
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
                    <input type="text" class="form-control" placeholder="{{trans('general.search')}}">
                    <span class="input-group-btn"><button class="btn btn-primary" type="button">{{trans('general.search')}}</button></span>
                </div>
            </div>
            <br />
        </div>
        <div class="col-md-3">
            <ul>
                <h3>Filtrer par:</h3>
                <hr />
                <h4>Categorie:</h4>
                <li></li>
                <li></li>
                <li></li>
                <h4>Prix:</h4>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12 text-right">
                    <select placeholder="Trier par">
                        <option>Trier par</option>
                    </select>
                </div>
                <div class="col-md-12 text-center">
                    <div class="col-md-3 panel panel-default">
                        <div class="panel-body">
                            <p>Description du produit</p>
                            <p>200.00C$</p>
                            <button class="btn btn primary">Ajouter au panier</button>
                        </div>
                    </div>
                    <div class="col-md-3 panel panel-default">
                        <div class="panel-body">
                            <p>Description du produit</p>
                            <p>200.00C$</p>
                            <button class="btn btn primary">Ajouter au panier</button>
                        </div>
                    </div>
                    <div class="col-md-3 panel panel-default">
                        <div class="panel-body">
                            <p>Description du produit</p>
                            <p>200.00C$</p>
                            <button class="btn btn primary">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <div class="col-md-3 panel panel-default">
                        <div class="panel-body">
                            <p>Description du produit</p>
                            <p>200.00C$</p>
                            <button class="btn btn primary">Ajouter au panier</button>
                        </div>
                    </div>
                    <div class="col-md-3 panel panel-default">
                        <div class="panel-body">
                            <p>Description du produit</p>
                            <p>200.00C$</p>
                            <button class="btn btn primary">Ajouter au panier</button>
                        </div>
                    </div>
                    <div class="col-md-3 panel panel-default">
                        <div class="panel-body">
                            <p>Description du produit</p>
                            <p>200.00C$</p>
                            <button class="btn btn primary">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <div class="col-md-3 panel panel-default">
                        <div class="panel-body">
                            <p>Description du produit</p>
                            <p>200.00C$</p>
                            <button class="btn btn primary">Ajouter au panier</button>
                        </div>
                    </div>
                    <div class="col-md-3 panel panel-default">
                        <div class="panel-body">
                            <p>Description du produit</p>
                            <p>200.00C$</p>
                            <button class="btn btn primary">Ajouter au panier</button>
                        </div>
                    </div>
                    <div class="col-md-3 panel panel-default">
                        <div class="panel-body">
                            <p>Description du produit</p>
                            <p>200.00C$</p>
                            <button class="btn btn primary">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center">
        <br />
            <button class="btn btn primary">Plus d'article</button>
        </div>
    </div>
</div>
@stop