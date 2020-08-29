@extends('admin.template')

@section('content')

<div class="w3-col">
    <div class="w3-round w3-theme-l5">
        <div class="w3-container w3-white w3-card" style="max-width: 900px">
        	<br>
            <h2 class="w3-center">Fiche produit # {{ $produit->id }}</h2>
            <hr>
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
							<th scope="row">Aperçu</th>
							@if($produit->img_path)
                                <td><div class="mb-3 portrait-big" style="background-image: url({{ $produit->img_path }});"></div></td>
                            @else
                                <td><div class="mb-3 portrait-big" style="background-image: url({{ asset('images/default_produit_img.jpg') }});"></div></td>
                            @endif
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
							<th scope="row">Catégories</th>
							<td>
                                @foreach($produit->produittags as $produittag)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $produittag->name !!}
                                @endforeach
                            </td>
						</tr>
						<tr>
							<th scope="row">Actions</th>
							<td>
								<a href="{{ url('admin/produit/'.$produit->id.'/edit') }}" class="w3-button w3-theme-d2 w3-round">Modifier</a>
								<p>{!! Form::open(['method' => 'DELETE', 'route' => ['admin.produit.destroy', $produit->id]]) !!}
										{!! Form::submit('Supprimer', ['class' => 'w3-button w3-red', 'onclick' => 'return confirm(\'Voulez vous vraiment supprimer ce produit ?\')']) !!}
									{!! Form::close() !!}
								</p>
							</td>
						</tr>
					</tbody>
				</table>
				<br>
			</div>
      	</div>
    </div>
    <br><br>
    <p><a href="{{ url('admin/produit') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour au catalogue</a></p>
    <!-- End Column -->
</div>
@endsection