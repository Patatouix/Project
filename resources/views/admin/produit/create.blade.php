@extends('admin.template')

@section('content')
<!-- Main column -->
    <div class="w3-col m12">
    <div class="w3-card w3-round w3-white w3-card-4">
        <div class="w3-container-fluid">
            <div class="w3-container w3-theme w3-round">
                <h4 class="w3-center">Création d'un produit</h4>
            </div>
            {!! Form::open(['route' => 'admin.produit.store', 'files' => true, 'class' => 'w3-container']) !!}
            <br>

            <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                <label for="name">Nom du produit :</label>
                {!! Form::text('name', null, ['class' => 'w3-input w3-border', 'placeholder' => 'Nom']) !!}
                {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('short_description') ? 'has-error' : '' !!}">
                <label for="short_description">Description courte :</label>
                {!! Form::text('short_description', null, ['class' => 'w3-input w3-border', 'placeholder' => 'Description (courte)']) !!}
                {!! $errors->first('short_description', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                <label for="description">Description complète :</label>
                {!! Form::textarea('description', null, ['class' => 'w3-input w3-border', 'placeholder' => 'Description (longue)']) !!}
                {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('price') ? 'has-error' : '' !!}">
                <label for="price">Prix :</label>
                {!! Form::number('price', null, ['class' => 'w3-input w3-border', 'placeholder' => 'Prix']) !!}
                {!! $errors->first('price', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
                <label>Visuel du produit :</label>
                <label for="image" class="form-control"><span class="file_input_placeholder"></span></label>
                {!! Form::file('image', ['id' => 'image', 'class' => 'form-control-file', 'style' => 'display:none', 'accept' => '.png, .jpg, .jpeg, .gif, .svg']) !!}
                {!! $errors->first('image', '<small class="help-block">:message</small>') !!}
            </div>

            <div class="form-group {!! $errors->has('produittag_id') ? 'has-error' : '' !!}">
                <label for="produittag_id">Catégorie(s) :</label>
                {!! Form::select('produittag_id[]', $select, null, ['multiple' => 'multiple', 'required' => 'required', 'class' => 'form-control']) !!}
                {!! $errors->first('produittag_id', '<small class="help-block">:message</small>') !!}
            </div>

            <br>
            <p class="w3-center">
                {!! Form::submit('Valider la création', ['class' => 'w3-button w3-theme w3-round']) !!}
            </p>
            <br>
            {!! Form::close() !!}
        </div>
    </div>
    <br><br>
    <a href="{{ url('admin/produit') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retour au catalogue</a>

    <!-- End Column -->
    </div>

    <script type="text/javascript">

        $(document).ready(function() {

            var $file_input = $("input[type='file']");
            var $file_input_placeholder = $(".file_input_placeholder");
            var user_image = '{{ $produit->image->name or 'undefined' }}';

            if(user_image == 'undefined') {
                $file_input_placeholder.html('Aucun fichier sélectionné.');
            }
            else {
                $file_input_placeholder.html(user_image);
            }

            $file_input.change(function() {
                var image_name = $file_input[0].files[0].name;
                $file_input_placeholder.html(image_name);
            });

        });

    </script>

@endsection