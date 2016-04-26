@include("init")

<link href="{{ URL::asset('css/choix.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('js/choix.js') }}" type="text/javascript"></script>
@extends('master')
<?php
    $courses = json_decode(file_get_contents(url('choix/getTasks')));
if(sizeof($_POST) > 0)
{
    $enseignantID = 1;
    $No1 = "";
    $No2 = "";
    $No3 = "";
    $No4 = "";
    $No5 = "";

    foreach ($_POST as $key => $value){
        switch ($value) {
            case 1:
                $No1 = $key;
                break;
            case 2:
                $No2 = $key;
                break;
            case 3:
                $No3 = $key;
                break;
            case 4:
                $No4 = $key;
                break;
            case 5:
                $No5 = $key;
                break;
        }
    }

    if(strlen($No1) == 0 || strlen($No2) == 0 || strlen($No3) == 0 || strlen($No4) == 0 || strlen($No5) == 0)
    {
        echo '<script language="javascript">';
        echo 'alert("' . trans('choix.error') . '")';
        echo '</script>';
    }
    else
    {
        $url = url('choix/submit/');
        $data = [
                'ensId' => $enseignantID,
                'values' => [
                        'a' => $No1,
                        'b' => $No2,
                        'c' => $No3,
                        'd' => $No4,
                        'e' => $No5
                ]
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

        echo '<script language="javascript">';
        if($worked == true)
        {
            echo 'alert("' . trans('choix.work') . '")';
        }
        else
        {
            echo 'alert("' . trans('choix.notWork') . '")';
        }
        echo '</script>';
    }
}
?>
@section('content')
    <div ondrop="drop(event)" ondragover="allowDrop(event)" id="fixer" >
        <h1><?=trans('choix.priorities')?></h1>
        <p id="1" draggable="true" ondragstart="drag(event)">&nbsp;1&nbsp;</p>
        <p id="2" draggable="true" ondragstart="drag(event)">&nbsp;2&nbsp;</p>
        <p id="3" draggable="true" ondragstart="drag(event)">&nbsp;3&nbsp;</p>
        <p id="4" draggable="true" ondragstart="drag(event)">&nbsp;4&nbsp;</p>
        <p id="5" draggable="true" ondragstart="drag(event)">&nbsp;5&nbsp;</p>
    </div>
        <form id="FormChoix" name="FormChoix" method="post" action="<?=url('choix')?>">
            {{ csrf_field() }}
            <h1><?=trans('choix.listC')?></h1>
            <table>
                <?php foreach ($courses as $c): ?>
                    <tr>
                        <td><?php echo $c->cou_no . " " . $c->cou_titre; ?>:</td>
                        <td>
                            <div id="<?php echo $c->cdn_id; ?>" class="elements" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                            <input type="text" value="" name="<?php echo $c->cdn_id; ?>"  hidden readonly/>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </table>
            <br/>
            <input type="submit" onclick="return confirm('<?=trans('choix.confirm')?>')" value="<?=trans('choix.bouton')?>">
        </form>
@endsection
