@include("init")
<link href="{{ URL::asset('css/gestion.css') }}" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    langue = "<?php echo App::getLocale();?>";
    ens = $.parseJSON('<?php echo curlCall(url("gestion/getEnseignant"));?>');
    routeAddEns = '<?=url('gestion/addEnseignant')?>';
    routeModifCours = '<?=url('gestion/addCours')?>';
    cours = $.parseJSON('<?php echo str_replace("'", "\\'",curlCall(url("gestion/getCours")));?>');
    addNewTask = '<?=url('gestion/addNewTask')?>';
    completeTask = '<?=url('gestion/completeTask')?>';
    initMarbles = '<?=url('gestion/initialMarbles')?>';
</script>
<script src="{{ URL::asset('js/gestion.js') }}" type="text/javascript"></script>
@extends('master')
@section('content')
    <div id="menuB">
        <ul>
            <li id="option1" onclick="clickUsers()"><?=trans('gestion.util')?></li>
            <li id="option2" onclick="clickCours()"><?=trans('gestion.cours')?></li>
            <li id="option3" onclick="clickImport('<?=url('gestion/generateImportForm')?>')"><?=trans('gestion.import')?></li>
        </ul>
    </div>

    <div id="contentGestion">
        <h3>Bienvenue dans l'onglet de gestion pour coordonnateurs.</h3>
    </div>

@endsection
