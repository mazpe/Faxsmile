<div class="form-group">
    {{ Form::label($name, null, ['class' => $class]) }}
    <div class="col-sm-10">
        {{ Form::select($name, $attributes, $value,
            ['class' => 'form-control','placeholder' => 'Select one...']) }}
    </div>
</div>