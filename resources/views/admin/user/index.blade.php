@extends('admin.template')

@section('content')

	<!-- Main column -->
    <div class="w3-col m12">

      <!-- Rdvs -->
      	<div class="w3-row-padding">
        	<div class="w3-col m12">
         		<div class="w3-card w3-round w3-white">
            		<div class="w3-container w3-padding">
		                <h3 class="w3-center w3-padding w3-border-bottom">Liste des clients</h3>
		                @if(session()->has('ok'))
			          		<div class="w3-container w3-green w3-display-container">
			          			<span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
			          			<p>{!! session('ok') !!}</p>
							</div>
				  	    @endif
		  	  			<br>
                		<div class="w3-container">
                			<div class="table-responsive-md">
								<table class="w3-table w3-striped">
									<thead>
										<tr class="w3-light-grey">
											<th>Nom</th>
                                            <th>Prénom</th>
											<th>Email</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach ($users as $user)
											<tr>
												<td><a href="{{ url('admin/user/'.$user->id) }}">{!! $user->name !!}</a></td>
												<td>{!! $user->prenom !!}</td>
												<td>{!! $user->email !!}</td>
												<td>
													{!! Form::open(['method' => 'DELETE', 'route' => ['admin.user.destroy', $user->id]]) !!}
														{!! Form::button('Suppr.', ['class' => 'w3-button w3-hover-red w3-white w3-border w3-border-red w3-text-red w3-round-large', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
													{!! Form::close() !!}
												</td>
											</tr>
										@endforeach
		  							</tbody>
								</table>
							</div>
							<br><br>
							{{ $links = $users->render("pagination::bootstrap-4") }}
							<br>
						</div>
					</div>
				</div>
				<br><br>
				<p><a href="{{ url('admin/home') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à l'écran d'accueil</a></p>
			</div>
		</div>
	</div>

@endsection