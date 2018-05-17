@extends('template')

@section('contenu')
    <div class="col-lg-12">
    	<br>
    	<label></label>
		<table class="table">
			<tr>
				<th>Nom</th>
				<td>{{ $user->name }}</td>

			</tr>
			<tr>
				<th>Email</th>
				<td>{{ $user->email }}</td>
			</tr>
			<tr>
				<th>Date d'inscription</th>
				<td>{{ $user->created_at }}</td>
			</tr>
			<tr>
				<th>Administrateur</th>
				<td>
					@if($user->admin == 1)
						Oui
					@else
						Non
					@endif
				</td>
			</tr>
				<th>Demandes de RDV</th>
				@if($user->rdvs->isEmpty())
					<td>Pas de RDV répertoriés</td>
				@else
					<td>
						<table>
							<thead class="thead-light">
								<tr>
									<th>#</th>
									<th>Date de création</th>
									<th>Requête</th>
									<th>Réponse</th>
									<th>Statut</th>
									<th>Animal</th>
									<th>Vétérinaire</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($user->rdvs as $rdv)
									<tr>
										<td>{{ $rdv->id }}</td>
										<td>{{ $rdv->created_at }}</td>
										<td>{{ $rdv->request }}</td>
										<td>{{ $rdv->response }}</td>
										<td>{{ $rdv->status }}</td>
										<td>{{ $rdv->animal->name }}</td>
										<td>{{ $rdv->vet->name }}</td>
										@if(Auth::user()->admin)
											@if($rdv->status == 'En attente')
												<td>{!! link_to_route('rdv.edit', 'Traiter', [$rdv->id], ['class' => 'btn btn-success btn-block']) !!}</td>
											@else
												<td style="color: green;">Pas d'action requise</td>
											@endif
										@else
											@if($rdv->status == 'Traité')
												<td>{!! link_to_route('rdv.edit', 'Traiter', [$rdv->id], ['class' => 'btn btn-success btn-block']) !!}</td>
											@else
												<td style="color: green;">Pas d'action requise</td>
											@endif
										@endif
									</tr>
								@endforeach	
							</tbody>
						</table>
					</td>
				@endif
			</tr>
			<tr>
				<th>Commandes</th>
				@if($user->commands->isEmpty())
					<td>Pas de commandes repertoriées</td>
				@else
					<td>
						<table>
							<thead class="thead-light">
								<tr>
									<th>#</th>
									<th>Date de création</th>
									<th>Date de retrait</th>
									<th>Statut</th>
									<th>Article</th>
									@if(Auth::user()->admin)
										<th>Actions</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($user->commands as $command)
									<tr>
										<td>{{ $command->id }}</td>
										<td>{{ $command->created_at }}</td>
										<td>{{ $command->takeout }}</td>
										<td>{{ $command->status }}</td>
										<td>{{ $command->article->name }}</td>
										@if(Auth::user()->admin)
											@if($command->status == 'En attente de validation')
												<td>{!! link_to_route('command.edit', 'Traiter', [$command->id], ['class' => 'btn btn-success btn-block']) !!}</td>
											@else
												<td style="color: green;">Pas d'action requise</td>
											@endif
										@endif
									</tr>
								@endforeach	
							</tbody>
						</table>
					</td>
				@endif
			</tr>
			@if(Auth::user()->admin)
				<tr>
					<th>Actions</th>
					<td>{!! link_to_route('user.edit', 'Modifier les infos de cet utilisateur', [$user->id], ['class' => 'btn btn-warning btn-block']) !!}
					{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
						{!! Form::submit('Supprimer le profil de cet utilisateur', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
					{!! Form::close() !!}</td>
				</tr>
			@endif
		</table>
		

			
		
	
			
	
		<a href="{{ url('user') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@endsection