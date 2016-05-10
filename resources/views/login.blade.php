@include('init')

@extends('master')

@section('content')
    <br/>
    <div id="menuB">
        <ul>
            <li id="bC" class="selected" onclick="clickTableau()"><h2><?=trans('login.welcome')?></h2></li>
        </ul>
    </div>
    <?php if(Session::get('jwt') === null) { ?>
    <h3><?=trans('login.connection')?></h3>
    <form action="<?=url('login')?>" method="post">
        {{ csrf_field() }}
        <span class="error"><?=session('error'); ?></span></br></br>
        <?=trans('login.email')?><br/>
        <input id="email" type="text" name="username" value=""><br/>
        <br>
            <?=trans('login.password')?><br>
        <input id="password" type="password" name="password" value=""><br/><br/>
        <input type="submit" value="<?=trans('login.connect')?>">
        <input type="hidden" value="true" name="web"/>
    </form>
    <br/>
    <?php }?>
    <?php if(Session::get('jwt') !== null) {?>
        <script type="text/javascript">
            window.location = "{{url('/home')}}"
        </script>
    <?php }?>
@endsection
