@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row align-items-center my-4">
                    <div class="col">
                        <h2 class="h3 mb-0 page-title">Modifier Département</h2>
                    </div>
                    <div class="col-auto">

                        <a href="{{route('departements.index')}}" class="btn btn-primary" style="color:white">
                            <span style="color:white"></span> {{ __('Retour') }}
                        </a>

                    </div>
                </div>
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('Accueil') }}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('departements.index')}}">{{ __('Départements') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('Modifier Département') }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Il semble que vous avez des erreurs.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card shadow mb-4">
                    <div class="card-body">
                        {!! Form::model($departement, ['method' => 'PATCH','route' => ['departements.update', $departement->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('Département') }} : </strong>
                                    {!! Form::text('nom', null, array('placeholder' => 'Nom du département','class' => 'form-control')) !!}
                                </div>
                            </div>
                            
                            <div class="center" style="text-align: center;">
                            <button type="submit" class="btn btn-success">{{ __('Confirmer') }}</button>
                            <a class="btn btn-warning" href="{{ route('departements.index') }}"> {{ __('Annuler') }}</a>
                        </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div> <!-- / .card -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection
