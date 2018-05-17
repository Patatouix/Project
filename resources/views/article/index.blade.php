@extends('template')

@section('contenu')
	@if(Auth::check() and Auth::user()->admin)
		<div class="row justify-content-lg-center">
			<div class="col-lg-12"> 
				{!! link_to_route('article.create', 'Ajouter un article dans le catalogue', [], ['class' => 'btn btn-info float-right']) !!}
			</div>
		</div>
		<br />
	@endif
	@if(isset($info))
		<div class="row alert alert-info">{{ $info }}</div>
	@endif
	<br />
	<div class="row">
		<div class="col-lg-2">
			<?php   ?>
			<ul class="list-group">
				<li class="list-group-item">
					{!! link_to('article', 'Reset Tag', ['class' => 'btn btn-success']) !!}
				</li>
				@foreach($tags as $tag)
					<li class="list-group-item">
						{!! link_to('article/tag/' . $tag->id, $tag->tag,	['class' => 'btn btn-info']) !!}
					</li>
				@endforeach
			</ul>
		</div>
		<div class="col-lg-10">
			@if(session()->has('ok'))
				<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
				<br />
			@endif
			<table class="table table-striped">
				<thead class="thead-light">
					<tr>
						<th scope="col">Nom</th>
						<th scope="col">Description</th>
						<th scope="col">Prix</th>
						<th scope="col">Aperçu</th>
						<th scope="col">Tag</th>
						<th scope="col"></th>
						<th scope="col"></th>
						<th scope="col"></th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $article)
						<tr>	
							<td>{{$article->name}}</td>
							<td>{{$article->short_description}}</td>
							<td>{{$article->price}} €</td>
							<td><img src="{{$article->image}}"></td>
							<td>{{$article->tag_id}}</td>
							<td>
								{!! link_to_route('article.show', 'Détails', [$article->id], ['class' => 'btn btn-success btn-block']) !!}
							</td>
							<td>
								@if(Auth::check())
									@if(!Auth::user()->admin)
										{!! link_to_route('command.create', 'Commander', [$article->id], ['class' => 'btn btn-warning btn-block']) !!}
									@endif
								@else
									Vous devez être connecté pour commander.
								@endif
							</td>
							<td>
								@if(Auth::check() and Auth::user()->admin)
									{!! link_to_route('article.edit', 'Modifier', [$article->id], ['class' => 'btn btn-warning btn-block']) !!}
								@endif
							</td>
							<td>
								@if(Auth::check() and Auth::user()->admin)
									{!! Form::open(['method' => 'DELETE', 'route' => ['article.destroy', $article->id]]) !!}
										{!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cet article ?\')']) !!}
									{!! Form::close() !!}
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{ $links = $articles->render("pagination::bootstrap-4") }}
		</div>
	</div>
@endsection