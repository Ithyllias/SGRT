@include("init")

<link href="{{ URL::asset('css/choix.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('js/choix.js') }}" type="text/javascript"></script>
@extends('master')
<?php
/**
 * Created by PhpStorm.
 * User: Mathieu Lapointe
 * Date: 2016-04-21
 * Time: 12:00
 */

?>
@section('content')
   <div id="menuB">
      <ul>
         <li id="plein"  class="selected" ><?=trans('login.welcome')?></li>
      </ul>
   </div>

   <?=trans('login.connectedMessage')?>
   <br/>
@endsection