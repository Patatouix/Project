@extends('template')

@section('contenu')
    <div class="col-sm-offset-6 col-sm-6">
    	<br>	
			<h3>Modification de produit</h3>
			<p><img src="{{ $article->image }}"></p>
			<br />
			<div>
				<div class="col-sm-12">
					{!! Form::model($article, ['route' => ['article.update', $article->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
						<label for="name"><strong>Nom</strong></label> 
					  	{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom']) !!}
					  	{!! $errors->first('name', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('short_description') ? 'has-error' : '' !!}">
						<label for="short_description"><strong>Description (courte)</strong></label> 
					  	{!! Form::text('short_description', null, ['class' => 'form-control', 'placeholder' => 'Description (courte)']) !!}
					  	{!! $errors->first('short_description', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
						<label for="description"><strong>Description (longue)</strong></label> 
					  	{!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Description (longue)']) !!}
					  	{!! $errors->first('description', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('price') ? 'has-error' : '' !!}">
						<label for="price"><strong>Prix</strong></label> 
					  	{!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Price']) !!}
					  	{!! $errors->first('price', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
						<label for="image"><strong>Image</strong></label> 
					  	{!! Form::url('image', null, ['class' => 'form-control', 'placeholder' => 'Image(url)']) !!}
					  	{!! $errors->first('image', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('tag') ? 'has-error' : '' !!}">
						<label for="tag"><strong>Catégorie</strong></label> 
							{!! Form::select('id_tag', $select, null, ['class' => 'form-control']) !!}
							{!! $errors->first('tag', '<small class="help-block">:message</small>') !!}
					</div>
						{!! Form::submit('Envoyer', ['class' => 'btn btn-warning float-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<a href="{{ url('article') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@endsection
