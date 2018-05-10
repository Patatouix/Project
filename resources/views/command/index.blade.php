@extends('command.template')

@section('contenu')
	@if(Auth::check())
		<div class="row justify-content-lg-center">
			<div class="col-lg-12"> 
				{!! link_to_route('article.index', 'Catalogue', [], ['class' => 'btn btn-info float-left']) !!}
			</div>
		</div>
		<br />
	@endif
	@if(isset($info))
		<div class="row alert alert-info">{{ $info }}</div>
	@endif
	<div class="row">
		<div class="col-lg-10">
			@if(session()->has('ok'))
				<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
				<br />
			@endif
			@if(!$commands->isEmpty())
				<table class="table table-striped">
					<thead class="thead-light">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Auteur</th>
							<th scope="col">Date création</th>
							<th scope="col">Article</th>
							<th scope="col">Statut</th>
							<th scope="col">Date retrait</th>
							<th scope="col"></th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($commands as $command)
							<tr>	
								<td>{{$command->id}}</td>
								<td>{{$command->user()->first()->name}}</td>
								<td>{{$command->created_at}}</td>
								<td>{{$command->articles()->first()->name}}</td>
								@if($command->status == 'En attente de validation')
									<td style="color: red;">{{$command->status}}</td>
								@else
									<td style="color: green;">{{$command->status}}</td>
								@endif
								</td>
								<td>{{$command->takeout}}</td>
								<td>
									@if(Auth::user()->admin and $command->status == 'En attente de validation')
										{!! link_to_route('command.edit', 'Traiter', [$command->id], ['class' => 'btn btn-warning btn-block']) !!}
									@elseif(!$command->status == 'En attente de validation')
									Commande traitée.
									@endif
								</td>
								<td>
									@if(!Auth::user()->admin)
										{!! Form::open(['method' => 'DELETE', 'route' => ['command.destroy', $command->id]]) !!}
											{!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cette commande ?\')']) !!}
										{!! Form::close() !!}
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<div class="alert alert-success alert-dismissible">Vous n'avez pas de commandes. Vous pouvez créer une nouvelle commande en cliquant sur "Catalogue" et en sélectionnant le produit désiré !
				</div>
			@endif
			{!! $links !!}
		</div>
	</div>
@endsection