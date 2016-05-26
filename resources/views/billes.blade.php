@include("init")
<link href="{{ URL::asset('css/billes.css') }}" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript">
     langue = "<?php echo App::getLocale();?>";
     Dummy = $.parseJSON('<?php echo str_replace("'", "\'",curlCall(url("billes/getBilles")));?>');
     console.log(Dummy);
     if(langue == "" || langue == null)
     {
         langue = "FR";
     }
</script>
<script src="{{ URL::asset('js/billes.js') }}" type="text/javascript"></script>
@extends('master')

@section('content')
    <div id="menuB">
        <ul>
            <li id="bC"  onclick="clickTableau()"><?=trans('choix.compt')?></li>
        </ul>
    </div>

    <div id="contentBilles">
    </div>

@endsection
