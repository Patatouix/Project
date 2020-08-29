@extends('admin.template')

@section('content')

	<div class="w3-col m12">
      	<div class="w3-card w3-round w3-white w3-card-4">
        	<div class="w3-container-fluid">
        		<div class="w3-container w3-padding w3-theme w3-round">
        			<h4 class="w3-center">Traitement de la demande de RDV #{{ $rdv->id }}</h4>
				</div>
				<table class="w3-table w3-striped">
					<thead>
						<tr class="w3-light-grey">
							<th scope="col">Auteur</th>
							<th scope="col">Date demande</th>
							<th scope="col">Animaux concernés</th>
							<th scope="col">Vétérinaire souhaité</th>
							<th scope="col">Demande et disponibilités</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $rdv->user->name }} {{ $rdv->user->prenom }}</td>
							<td>{{ date('d/m/Y H:i:s', strtotime($rdv->created_at)) }}</td>
							<td>
                                @foreach($rdv->animals as $animal)
                                    {{ $loop->first ? '' : ', ' }}
                                    <a href="{{ url('admin/animal/'.$animal->id) }}">{{ $animal->name }}</a>
                                @endforeach
                            </td>
							<td>{{ $rdv->vet->name }}</td>
							<td>{{ $rdv->request }}</td>
						</tr>
					</tbody>
				</table>
				<hr>
				<div>
					<div class="col-sm-12">
						{!! Form::open(['route' => ['admin.rdv.update', $rdv->id], 'method' => 'put', 'class' => 'w3-container w3-margin w3-padding pb-3']) !!}
						<p>
							<label>Faites une proposition au client :</label>
							<div class="form-group {!! $errors->has('response') ? 'has-error' : '' !!}">
				  				{!! Form::text('response', null, ['class' => 'form-control', 'placeholder' => 'Proposition']) !!}
				  				{!! $errors->first('response', '<small class="help-block">:message</small>') !!}
				  			</div>
				  		</p>
				  		<p>
							{!! Form::submit('Traiter', ['class' => 'w3-button w3-round w3-theme w3-right']) !!}
						</p>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		<br>
		<br>
		<p><a href="{{ url('admin/rdv') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à la liste des RDVs</a></p>
	</div>

@endsection
