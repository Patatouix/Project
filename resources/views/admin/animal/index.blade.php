@extends('admin.template')

@section('content')

  	<!-- Main column -->
    <div class="w3-col">
    <div class="w3-card w3-round w3-white">
        <div class="w3-container w3-padding">
            <div class="p-2 border-bottom">
                <h3 class="w3-center">Animaux des clients</h3>
            </div>
            @if(session()->has('ok'))
                <div class="w3-container w3-green w3-display-container">
                    <span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <p>{!! session('ok') !!}</p>
                </div>
            @endif
            <br>
            {!! Form::open(['route' => ['admin.animal.user'], 'class' => 'w3-container']) !!}
			<p>
				<label><i class="fa fa-info-circle w3-large"></i>  Recherche par client</label>
				<div class="form-group {!! $errors->has('user_id') ? 'has-error' : '' !!}">
					{!! Form::select('user_id', $select, !empty($user) ? $user->id : null , ['class' => 'w3-select', 'required' => 'required', 'placeholder' => 'Sélectionnez un client']) !!}
					{!! $errors->first('user_id', '<small class="help-block">:message</small>') !!}
				</div>
			</p>
			<br>
			<p>
            {!! Form::submit('Chercher', ['class' => 'w3-button w3-theme w3-round']) !!} <a href="{{ url('admin/animal') }}" class="w3-button w3-theme w3-margin">Annuler le filtre</a>
			</p>
			<hr>
			<br>
			{!! Form::close() !!}
            <br><br>
            <div class="w3-container">
                <div class="table-responsive-md">
                    <table class="w3-table w3-striped">
                        <thead>
                            <tr class="w3-light-grey">
                                <th>Nom</th>
                                <th>Propriétaire</th>
                                <th>Espèce</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($animals as $animal)
                                <tr>
                                    <td><a href="{{ url('admin/animal/'.$animal->id) }}">{!! $animal->name !!}</a></td>
                                    <td>{!! $animal->user->name !!} {!! $animal->user->prenom !!}</td>
                                    <td>{!! $animal->espece->name !!}</td>
                                    <td>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.animal.destroy', $animal->id]]) !!}
                                            {!! Form::button('Suppr.', ['class' => 'w3-button w3-hover-red w3-white w3-border w3-border-red w3-text-red w3-round-large', 'onclick' => 'return confirm(\'Vraiment supprimer cet animal ?\')']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br><br>
                {{ $links = $animals->render("pagination::bootstrap-4") }}
                <br>
            </div>
        </div>
    </div>
    <br><br>
    <p><a href="{{ url('admin/home') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour à l'accueil</a></p>

    <!-- End Column -->
    </div>


@endsection