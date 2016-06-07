<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>SGRT</title>
    <link href="{{ URL::asset('css/master.css') }}" media="all" rel="stylesheet" type="text/css" />
    <script src="{{ URL::asset('js/master.js') }}" type="text/javascript"></script>
</head>
<?php
$nomUser = Session::get('connected_user');
?>
<body>
<div id="header">
    <a href="<?=url('changeLang/' . trans('master.nextLanguage'))?>" class="hautDroit"> <?=trans('master.nextLanguage')?></a>
    <?php if(Session::get("jwt") == null){
        echo "<a href=" . url('/'). " class=" . "hautDroit" . "> " . trans('master.login') . " &nbsp&nbsp </a>";
    }
    else{
        echo "<a href=" . url('/logout') . " class=" . "hautDroit" . "> ". trans('master.logout') . " (". $nomUser . ") &nbsp&nbsp </a>";
    }
    ?>
    <div id="title">
        <a href="<?=url('/')?>"> <img src="{{ URL::asset('images/logo.jpg') }}"></a>
                <span>
                    <?=trans('master.title')?>
                </span>
    </div>
</div>

<div id="tabs">
    <ul id="menu">
        <li><a href="<?=url('')?>"><?=trans('master.home')?></a></li>
        <?php if(Session::get("jwt") !== null){ ?>
        <li><a href="<?=url('choix')?>"><?=trans('master.choix')?></a></li>
        <li><a href="<?=url('billes')?>"><?=trans('master.billes')?></a></li>
            <?php if(App\Enseignant::getIsCoordoFromId(Session::get('user_id')) == 1){ ?>
            <li><a href="<?=url('gestion')?>"><?=trans('master.gestion')?></a></li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
<div id="content">
    <span class="error"><?=session('error'); ?></span><span class="error"><?=session('minorError'); ?></span><span class="success"><?=session('success'); ?></span></br></br>
    @yield("content")
</div>
</body>
</html>