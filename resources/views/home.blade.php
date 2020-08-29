@extends('template')

@section('content')

    <div class="w3-center mb-4"><a href="{{ url('chat') }}" class="w3-button w3-theme w3-round">Espace discussion<a></div>

    <!-- Left Column -->
    <div class="w3-col m3">

        <!-- Profile -->
        <div class="w3-card w3-round w3-white">
            <div class="w3-container p-3">
                <div class="p-2 border-bottom">
                    <h4 class="w3-center">Mon Profil</h4>
                </div>
                <div class="pb-3 pt-3 w3-center">
                    <div class="p-2">
                        @if($user->img_path)
                            <div class="mb-2 portrait" style="background-image: url({{ $user->img_path }});"></div>
                        @else
                            <div class="mb-2 portrait" style="background-image: url({{ asset('images/default_user_img.jpg') }});"></div>
                        @endif
                        <div class="w3-center p-2">{{ $user->prenom }} {{ $user->name }}</div>
                        <div class="w3-center p-2">{{ $user->email }}</div>
                    </div>
                </div>
                <div class="w3-center p-2"><a href="{{ url('user/'.$user->id) }}" class="w3-button w3-theme w3-round">Mes infos</a></div>
            </div>
        </div>

        <div class="w3-card w3-round w3-white mt-3">
            <div class="w3-container p-3">
                <div class="p-2 border-bottom">
                    <h4 class="w3-center">Catalogue</h4>
                </div>
                <div class="pt-5 pb-5 pl-2 pr-2 w3-center">Retrouvez l'intégralité des produits réservables en ligne</div>
                <div class="w3-center p-2"><a href="{{ url('produit') }}" class="w3-button w3-theme w3-round">Le catalogue<a></div>
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
                            <h4 class="w3-center">Mes dernières demandes de rendez-vous</h4>
                        </div>
                        @if($user->rdvs->count())
                            <div class="pb-3 pt-3">
                                @foreach($rdvs as $rdv)
                                    <div class="p-2 pb-3">
                                        <h6><a href="{{ url('rdv/'.$rdv->id.'/edit') }}" class="w3-button w3-theme-l4">Demande #{{ $rdv->id }}</a></h6>
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
                                                <td>Animal concerné :</td>
                                                <td>
                                                    @foreach($rdv->animals as $animal)
                                                        {{ $loop->first ? '' : ', ' }}
                                                        {!! $animal->name !!}
                                                @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Statut :</td>
                                                <td>{{ $rdv->status }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                            <div class="w3-center p-2"><a href="rdv" class="w3-button w3-theme w3-round">Mes RDVs</a></div>
                        @else
                            <div class="w3-center p-4">
                                Vous n'avez pas encore demandé de rendez-vous. Vous pouvez envoyer une demande de rendez-vous à la clinique en cliquant sur le bouton ci-dessous.
                            </div>
                            <div class="w3-center p-2"><a href="rdv/create" class="w3-button w3-theme w3-round">Demander un RDV<a></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Réservations -->
        <div class="w3-row-padding mt-3">
            <div class="w3-col m12">
                <div class="w3-card w3-round w3-white">
                    <div class="w3-container p-3">
                        <div class="p-2 border-bottom">
                            <h4 class="w3-center">Mes dernières réservations</h4>
                        </div>
                        @if($user->reservations->count())
                            <div class="pb-3 pt-3">
                                @foreach($reservations as $reservation)
                                    <div class="p-2 pb-3">
                                        <h6><a href="#" class="w3-button w3-theme-l4">Réservation #{{ $reservation->id }}</a></h6>
                                        <table class="w3-table w3-striped">
                                            <tr>
                                                <td>Date de demande :</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($reservation->created_at)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Produit(s) réservé(s) :</td>
                                                <td>
                                                    @foreach($reservation->produits as $produit)
                                                        {{ $loop->first ? '' : ', ' }}
                                                        {!! $produit->name !!}
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Statut :</td>
                                                <td>{{ $reservation->status }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date de retrait :</td>
                                                <td>{{ $reservation->takeout }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                            <div class="w3-center p-2"><a href="{{ url('reservation') }}" class="w3-button w3-theme w3-round">Mes réservations</a></div>
                        @else
                            <div class="w3-center p-4">Vous n'avez pas encore effectué de réservations. Visitez la boutique pour réserver un produit.</div>
                            <div class="w3-center p-2"><a href="{{ url('produit') }}" class="w3-button w3-theme w3-round">La boutique<a></div>
                        @endif
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
                    <h4 class="w3-center">Mes Animaux</h4>
                </div>
                @if($user->animals->count())
                    <div class="pb-3 pt-3 w3-center">
                        @foreach($user->animals as $animal)
                            <div class="p-2">
                                @if($animal->img_path)
                                    <div class="mb-2 portrait" style="background-image: url({{ $animal->img_path }});"></div>
                                @else
                                    <div class="mb-2 portrait" style="background-image: url({{ asset('images/default_animal_img.png') }});"></div>
                                @endif
                                <a href="{{ url('animal/' . $animal->id) }}">{{ $animal->name }}</a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="w3-center p-3">Vous n'avez pas encore enregistré d'animal ! Créez un profil pour votre animal en cliquant sur le bouton ci-dessous.</div>
                    <div class="w3-center p-3"><a href="{{ url('animal/create') }}" class="w3-button w3-theme w3-round">Ajouter animal<a></div>
                @endif
            </div>
        </div>

        <div class="w3-card w3-round w3-white mt-3">
            <div class="w3-container p-3">
                <div class="p-2 border-bottom">
                    <h4 class="w3-center">Conseils santé</h4>
                </div>
                <div class="pt-5 pb-5 pl-2 pr-2 w3-center">
                    Ici vous pouvez consulter la bibliothèque de conseils
                </div>
                <div class="w3-center p-2"><a href="{{ url('conseil') }}" class="w3-button w3-theme w3-round">Les conseils<a></div>
            </div>
        </div>

    <!-- End Right Column -->
    </div>

@endsection
