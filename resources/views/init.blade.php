<script src="{{ URL::asset('js/jquery-2.2.3.min.js') }}"></script>
<script src="{{ URL::asset('js/services.js') }}" type="text/javascript"></script>
<script>
    function gotoPost(url, data){
        $.ajax({
            url : url,
            type : "POST",
            contentType : "application/json; charset=utf-8",
            dataType : "json",
            data : JSON.stringify(data),
            crossDomain : true,
            beforesend : function(req){
                req.setRequestHeader('Authorization', "bearer " + <?=Session::get('jwt')?> + "");
            },
            success : function(){

            }
        });
    }
</script>
<?php
    $lang = Session::get('locale');
    if(isset($lang)){
        App::setLocale($lang);
    }

    /**
     * @param $url String Url to call
     * @param array $data Array Data to send in the POST
     * @param array $headers Array Headers to add to the post call (array('Header: value', 'Header2: value2',...)
     * @return mixed Data returned by the post call
     */
    function curlCall($url, $data = [], $headers = []){
        $field_string = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $returnVal = curl_exec($ch);
        curl_close($ch);
        return $returnVal;
    }
?>
