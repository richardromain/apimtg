@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(count($sets) > 0)
                    <table class="table table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($sets as $set)
                            <tr>
                                <td>{{ $set->id }}</td>
                                <td>{{ $set->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('sets.show', $set) }}">Voir</a></li>
                                            <li><a href="#">Modifier</a></li>
                                            <li>
                                                <a href="{{ route('sets.destroy', $set) }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">
                                                    Supprimer
                                                </a>

                                                <form id="delete-form" action="{{ route('sets.destroy', $set) }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p>Il n'y a pas encore d'extensions.</p>
                @endif
            </div>
        </div>
    </div>
@endsection