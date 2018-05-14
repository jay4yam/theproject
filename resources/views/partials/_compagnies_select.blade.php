@php
    $select = null;
 if(count(@$user->compagnie)) {
    $select = @$user->compagnie()->first()->pivot->compagny_id;
}
@endphp
<div id="compagnies_bloc" class="form-group flex-column {!! $errors->has('compagnie') ? 'has-error' : '' !!}">
    {{ Form::label('compagnie', 'ASSOCIER CET UTILISATEUR AVEC UNE COMPAGNIE :') }}
    {{ Form::select('compagnie', $compagnies, $select, ['placeholder' => 'selectionner une compagnie','class' => 'form-control']) }}
    {!! $errors->first('compagnie', '<small class="help-block">:message</small>') !!}
</div>