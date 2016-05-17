@include("init")
<link href="{{ URL::asset('css/gestion.css') }}" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    langue = "<?php echo App::getLocale();?>";
</script>
<script src="{{ URL::asset('js/gestion.js') }}" type="text/javascript"></script>
@extends('master')

@section('content')
    <div id="menuB">
        <ul>
            <li id="option1" onclick="clickopt1()">Utilisateurs</li>
            <li id="option2" onclick="clickopt2()">Cours</li>
            <li id="option3" onclick="clickopt3()">Importation</li>
        </ul>
    </div>

    <div id="contentGestion">
    </div>

@endsection
