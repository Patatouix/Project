@extends('template')

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
                        {!! Form::open(['route' => ['conseil.tag'], 'class' => 'w3-container mt-5']) !!}
                            <p>
                                <label><i class="fa fa-info-circle w3-large"></i>  Info pratique : cherchez par catégorie pour plus de facilité</label>
                                <div class="form-group {!! $errors->has('tag_id') ? 'has-error' : '' !!}">
                                    {!! Form::select('tag_id', $select, !empty($tag->id) ? $tag->id : null, ['class' => 'w3-select', 'placeholder' => 'Sélectionnez une catégorie']) !!}
                                    {!! $errors->first('tasg_id', '<small class="help-block">:message</small>') !!}
                                </div>
                            </p>
                            <br>
                            <p>
                                {!! Form::submit('Chercher', ['class' => 'w3-button w3-theme w3-round']) !!} <a href="{{ url('conseil') }}" class="w3-button w3-theme w3-margin">Annuler le filtre</a>
                            </p>
                            <hr>
                            <br>
                        {!! Form::close() !!}
                		<div class="w3-container p-4">
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
												<td><a href="{{ url('conseil/'.$conseil->id) }}">{!! $conseil->title !!}</a></td>
                                                <td>
                                                    @foreach($conseil->conseiltags as $conseiltag)
                                                        {{ $loop->first ? '' : ', ' }}
                                                        {!! $conseiltag->name !!}
                                                    @endforeach
                                                </td>
												<td>{!! date('d/m/Y H:i:s', strtotime($conseil->created_at)) !!}</td>
												<td>{!! date('d/m/Y H:i:s', strtotime($conseil->updated_at)) !!}</td>
												<td>
												</td>
											</tr>
										@endforeach
		  							</tbody>
								</table>
							</div>
							<br><br>
							{{ $links = $conseils->render("pagination::bootstrap-4") }}
							<br>
						</div>
					</div>
				</div>
				<br><br>
				<p><a href="{{ url('home') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à l'écran d'accueil</a></p>
			</div>
		</div>
	</div>

@endsection