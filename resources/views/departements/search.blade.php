@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row align-items-center my-4">
                    <div class="col">
                        <h2 class="h3 mb-0 page-title">Recherche</h2>
                    </div>
                    <div class="col-auto">
                            <a href="{{route('departements.index')}}" class="btn btn-primary" style="color:white">
                                <span style="color:white"></span>Retour
                            </a>
                    </div>
                </div>

                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('departements.index')}}">{{ __('Départements') }}</a></li>
                                    <li class="breadcrumb-item active"> <i class="fa fa-search" aria-hidden="true"></i> Recherche</li>                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="row my-8">
                    <div class="col-md-12">
                        <div class="card-body">

                        
                        </div></div></div>

                <div class="row my-8">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th width="400px">{{ __('Département') }}</th>
                                        <th width="200px">{{ __('Ajouté par') }}</th>
                                        <th width="300px">{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach ($departements as $key => $departement)
                                        <tbody>
                                        <tr>
                                            <td>{{ $departement->id }}</td>
                                            <td>{{ $departement->nom }}</td>
                                            <td>{{ $departement->user->nom}} {{ $departement->user->prenom}}</td>
                                            <td>
                                              
                                                @can('modifier département')
                                                    <a class="btn btn-warning" href="{{ route('departements.edit',$departement->id) }}">                                                           
                                                    <i class="fa fa-edit"></i>
                                                    Modifier</a>
                                                @endcan

                                            </td>
                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            <!-- end table -->
                            </div>
                        </div>
                    </div> <!-- .col-md-12 -->
                </div> <!-- end section row my-4 -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->

@endsection
