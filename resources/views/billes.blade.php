@include("init")
<link href="{{ URL::asset('css/billes.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('js/billes.js') }}" type="text/javascript"></script>
@extends('master')

@section('content')
    <div id="menuBilles">
        <ul>
            <li id="bBilles" onclick="clickBilles()">Compteur Billes</li>
            <li id="bFois" onclick="clickFois()">Compteur Fois</li>
        </ul>
    </div>

    <div id="contentBilles">
    </div>

@endsection
