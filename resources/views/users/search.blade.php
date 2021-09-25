@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form method="POST" action="{{ route('users.index') }}">
                <div class="row align-itms-center my-4">
                    <div class="col">
                        <h2 class="h3 mb-0 page-title">{{ __('Recherche Utilisateur') }}</h2>
                    </div>

                    <div class="col-auto">
                    <a href="{{route('users.index')}}" class="btn btn-primary" style="color:white">
                        <span style="color:white"></span> {{ __('Retour') }}
                    </a>
                    </div>

                </form>
            </div>
                <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('Accueil') }}</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('users.index')}}">{{ __('Utilisateurs') }}</a></li>
                                    <li class="breadcrumb-item active">Recherche</li>                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                @if($data->isNotEmpty())
        <div class="row my-8">
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
                <th>{{ __('Rôle') }}</th>
                <th width="300px">{{ __('Action') }}</th>
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
                                {{ $v }}
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-secondary" href="{{ route('users.show',$user->id) }}">      
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            {{ __('Afficher') }}
                        </a>
                        @can('modifier utilisateur')
                        <a class="btn btn-warning" href="{{ route('users.edit',$user->id) }}"> 
                            <i class="fa fa-edit"></i>
                            {{ __('Modifier') }}
                        </a>
                        @endcan

                    </td>
                </tr> 
            </tbody>
                        @endforeach
                    </table>
                    @else
                    <script> window.location = "{{ url('/users') }}";</script>
@endif
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
