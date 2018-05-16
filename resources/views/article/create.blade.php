@extends('template')

@section('contenu')
	<div class="col-sm-offset-6 col-sm-6">
		<br>	
			<h3>Ajouter un article au catalogue<h3>
			<br />
			<div>
				<div class="col-sm-12">
					{!! Form::open(['route' => 'article.store', 'class' => 'form-horizontal panel']) !!}	
						<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
							{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
							{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('short_description') ? 'has-error' : '' !!}">
							{!! Form::text('short_description', null, ['class' => 'form-control', 'placeholder' => 'Description (courte)']) !!}
							{!! $errors->first('short_description', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
							{!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Description (longue)']) !!}
							{!! $errors->first('description', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('price') ? 'has-error' : '' !!}">
							{!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Prix']) !!}
							{!! $errors->first('price', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
							{!! Form::url('image', null, ['class' => 'form-control', 'placeholder' => 'Image (URL)']) !!}
							{!! $errors->first('image', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group {!! $errors->has('id_tag') ? 'has-error' : '' !!}">
							{!! Form::select('id_tag', $select, null, ['placeholder' => 'Alimentation'], ['class' => 'form-control']) !!}
							{!! $errors->first('id_tag', '<small class="help-block">:message</small>') !!}
						</div>
						{!! Form::submit('Envoyer', ['class' => 'btn btn-warning float-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<a href="{{ url('article') }}" class="btn btn-primary float-left">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@endsection