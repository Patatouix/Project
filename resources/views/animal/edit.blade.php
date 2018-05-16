@extends('template')

@section('contenu')
    <div class="col-sm-offset-6 col-sm-6">
    	<br>	
			<h3>Modification de {{$animal->name}}</h3>
			<p><img src="{{ $animal->image }}"></p>
			<br />
			<div>
				<div class="col-sm-12">
					{!! Form::model($animal, ['route' => ['animal.update', $animal->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
						<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
							{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
							{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('age') ? 'has-error' : '' !!}">
							{!! Form::number('age', null, ['class' => 'form-control', 'step' => '0.1', 'placeholder' => 'Âge']) !!}
							{!! $errors->first('age', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('weight') ? 'has-error' : '' !!}">
							{!! Form::number('weight', null, ['class' => 'form-control', 'step' => '0.01', 'placeholder' => 'Poids']) !!}
							{!! $errors->first('weight', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('gender') ? 'has-error' : '' !!}">
							{!! Form::select('gender', ['male' => 'Male', 'femelle' => 'Femelle'], null, ['class' => 'form-control', 'placeholder' => 'Genre']) !!}
							{!! $errors->first('gender', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('sterilization', 1, null) !!} animal stérilisé ?
								</label>
							</div>
						</div>
						<div class="form-group {!! $errors->has('species_id') ? 'has-error' : '' !!}">
							{!! Form::select('species_id', $data['selectSpe'], null, ['class' => 'form-control', 'placeholder' => 'Espèce']) !!}
							{!! $errors->first('species_id', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('race_id') ? 'has-error' : '' !!}">
							{!! Form::select('race_id', $data['selectR'], null,  ['class' => 'form-control', 'placeholder' => 'Race']) !!}
							{!! $errors->first('race_id', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('food_id') ? 'has-error' : '' !!}">
							{!! Form::select('food_id', $data['selectF'], null, ['class' => 'form-control', 'placeholder' => 'Alimentation']) !!}
							{!! $errors->first('food_id', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('sport_id') ? 'has-error' : '' !!}">
							{!! Form::select('sport_id', $data['selectSpo'], null, ['class' => 'form-control', 'placeholder' => 'Sport']) !!}
							{!! $errors->first('sport_id', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('environment_id') ? 'has-error' : '' !!}">
							{!! Form::select('environment_id', $data['selectE'], null, ['class' => 'form-control', 'placeholder' => 'Lieu de vie']) !!}
							{!! $errors->first('environment_id', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
							{!! Form::url('image', null, ['class' => 'form-control', 'placeholder' => 'Image (url)']) !!}
							{!! $errors->first('image', '<small class="help-block">:message</small>') !!}
						</div>
						{!! Form::submit('Modifier', ['class' => 'btn btn-warning float-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<a href="{{ url('animal') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@endsection
