@extends('base')

@section('content')
    <div class="content-page">
        <div class="container">
            <h2 class="main-title">Fiche de sortie N° {{$file->id}}</h2>
            <!-- Start Content-->
            <input type="hidden" value="{{$file->id}}" id="fiche">
            <div class="row mt-3">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <dl>
                                <dt>Machine</dt>
                                <dd>{{$file->fiche_depannage->demande->machine->marque}}</dd>

                                <dt>Couleur</dt>
                                <dd>{{$file->fiche_depannage->demande->machine->couleur}}</dd>
                            </dl>
                        </div>
                   </div>

                </div>
                <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <dl>
                            <dt>Description de la panne</dt>
                            <dd>
                                {{$file->fiche_depannage->demande->description}}</dd>
                            <dt>Observation</dt>
                            <dd> {{$file->fiche_depannage->observation}}</dd>

                        </dl>
                    </div>
                </div>
                </div>
                <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <dl> <dt>Date depannage</dt>
                                <dd>{{$file->fiche_depannage->created_at}}</dd>
                                <dt>Technicien</dt>
                                <dd>{{$file->fiche_depannage->user->name}}</dd>
                                <dt>Cout materiel</dt>
                                <dd>{{$file->fiche_depannage->totalpiece}}</dd>

                                <dt>Cout main d'oeuvre</dt>
                                <dd>{{$file->fiche_depannage->maindoeuvre}}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" mt-3">
                <div class="btn-group">
                <a class="btn btn-warning" href="{{route('fiche.index')}}"><i class="mdi mdi-arrow-left"></i> retour</a>
                <a class="btn btn-dark"><i class="mdi mdi-file-pdf"></i> Imprimer</a>
                </div>
            </div>
        </div>

    </div>

@endsection



