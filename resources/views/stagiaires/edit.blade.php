@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row align-items-center my-4">
                    <div class="col">
                        <h2 class="h3 mb-0 page-title">{{ __('Modifier Stagiaire') }}</h2>
                    </div>
                    <div class="col-auto">

                        <a href="{{route('stagiaires.index')}}" class="btn btn-primary" style="color:white">
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
                                    <li class="breadcrumb-item"><a href="{{route('stagiaires.index')}}">{{ __('Stagiaires') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('Modifier Stagiaire') }}</li>
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
                        {!! Form::model($stagiaire, ['method' => 'PATCH','route' => ['stagiaires.update', $stagiaire->id]]) !!}
                    <div class="row">                        
                    <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Nom') }}:</strong>
                                <input disabled type="text" class="form-control" id="nom" name="nom"  placeholder="{{ $stagiaire->nom}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Prenom') }}:</strong>
                                <input disabled type="text" class="form-control" id="prenom" name="prenom"  placeholder="{{ $stagiaire->prenom}}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                         <label for="date_naissance">Date de Naissance</label>
                         <input disabled type="text" class="form-control" id="date_naissance" name="date_naissance"  placeholder="{{ $stagiaire->date_naissance}}">
                             </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('Email') }}:</strong>
                                    {!! Form::email('email', null, array('placeholder' => 'name@example.com','class' => 'form-control')) !!}
                                </div>
                            </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>{{ __('Numéro de téléphone') }}:</strong>
                                    {!! Form::text('tel', null, array('placeholder' => 'Téléphone','class' => 'form-control')) !!}
                                </div>
                            </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Etablissement</strong>
                            <input  type="text" class="form-control" id="etablissement" name="etablissement"  value="{{ $stagiaire->etablissement}}">
 </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <strong for="niveau">Niveau d'étude</strong>
                                <select class="form-select mt-1" id="niveau"  name="niveau" required >
                                    <option value="" selected disabled>
                                        @if($stagiaire->niveau == 1)
                                    {{ $stagiaire->niveau }}ère année
                                @else    
                                    {{ $stagiaire->niveau }}ème année
                                @endif</option>
                                    <option value="1">1ère année</option>
                                    <option value="2">2ème année</option>
                                    <option value="3">3ème année</option>
                                    <option value="4">4ème année</option>
                                    <option value="5">5ème année</option>
                                </select> </div>
                        </div>

                        <div class="center" style="text-align: center;">
                            <button type="submit" class="btn btn-success">{{ __('Confirmer') }}</button>
                            <a class="btn btn-warning" href="{{ route('stagiaires.index') }}"> {{ __('Annuler') }}</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div> <!-- / .card -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection

<style>
    .cont{
        text-align: center;
    }

</style>