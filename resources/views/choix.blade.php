@include("init")

<link href="{{ URL::asset('css/choix.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('js/choix.js') }}" type="text/javascript"></script>
@extends('master')

<?php
    $enseignantID = Session::get('user_id');
    $data = [
            'user_id' => $enseignantID
    ];
    $choixFaitJSON = curlCall(url('choix/choixStatus'),$data);
    $choixFait = json_decode($choixFaitJSON);
?>
<script type="text/javascript">
    langue = "<?php echo App::getLocale();?>";
    choixFait = $.parseJSON('<?php echo $choixFaitJSON;?>');
    courses = $.parseJSON('<?php echo str_replace("'", "\\'",curlCall(url('choix/getTasks'), []));?>');
    tache = $.parseJSON('<?php echo str_replace("'", "\\'",curlCall(url('choix/getChoix/'),$data));?>');
    ensId = "<?=$enseignantID ?>";
    RouteSubmit = '<?=url('choix/submit')?>';
    cmptEtBilles = $.parseJSON('<?php echo str_replace("'", "\'",curlCall(url("billes/getBilles")));?>');
    ens = $.parseJSON('<?php echo curlCall(url("billes/getActiveAliases"));?>');
    cours = $.parseJSON('<?php echo str_replace("'", "\\'",curlCall(url("gestion/getCours")));?>');
</script>
@section('content')
    <div id="menuB">
        <ul>
            <li id="option1" onclick="ClickA()"><?=trans('choix.A') . " " . $choixFait->tac_annee ?></li>
            <li id="option2" onclick="ClickH()" ><?=trans('choix.H') . " " . $choixFait->tac_annee ?></li>
            <li id="option3" onclick="ClickE()" ><?=trans('choix.E') . " " . $choixFait->tac_annee ?></li>
        </ul>
    </div>
<div id="contentChoix">
    <h3><?=trans('choix.Bienvenu')?></h3>
</div>

@endsection