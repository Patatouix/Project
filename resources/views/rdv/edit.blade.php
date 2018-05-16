@extends('template')

@section('contenu')
    <div class="col-sm-offset-4 col-sm-5">
    	<h2>Demande de RDV #{{$rdv->id}}</h2>
    	<br>
		<table class="table table-striped">			
			<tbody>
				<tr>
					@if(Auth::user()->admin)
						<th scope="row">Client</th>
						<td>{{ $rdv->user->name }}</td>
					@endif
				</tr>
				<tr>
					<th scope="row">Date</th>
					<td>{{ $rdv->created_at }} €</td>
				</tr>
				<tr>
					<th scope="row">Demande</th>
					@if(Auth::user()->admin)
						<td>{{ $rdv->request }}</td>
					@else
						<td>
							{!! Form::model($rdv, ['route' => ['rdv.update', $rdv->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}	
							<div class="form-group {!! $errors->has('request') ? 'has-error' : '' !!}">
								{!! Form::text('request', null, ['class' => 'form-control', 'placeholder' => 'Vos disponibilités']) !!}
								{!! $errors->first('request', '<small class="help-block">:message</small>') !!}
							</div>
						</td>
					@endif
				</tr>
				<tr>
					<th scope="row">Statut</th>
					<td>{{ $rdv->status }}</td>
				</tr>
				<tr>
					<th scope="row">Animal</th>
					<td>{{ $rdv->animal->name }}</td>
				</tr>
				<tr>
					<th scope="row">Véto</th>
					<td>{{ $rdv->vet->name }}</td>
				</tr>
				<tr>
					<th scope="row">Réponse</th>
					<td>
						@if(Auth::user()->admin)
							{!! Form::model($rdv, ['route' => ['rdv.update', $rdv->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
							<div class="form-group {!! $errors->has('response') ? 'has-error' : '' !!}">
								 
							  	{!! Form::text('response', null, ['class' => 'form-control', 'placeholder' => 'Proposition']) !!}
							  	{!! $errors->first('response', '<small class="help-block">:message</small>') !!}
					  		</div>
					  	@else
					  		{{ $rdv->response }}
					  	@endif
					</td>
				</tr>	
			</tbody>
		</table>
				{!! Form::submit('Envoyer', ['class' => 'btn btn-warning float-right']) !!}
			{!! Form::close() !!}	
		<br />		
		<a href="{{ url('rdv') }}" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
		<br />
		<br />
	</div>
@endsection