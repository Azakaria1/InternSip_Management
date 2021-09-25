@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row align-items-center my-4">
                    <div class="col">
                        <h2 class="h3 mb-0 page-title">Liste des Services</h2>
                    </div>
                    <div class="col-auto">
                        @can('créer service')
                            <a href="{{route('services.create')}}" class="btn btn-success" style="color:white">
                                <span style="color:white"></span>Nouveau
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
                                    <li class="breadcrumb-item active">{{ __('Services') }}</li>
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

                            @if($services -> count())
                                <form style="float: right" class="form-inline my-2 my-lg-0"action="{{ route('services.search') }}" method="POST" >
                                    @csrf
                                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            @endif
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
                        <th width="200px">{{ __('Service') }}</th>
                        <th width="300px">{{ __('Département') }}</th>                           
                        <th width="150px">{{ __('Ajouté par') }}</th>
                        <th width="300px">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    @foreach ($services as $service)
                        <tbody>
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->nom }}</td>
                             <td>{{ $service->departement->nom ?? "vide"}}</td>
                             <td>{{ $service->user->nom}} {{ $service->user->prenom}}</td>
                            </td>
                            <td>
                                @can('modifier service')
                                    <a class="btn btn-warning" href="{{ route('services.edit',$service->id) }}">                                                           
                                    <i class="fa fa-edit"></i>
                                    Modifier</a>
                                @endcan

                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
                {!! $services->render() !!}

            <!-- end table -->
            </div>
        </div>
    </div> <!-- .col-md-12 -->
</div> <!-- end section row my-4 -->
</div> <!-- .col-12 -->
</div> <!-- .row -->
</div> <!-- .container-fluid -->

@endsection
