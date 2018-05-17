@extends('template')

@section('contenu')
    <br>
    <div class="col-lg-12">
    	@if(session()->has('ok'))
			<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
		@endif
		{!! link_to_route('user.create', 'Ajouter un utilisateur', [], ['class' => 'btn btn-info float-right']) !!}
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Liste des utilisateurs</h3>
			</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Nom</th>
							<th>Mail</th>
							<th>Traitement</th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td>{!! $user->id !!}</td>
								<td>{!! $user->name !!}</td>
								<td>{!! $user->email !!}</td>
								@if($user->commands->where('status', 'En attente de validation')->isEmpty() and $user->rdvs->where('status', 'En attente')->isEmpty())
									<td style="color: green;">Pas de traitement requis</td>
								@else
									<td style="color: red;">Traitement requis !</td>
								@endif
								</td>
								<td>{!! link_to_route('user.show', 'Récap', [$user->id], ['class' => 'btn btn-success btn-block']) !!}</td>
								<td>{!! link_to_route('user.edit', 'Modifier', [$user->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
								<td>
									{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) !!}
										{!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
									{!! Form::close() !!}
								</td>
							</tr>
						@endforeach
		  			</tbody>
				</table>
			</div>
		</div>
		{{ $links = $users->render( "pagination::bootstrap-4") }}
	</div>
@endsection