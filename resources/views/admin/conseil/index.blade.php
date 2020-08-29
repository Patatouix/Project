@extends('admin.template')

@section('content')

	<!-- Main column -->
    <div class="w3-col m12">

      <!-- Rdvs -->
      	<div class="w3-row-padding">
        	<div class="w3-col m12">
         		<div class="w3-card w3-round w3-white">
            		<div class="w3-container w3-padding">
		                <h3 class="w3-center w3-padding w3-border-bottom">Liste des Conseils</h3>
		                @if(session()->has('ok'))
			          		<div class="w3-container w3-green w3-display-container">
			          			<span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
			          			<p>{!! session('ok') !!}</p>
							</div>
				  	    @endif
                        <p class="w3-center m-5"><a href="{{ url('admin/conseil/create') }}" class="w3-button w3-theme-d2 w3-round w3-large">Créer un conseil<a></p>
                		<div class="w3-container">
                			<div class="table-responsive-md">
								<table class="w3-table w3-striped">
									<thead>
										<tr class="w3-light-grey">
											<th>Titre</th>
                                            <th>Catégories</th>
                                            <th>Date de création</th>
											<th>Dernière modification</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach ($conseils as $conseil)
											<tr>
												<td><a href="{{ url('admin/conseil/'.$conseil->id) }}">{!! $conseil->title !!}</a></td>
                                                <td>
                                                    @foreach($conseil->conseiltags as $conseiltag)
                                                        {{ $loop->first ? '' : ', ' }}
                                                        {!! $conseiltag->name !!}
                                                    @endforeach
                                                </td>
												<td>{!! date('d/m/Y H:i:s', strtotime($conseil->created_at)) !!}</td>
												<td>{!! date('d/m/Y H:i:s', strtotime($conseil->updated_at)) !!}</td>
												<td>
													{!! Form::open(['method' => 'DELETE', 'route' => ['admin.conseil.destroy', $conseil->id]]) !!}
														{!! Form::button('Suppr.', ['class' => 'w3-button w3-hover-red w3-white w3-border w3-border-red w3-text-red w3-round-large', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
													{!! Form::close() !!}
												</td>
											</tr>
										@endforeach
		  							</tbody>
								</table>
							</div>
							<br>
							{{ $links = $conseils->render("pagination::bootstrap-4") }}
							<br>
                        </div>
                        <p class="w3-center mb-4"><a href="{{ url('admin/parametres') }}" class="w3-button w3-theme-d2 w3-round w3-large">Paramétrer les critères<a></p>
					</div>
				</div>
				<br><br>
				<p><a href="{{ url('admin/home') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à l'écran d'accueil</a></p>
			</div>
		</div>
	</div>

@endsection