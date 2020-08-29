@extends('template')

@section('content')

<div class="w3-col">
    <div class="w3-round w3-theme-l5">
        <div class="w3-container w3-white w3-card" style="max-width: 900px">
            <div class="p-2 border-bottom">
                <h2 class="w3-center">Fiche produit "{{ $produit->name }}"</h2>
            </div>
            @if(session()->has('ok'))
          		<div class="w3-container w3-theme w3-display-container">
          			<span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
          			<p>{!! session('ok') !!}</p>
				</div>
		    @endif
		    <br>
        	<div class="w3-container w3-center">
        		<table class="table table-striped">
					<tbody>
						<tr>
							<th scope="row">Nom</th>
							<td>{{ $produit->name }}</td>
						</tr>
						<tr>
							<th scope="row">Prix</th>
							<td>{{ $produit->price }} €</td>
						</tr>
						<tr>
							<th scope="row">Description</th>
							<td>{{ $produit->description }}</td>
						</tr>
						<tr>
                            <th scope="row">Aperçu</th>
                            @if($produit->img_path)
                                <td><div class="mb-3 portrait-big" style="background-image: url({{ $produit->img_path }});"></div></td>
                            @else
                                <td><div class="mb-3 portrait-big" style="background-image: url({{ asset('images/default_produit_img.jpg') }});"></div></td>
                            @endif
						</tr>
						<tr>
							<th scope="row">Actions</th>
							<td>
								<a href="{{ url('reservation/store/'.$produit->id) }}" class="w3-button w3-theme-d2 w3-round">Réserver ce produit</a>
							</td>
						</tr>
					</tbody>
				</table>
				<br>
			</div>
      	</div>
    </div>
    <br><br>
    <p><a href="{{ url('produit') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour au catalogue</a></p>
    <!-- End Column -->
</div>
@endsection

