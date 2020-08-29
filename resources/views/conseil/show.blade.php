@extends('template')

@section('content')

  	<!-- Main column -->
    <div class="w3-col m12">

    <!-- Profile -->
    <div class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card w3-round w3-white">
                <div class="w3-container w3-padding">
                    <div class="p-2 border-bottom">
                        <h3 class="w3-center">Conseil : {{ $conseil->title }}</h3>
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
                            <th>Titre</th>
                            <td>{{ $conseil->title }}</td>
                        </tr>
                        <tr>
                            <th>Contenu</th>
                            <td>{{ $conseil->text }}</td>
                        </tr>
                        <tr>
                            <th>Catégories</th>
                            <td>
                                @foreach($conseil->conseiltags as $conseiltag)
                                    {{ $loop->first ? '' : ', ' }}
                                    {!! $conseiltag->name !!}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Âges</th>
                            <td>
                                @if($conseil->ages->count())
                                    @foreach($conseil->ages as $age)
                                        {{ $loop->first ? '' : ', ' }}
                                        {!! $age->name !!}
                                    @endforeach
                                @else
                                    Indifférent
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Lieux de vie</th>
                            <td>
                                @if($conseil->environments  ->count())
                                    @foreach($conseil->environments as $environment)
                                        {{ $loop->first ? '' : ', ' }}
                                        {!! $environment->name !!}
                                    @endforeach
                                @else
                                    Indifférent
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Espèces</th>
                            <td>
                                @if($conseil->especes->count())
                                    @foreach($conseil->especes as $espece)
                                        {{ $loop->first ? '' : ', ' }}
                                        {!! $espece->name !!}
                                    @endforeach
                                @else
                                    Indifférent
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Alimentation</th>
                            <td>
                                @if($conseil->foods->count())
                                    @foreach($conseil->foods as $food)
                                        {{ $loop->first ? '' : ', ' }}
                                        {!! $food->name !!}
                                    @endforeach
                                @else
                                    Indifférent
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Sexes</th>
                            <td>
                                @if($conseil->genders->count())
                                    @foreach($conseil->genders as $gender)
                                        {{ $loop->first ? '' : ', ' }}
                                        {!! $gender->name !!}
                                    @endforeach
                                @else
                                    Indifférent
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Races</th>
                            <td>
                                @if($conseil->races->count())
                                    @foreach($conseil->races as $race)
                                        {{ $loop->first ? '' : ', ' }}
                                        {!! $race->name !!}
                                    @endforeach
                                @else
                                    Indifférent
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Activité physique</th>
                            <td>
                                @if($conseil->sports->count())
                                    @foreach($conseil->sports as $sport)
                                        {{ $loop->first ? '' : ', ' }}
                                        {!! $sport->name !!}
                                    @endforeach
                                @else
                                    Indifférent
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Stérilisation</th>
                            <td>
                                @if($conseil->sterilizations->count())
                                    @foreach($conseil->sterilizations as $sterilization)
                                        {{ $loop->first ? '' : ', ' }}
                                        {!! $sterilization->name !!}
                                    @endforeach
                                @else
                                    Indifférent
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Poids</th>
                            <td>
                                @if($conseil->weights->count())
                                    @foreach($conseil->weights as $weight)
                                        {{ $loop->first ? '' : ', ' }}
                                        {!! $weight->name !!}
                                    @endforeach
                                @else
                                    Indifférent
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Création</th>
                            <td>{{ date('d/m/Y H:i:s', strtotime($conseil->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th>Modification</th>
                            <td>{{ date('d/m/Y H:i:s', strtotime($conseil->updated_at)) }}</td>
                        </tr>
                    </table>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <a href="{{ url('conseil') }}" class="w3-button w3-theme-d2 w3-round">
        <i class="fa fa-angle-left w3-margin-right"></i>Retourner aux conseils
    </a>

    <!-- End Center Column -->
    </div>

@endsection