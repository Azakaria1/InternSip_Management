@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row align-items-center my-4">
                    <div class="col">
                            <h2 class="h3 mb-0 page-title">{{ __('Modifier Stage') }}</h2>
                    </div>
                    <div class="col-auto">

                        <a href="{{route('stages.index')}}" class="btn btn-primary" style="color:white">
                            <span style="color:white"></span> {{ __('Retour') }}
                        </a>

                    </div>
                </div>
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home')}}">{{ __('Accueil') }}</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('stages.index')}}">{{ __('Stages') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('Modifier Stage') }}</li>
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
                    {!! Form::model($stage, ['method' => 'PATCH','route' => ['stages.update', $stage->id]]) !!}
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                <strong for="stagiaire">Stagiaire</strong>
                                    <select aria-strong="Default select example" name="stagiaire" id="stagiaire" class="form-select mt-1 mt-1">
                                        <option selected disabled>{{ $stage->stagiaire->nom }} {{ $stage->stagiaire->prenom }}</option>
                                        @foreach($stagiaires as $stagiaire)
                                            <option value="{{ $stagiaire->id }}">{{ $stagiaire->nom }} {{ $stagiaire->prenom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <div class="col">
                            <strong for="encadrant">Encadrant</strong>
                                <select aria-strong="Default select example" name="encadrant" id="encadrant" class="form-select mt-1">
                                    <option selected disabled>{{ $stage->user->nom }} {{ $stage->user->prenom }}</option>

                                        @foreach($users as $user)
                                            @if($user->hasRole('Encadrant'))
                                        <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }}</option>
                                        @endif
                                        @endforeach
                                </select>
                            </div>
                            </div></div></div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                <strong for="sujet">Sujet</strong>
                                <select aria-strong="Default select example" name="sujet" id="sujet" class="form-select mt-1">
                                    <option selected disabled>{{ $stage->sujet->titre }}</option>
                                    @foreach($sujets as $sujet)
                                        <option value="{{ $sujet->id }}">{{ $sujet->titre }}</option>
                                    @endforeach
                                </select>
                                </div>
                            <div class="col">
                            <strong for="service">Service</strong>
                                <select aria-strong="Default select example" name="service" id="service" class="form-select mt-1">
                                    <option selected disabled>{{ $stage->service->nom }}</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                    <strong for="statut">Statut</strong>
                                <select aria-strong="Default select example" name="statut" id="statut" class="form-select mt-1">
                                    <option selected disabled>{{ $stage->statut->description }}</option>
                                    @foreach($status as $statut)
                                        <option value="{{ $statut->id }}">{{ $statut->description }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div></div></div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                    <div class="form-group  w-75">

                                    <strong for="date_debut">Date de Début</strong>
                                <input type="date" required class="form-control" name="date_debut" value="{{ $stage->date_debut}}" id="date_debut">
                              
                                </div>
                                    </div>
                            <div class="col">
                            <div class="form-group  w-75">

                            <strong for="date_fin">Date de Fin</strong>
                                <input type="date" required class="form-control" name="date_fin" value="{{ $stage->date_debut}}" id="date_fin">
                            </div>
                            </div>
                            </div>
                            </div></div>
                        <div class="center" style="text-align: center;">
                            <button type="submit" class="btn btn-success">{{ __('Enregistrer') }}</button>
                            <a class="btn btn-warning" href="{{ route('stages.index') }}"> {{ __('Annuler') }}</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div> <!-- / .card -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection