<div class="form-group">
    {{ dd($attributes->name) }}
    {{ Form::label($name, null, ['class' => $class]) }}
    <div class="col-sm-10">
        {{ Form::select($name, $attributes->name, null,
            ['class' => 'form-control','placeholder' => 'Select one...']) }}
    </div>
</div>