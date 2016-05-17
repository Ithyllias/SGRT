@include("init")
<link href="{{ URL::asset('css/gestion.css') }}" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    langue = "<?php echo App::getLocale();?>";
    ens = $.parseJSON('<?php echo curlCall(url("gestion/getEnseignant"));?>');
    routeAddEns = '<?=url('gestion/addEnseignant')?>';
</script>
<script src="{{ URL::asset('js/gestion.js') }}" type="text/javascript"></script>
@extends('master')
@section('content')
    <div id="menuB">
        <ul>
            <li id="option1" onclick="clickopt1()"><?=trans('gestion.util')?></li>
            <li id="option2" onclick="clickopt2()"><?=trans('gestion.cours')?></li>
            <li id="option3" onclick="clickopt3()"><?=trans('gestion.import')?></li>
        </ul>
    </div>

    <div id="contentGestion">
    </div>

@endsection
