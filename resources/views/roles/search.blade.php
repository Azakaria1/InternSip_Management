@extends('layouts.app')
@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="row align-items-center my-4">
            <div class="col">
                <h2 class="h3 mb-0 page-title">Liste des Rôles</h2>
            </div>
            <div class="col-auto">
                @can('créer rôle')
                    <a href="{{route('roles.index')}}" class="btn btn-primary" style="color:white">
                        <span style="color:white"></span>Retour
                    </a>
                @endcan
            </div>
        </div>
    <div class="content-header row">
        <div class="content-header-left col-md-12 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{route('roles.index')}}">{{ __('Rôles') }}</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-search" aria-hidden="true"></i> Recherche</li>                                </ol>
                </div>
            </div>
        </div>
    </div>

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
                    <thead>
                    <tr>
                        <th>#</th>
                        <th width="500px">{{ __('Rôle') }}</th>
                        <th width="300px">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    @if($roles->count())
                    @foreach ($roles as $key => $role)
                        <tbody>
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            </td>
                            <td>
                                <a class="btn btn-secondary" href="{{ route('roles.show',$role->id) }}">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                    Afficher</a>
                                @can('modifier rôle')
                                    <a class="btn btn-warning" href="{{ route('roles.edit',$role->id) }}">                                                           
                                    <i class="fa fa-edit"></i>
                                    Modifier</a>
                                @endcan

                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                    @else
                    <script>window.location = "/roles";</script>
                    @endif
            
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
