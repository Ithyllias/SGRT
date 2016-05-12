@include("init")

<link href="{{ URL::asset('css/choix.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('js/choix.js') }}" type="text/javascript"></script>
@extends('master')
<?php
    $enseignantID = 1;
    $data = [
            'ensId' => $enseignantID
    ];
    $choixFait = json_decode(curlCall(url('choix/choixStatus'),$data));
    if($choixFait[0]->choixFait == false)
    {
        $courses = json_decode(curlCall(url('choix/getTasks'), []));
     }
     else
     {
         $data = [
                 'ensId' => $enseignantID
         ];

         $tacheEns = json_decode(curlCall(url('choix/getChoix/'),$data));
     }
?>
@section('content')
    <?php if($choixFait[0]->choixFait == false) { ?>
        <div ondrop="drop(event)" ondragover="allowDrop(event)" id="fixer" >
            <h1><?=trans('choix.priorities')?></h1>
            <p id="01" draggable="true" ondragstart="drag(event)">&nbsp;1&nbsp;</p>
            <p id="02" draggable="true" ondragstart="drag(event)">&nbsp;2&nbsp;</p>
            <p id="03" draggable="true" ondragstart="drag(event)">&nbsp;3&nbsp;</p>
            <p id="04" draggable="true" ondragstart="drag(event)">&nbsp;4&nbsp;</p>
            <p id="05" draggable="true" ondragstart="drag(event)">&nbsp;5&nbsp;</p>
        </div>
            <form id="FormChoix" name="FormChoix" method="post" action="<?=url('choix/submit')?>">
                <input type="hidden" value="<?=$enseignantID?>" name="ensId" readonly/>
                <div id="menuB">
                    <ul>
                        <li id="plein" class="selected"><?=trans('choix.listC') . " " . $choixFait[0]->tac_annee ?></li>
                    </ul>
                </div>

                <table>
                    <?php foreach ($courses[0] as $c): ?>
                        <tr>
                            <td class="cours"><?php echo $c->cou_no . " " . $c->cou_titre; ?>:</td>
                            <td class="divDrop" >
                                <div id="<?php echo $c->cdn_id; ?>" class="elements"   ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                                <input type="text" value=""  name="<?php echo $c->cdn_id; ?>"  hidden readonly/>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </table>
                <br/>
                <input type="submit" onclick="return confirm('<?=trans('choix.confirm')?>')" value="<?=trans('choix.bouton')?>">
            </form>
    <?php }else { ?>
    <div id="menuB">
        <ul>
            <li id="plein" class="selected"><?=trans('choix.choixTitle') . $choixFait[0]->tac_annee ?></li>
        </ul>
    </div>
        <table id="tRes">
            <tr>
                <th>Cours</th>
                <th>Priorités</th>
            </tr>
            <?php foreach ($tacheEns as $tache): ?>
                <tr>
                    <td class="cours"><?php echo $tache->cou_no . " " . $tache->cou_titre; ?></td>
                    <td>
                        <?php echo $tache->chx_priorite; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <br/>
    <?php } ?>
@endsection