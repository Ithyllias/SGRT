<?php
    $lang = Session::get('newLang');
    if(isset($lang)){
        App::setLocale($lang);
    }
?>
@extends('master')

@section('content')
    <br/>
    <h2><?=trans('home.welcome')?></h2>
    <h3><?=trans('home.connection')?></h3>
    <br/>
    <form action="">
        <?=trans('home.email')?><br/>
        <input id="usrname" type="text" name="username" value=""><br/>
        <br>
            <?=trans('home.password')?><br>
        <input id="pwd" type="password" name="password" value=""><br/><br/>
        <input type="submit" value="<?=trans('home.connect')?>">
    </form>
@endsection
