<script src="{{ URL::asset('js/jquery-2.2.3.min.js') }}"></script>
<script src="{{ URL::asset('js/services.js') }}" type="text/javascript"></script>
<?php
    $lang = Session::get('newLang');
    if(isset($lang)){
        App::setLocale($lang);
    }

    function curlCall($url, $data){
        $field_string = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
        $returnVal = curl_exec($ch);
        curl_close($ch);
        return $returnVal;
    }
?>
