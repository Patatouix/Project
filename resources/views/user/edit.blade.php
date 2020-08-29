@extends('template')

@section('content')

	<!-- Main column -->
  	<div class="w3-col m12">
      <div class="w3-card w3-round w3-white w3-card-4 mb-5">
        <div class="w3-container-fluid">
        	<div class="w3-container w3-theme w3-round p-2">
        		<h4 class="w3-center">Modification de mon profil</h4>
			</div>
			{!! Form::model($user, ['route' => ['user.update', $user->id], 'files' => true, 'method' => 'put', 'class' => 'w3-container p-3']) !!}
                <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                    <label for="name">Votre nom :</label>
                    {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
                    {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('prenom') ? 'has-error' : '' !!}">
                    <label for="prenom">Votre prénom :</label>
                    {!! Form::text('prenom', $user->prenom, ['class' => 'form-control', 'placeholder' => 'Prénom']) !!}
                    {!! $errors->first('prenom', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                    <label for="email">Votre adresse mail :</label>
                    {!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
                    <label>Votre image de profil :</label>
                    <label for="image" class="form-control"><span class="file_input_placeholder"></span></label>
                    {!! Form::file('image', ['id' => 'image', 'class' => 'form-control-file', 'style' => 'display:none', 'accept' => '.png, .jpg, .jpeg, .gif, .svg']) !!}
                    {!! $errors->first('image', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('phone') ? 'has-error' : '' !!}">
                    <label for="phone">Votre numéro de téléphone (facultatif) :</label>
                    {!! Form::text('phone', $user->phone, ['class' => 'form-control', 'step' => '0.01', 'placeholder' => 'Téléphone']) !!}
                    {!! $errors->first('phone', '<small class="help-block">:message</small>') !!}
                </div>

                <div class="form-group {!! $errors->has('adress') ? 'has-error' : '' !!}">
                    <label for="adress">Votre adresse (facultatif) :</label>
                    {!! Form::text('adress', $user->adress, ['class' => 'form-control', 'step' => '0.01', 'placeholder' => 'Adresse']) !!}
                    {!! $errors->first('adress', '<small class="help-block">:message</small>') !!}
                </div>
				<p class="w3-center">
					{!! Form::submit('Valider les modifications', ['class' => 'w3-button w3-theme w3-round']) !!}
				</p>
			{!! Form::close() !!}
		</div>
      </div>

      <a href="{{ url('user/'.$user->id) }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à mon profil</a>

    <!-- End Column -->
    </div>

<script type="text/javascript">

    $(document).ready(function() {

        var $file_input = $("input[type='file']");
        var $file_input_placeholder = $(".file_input_placeholder");
        var user_image = '{{ $user->image->name or 'undefined' }}';

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