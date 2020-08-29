@extends('admin.template')

@section('content')

	<!-- Main column -->
  	<div class="w3-col m12">
      <div class="w3-card w3-round w3-white w3-card-4">
        <div class="w3-container-fluid">
        	<div class="w3-container w3-theme w3-padding-16">
        		<h4 class="w3-center">Création d'un conseil santé</h4>
			</div>
			{!! Form::open(['route' => 'admin.conseil.store', 'class' => 'w3-container']) !!}
			<br>
			<p>
				<label>Titre :</label>
				<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
					{!! Form::text('title', null, ['class' => 'w3-input w3-border', 'required' => 'required', 'placeholder' => 'Titre']) !!}
					{!! $errors->first('title', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
			<p>
				<label>Texte :</label>
				<div class="form-group {!! $errors->has('text') ? 'has-error' : '' !!}">
					{!! Form::textarea('text', null, ['class' => 'w3-input w3-border', 'required' => 'required', 'placeholder' => 'Texte']) !!}
					{!! $errors->first('text', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
			<p>
                <label>Catégories :</label>
				<div class="form-group {!! $errors->has('conseiltag_id') ? 'has-error' : '' !!}">
					{!! Form::select('conseiltag_id[]', $data['conseiltagsSelect'], '0', ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('conseiltag_id', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
            <p>
                <label>Âges :</label>
				<div class="form-group {!! $errors->has('age_id') ? 'has-error' : '' !!}">
					{!! Form::select('age_id[]', $data['agesSelect'], '0',  ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('age_id', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
			<p>
                <label>Environnements :</label>
				<div class="form-group {!! $errors->has('environment_id') ? 'has-error' : '' !!}">
					{!! Form::select('environment_id[]', $data['environmentsSelect'], '0',  ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('environment_id', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
			<p>
                <label>Espèces :</label>
				<div class="form-group {!! $errors->has('espece_id') ? 'has-error' : '' !!}">
					{!! Form::select('espece_id[]', $data['especesSelect'], '0', ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('espece_id', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
			<p>
                <label>Alimentations :</label>
				<div class="form-group {!! $errors->has('food_id') ? 'has-error' : '' !!}">
					{!! Form::select('food_id[]', $data['foodsSelect'], '0', ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('food_id', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
			<p>
                <label>Sexes :</label>
				<div class="form-group {!! $errors->has('gender_id') ? 'has-error' : '' !!}">
					{!! Form::select('gender_id[]', $data['gendersSelect'], '0', ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('gender_id', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
            <p>
                <label>Races :</label>
				<div class="form-group {!! $errors->has('race_id') ? 'has-error' : '' !!}">
					{!! Form::select('race_id[]', $data['racesSelect'], '0',  ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('race_id', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
			<p>
                <label>Sports :</label>
				<div class="form-group {!! $errors->has('sport_id') ? 'has-error' : '' !!}">
					{!! Form::select('sport_id[]', $data['sportsSelect'], '0', ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('sport_id', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
			<p>
                <label>Stérilisations :</label>
				<div class="form-group {!! $errors->has('sterilization_id') ? 'has-error' : '' !!}">
					{!! Form::select('sterilization_id[]', $data['sterilizationsSelect'], '0', ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('sterilization_id', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
			<p>
                <label>Poids :</label>
				<div class="form-group {!! $errors->has('weight_id') ? 'has-error' : '' !!}">
					{!! Form::select('weight_id[]', $data['weightsSelect'], '0', ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('weight_id', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
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