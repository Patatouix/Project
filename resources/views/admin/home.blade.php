@extends('admin.template')

@section('content')

    <div class="w3-center mb-4"><a href="{{ url('admin/chat') }}" class="w3-button w3-theme w3-round">Espace discussion<a></div>

    <!-- Left Column -->
    <div class="w3-col m3 mb-3">

        <!-- Profile -->
        <div class="w3-card w3-round w3-white">
            <div class="w3-container p-3">
                <div class="p-2 border-bottom">
                    <h4 class="w3-center">Derniers clients enregistrés</h4>
                </div>
                @if($users->count())
                    <div class="pb-3 pt-3 w3-center">
                        @foreach($users as $user)
                        <div class="p-2">
                            @if($user->img_path)
                                <div class="mb-2 portrait" style="background-image: url({{ $user->img_path }});"></div>
                            @else
                                <div class="mb-2 portrait" style="background-image: url({{ asset('images/default_user_img.jpg') }});"></div>
                            @endif
                            <a href="{{ url('admin/user/' . $user->id) }}">{{ $user->name }} {{ $user->prenom }}</a>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="w3-center p-3">Pas de clients.</div>
                @endif
                <div class="w3-center p-2"><a href="{{ url('admin/user') }}" class="w3-button w3-theme w3-round">Tous les clients<a></div>
            </div>
        </div>

        <div class="w3-card w3-round w3-white mt-3">
            <div class="w3-container p-3">
                <div class="p-2 border-bottom">
                    <h4 class="w3-center">Catalogue</h4>
                </div>
                <div class="pt-5 pb-5 pl-2 pr-2 w3-center">Gérez le catalogue de la clinique</div>
                <div class="w3-center p-2"><a href="{{ url('admin/produit') }}" class="w3-button w3-theme w3-round">Voir le catalogue<a></div>
            </div>
        </div>

    <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <div class="w3-col m6 mb-3">

        <!-- Rdvs -->
        <div class="w3-row-padding">
            <div class="w3-col m12">
                <div class="w3-card w3-round w3-white">
                    <div class="w3-container p-3">
                        <div class="p-2 border-bottom">
                            <h4 class="w3-center">Derniers rdv en attente</h4>
                        </div>
                        @if($rdvs->count())
                            <div class="pb-3 pt-3">
                                @foreach($rdvs as $rdv)
                                    <div class="p-2 pb-3">
                                        <h6><a href="{{ url('admin/rdv/'.$rdv->id.'/edit') }}" class="w3-button w3-theme-l4 w3-round">Demande #{{ $rdv->id }}</a></h6>
                                        <table class="w3-table w3-striped">
                                            <tr>
                                                <td>Date de la demande :</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($rdv->created_at)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Dernière mise à jour :</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($rdv->updated_at)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Client :</td>
                                                <td>{{ $rdv->user->name }} {{ $rdv->user->prenom }}</td>
                                            </tr>
                                            <tr>
                                                <td>Statut :</td>
                                                <td>{{ $rdv->status }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="w3-center p-4">Pas de rdvs.</div>
                        @endif
                        <div class="w3-center p-2"><a href="{{ url('admin/rdv') }}" class="w3-button w3-theme w3-round">Tous les rdvs<a></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- reservations -->
        <div class="w3-row-padding mt-3">
            <div class="w3-col m12">
                <div class="w3-card w3-round w3-white">
                    <div class="w3-container p-3">
                        <div class="p-2 border-bottom">
                            <h4 class="w3-center">Derniers réservations en attente</h4>
                        </div>
                        @if($reservations->count())
                            <div class="pb-3 pt-3">
                                @foreach($reservations as $reservation)
                                    <div class="p-2 pb-3">
                                        <h6><a href="{{ url('admin/reservation/'.$reservation->id.'/edit') }}" class="w3-button w3-theme-l4 w3-round">Réservation #{{ $reservation->id }}</a></h6>
                                        <table class="w3-table w3-striped">
                                            <tr>
                                                <td>Date de demande :</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($reservation->created_at)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Client :</td>
                                                <td>{{ $reservation->user->name }} {{ $rdv->user->prenom }}</td>
                                            </tr>
                                            <tr>
                                                <td>Produit(s) réservé(s) :</td>
                                                <td>@foreach($reservation->produits as $produit)
                                                        {{ $loop->first ? '' : ', ' }}
                                                        {!! $produit->name !!}
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Statut :</td>
                                                <td>{{ $reservation->status }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="w3-center p-4">Pas de réservations.</div>
                        @endif
                        <div class="w3-center p-2"><a href="{{ url('admin/reservation') }}" class="w3-button w3-theme w3-round">Toutes les réservations</a></div>
                    </div>
                </div>
            </div>
        </div>

    <!-- End Center Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-col m3">
        <!-- Profile -->
        <div class="w3-card w3-round w3-white">
            <div class="w3-container p-3">
                <div class="p-2 border-bottom">
                    <h4 class="w3-center">Derniers animaux enregistrés</h4>
                </div>
                @if($animals->count())
                    <div class="pb-3 pt-3 w3-center">
                        @foreach($animals as $animal)
                            <div class="p-2">
                                @if($animal->img_path)
                                    <div class="mb-2 portrait" style="background-image: url({{ $animal->img_path }});"></div>
                                @else
                                    <div class="mb-2 portrait" style="background-image: url({{ asset('images/default_animal_img.png') }});"></div>
                                @endif
                                <a href="{{ url('admin/animal/' . $animal->id) }}">{{ $animal->name }}</a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="w3-center p-3">Pas d'animaux enregistrés récemment.</div>
                @endif
                <div class="w3-center p-2">
                    <a href="{{ url('admin/animal') }}" class="w3-button w3-theme w3-round">Tous les animaux<a>
                </div>
            </div>
        </div>

        <div class="w3-card w3-round w3-white mt-3">
            <div class="w3-container p-3">
                <div class="p-2 border-bottom">
                    <h4 class="w3-center">Conseils</h4>
                </div>
                <div class="pt-5 pb-5 pl-2 pr-2 w3-center">Gérez la bibliothèque des conseils</div>
                <div class="w3-center p-2"><a href="{{ url('admin/conseils') }}" class="w3-button w3-theme w3-round">Voir les conseils<a></div>
            </div>
        </div>

    <!-- End Right Column -->
    </div>

@endsection
