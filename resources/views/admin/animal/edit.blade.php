@extends('admin.template')

@section('content')

	<!-- Main column -->
  	<div class="w3-col m12">
      <div class="w3-card w3-round w3-white w3-card-4">
        <div class="w3-container-fluid">
        	<div class="w3-container w3-theme w3-padding-16">
        		<h4 class="w3-center">Modification de l'animal "{{ $animal->name }}"</h4>
			</div>
			{!! Form::model($animal, ['route' => ['admin.animal.update', $animal->id], 'method' => 'put', 'class' => 'w3-container']) !!}
			<br>
			<div>
				<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                    <label>Nom :</label>
					{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Nom', 'readonly' => true]) !!}
					{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('user') ? 'has-error' : '' !!}">
                    <label>Propriétaire :</label>
					{!! Form::text('user', ($animal->user->name . ' ' . $animal->user->prenom), ['class' => 'form-control', 'required' => 'required', 'readonly' => true]) !!}
					{!! $errors->first('text', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('age_id') ? 'has-error' : '' !!}">
                    <label>Âge :</label>
					{!! Form::select('age_id', $data['agesSelect'], $animal->age->id, ['required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('age_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
            <div>
				<div class="form-group {!! $errors->has('weight_id') ? 'has-error' : '' !!}">
                    <label>Poids :</label>
					{!! Form::select('weight_id', $data['weightsSelect'], $animal->weight->id, ['required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('weight_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('gender_id') ? 'has-error' : '' !!}">
                    <label>Genre :</label>
					{!! Form::select('gender_id', $data['gendersSelect'], $animal->gender->id, ['required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('gender_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('sterilization_id') ? 'has-error' : '' !!}">
                <label>Stérilisation :</label>
					{!! Form::select('sterilization_id', $data['sterilizationsSelect'], $animal->sterilization->id, ['required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('sterilization_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('espece_id') ? 'has-error' : '' !!}">
                    <label>Espèce :</label>
					{!! Form::select('espece_id', $data['especesSelect'], $animal->espece->id, ['required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('espece_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('race_id') ? 'has-error' : '' !!}">
                    <label>Race(s) :</label>
					{!! Form::select('race_id[]', $data['racesSelect'], ($animal->races->count() ? $animal->races : 0), ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('race_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
            <div>
				<div class="form-group {!! $errors->has('food_id') ? 'has-error' : '' !!}">
                    <label>Alimentation :</label>
					{!! Form::select('food_id[]', $data['foodsSelect'], ($animal->foods->count() ? $animal->foods : 0),  ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('food_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('sport_id') ? 'has-error' : '' !!}">
                    <label>Activité physique :</label>
					{!! Form::select('sport_id', $data['sportsSelect'], $animal->sport->id, ['required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('sport_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('environment_id') ? 'has-error' : '' !!}">
                    <label>Lieu(x) de vie :</label>
					{!! Form::select('environment_id[]', $data['environmentsSelect'], ($animal->environments->count() ? $animal->environments : 0), ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
					{!! $errors->first('environment_id', '<small class="help-block">:message</small>') !!}
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
      <a href="{{ url('admin/animal') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour aux animals</a>

    <!-- End Column -->
    </div>

@endsection