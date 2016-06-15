@include("init")
{!! Form::open(array('url' => url('gestion/addNewTask'), 'files' => true, 'enctype'=>'multipart/form-data')) !!}
    <h3><?=trans('gestion.newTask')?></h3> </br>
    {!! Form::file('datafile', array('size'=> 40)) !!}
    </br></br> 
    {!! Form::submit(trans('gestion.send')) !!}
{!! Form::close() !!}

{!! Form::open(array('url' => url('gestion/completeTask'), 'files' => true)) !!}
<h3><?=trans('gestion.completedTask')?></h3> </br>
<input type="file" name="datafile" size="40">
</br></br>
{!! Form::submit(trans('gestion.send')) !!}
{!! Form::close() !!}


<?php if(!App\BillesDepart::checkEmpty()){ ?>
    {!! Form::open(array('url' => url('gestion/initialMarbles'), 'files' => true)) !!}
    <h3><?=trans('gestion.initMarbles')?></h3> </br>
    <input type="file" name="datafile" size="40">
    </br></br>
    {!! Form::submit(trans('gestion.send')) !!}
    {!! Form::close() !!}
<?php  } ?>

