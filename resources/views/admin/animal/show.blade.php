@extends('admin.template')

@section('content')

  	<!-- Main column -->
  	<div class="w3-col">
      <div class="w3-card w3-round w3-theme-l4">
        <div class="w3-container">
          <h2 class="w3-center pt-3">Profil de {{ $animal->name }}</h2>
          <hr>
          @if(session()->has('ok'))
          	<div class="w3-container w3-theme w3-display-container">
          		<span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
          		<p>{!! session('ok') !!}</p>
			</div>
		  @endif
		  <br>
        	<div class="w3-container w3-center w3-theme-l3" style="max-width: 800px;">
                @if($animal->img_path)
                    <div class="m-3 portrait-big" style="background-image: url({{ $animal->img_path }});"></div>
                @else
                    <div class="m-3 portrait-big" style="background-image: url({{ asset('images/default_animal_img.png') }});"></div>
                @endif
        			<table class="w3-table w3-striped w3-bordered w3-card w3-centered">
					<tbody>
						<tr>
							<th scope="row">Nom</th>
							<td>{{ $animal->name }}</td>
						</tr>
                        <tr>
							<th scope="row">Propriétaire</th>
							<td>{{ $animal->user->name }} {{ $animal->user->prenom }}</td>
						</tr>
						<tr>
							<th scope="row">Age</th>
							<td>{{ $animal->age->name }}</td>
						</tr>
						<tr>
							<th scope="row">Poids</th>
							<td>{{ $animal->weight->name }}</td>
						</tr>
						<tr>
							<th scope="row">Genre</th>
							<td>{{ $animal->gender->name }}</td>
						</tr>
						<tr>
							<th scope="row">Stérilisation</th>
							<td>{{ $animal->sterilization->name }}</td>
						</tr>
						<tr>
							<th scope="row">Espèce</th>
							<td>{{ $animal->espece->name }}</td>
						</tr>
						<tr>
							<th scope="row">Race</th>
							<td>
                                @foreach($animal->races as $race)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $race->name !!}
                                @endforeach
                            </td>
						</tr>
						<tr>
							<th scope="row">Alimentation</th>
							<td>
                                @foreach($animal->foods as $food)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $food->name !!}
                                @endforeach
                            </td>
						</tr>
						<tr>
							<th scope="row">Activité physique</th>
							<td>{{ $animal->sport->name }}</td>
						</tr>
						<tr>
							<th scope="row">Environnement</th>
							<td>
                                @foreach($animal->environments as $environment)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $environment->name !!}
                                @endforeach
                            </td>
						</tr>
					</tbody>
				</table>
        		<br><br>
        		<div>
                    <h4>Sélection de conseils <i class="fas fa-comment-medical"></i></h4>
                    <ul class="list-group p-4">
                        @if($conseils)
                            @foreach($conseils as $conseil)
                                <a href="{{ url('admin/conseil/' . $conseil->id) }}">
                                    <li class="list-group-item">{{ $conseil->title }}</li>
                                </a>
                            @endforeach
                        @else
                            <div class="p-2">Désolé, nous n'avons pas trouvé de conseils pour votre animal <i class="far fa-sad-tear"></i></div>
                        @endif
                    </ul>
                </div>
        		<p class="w3-center">
        			<p><a href="{{ url('admin/animal/'.$animal->id.'/edit') }}" class="w3-button w3-theme-d2 w3-round">Modifier les infos du profil</a></p>
        			<p>{!! Form::open(['method' => 'DELETE', 'route' => ['admin.animal.destroy', $animal->id]]) !!}
						  {!! Form::submit('Supprimer le profil', ['class' => 'w3-button w3-red', 'onclick' => 'return confirm(\'Voulez vous vraiment supprimer cet animal ?\')']) !!}
					   {!! Form::close() !!}
					</p>
        		</p>
        		<br>
        	</div>
        	<br><br>
        	<p><a href="{{ url('admin/animal') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour aux animaux</a></p>
          <br>
        </div>
      </div>

    <!-- End Column -->
    </div>


@endsection