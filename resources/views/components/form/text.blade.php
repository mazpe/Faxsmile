<div class="form-group">
    {{ Form::label($name, $title, ['class' => $labelAttributes['class']]) }}
    <div class="col-sm-10">
        {{ Form::text($name, $value, $inputAttributes) }}
    </div>
</div>