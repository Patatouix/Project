@extends('template')

@section('content')

<div class="w3-col">
    <div class="w3-round w3-white w3-theme-l5">
        <div class="w3-container w3-center w3-white w3-card" style="max-width: 900px">
            <div class="p-2 border-bottom">
                <h3 class="w3-center">Catalogue</h3>
            </div>
          @if(session()->has('ok'))
          	<div class="w3-container w3-green w3-display-container">
          		<span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
          		<p>{!! session('ok') !!}</p>
			</div>
		  @endif
		  <br><br>
		  <div>
		  	{!! Form::open(['route' => ['produit.tag'], 'class' => 'w3-container']) !!}
			<p>
				<label><i class="fa fa-info-circle w3-large"></i>  Info pratique : cherchez par catégorie pour plus de facilité</label>
				<div class="form-group {!! $errors->has('tag_id') ? 'has-error' : '' !!}">
					{!! Form::select('tag_id', $select, !empty($tag->id) ? $tag->id : null, ['class' => 'w3-select', 'placeholder' => 'Sélectionnez une catégorie']) !!}
					{!! $errors->first('tag_id', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
			<br>
			<p>
				{!! Form::submit('Chercher', ['class' => 'w3-button w3-theme w3-round']) !!} <a href="{{ url('produit') }}" class="w3-button w3-theme w3-margin">Annuler le filtre</a>
			</p>
			<hr>
			<br>
			{!! Form::close() !!}
			<p><i class="fa fa-info-circle"></i> Cliquez sur l'image ou le nom d'un produit pour accéder à sa description.</p>
			<br>
	    	<div class="w3-container" class="w3-center">
				<table class="w3-table w3-striped w3-bordered w3-card w3-centered w3-large">
					<thead>
						<tr class="w3-light-grey">
							<th scope="col">Nom</th>
							<th scope="col">Aperçu</th>
							<th scope="col">Prix</th>
						</tr>
					</thead>
					<tbody>
						@foreach($produits as $produit)
						<tr>
                            <td><a href="{{ url('produit/'.$produit->id) }}">{{ $produit->name }}</a></td>
                            @if($produit->img_path)
                                <td><a href="{{ url('produit/'.$produit->id) }}"><div class="mb-3 portrait" style="background-image: url({{ $produit->img_path }});"></div></a></td>
                            @else
                                <td><a href="{{ url('produit/'.$produit->id) }}"><div class="mb-3 portrait" style="background-image: url({{ asset('images/default_produit_img.jpg') }});"></div></a></td>
                            @endif
							<td>{{ $produit->price }} €</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<br><br>
				{{ $links = $produits->render("pagination::bootstrap-4") }}
        		<br>
			</div>
		</div>
	</div>
	<br><br>
	<p><a href="{{ url('home') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à l'écran d'accueil</a></p>
</div>

@endsection
