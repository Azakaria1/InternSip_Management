@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="{{ asset('js/app.js') }}" defer></script>

    @auth
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-8">
            <div class="content">
                <img src="logo/mylogo.jpeg" />
            </div>
        </div>
    </div>
</div>
@endauth
@if (Auth::guest())
    <div class="contain">
            <div class="card" >
                <div class="card-header">
                    <i class="fa fa-info-circle">

                    </i> <b> Information !</b>
            <p> <p></p>   
                Vous devez vous <a href="{{ url('/login' )}}">connecter</a> pour utiliser l'application !
            </p>
            </div>
        </div>
    </div>
    @endif
@endsection

<style>
 .content img {
    border-radius: 8px; 
    margin-top:20px ;
    }
    .card{
        float: center;
    }
    .contain{
    position: absolute; 
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    display: flex;
align-items: center;
justify-content: center; 
align-contenT:center; 
min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
min-height: 100vh;
}
    </style>