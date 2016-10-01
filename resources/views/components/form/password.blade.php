<div class="form-group">
    {{ Form::label($name, $title, ['class' => $class]) }}
    <div class="col-sm-10">
        {{ Form::password($name, ['class' => 'form-control']) }}
    </div>
</div>