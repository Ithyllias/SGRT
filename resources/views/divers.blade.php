<hr> </br>
{!! Form::open(array('url' => url('gestion/closeTask'), 'files' => true, 'onsubmit' => 'return confirmClose(\''.url('gestion/unfinished').'\')')) !!}
<input type="submit" value="<?=trans('gestion.closeTask')?>">
{!! Form::close() !!}
<hr> </br>
{!! Form::open(array('url' => url('gestion/resetMarbles'), 'files' => true, 'onsubmit' => 'return confirmReset()')) !!}
<input type="submit" value="<?=trans('gestion.resetMarbles')?>">
{!! Form::close() !!}
