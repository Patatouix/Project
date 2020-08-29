@extends('admin.template')

@section('content')

	<!-- Main column -->
  	<div class="w3-col m12">
      <div class="w3-card w3-round w3-white w3-card-4">
        <div class="w3-container-fluid">
        	<div class="w3-container w3-theme w3-padding-16">
        		<h4 class="w3-center">Modification du conseil santé "{{ $conseil->title }}"</h4>
			</div>
			{!! Form::model($conseil, ['route' => ['admin.conseil.update', $conseil->id], 'method' => 'put', 'class' => 'w3-container']) !!}
			<br>
			<div>
				<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
                    <label>Titre :</label>
					{!! Form::text('title', null, ['class' => 'w3-input w3-border', 'required' => 'required', 'placeholder' => 'Titre']) !!}
					{!! $errors->first('title', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('text') ? 'has-error' : '' !!}">
                    <label>Texte :</label>
					{!! Form::textarea('text', null, ['class' => 'w3-input w3-border', 'required' => 'required', 'placeholder' => 'Texte']) !!}
					{!! $errors->first('text', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('conseiltag_id') ? 'has-error' : '' !!}">
                    <label>Catégories :</label>
					{!! Form::select('conseiltag_id[]', $data['conseiltagsSelect'], ($conseil->conseiltags->count() ? $conseil->conseiltags : 0), ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('conseiltag_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
            <div>
				<div class="form-group {!! $errors->has('age_id') ? 'has-error' : '' !!}">
                    <label>Âges :</label>
					{!! Form::select('age_id[]', $data['agesSelect'], ($conseil->ages->count() ? $conseil->ages : 0),  ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('age_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('environment_id') ? 'has-error' : '' !!}">
                    <label>Environnements :</label>
					{!! Form::select('environment_id[]', $data['environmentsSelect'], ($conseil->environments->count() ? $conseil->environments : 0),  ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('environment_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('espece_id') ? 'has-error' : '' !!}">
                    <label>Espèces :</label>
					{!! Form::select('espece_id[]', $data['especesSelect'], ($conseil->especes->count() ? $conseil->especes : 0), ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('espece_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('food_id') ? 'has-error' : '' !!}">
                    <label>Alimentations :</label>
					{!! Form::select('food_id[]', $data['foodsSelect'], ($conseil->foods->count() ? $conseil->foods : 0), ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('food_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('gender_id') ? 'has-error' : '' !!}">
                    <label>Sexes :</label>
					{!! Form::select('gender_id[]', $data['gendersSelect'], ($conseil->genders->count() ? $conseil->genders : 0), ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('gender_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
            <div>
				<div class="form-group {!! $errors->has('race_id') ? 'has-error' : '' !!}">
                    <label>Races :</label>
					{!! Form::select('race_id[]', $data['racesSelect'], ($conseil->races->count() ? $conseil->races : 0),  ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('race_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('sport_id') ? 'has-error' : '' !!}">
                    <label>Sports :</label>
					{!! Form::select('sport_id[]', $data['sportsSelect'], ($conseil->sports->count() ? $conseil->sports : 0), ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('sport_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('sterilization_id') ? 'has-error' : '' !!}">
                    <label>Stérilisations :</label>
					{!! Form::select('sterilization_id[]', $data['sterilizationsSelect'], ($conseil->sterilizations->count() ? $conseil->sterilizations : 0), ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('sterilization_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('weight_id') ? 'has-error' : '' !!}">
                    <label>Poids :</label>
					{!! Form::select('weight_id[]', $data['weightsSelect'], ($conseil->weights->count() ? $conseil->weights : 0), ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('weight_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<br>
			<p class="w3-center">
				{!! Form::submit('Valider', ['class' => 'w3-button w3-theme w3-round']) !!}
			</p>
			<br>
			{!! Form::close() !!}
		</div>
      </div>
      <br><br>
      <a href="{{ url('admin/conseil') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour aux conseils</a>

    <!-- End Column -->
    </div>

@endsection