@extends('base')

@section('content')
    <div class="content-page">
        <div class="container">
            <h2 class="main-title">Modifier:@if($user->user_type==0) l'administrateur @elseif($user->user_type==1) le technicien @else le client @endif </h2>
        <!-- Start Content-->

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <form class="form" method="POST" action="{{route('users.update',['id'=>$user->id])}}">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Nom complet</p>
                                            <input class="form-input" value="{{$user->name}}" type="text" name="name" placeholder="" required>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Telephone</p>
                                            <input class="form-input" value="{{$user->phone}}" type="text" name="phone" placeholder="" required>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Email</p>
                                            <input class="form-input" value="{{$user->email}}" type="email" name="email" placeholder="" required>
                                        </label></div>
                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Adresse</p>
                                            <input class="form-input" value="{{$user->adresse}}"  type="text" name="adresse" placeholder="" required>
                                        </label></div>

                                </div>
                                <div class="mb-3 mt-3 text-center">
                                    <a class="btn btn-warning" type="button" href="{{route('users.technicien')}}"><i class="mdi mdi-arrow-left"></i> annuler </a>
                                    <button class="btn btn-success" type="submit"> Modifier </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </div>

@endsection


