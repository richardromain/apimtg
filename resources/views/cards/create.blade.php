@extends('layouts.app')

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Ajouter une carte</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('cards.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nom</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('cost') ? ' has-error' : '' }}">
                                <label for="cost" class="col-md-4 control-label">Coût</label>

                                <div class="col-md-6">
                                    <input id="cost" type="text" class="form-control" name="cost" value="{{ old('cost') }}" required>

                                    @if ($errors->has('cost'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('cost') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="content" class="col-md-4 control-label">Contenu</label>

                                <div class="col-md-6">
                                    <textarea name="content" id="content" cols="30" rows="10" class="form-control" required>{{ old('content') }}</textarea>

                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                                <label for="picture" class="col-md-4 control-label">Image</label>

                                <div class="col-md-6">
                                    <input type="file" name="picture" id="picture" required>

                                    @if ($errors->has('picture'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('picture') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('types') ? ' has-error' : '' }}">
                                <label for="types" class="col-md-4 control-label">Types</label>

                                <div class="col-md-6">
                                    <select class="types form-control" id="types" multiple="multiple" name="types[]">
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('types'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('types') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('colors') ? ' has-error' : '' }}">
                                <label for="colors" class="col-md-4 control-label">Couleurs</label>

                                <div class="col-md-6">
                                    <select class="colors form-control" id="colors" multiple="multiple" name="colors[]">
                                        @foreach($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('colors'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('colors') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('set_id') ? ' has-error' : '' }}">
                                <label for="set_id" class="col-md-4 control-label">Extension</label>

                                <div class="col-md-6">
                                    <select class="set_id form-control" id="set_id" name="set_id">
                                        @foreach($sets as $set)
                                            <option value="{{ $set->id }}">{{ $set->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('set_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('set_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Enregister la carte
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('select2/js/select2.js') }}"></script>
    <script type="application/javascript">
        $(".types").select2({
            theme: "bootstrap"
        });
        $(".colors").select2({
            theme: "bootstrap"
        });
        $(".set_id").select2({
            theme: "bootstrap"
        });
    </script>
@endpush