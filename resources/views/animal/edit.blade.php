@extends('template')

@section('content')

	<!-- Main column -->
    <div class="w3-col m12">
        <div class="w3-card w3-round w3-white w3-card-4">
            <div class="w3-container-fluid">
                <div class="w3-container w3-theme w3-round pt-1">
                    <h4 class="w3-center">Modification du profil de {{ $animal->name }}</h4>
                </div>
                {!! Form::model($animal, ['route' => ['animal.update', $animal->id], 'files' => true, 'method' => 'put', 'class' => 'w3-container']) !!}
                <br>

                <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                    <label for="name">Nom :</label>
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Nom', 'readonly' => true]) !!}
                    {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('age_id') ? 'has-error' : '' !!}">
                    <label for="age_id">Âge :</label>
                    {!! Form::select('age_id', $data['agesSelect'], $animal->age->id, ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Choisissez une tranche d\'âge']) !!}
                    {!! $errors->first('age_id', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
                    <label>Image de profil :</label>
                    <label for="image" class="form-control"><span class="file_input_placeholder"></span></label>
                    {!! Form::file('image', ['id' => 'image', 'class' => 'form-control-file', 'style' => 'display:none', 'accept' => '.png, .jpg, .jpeg, .gif, .svg']) !!}
                    {!! $errors->first('image', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('weight_id') ? 'has-error' : '' !!}">
                    <label for="weight_id">Poids :</label>
                    {!! Form::select('weight_id', $data['weightsSelect'], $animal->weight->id, ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Choisissez une tranche de poids']) !!}
                    {!! $errors->first('weight_id', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('gender_id') ? 'has-error' : '' !!}">
                    <label for="gender_id">Genre :</label>
                    {!! Form::select('gender_id', $data['gendersSelect'], $animal->gender->id, ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Choisissez un genre']) !!}
                    {!! $errors->first('gender_id', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('sterilization_id') ? 'has-error' : '' !!}">
                    <label for="sterilization_id">Stérilisation :</label>
                    {!! Form::select('sterilization_id', $data['sterilizationsSelect'], $animal->sterilization->id, ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Choisissez le type de stérilisation']) !!}
                    {!! $errors->first('sterilization_id', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('espece_id') ? 'has-error' : '' !!}">
                    <label for="espece_id">Espèce :</label>
                    {!! Form::select('espece_id', $data['especesSelect'], $animal->espece->id, ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Choisissez une espèce']) !!}
                    {!! $errors->first('espece_id', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('race_id') ? 'has-error' : '' !!}">
                    <label for="race_id">Race(s) :</label>
                    {!! Form::select('race_id[]', $data['racesSelect'], ($animal->races->count() ? $animal->races : 0), ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
                    {!! $errors->first('race_id', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('food_id') ? 'has-error' : '' !!}">
                    <label for="food_id">Alimentation :</label>
                    {!! Form::select('food_id[]', $data['foodsSelect'], ($animal->foods->count() ? $animal->foods : 0),  ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
                    {!! $errors->first('food_id', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('sport_id') ? 'has-error' : '' !!}">
                    <label for="sport_id">Activité physique :</label>
                    {!! Form::select('sport_id', $data['sportsSelect'], $animal->sport->id, ['required' => 'required', 'placeholder' => 'Choisissez un type de pratique sportive', 'class' => 'form-control']) !!}
                    {!! $errors->first('sport_id', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('environment_id') ? 'has-error' : '' !!}">
                    <label for="environment_id">Lieu(x) de vie :</label>
                    {!! Form::select('environment_id[]', $data['environmentsSelect'], ($animal->environments->count() ? $animal->environments : 0), ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
                    {!! $errors->first('environment_id', '<small class="help-block">:message</small>') !!}
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
        <a href="{{ url('animal') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à mes animaux</a>

    <!-- End Column -->
    </div>

    <script type="text/javascript">

        $(document).ready(function() {

            var $file_input = $("input[type='file']");
            var $file_input_placeholder = $(".file_input_placeholder");
            var user_image = '{{ $animal->image->name or 'undefined' }}';

            if(user_image == 'undefined') {
                $file_input_placeholder.html('Aucun fichier sélectionné.');
            }
            else {
                $file_input_placeholder.html(user_image);
            }

            $file_input.change(function() {
                var image_name = $file_input[0].files[0].name;
                $file_input_placeholder.html(image_name);
            });

        });

    </script>

@endsection