@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Fiche de carte</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <img src="{{ asset('pictures/cards/'.$card->id.'/'.$card->picture) }}" alt="{{ $card->name }}">
                            </div>
                            <div class="col-sm-7">
                                <p><strong>Nom : </strong>{{ $card->name }}</p>
                                <p><strong>Coût : </strong>{{ $card->cost }}</p>
                                <p><strong>Description : </strong>{{ $card->content }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection