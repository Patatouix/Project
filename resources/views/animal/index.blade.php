@extends('template')

@section('content')

  	<!-- Main column -->
  	<div class="w3-col">
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
            <div class="p-2 border-bottom">
                <h3 class="w3-center">Mes Animaux</h3>
            </div>
          @if(session()->has('ok'))
          	<div class="w3-container w3-green w3-display-container">
          		<span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
          		<p>{!! session('ok') !!}</p>
			</div>
		  @endif
		  <p class="w3-center m-5"><a href="{{ url('animal/create') }}" class="w3-button w3-theme w3-large w3-round">Enregistrer un nouvel animal<a></p>
	    	<div class="w3-container d-flex justify-content-center w3-center flex-wrap">
	    		 @if(!$animals->isEmpty())
	   				@foreach($animals as $animal)
		        		<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-5">
		        			<div class="w3-card w3-theme-l5">
                                <br>
                                @if($animal->img_path)
                                    <a href="{{ url('animal/'.$animal->id) }}"><div class="mb-2 portrait-big" style="background-image: url({{ $animal->img_path }});"></div></a>
                                @else
                                    <a href="{{ url('animal/'.$animal->id) }}"><div class="mb-2 portrait-big" style="background-image: url({{ asset('images/default_animal_img.png') }});"></div></a>
                                @endif
		        				<br><br>
		        				<div class="w3-container">
		        					<table class="w3-table w3-striped w3-bordered w3-card w3-centered">
										<tbody>
											<tr>
												<th scope="row">Nom</th>
												<td>{{ $animal->name }}</td>
											</tr>
											<tr>
												<th scope="row">Espèce</th>
												<td>{{ $animal->espece->name }}</td>
											</tr>
                                            <tr>
												<th scope="row">Race(s)</th>
												<td>
                                                    @foreach($animal->races as $race)
                                                        {{ $loop->first ? '' : ', ' }}
                                                        {!! $race->name !!}
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
												<th scope="row">Sexe</th>
												<td>{{ $animal->gender->name }}</td>
											</tr>
										</tbody>
									</table>
									<br><br>
		        					<p class="w3-center"><a href="{{ url('animal/'.$animal->id) }}" class="w3-button w3-theme w3-round">Voir le profil</a></p>
		        					<br>
		        					<p class="w3-center">
			            			<p><a href="{{ url('animal/'.$animal->id.'/edit') }}" class="w3-button w3-theme-d2 w3-round">Modifier le profil</a></p>
			            			<p>{!! Form::open(['method' => 'DELETE', 'route' => ['animal.destroy', $animal->id]]) !!}
										 {!! Form::submit('Supprimer le profil', ['class' => 'w3-button w3-round w3-red', 'onclick' => 'return confirm(\'Voulez vous vraiment supprimer cet animal ?\')']) !!}
									   {!! Form::close() !!}
									</p>
		        					<br>
								</div>
							</div>
						</div>
					@endforeach
          		@else
            	<br>
	            <p class="w3-center">Vous n'avez pas encore enregistré d'animal ! Créez un profil pour votre animal en cliquant sur le bouton ci-dessus.</p>
	            <br>
          		@endif
          	<br>
        	</div>
          </div>
      </div>
      <br><br>
      <p><a href="{{ url('home') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à l'accueil</a></p>
    <!-- End Column -->
    </div>

@endsection