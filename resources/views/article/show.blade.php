@extends('template')

@section('contenu')
    <div class="col-sm-offset-4 col-sm-5">
    	<h2>Fiche produit</h2>
    	<br>
		<table class="table table-striped">			
			<tbody>
				<tr>
					<th scope="row">Nom</th>
					<td>{{ $article->name }}</td>
				</tr>
				<tr>
					<th scope="row">Prix</th>
					<td>{{ $article->price }} €</td>
				</tr>
				<tr>
					<th scope="row">Description</th>
					<td>{{ $article->description }}</td>
				</tr>
				<tr>
					<th scope="row">Aperçu</th>
					<td><img src="{{ $article->image }}"></td>
				</tr>
				<tr>
					@if(Auth::check())
						@if(!Auth::user()->admin)
							<th scope="row">Actions</th>
							<td>{!! link_to_route('command.create', 'Commander', [$article->id], ['class' => 'btn btn-success btn-block']) !!}</td>
						@endif
					@endif
				</tr>	
			</tbody>
		</table>	
		<br />		
		<a href="{{ url('article') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
		<br />
		<br />
	</div>
@endsection