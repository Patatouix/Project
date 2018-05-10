<!DOCTYPE html>
<html lang="fr" style="height: 100%;">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Espace Client Matterberg	</title>
		{!! Html::style('https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css') !!}
		<!--[if lt IE 9]>
			{{ Html::style('https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js') }}
			{{ Html::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
		<![endif]-->
		<style> textarea { resize: none; } </style>
	</head>
  <body style="height:100%;">
    <div class="wrapper" style="min-height: 100%; margin-bottom: -70px;">
      <header class="jumbotron">
        <div class="container">
        		@if(Auth::check())
        			@if(Auth::user()->admin)
        				<p>Bienvenue, {{ Auth::user()->name }} (admin)</p>
        				
        				<div class="btn-group float-right">
  						{!! link_to('logout', 'Deconnexion', ['class' => 'btn btn-warning']) !!}
  					</div>
        			@else
        				<p>Bienvenue, {{ Auth::user()->name }} (client)</p>
        				
        				<div class="btn-group float-right">
  						{!! link_to('logout', 'Deconnexion', ['class' => 'btn btn-warning']) !!}
  					</div>
        			@endif
        		@else
        			<p>Bienvenue, invité</p>

        			<div class="btn-group float-right">
        				{!! link_to('login', 'Se connecter', ['class' => 'btn btn-info pull-right']) !!}
        			</div>
        		@endif
          <h1 class="page-header">{!! link_to_route('user.index', 'Clients') !!}</h1>
          @yield('header')
        </div>
      </header>
      <div class="container">
        <br />
        @yield('contenu')
      </div>
      <br />
     
    </div>
      <footer class="footer" style="background-color: #e9ecef; height: 70px; display:flex; border-top: 1px solid lightgrey">
        <div class="container" style="margin:auto; text-align: center;">
          <span class="text-muted">
            Site client Clinique Vétérinaire Matterberg - Charles Anguenot - 05/2018
          </span>
        </div>
      </footer>
  </body>
</html>