<?php
    $lang = Session::get('newLang');
    if(isset($lang)){
        App::setLocale($lang);
    }
?>
@extends('master')

@section('content')
    GESTION
@endsection
