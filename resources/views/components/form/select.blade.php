<div class="form-group">
    {{ Form::label($name, null, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('type', $attributes, null,
            ['class' => 'form-control','placeholder' => 'Select one...']) }}
    </div>
</div>