@extends('admin.template')

@section('content')
	<div class="w3-col m12">
      	<div class="w3-card w3-round w3-white w3-card-4">
        	<div class="w3-container-fluid">
        		<div class="w3-container w3-padding w3-theme w3-round">
        			<h4 class="w3-center">Traitement de la commande # {{ $command->id }}</h4>
				</div>   	
				<table class="w3-table w3-striped">
					<thead>
						<tr class="w3-light-grey">
							<th scope="col">Auteur</th>
							<th scope="col">Date création</th>
							<th scope="col">Article</th>
							<th scope="col">Date de retrait</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $command->user->name }}</td>
							<td>{{$command->created_at}}</td>
							<td>{{$command->article()->first()->name}}</td>
							<td>
								<div class="col-sm-12">
									{!! Form::open(['route' => ['command.update', $command->id], 'method' => 'put', 'class' => 'w3-container w3-margin w3-padding']) !!}
									<div class="form-group {!! $errors->has('takeout') ? 'has-error' : '' !!}">
						  				{!! Form::text('takeout', null, ['class' => 'form-control', 'placeholder' => 'Date / heure']) !!}
						  				{!! $errors->first('takeout', '<small class="help-block">:message</small>') !!}
						  			</div>
										{!! Form::submit('Envoyer', ['class' => 'w3-button w3-theme w3-right']) !!}
									{!! Form::close() !!}
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<br>
		<br>
		<p><a href="{{ url('command') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à mes commandes</a></p>
	</div>
@endsection
