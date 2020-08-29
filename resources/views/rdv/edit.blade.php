@extends('template')

@section('content')

	<div class="w3-col m12">
      <div class="w3-card w3-round w3-white w3-card-4">
        <div class="w3-container-fluid">
        	<div class="w3-container w3-theme w3-round">
        		<h4 class="w3-center pt-1">Modification de ma demande de RDV</h4>
			</div>
			{!! Form::model($rdv, ['route' => ['rdv.update', $rdv->id], 'method' => 'put', 'class' => 'w3-container']) !!}
				<br>
                <div>
					<div class="form-group {!! $errors->has('response') ? 'has-error' : '' !!}">
                        <label>Réponse de la clinique à votre demande de rendez-vous :</label>
						{!! Form::text('response', $rdv->response, ['class' => 'form-control', 'readonly' => true, 'placeholder' => 'Demande et disponiblités']) !!}
						{!! $errors->first('response', '<small class="help-block">:message</small>') !!}
					</div>
				</div>
				<div>
					<div class="form-group {!! $errors->has('request') ? 'has-error' : '' !!}">
                        <label>Modifiez ici votre demande et vos disponibilités :</label>
						{!! Form::textarea('request', $rdv->request, ['required' => 'required', 'class' => 'form-control', 'rows' => 5, 'placeholder' => 'Demande et disponiblités']) !!}
						{!! $errors->first('request', '<small class="help-block">:message</small>') !!}
					</div>
				</div>
				<div>
					<div class="form-group {!! $errors->has('animal_id') ? 'has-error' : '' !!}">
                        <label>Choisissez le ou les animaux concerné(s) :</label>
						{!! Form::select('animal_id[]', $selectData['animalsSelect'], ($rdv->animals->count() ? $rdv->animals : 0), ['required' => 'required', 'multiple' => true, 'size' => '3', 'class' => 'form-control']) !!}
						{!! $errors->first('animal_id', '<small class="help-block">:message</small>') !!}
					</div>
				</div>
				<div>
					<div class="form-group {!! $errors->has('vet_id') ? 'has-error' : '' !!}">
                        <label>Choisissez le vétérinaire qui s'occupera de votre animal :</label>
						{!! Form::select('vet_id', $selectData['vetsSelect'], $rdv->vet->id,  ['required' => 'required', 'class' => 'form-control', 'placeholder' => 'Sélectionnez un vétérinaire']) !!}
						{!! $errors->first('vet_id', '<small class="help-block">:message</small>') !!}
					</div>
				</div>
				<br>
				<p class="w3-center">
					{!! Form::submit('Valider les modifications', ['class' => 'w3-button w3-theme w3-round']) !!}
				</p>
				<br>
			{!! Form::close() !!}
		</div>
      </div>
      <br><br><br>
      <a href="{{ url('rdv') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour aux demandes de RDV</a>

    <!-- End Column -->
    </div>

@endsection


