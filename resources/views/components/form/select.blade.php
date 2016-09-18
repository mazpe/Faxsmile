<div class="form-group">
    {{ Form::label($name, null, ['class' => $class]) }}
    <div class="col-sm-10">
        {{ Form::select('type', $attributes, null,
            ['class' => 'form-control','placeholder' => 'Select one...']) }}
    </div>
</div>