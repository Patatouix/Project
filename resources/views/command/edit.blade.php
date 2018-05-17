@extends('template')

@section('contenu')
    <div class="col-sm-offset-6 col-sm-6">
    	<br>	
			<h3>Traitement de commande # {{$command->id}}</h3>
			<br />
			<div>
				<table class="table table-bordered">
					<thead class="thead-light">
						<tr>
							<th scope="col">Auteur</th>
							<th scope="col">Date création</th>
							<th scope="col">Article</th>
							<th scope="col">Date de retrait</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{$command->user()->first()->name}}</td>
							<td>{{$command->created_at}}</td>
							<td>{{$command->article()->first()->name}}</td>
							<td>
								<div class="col-sm-12">
									{!! Form::open(['route' => ['command.update', $command->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
									<div class="form-group {!! $errors->has('takeout') ? 'has-error' : '' !!}">
										<label for="takeout"><strong>Date et heure de retrait</strong></label> 
						  				{!! Form::text('takeout', null, ['class' => 'form-control', 'placeholder' => 'Date / heure']) !!}
						  				{!! $errors->first('takeout', '<small class="help-block">:message</small>') !!}
						  			</div>
										{!! Form::submit('Envoyer', ['class' => 'btn btn-warning float-right']) !!}
									{!! Form::close() !!}
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<a href="{{ url('command') }}" class="btn btn-primary float-left">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@endsection
