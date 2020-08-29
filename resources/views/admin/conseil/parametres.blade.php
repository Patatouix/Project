@extends('admin.template')

@section('content')

  	<!-- Main column -->
    <div class="w3-col m12">

    <!-- Profile -->
    <div class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card w3-round w3-white">
                <div class="w3-container w3-padding">
                    <div class="p-2 border-bottom">
                        <h3 class="w3-center">Paramètres conseils</h3>
                    </div>
                    @if(session()->has('ok'))
                    <div class="w3-container w3-green w3-display-container">
                        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
                        <p>{!! session('ok') !!}</p>
                    </div>
                    @endif
                    <br>
                    <table class="w3-table w3-striped">
                        <tr>
                            <th>Catégories</th>
                            <td>
                                @foreach($conseiltags as $conseiltag)
                                    {{ $loop->first ? '' : ' / ' }}
                                    {!! $conseiltag->name !!}
                                @endforeach
                            </td>
                            <td>
                                {!! Form::open(['route' => 'admin.parametres.conseiltag.store', 'class' => 'w3-container']) !!}
                                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                        <label for="name">Ajouter une catégorie :</label>
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'size' => 50]) !!}
                                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Âges</th>
                            <td>
                                @foreach($ages as $age)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $age->name !!}
                                @endforeach
                            </td>
                            <td>
                                {!! Form::open(['route' => 'admin.parametres.age.store', 'class' => 'w3-container']) !!}
                                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                        <label for="name">Ajouter un âge :</label>
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'size' => 50]) !!}
                                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Lieux de vie</th>
                            <td>
                                @foreach($environments as $environment)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $environment->name !!}
                                @endforeach
                            </td>
                            <td>
                                {!! Form::open(['route' => 'admin.parametres.environment.store', 'class' => 'w3-container']) !!}
                                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                        <label for="name">Ajouter un lieu de vie :</label>
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'size' => 50]) !!}
                                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Espèces</th>
                            <td>
                                @foreach($especes as $espece)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $espece->name !!}
                                @endforeach
                            </td>
                            <td>
                                {!! Form::open(['route' => 'admin.parametres.espece.store', 'class' => 'w3-container']) !!}
                                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                        <label for="name">Ajouter une espèce :</label>
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'size' => 50]) !!}
                                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Alimentation</th>
                            <td>
                                @foreach($foods as $food)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $food->name !!}
                                @endforeach
                            </td>
                            <td>
                                {!! Form::open(['route' => 'admin.parametres.food.store', 'class' => 'w3-container']) !!}
                                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                        <label for="name">Ajouter une nourriture :</label>
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'size' => 50]) !!}
                                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Sexes</th>
                            <td>
                                @foreach($genders as $gender)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $gender->name !!}
                                @endforeach
                            </td>
                            <td>
                                {!! Form::open(['route' => 'admin.parametres.gender.store', 'class' => 'w3-container']) !!}
                                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                        <label for="name">Ajouter un sexe :</label>
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'size' => 50]) !!}
                                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Races</th>
                            <td>
                                @foreach($races as $race)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $race->name !!}
                                @endforeach
                            </td>
                            <td>
                                {!! Form::open(['route' => 'admin.parametres.race.store', 'class' => 'w3-container']) !!}
                                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                        <div class="form-group">
                                            <label for="name">Ajouter une race :</label>
                                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'size' => 50]) !!}
                                            {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="espece_id">Sélectionnez l'espèce associée :</label>
                                            {!! Form::select('espece_id', $especesSelect, null, ['class' => 'form-control', 'required' => 'required']) !!}
                                            {!! $errors->first('espece_id', '<small class="help-block">:message</small>') !!}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Activité physique</th>
                            <td>
                                @foreach($sports as $sport)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $sport->name !!}
                                @endforeach
                            </td>
                            <td>
                                {!! Form::open(['route' => 'admin.parametres.sport.store', 'class' => 'w3-container']) !!}
                                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                        <label for="name">Ajouter une activité physique :</label>
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'size' => 50]) !!}
                                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Stérilisation</th>
                            <td>
                                @foreach($sterilizations as $sterilization)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $sterilization->name !!}
                                @endforeach
                            </td>
                            <td>
                                {!! Form::open(['route' => 'admin.parametres.sterilization.store', 'class' => 'w3-container']) !!}
                                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                        <label for="name">Ajouter une stérilisation :</label>
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'size' => 50]) !!}
                                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Poids</th>
                            <td>
                                @foreach($weights as $weight)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $weight->name !!}
                                @endforeach
                            </td>
                            <td>
                                {!! Form::open(['route' => 'admin.parametres.weight.store', 'class' => 'w3-container']) !!}
                                    <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                        <label for="name">Ajouter un poids :</label>
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'size' => 50]) !!}
                                        {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    </table>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <a href="{{ url('admin/conseil') }}" class="w3-button w3-theme-d2 w3-round">
        <i class="fa fa-angle-left w3-margin-right"></i>Retourner aux conseils
    </a>

    <!-- End Center Column -->
    </div>

@endsection