@extends('template')

@section('contenu')
	@if(Auth::check() and !Auth::user()->admin)
		<div class="row justify-content-lg-center">
			<div class="col-lg-12"> 
				{!! link_to_route('rdv.create', 'Nouvelle demande', [], ['class' => 'btn btn-info float-left']) !!}
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
			@if(!$rdvs->isEmpty())
				<table class="table table-striped">
					<thead class="thead-light">
						<tr>
							<th scope="col">#</th> 
							@if(Auth::check() and Auth::user()->admin)
								<th scope="col">Demandeur</th>
							@endif
							<th scope="col">Date</th>
							<th scope="col">Demande</th>
							<th scope="col">Réponse</th>
							<th scope="col">Statut</th>
							<th scope="col">Animal</th>
							<th scope="col">Vétérinaire</th>				
							<th></th>		
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($rdvs as $rdv)
							<tr>
								<td>{{$rdv->id}}</td>
								@if(Auth::check() and Auth::user()->admin)
									<td>{!! link_to_route('user.show', $rdv->user->name, [$rdv->user->id]) !!}</td>
								@endif	
								<td>{{$rdv->created_at}}</td>
								<td>{{$rdv->request}}</td>
								<td>{{$rdv->response}}</td>
								@if($rdv->status == 'En attente')
									<td style="color: red;">{{$rdv->status}}</td>
								@elseif($rdv->status == 'Traité')
									<td style="color: orange;">{{$rdv->status}}</td>
								@else
									<td style="color: green;">{{$rdv->status}}</td>
								@endif
								<td>{{$rdv->animal->name}}</td>
								<td>{{$rdv->vet->name}}</td>
								@if(!Auth::user()->admin)
									@if($rdv->status == 'Traité')
										<td>{!! link_to_route('rdv.confirm', 'Confirmer', [$rdv->id], ['class' => 'btn btn-success btn-block', 'onclick' => 'return confirm(\'Vraiment confirmer ce RDV ?\')']) !!}</td>
										<td>{!! link_to_route('rdv.edit', 'Modifier', [$rdv->id], ['class' => 'btn btn-warning btn-block']) !!}</td>	
									@else
										<td></td>
										<td></td>
									@endif
								@else
									@if($rdv->status == 'En attente')
										<td>{!! link_to_route('rdv.edit', 'Traiter', [$rdv->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
										<td></td>	
									@else
										<td></td>
										<td></td>
									@endif
								@endif
								@if(!Auth::user()->admin and $rdv->status == 'Confirmé')
									<td>Annulation uniquement par tél.</td>
								@else
									<td>{!! Form::open(['method' => 'DELETE', 'route' => ['rdv.destroy', $rdv->id]]) !!}
											{!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer ce RDV ?\')']) !!}
										{!! Form::close() !!}</td>
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<div class="alert alert-success alert-dismissible">Vous n'avez pas de demandes de RDV. Créez une nouvelle demande en cliquant sur "Nouvelle demande".</div>
			@endif
			{{ $links = $rdvs->render( "pagination::bootstrap-4") }}
		</div>
	</div>
@endsection