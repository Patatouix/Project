@extends('template')

@section('content')

<!-- Main column -->
  	<div class="w3-col m12">
      <div class="w3-card w3-round w3-white w3-card-4">
        <div class="w3-container-fluid">
        	<div class="w3-container w3-theme w3-round">
        		<h4 class="w3-center pt-1   ">Création d'une demande de RDV</h4>
			</div>
			@if($selectData['animalsSelect'])
				{!! Form::open(['route' => 'rdv.store', 'class' => 'w3-container']) !!}
					<br>
					<div>
						<div class="form-group {!! $errors->has('request') ? 'has-error' : '' !!}">
                            <label>Détaillez ici votre demande, ainsi que vos disponibilités :</label>
							{!! Form::textarea('request', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Demande et disponiblités', 'rows' => '5']) !!}
							{!! $errors->first('request', '<small class="help-block">:message</small>') !!}
						</div>
                    </div>
					<div>
						<div class="form-group {!! $errors->has('animal_id') ? 'has-error' : '' !!}">
                            <label>Choisissez le(s) animau(x) concernés :</label>
							{!! Form::select('animal_id[]', $selectData['animalsSelect'], null, ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control', 'size' => '3']) !!}
							{!! $errors->first('animal_id', '<small class="help-block">:message</small>') !!}
						</div>
					</div>
					<div>
						<div class="form-group {!! $errors->has('vet_id') ? 'has-error' : '' !!}">
                            <label>Choisissez le vétérinaire qui s'occupera de votre animal :</label>
							{!! Form::select('vet_id', $selectData['vetsSelect'], null,  ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Vétérinaire']) !!}
							{!! $errors->first('vet_id', '<small class="help-block">:message</small>') !!}
						</div>
					</div>
					<br>
					<div class="w3-center mb-2">
						{!! Form::submit('Valider la demande', ['class' => 'w3-button w3-theme w3-round']) !!}
					</div>
					<br>
				{!! Form::close() !!}
			@else
				<br><br><br>
				<p class="w3-center">Vous n'avez pas d'animal enregistré. Enregistrez un animal pour prendre RDV !</p>
				<br><br><br>
			@endif
		</div>
      </div>
      <br><br><br>
      <a href="{{ url('rdv') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à mes demandes de RDV</a>

    <!-- End Column -->
    </div>

@endsection