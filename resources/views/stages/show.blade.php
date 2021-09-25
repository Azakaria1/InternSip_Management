@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row align-items-center my-4">
                    <div class="col">
                        <h2 class="h3 mb-0 page-title">Stage {{ $stage->id }}</h2>
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
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('Accueil') }}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('stages.index')}}">{{ __('Stages') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('Afficher Stage') }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ __('Stagiaire') }}: </strong>
                                        {{ $stage->stagiaire->nom}} {{ $stage->stagiaire->prenom}}                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ __('Encadrant') }}: </strong>
                                        {{ $stage->user->nom}} {{ $stage->user->prenom}} 
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ __('Sujet de stage') }}: </strong>
                                        {{ $stage->sujet->titre}}
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ __('Service') }}: </strong>
                                        {{ $stage->service->nom }}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ __('Date de début') }}: </strong>
                                    {{ \Carbon\Carbon::parse( $stage->date_debut)->format('d/m/Y')}}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ __('Date de fin') }}: </strong>
                                    {{ \Carbon\Carbon::parse( $stage->date_fin)->format('d/m/Y')}}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ __('Statut') }}:</strong>
                                        {{ $stage->statut->description}}
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div> <!-- .col-md-12 -->
                </div> <!-- end section row my-4 -->

            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection