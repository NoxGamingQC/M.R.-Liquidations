@extends('layouts.app')
@section('title', 'Welcome')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>NOUS CONTACTER</h1>
            <hr />
        </div>
        <div class="col-md-12">
            <label>Nom *</label>
            <input class="form-control" type="text" placeholder="Saisissez votre nom">
            
            <label>E-mail *</label>
            <input class="form-control" type="text" placeholder="Saisissez votre e-mail">
            
            <label>Objet</label>
            <input class="form-control" type="text" placeholder="Saisissez l'objet">
            
            <label>Message *</label>
            <textarea class="form-control" type="text" placeholder="Rédigez votre message ici..."></textarea>

            <br />
            <input class="btn btn-primary form-control" type="button" value="Envoyer"/>
        </div>
        <div class="col-md-12">
            Add map with address 621 12e rue shawinigan G9T 4A8
        </div>
    </div>
</div>
@stop