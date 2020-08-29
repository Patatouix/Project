@extends('template')

@section('content')


  	<!-- Main column -->
    <div class="w3-col m12">

      <!-- reservations -->
      	<div class="w3-row-padding">
        	<div class="w3-col m12">
         		<div class="w3-card w3-round w3-white">
            		<div class="w3-container w3-padding">
                        <div class="p-2 border-bottom">
		                    <h3 class="w3-center">Mes réservations</h3>
                        </div>
		                @if(session()->has('ok'))
			          		<div class="w3-container w3-green w3-display-container">
			          			<span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
			          			<p>{!! session('ok') !!}</p>
							</div>
				  	    @endif
                        @if(session()->has('error'))
                        <div class="w3-container w3-red w3-display-container">
                            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
                            <p>{!! session('error') !!}</p>
                        </div>
				  	    @endif
		  	  			<br><br>
                        {!! Form::open(['route' => ['reservation.status'], 'class' => 'w3-container']) !!}
                        <p>
                            <label><i class="fa fa-info-circle w3-large"></i>  Recherche par statut</label>
                            <div class="form-group {!! $errors->has('status_id') ? 'has-error' : '' !!}">
                                {!! Form::select('status_id', $select, isset($status_id) ? $status_id : null , ['class' => 'w3-select', 'required' => 'required', 'placeholder' => 'Sélectionnez un statut']) !!}
                                {!! $errors->first('status_id', '<small class="help-block">:message</small>') !!}
                            </div>
                        </p>
                        <br>
                        <p>
                            {!! Form::submit('Chercher', ['class' => 'w3-button w3-theme w3-round']) !!} <a href="{{ url('admin/rdv') }}" class="w3-button w3-theme w3-margin">Annuler le filtre</a>
                        </p>
                        <hr>
                        <br>
                        {!! Form::close() !!}
                        <br>
		  	  			<p class="w3-center"><a href="{{ url('produit') }}" class="w3-button w3-theme w3-large w3-round">Consulter le catalogue<a></p>
		      			<br>
                		<div class="w3-container">
	    		 			@if(!$reservations->isEmpty())
	    		 				@foreach($reservations as $reservation)
	    		 					<h4>Réservation # {{ $reservation->id }}</h4>
		    		 				<table class="w3-table w3-striped">
		    		 					<tbody>
		    		 						<tr>
		    		 							<th>Identifiant de la demande</th>
		    		 							<td># {{ $reservation->id }}</td>
		    		 						</tr>
		    		 						<tr>
		    		 							<th>Date de création</th>
		    		 							<td>{{ date('d/m/Y H:i:s', strtotime($reservation->created_at)) }}</td>
		    		 						</tr>
		    		 						<tr>
		    		 							<th>Dernière modification</th>
		    		 							<td>{{ date('d/m/Y H:i:s', strtotime($reservation->updated_at)) }}</td>
		    		 						</tr>
		    		 						<tr>
		    		 							<th>Produit(s) réservé(s)</th>
		    		 							<td>@foreach($reservation->produits as $produit)
                                                        {{ $loop->first ? '' : ', ' }}
                                                        {!! $produit->name !!}
                                                    @endforeach
                                                </td>
                                            </tr>
		    		 						<tr>
		    		 							<th>Statut de la réservation</th>
		    		 							<td>{{ $reservation->status }}</td>
		    		 						</tr>
		    		 						<tr>
		    		 							<th>Date du retrait en clinique</th>
		    		 							<td>{{ $reservation->takeout }}</td>
		    		 						</tr>
		    		 					</tbody>
		    		 				</table>
		    		 				<br>
		    		 				@if($reservation->status != 'Validée')
		    		 				<p>{!! Form::open(['method' => 'DELETE', 'route' => ['reservation.destroy', $reservation->id]]) !!}
										 {!! Form::submit('Supprimer la réservation', ['class' => 'w3-button w3-red w3-right w3-round', 'onclick' => 'return confirm(\'Voulez vous vraiment supprimer cette réservation ?\')']) !!}
									   {!! Form::close() !!}
									</p>
									<br><br>
		    		 				@else
		    		 				<p><i class="fa fa-info-circle w3-large"></i>Une réservation validée par la clinique ne peut être annulée. Si nécessaire, contactez la clinique par téléphone.</p>
		    		 				@endif
		    		 				<hr>
		    		 			@endforeach
          		 			@else
	            				<br>
		            			<p class="w3-center">Vous n'avez pas encore réservé de produits vétérinaires ! Faites le sans attendre en cliquant sur le bouton ci dessus pour accéder au catalogue.</p>
		            			<br>
          		 			@endif
          	    		<br>
                		</div>
        			</div>
          		</div>
          		<br><br>
        		<p><a href="{{ url('home') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à l'écran d'accueil</a></p>
        		<br>
        	</div>
      	</div>

    <!-- End Center Column -->
    </div>


@endsection