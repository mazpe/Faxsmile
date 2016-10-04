<div class="form-group">
    {{ Form::label($name, $title, ['class' => $class]) }}
    <div class="col-sm-10">
        {{ Form::email($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    </div>
</div>