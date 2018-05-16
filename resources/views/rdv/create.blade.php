@extends('template')

@section('contenu')
	<div class="col-sm-10">
		<br>	
		<h3>Demande de RDV<h3>
		<br />
		@if(!empty($selectA))
			<div>
				{!! Form::open(['route' => 'rdv.store', 'class' => 'form-horizontal panel']) !!}	
					<div class="form-group {!! $errors->has('request') ? 'has-error' : '' !!}">
						{!! Form::text('request', null, ['class' => 'form-control', 'placeholder' => 'Vos disponibilités']) !!}
						{!! $errors->first('request', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('animal_id') ? 'has-error' : '' !!}">
						{!! Form::select('animal_id', $selectA, null, ['class' => 'form-control', 'placeholder' => 'Animal']) !!}
						{!! $errors->first('animal_id', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('vet_id') ? 'has-error' : '' !!}">
						{!! Form::select('vet_id', $selectV, null,  ['class' => 'form-control', 'placeholder' => 'Vétérinaire']) !!}
						{!! $errors->first('vet_id', '<small class="help-block">:message</small>') !!}
					</div>
					{!! Form::submit('Envoyer', ['class' => 'btn btn-warning float-right']) !!}
				{!! Form::close() !!}
			</div>
		@else
			<p>Vous n'avez pas d'animal enregistré. Enregistrez un animal pour prendre RDV !</p>
		@endif
		<a href="{{ url('rdv') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@endsection