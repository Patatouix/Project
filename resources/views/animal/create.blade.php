@extends('template')

@section('content')

	<!-- Main column -->
  	<div class="w3-col m12">
      <div class="w3-card w3-round w3-white w3-card-4">
        <div class="w3-container-fluid">
        	<div class="w3-container w3-theme w3-round pt-1">
        		<h4 class="w3-center">Création du profil de votre animal</h4>
			</div>
			{!! Form::open(['route' => 'animal.store', 'files' => true, 'class' => 'w3-container']) !!}
			<br>
			<div>
				<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                    <label>Nom :</label>
					{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Nom', 'required' => 'required']) !!}
					{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('age_id') ? 'has-error' : '' !!}">
                    <label>Âge :</label>
					{!! Form::select('age_id', $data['agesSelect'], null, ['required' => 'required', 'placeholder' => 'Choisissez une tranche d\'âge', 'class' => 'form-control']) !!}
					{!! $errors->first('age_id', '<small class="help-block">:message</small>') !!}
				</div>
            </div>
            <div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
                    <label>Image de profil :</label>
                    <label for="image" class="form-control"><span class="file_input_placeholder"></span></label>
                    {!! Form::file('image', ['id' => 'image', 'class' => 'form-control-file', 'style' => 'display:none', 'accept' => '.png, .jpg, .jpeg, .gif, .svg']) !!}
                    {!! $errors->first('image', '<small class="help-block">:message</small>') !!}
                </div>
            <div>
				<div class="form-group {!! $errors->has('weight_id') ? 'has-error' : '' !!}">
                    <label>Poids :</label>
					{!! Form::select('weight_id', $data['weightsSelect'], null, ['required' => 'required', 'placeholder' => 'Choisissez une tranche de poids', 'class' => 'form-control']) !!}
					{!! $errors->first('weight_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('gender_id') ? 'has-error' : '' !!}">
                    <label>Genre :</label>
					{!! Form::select('gender_id', $data['gendersSelect'], null, ['required' => 'required', 'placeholder' => 'Choisissez un genre', 'class' => 'form-control']) !!}
					{!! $errors->first('gender_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('sterilization_id') ? 'has-error' : '' !!}">
                    <label>Stérilisation :</label>
					{!! Form::select('sterilization_id', $data['sterilizationsSelect'], null, ['required' => 'required', 'placeholder' => 'Choisissez le type de stérilisation', 'class' => 'form-control']) !!}
					{!! $errors->first('sterilization_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('espece_id') ? 'has-error' : '' !!}">
                    <label>Espèce :</label>
					{!! Form::select('espece_id', $data['especesSelect'], null, ['required' => 'required', 'placeholder' => 'Choisissez une espèce', 'class' => 'form-control']) !!}
					{!! $errors->first('espece_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('race_id') ? 'has-error' : '' !!}">
                    <label>Race(s) :</label>
					{!! Form::select('race_id[]', $data['racesSelect'], null, ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
                    {!! $errors->first('race_id', '<small class="help-block">:message</small>') !!}
                    <small class="form-text text-muted">Maintenez la touche Ctrl pour sélectionner plusieurs éléments</small>
				</div>
			</div>
            <div>
				<div class="form-group {!! $errors->has('food_id') ? 'has-error' : '' !!}">
                    <label>Alimentation :</label>
					{!! Form::select('food_id[]', $data['foodsSelect'], null,  ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
                    {!! $errors->first('food_id', '<small class="help-block">:message</small>') !!}
                    <small class="form-text text-muted">Maintenez la touche Ctrl pour sélectionner plusieurs éléments</small>
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('sport_id') ? 'has-error' : '' !!}">
                    <label>Activité physique :</label>
					{!! Form::select('sport_id', $data['sportsSelect'], null, ['required' => 'required', 'placeholder' => 'Choisissez un type de pratique sportive', 'class' => 'form-control']) !!}
					{!! $errors->first('sport_id', '<small class="help-block">:message</small>') !!}
				</div>
			</div>
			<div>
				<div class="form-group {!! $errors->has('environment_id') ? 'has-error' : '' !!}">
                    <label>Lieu(x) de vie :</label>
					{!! Form::select('environment_id[]', $data['environmentsSelect'], null, ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
                    {!! $errors->first('environment_id', '<small class="help-block">:message</small>') !!}
                    <small class="form-text text-muted">Maintenez la touche Ctrl pour sélectionner plusieurs éléments</small>
				</div>
			</div>
			<br>
			<div class="w3-center">
				{!! Form::submit('Valider les informations', ['class' => 'w3-button w3-theme w3-round']) !!}
			</div>
			<br>
			{!! Form::close() !!}
		</div>
      </div>
      <br><br>
      <a href="{{ url('animal') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à mes animaux</a>

    <!-- End Column -->
    </div>

    <script type="text/javascript">

    $(document).ready(function() {

        var $file_input = $("input[type='file']");
        var $file_input_placeholder = $(".file_input_placeholder");

        $file_input_placeholder.html('Aucun fichier sélectionné.');

        $file_input.change(function() {
            var image_name = $file_input[0].files[0].name;
            $file_input_placeholder.html(image_name);
        });

    });

</script>

@endsection