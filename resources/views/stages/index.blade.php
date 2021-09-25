@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form method="POST" action="{{ route('stages.index') }}">
                <div class="row align-itms-center my-4">
                    <div class="col">
                        <h2 class="h3 mb-0 page-title">{{ __('Liste des Stages') }}</h2>
            </div>
            <div class="col-auto">
                @can('créer stage')
                    <a href="{{route('stages.create')}}" class="btn btn-success" style="color:white">
                        <span style="color:white"></span>Nouveau</a>
                @endcan

            </div>
        </form></div>
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('Accueil') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Stages') }}</li>
                        </ol>
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

        @if($stages -> count())
            <form style="float: right" class="form-inline my-2 my-lg-0"action="{{ route('stages.search') }}" method="POST" >
                @csrf
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
            </form>
        @endif
    </div></div></div>

<div class="row my-10">
<div class="col-md-12">
    <div class="card shadow">
        <div class="card-body">
            <!-- table -->
            <table class="table datatables" id="dataTable-1">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th width="80px">Stagiaire</th>
                    <th width="70px">Encadrant</th>
                    <th width="80px">Sujet</th>
                    <th width="85px">Service</th>
                    <th  width="120px">Date de Début</th>
                    <th  width="110px">Date de Fin</th>
                    <th  width="100px">Statut</th>
                    <th  width="100px" >Ajouté par</th>
                    <th  width="220px" >Action</th>
                </tr>
                </thead>
                @if($stages -> count())
            @foreach ($stages as $stage)
                <tbody>
                <tr>
                    <td>{{ $stage->id}}</td>
                    <td>{{ $stage->stagiaire->nom}} {{ $stage->stagiaire->prenom}}</td>
                    <td>{{ $stage->user->nom}} {{ $stage->user->prenom}} </td>
                    <td>{{ $stage->sujet->titre }}</td>
                    <td>{{ $stage->service->nom }}</td>
                    <td>{{ \Carbon\Carbon::parse( $stage->date_debut)->format('d/m/Y')}}</td>
                    <td>{{ \Carbon\Carbon::parse( $stage->date_fin)->format('d/m/Y')}}</td>
                    <td>{{ $stage->statut->description}}</td>
                    <td>{{ $stage->nom_ajoute_par}} {{ $stage->prenom_ajoute_par}}</td>
                <td>
                            <a class="btn btn-secondary" href="{{ route('stages.show',$stage->id) }}">
                            <i class="fa fa-eye"></i>
                                {{ __('Afficher') }}</a>
                            @can('modifier stage')
                                <a class="btn btn-warning" href="{{ route('stages.edit',$stage->id) }}">
                                <i class="fa fa-edit"></i>
                                {{ __('Modifier') }}</a>
                            @endcan

                        </td>
                    </tr>
                    </tbody>
                @endforeach
            @endif
               </table>
            {!! $stages->render() !!}
                <!-- end table -->
            </div>
        </div>
    </div> <!-- .col-md-12 -->
</div> <!-- end section row my-4 -->
</form>
</div> <!-- .col-12 -->
</div> <!-- .row -->
</div> <!-- .container-fluid -->

@endsection
