@extends('template')

@section('contenu')
	@if(Auth::check() and !Auth::user()->admin)
		<div class="row justify-content-lg-center">
			<div class="col-lg-12"> 
				{!! link_to_route('animal.create', 'Ajouter', [], ['class' => 'btn btn-info float-left']) !!}
			</div>
		</div>
		<br />
	@endif
	@if(isset($info))
		<div class="row alert alert-info">{{ $info }}</div>
	@endif
	<div class="row">
		<div class="col-lg-12">
			@if(session()->has('ok'))
				<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
				<br />
			@endif
			@if(!$animals->isEmpty())
				<table class="table table-striped">
					<thead class="thead-light">
						<tr>
							@if(Auth::check() and Auth::user()->admin)
								<th scope="col">Propriétaire</th>
							@endif
							<th scope="col">Nom</th>
							<th scope="col">Âge</th>
							<th scope="col">Poids</th>
							<th scope="col">Genre</th>
							<th scope="col">Stérilisé(e)</th>
							<th scope="col">Photo</th>
							<th scope="col"></th>
							@if(Auth::check() and !Auth::user()->admin)
								<th scope="col"></th>
								<th scope="col"></th>
							@endif
						</tr>
					</thead>
					<tbody>
						@foreach($animals as $animal)
							<tr>
								@if(Auth::check() and Auth::user()->admin)
									<td>{!! link_to_route('user.show', $animal->user->name, [$animal->user->id]) !!}</td>
								@endif	
								<td>{{$animal->name}}</td>
								<td>{{$animal->age}}</td>
								<td>{{$animal->weight}}</td>
								<td>{{$animal->gender}}</td>
								<td>{{$animal->sterilization}}</td>
								<td><img src="{{$animal->image}}"></td>
								<td>{!! link_to_route('animal.show', 'Voir', [$animal->id], ['class' => 'btn btn-primary btn-block']) !!}
								@if(Auth::check() and !Auth::user()->admin)
									<td>{!! link_to_route('animal.edit', 'Modifier', [$animal->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
									<td>
										{!! Form::open(['method' => 'DELETE', 'route' => ['animal.destroy', $animal->id]]) !!}
											{!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cet animal ?\')']) !!}
										{!! Form::close() !!}
									</td>
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<div class="alert alert-success alert-dismissible">Vous n'avez pas d'animaux enregistrés. Créez un nouveau profil en cliquant sur "Ajouter"</div>
			@endif
			{{ $links = $animals->render( "pagination::bootstrap-4") }}
		</div>
	</div>
@endsection