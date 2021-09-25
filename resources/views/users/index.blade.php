@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form method="POST" action="{{ route('users.index') }}">
                <div class="row align-itms-center my-4">
                    <div class="col">
                        <h2 class="h3 mb-0 page-title">{{ __('Liste des Utilisateurs') }}</h2>
                    </div>
                    <div class="col-auto">
                        @can('créer utilisateur')
                            <a href="{{route('users.create')}}" class="btn btn-success" style="color:white">
                                <span style="color:white"></span><i class="fa fa-user-plus" aria-hidden="true"></i>
                            </a>
                        @endcan

                    </div>
                </form></div>
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('Accueil') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('Utilisateurs') }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-8">
                    <div class="col-md-12">
                        <div class="card-body">

                            @if($data -> count())
                                <form style="float: right" class="form-inline my-2 my-lg-0"action="{{ route('users.search') }}" method="POST" >
                                   
                                @csrf
                                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            @endif
                        </div></div></div>

    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row my-10">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Nom') }}</th>
                                        <th>{{ __('Prénom') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th width="230px">{{ __('Rôle') }}</th>
                                        <th width="230px">{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach ($data as $key => $user)
                                        <tbody>
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->nom }}</td>
                                            <td>{{ $user->prenom }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $v)
                                                       <p>{{ $v }}</p> 
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-secondary" href="{{ route('users.show',$user->id) }}">
                                                <i class="fa fa-eye"></i>
                                                    {{ __('Afficher') }}</a>
                                                @can('modifier utilisateur')
                                                    <a class="btn btn-warning" href="{{ route('users.edit',$user->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                    {{ __('Modifier') }}</a>
                                                @endcan

                                            </td>
                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            {!! $data->render() !!}
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
