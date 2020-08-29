@extends('template')

@section('contenu')
    <div class="col-sm-offset-4 col-sm-5">
    	<h2>Votre commande</h2>
    	<br>
		<table class="table table-striped">			
			<tbody>
				<tr>
					<th scope="row">Auteur</th>
					<td>{{ Auth::user()->name }}</td>
				</tr>
				<tr>
					<th scope="row">Article</th>
					<td>{{ $article->name }}</td>
				</tr>
				<tr>
					<th scope="row">Prix</th>
					<td>{{ $article->price }} €</td>
				</tr>
				<tr>
					<th scope="row">Description</th>
					<td>{{ $article->short_description }}</td>
				</tr>
				<tr>
					<th scope="row">Aperçu article</th>
					<td><img src="{{ $article->image }}"></td>
				</tr>
				<tr>
					<th scope="row">Infos</th>
					<td>Après validation, votre commande sera traitée dans les <strong>24 heures</strong> et il vous sera indiqué une <strong>date de retrait en clinique</strong>.</td>
				</tr>
				<tr>
					<th scope="row">Actions</th>
					<td>
						{!! link_to_route('command.store', 'Valider la commande', [$article->id],
						['class' => 'btn btn-warning btn-block', 'onclick' => 'return confirm(\'Vraiment valider cette commande ?\')']) !!}
					</td>
				</tr>	
			</tbody>
		</table>	
		<br />		
		<a href="{{ url('article') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Annuler
		</a>	
	</div>
@endsection