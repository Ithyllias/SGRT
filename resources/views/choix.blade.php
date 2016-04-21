@include("init");

<link href="{{ URL::asset('css/choix.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('js/choix.js') }}" type="text/javascript"></script>
@extends('master')
<?php
    $courses = json_decode(file_get_contents(url('choix/getTasks')));

?>
@section('content')
    <div ondrop="drop(event)" ondragover="allowDrop(event)" id="fixer" >
        <h1>Priorités</h1>
        <p id="1" draggable="true" ondragstart="drag(event)">&nbsp;1&nbsp;</p>
        <p id="2" draggable="true" ondragstart="drag(event)">&nbsp;2&nbsp;</p>
        <p id="3" draggable="true" ondragstart="drag(event)">&nbsp;3&nbsp;</p>
        <p id="4" draggable="true" ondragstart="drag(event)">&nbsp;4&nbsp;</p>
        <p id="5" draggable="true" ondragstart="drag(event)">&nbsp;5&nbsp;</p>
    </div>
        <form action="action_page.php">
            <h1>Liste des cours:</h1>
            <table>
                <?php foreach ($courses as $c): ?>
                    <tr>
                        <td><?php echo $c->cou_no . $c->cou_titre; ?>:</td>
                        <td>
                            <div class="elements" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </table>
            <br/>
            <input type="submit" value="Soumettre">
        </form>
@endsection
