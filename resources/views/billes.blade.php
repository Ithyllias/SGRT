@include("init");

@extends('master')

@section('content')
    <?php
        $url = url('choix/test');
        $data = [
            'ensId' => 1,
        ];
        $field_string = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
        $worked = curl_exec($ch);
        curl_close($ch);
            echo $worked;
    ?>
@endsection
