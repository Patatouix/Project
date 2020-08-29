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
                    <h3 class="w3-center">Profil de {{ $user->prenom }} {{ $user->name }}</h3>
                </div>
                @if(session()->has('ok'))
                <div class="w3-container w3-green w3-display-container">
                    <span onclick="this.parentElement.style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <p>{!! session('ok') !!}</p>
                </div>
                @endif
                <br>
                @if($user->img_path)
                    <div class="mb-3 portrait-big" style="background-image: url({{ $user->img_path }});"></div></a></td>
                @else
                    <div class="mb-3 portrait-big" style="background-image: url({{ asset('images/default_user_img.jpg') }});"></div></a></td>
                @endif
                <br><br>
                <table class="w3-table w3-striped">
                <tr>
                    <td>Nom de famille :</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Prénom :</td>
                    <td>{{ $user->prenom }}</td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Numéro de téléphone :</td>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <td>Adresse :</td>
                    <td>{{ $user->adress }}</td>
                </tr>
                <tr>
                    <td>Date d'inscription :</td>
                    <td>{{ date('d/m/Y H:i:s', strtotime($user->created_at)) }}</td>
                </tr>
                <tr>
                    <td>Dernière modification :</td>
                    <td>{{ date('d/m/Y H:i:s', strtotime($user->updated_at)) }}</td>
                </tr>
                </table>
            <br><br>
            </div>
            </div>
        </div>
    </div>
      <br><br>
      <a href="{{ url('admin/user') }}" class="w3-button w3-theme-d2 w3-round"><i class="fa fa-angle-left w3-margin-right"></i>Retourner aux clients</a>

    <!-- End Center Column -->
    </div>

@endsection