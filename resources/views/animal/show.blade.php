@extends('template')

@section('contenu')
    <div class="col-lg-12">
    	<h2>Fiche animal</h2>
    	<br>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Caractéristique</th>
					<th>Valeur</th>
					<th>Le conseil d	</th>
			</thead>			
			<tbody>
				<tr>
					<th scope="row">Nom</th>
					<td>{{ $animal->name }}</td>
					<td>Joli nom !</td>
				</tr>
				<tr>
					<th scope="row">Photo</th>
					<td><img src="{{ $animal->image }}"></td>
					<td>Joli moumousse !</td>
				</tr>
				<tr>
					<th scope="row">Age</th>
					<td>{{ $animal->age }}</td>
					<td>RAS</td>
				</tr>
				<tr>
					<th scope="row">Poids</th>
					<td>{{ $animal->weight }}</td>
					<td>RAS</td>
				</tr>
				<tr>
					<th scope="row">Genre</th>
					<td>{{ $animal->gender }}</td>
					<td>RAS</td>
				</tr>
				<tr>
					<th scope="row">Sterilisation</th>
					<td>{{ $animal->sterilization }}</td>
					<td>RAS</td>
				</tr>
				<tr>
					<th scope="row">Espèce</th>
					<td>{{ $animal->species->name }}</td>
					<td>{{ $animal->species->advice }}</td>
				</tr>
				<tr>
					<th scope="row">Race</th>
					<td>{{ $animal->race->name }}</td>
					<td>{{ $animal->species->advice }}</td>
				</tr>
				<tr>
					<th scope="row">Alimentation</th>
					<td>{{ $animal->food->name }}</td>
					<td>{{ $animal->species->advice }}</td>
				</tr>
				<tr>
					<th scope="row">Sport</th>
					<td>{{ $animal->sport->name }}</td>
					<td>{{ $animal->species->advice }}</td>
				</tr>
				<tr>
					<th scope="row">Environnement</th>
					<td>{{ $animal->environment->name }}</td>
					<td>{{ $animal->species->advice }}</td>
				</tr>
					
			</tbody>
		</table>	
		<br />		
		<a href="{{ url('animal') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
		<br />
		<br />
	</div>
@endsection