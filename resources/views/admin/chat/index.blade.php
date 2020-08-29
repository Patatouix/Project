@extends('admin.template')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Utilisateurs connectés
                </div>
                <div class="card-body">
                    <ul class="user_list" style="list-style: none; margin-bottom: 0px;">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Discussion</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 div-scroll" style="max-height: 400px; overflow-y: auto">
                            <div id="messages" ></div>
                        </div>
                        <div class="col-lg-12" >
                            <form action="sendmessage" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                <input type="hidden" name="user" value="{{ Auth::user()->name }} {{ Auth::user()->prenom }}" >
                                <input type="hidden" name="admin" value="{{ Auth::user()->admin }}" >
                                <div class="form-group">
                                    <textarea class="form-control msg" placeholder="Envoyer un message"></textarea>
                                </div>
                                <input type="button" value="Send" class="btn btn-success send-msg">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
