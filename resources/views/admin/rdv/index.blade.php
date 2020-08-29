@extends('admin.template')

@section('content')


  	<!-- Main column -->
    <div class="w3-col m12">

      <!-- Rdvs -->
      	<div class="w3-row-padding">
        	<div class="w3-col m12">
         		<div class="w3-card w3-round w3-white">
            		<div class="w3-container w3-padding">
                        <div class="p-2 border-bottom">
		                    <h3 class="w3-center">Demandes de rendez-vous des clients</h3>
                        </div>
		                @if(session()->has('ok'))
			          		<div class="w3-container w3-green w3-display-container">
			          			<span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
			          			<p>{!! session('ok') !!}</p>
							</div>
				  	    @endif
		  	  			<br>
                        {!! Form::open(['route' => ['admin.rdv.status'], 'class' => 'w3-container']) !!}
                        <p>
                            <label><i class="fa fa-info-circle w3-large"></i>  Recherche par statut</label>
                            <div class="form-group {!! $errors->has('status_id') ? 'has-error' : '' !!}">
                                {!! Form::select('status_id', $select, isset($status_id) ? $status_id : null , ['class' => 'w3-select', 'required' => 'required', 'placeholder' => 'Sélectionnez un statut']) !!}
                                {!! $errors->first('status_id', '<small class="help-block">:message</small>') !!}
                            </div>
                        </p>
                        <br>
                        <p>
                            {!! Form::submit('Chercher', ['class' => 'w3-button w3-theme w3-round']) !!} <a href="{{ url('admin/rdv') }}" class="w3-button w3-theme w3-margin w3-round">Annuler le filtre</a>
                        </p>
                        <hr>
                        <br>
                        {!! Form::close() !!}
		      			<br><br>
                		<div class="w3-container">
    		 				@foreach($rdvs as $rdv)
    		 					<h4>Demande de Rdv # {{ $rdv->id }}</h4>
	    		 				<table class="w3-table w3-striped">
	    		 					<tbody>
	    		 						<tr>
	    		 							<th>Identifiant de la demande</th>
	    		 							<td># {{ $rdv->id }}</td>
	    		 						</tr>
	    		 						<tr>
	    		 							<th>Date de création</th>
	    		 							<td>{{ date('d/m/Y H:i:s', strtotime($rdv->created_at)) }}</td>
	    		 						</tr>
	    		 						<tr>
	    		 							<th>Dernière modification</th>
	    		 							<td>{{ date('d/m/Y H:i:s', strtotime($rdv->updated_at)) }}</td>
	    		 						</tr>
	    		 						<tr>
	    		 							<th>Client demandeur</th>
	    		 							<td>{{ $rdv->user->name }} {{ $rdv->user->prenom }}</td>
	    		 						</tr>
	    		 						<tr>
	    		 							<th>Requête</th>
	    		 							<td>{{ $rdv->request }}</td>
	    		 						</tr>
	    		 						<tr>
	    		 							<th>Réponse</th>
	    		 							<td>{{ $rdv->response }}</td>
	    		 						</tr>
	    		 						<tr>
	    		 							<th>Statut</th>
	    		 							<td>{{ $rdv->status }}</td>
	    		 						</tr>
	    		 						<tr>
	    		 							<th>Animal concerné</th>
	    		 							<td>@foreach($rdv->animals as $animal)
                                                    {{ $loop->first ? '' : ', ' }}
                                                    {!! $animal->name !!}
                                                @endforeach
                                            </td>
	    		 						</tr>
	    		 						<tr>
	    		 							<th>Vétérinaire demandé</th>
	    		 							<td>{{ $rdv->vet->name }}</td>
	    		 						</tr>
	    		 					</tbody>
	    		 				</table>
	    		 					<br>
	    		 					<p>
		    		 					@if($rdv->status == 'En attente')
		    		 						<a href="{{ url('admin/rdv/'.$rdv->id.'/edit') }}" class="w3-button w3-theme w3-round">Traiter la demande</a>
		    		 					@elseif($rdv->status == 'Confirmé')
		    		 						<a href="{{ url('admin/rdv/'.$rdv->id.'/archive') }}" class="w3-button w3-theme w3-round">Archiver la demande</a>
		    		 					@endif
	    		 					</p>
    		 						<p>
    		 						   {!! Form::open(['method' => 'DELETE', 'route' => ['admin.rdv.destroy', $rdv->id], 'class' => 'w3-right']) !!}
								 	   		{!! Form::submit('Supprimer la demande', ['class' => 'w3-button w3-red w3-round', 'onclick' => 'return confirm(\'Voulez vous vraiment supprimer cette demande de RDV ?\')']) !!}
							   		   {!! Form::close() !!}
									</p>
									<br>
	    		 				<br>
	    		 				<hr>
	    		 			@endforeach
          	    		<br>
                		</div>
                		<br>
                		{{ $links = $rdvs->render("pagination::bootstrap-4") }}
                		<br>
        			</div>
          		</div>
          		<br><br>
        		<p><a href="{{ url('admin/home') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à l'écran d'accueil</a></p>
        		<br>
        	</div>
      	</div>

    <!-- End Center Column -->
    </div>


@endsection

