@extends('base')

@section('content')
    <div class="content-page">
        <div class="container">
            <h2 class="main-title">Modifier:Pieces détachés </h2>
        <!-- Start Content-->

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <form class="form" method="POST" action="{{route('piecedetache.update',['id'=>$piece->id])}}">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Libelle</p>
                                            <input class="form-input" value="{{$piece->libelle}}" type="text" name="libelle" placeholder="" required>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Modele</p>
                                            <input class="form-input" value="{{$piece->modele}}" type="text" name="modele" placeholder="" required>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Marque</p>
                                            <input class="form-input" value="{{$piece->marque}}" type="text" name="marque" placeholder="" required>
                                        </label></div>
                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Quantite</p>
                                            <input class="form-input" value="{{$piece->quantite}}" min="0" type="number" name="quantite" placeholder="" required>
                                        </label></div>

                                </div>
                                <div class="mb-3 mt-3 text-center">
                                    <a class="btn btn-warning" type="button" href="{{route('piecedetache.index')}}"><i class="mdi mdi-arrow-left"></i> annuler </a>
                                    <button class="btn btn-success" type="submit"> Modifier </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </div>

@endsection


