@include("init")
<link href="{{ URL::asset('css/billes.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('js/billes.js') }}" type="text/javascript"></script>
@extends('master')

@section('content')
    <div id="menuBilles">
        <ul>
            <li id="bBilles" onclick="clickBilles()"><?=trans('choix.comptB')?></li>
            <li id="bFois" onclick="clickFois()"><?=trans('choix.comptF')?></li>
        </ul>
    </div>

    <div id="contentBilles">
    </div>

@endsection
