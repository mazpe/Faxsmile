<div class="box-body">
    <!-- name, title, value, label attributes, input attributes -->

    @if ( Auth::user()->isSuperAdmin() )
        {{ Form::bsSelect('parent_id', 'Company',
        isset($client->company) ? $client->company->id : null, $companies,
        ['class' => 'col-sm-2 control-label'], ['id' => 'client-companies', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
    @elseif ( Auth::user()->isCompanyAdmin() )
        {{ Form::bsHidden('parent_id', Auth::user()->entity->id) }}
    @elseif ( Auth::user()->isClientAdmin() )
        {{ Form::bsHidden('parent_id', $client->parent_id) }}
    @endif

    {{ Form::bsText('name', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('address_1', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('address_2', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('city', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsSelect('state', 'State',
        isset($client->state) ? $client->state : null, $states,
        ['class' => 'col-sm-2 control-label'], ['id' => 'client-states', 'class' =>'form-control', 'placeholder' => 'Select one...']) }}
    {{ Form::bsText('zip', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('phone', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('fax', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('website', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}

    @if(Route::current()->getName() == 'client.create')
    {{ Form::bsText('contact_first_name', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('contact_last_name', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsText('contact_phone', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsEmail('contact_email', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    @endif

    {{ Form::bsText('note', null, null, ['class' => 'col-sm-2 control-label'], ['class' =>'form-control']) }}
    {{ Form::bsSubmit('Submit', '','btn btn-info pull-right') }}
</div>