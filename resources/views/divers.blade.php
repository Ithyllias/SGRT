<?php if(!App\Tache::isTaskClosed()){ ?>
    <h3> <?=trans('gestion.resetChoice')?> </h3>
    {!! Form::open(array('url' => url('gestion/resetChoice'))) !!}
    <div>
        <table id='tabResetChoice'>
            <tr>
                <th><?=trans('gestion.alias')?></th>
                <th><?=trans('gestion.session')?></th>
            </tr>
            <tr>
                <td>
                    <select name="profList">
                        <option value=""><?=trans('gestion.session.null')?></option>
                        <?php foreach ($ens->getData() as $prof){?>
                            <option value="<?php echo $prof->ens_id ?>"><?php echo $prof->ens_alias; ?></option>
                        <?php }?>
                    </select>
                </td>
                <td>
                    <select name="sessionList">
                        <option value=""><?=trans('gestion.session.null')?></option>
                        <option value="1"><?=trans('gestion.session.automne')?></option>
                        <option value="3"><?=trans('gestion.session.hiver')?></option>
                        <option value="2"><?=trans('gestion.session.ete')?></option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    {!! Form::submit(trans('gestion.send')) !!}
    {!! Form::close() !!}

    <hr> </br>
    {!! Form::open(array('url' => url('gestion/closeTask'), 'files' => true, 'onsubmit' => 'return confirmClose(\''.url('gestion/unfinished').'\')')) !!}
    <input type="submit" value="<?=trans('gestion.closeTask')?>">
    {!! Form::close() !!}
    <hr> </br>
<?php  } else { ?>
    <h3> <?=trans('gestion.taskClosed')?> </h3>
<?php } ?>
{!! Form::open(array('url' => url('gestion/resetMarbles'), 'files' => true, 'onsubmit' => 'return confirmReset()')) !!}
<input type="submit" value="<?=trans('gestion.resetMarbles')?>">
{!! Form::close() !!}
