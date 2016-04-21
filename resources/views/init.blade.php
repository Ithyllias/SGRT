<script src="{{ URL::asset('js/jquery-2.2.3.min.js') }}"></script>
<script src="{{ URL::asset('js/services.js') }}" type="text/javascript"></script>
<?php
    $lang = Session::get('newLang');
    if(isset($lang)){
        App::setLocale($lang);
    }
?>
