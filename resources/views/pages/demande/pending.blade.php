@extends('base')

@section('content')
    <div class="container">
        <h2 class="main-title">Depannages encours</h2>

        <div class="white-block">
                <div class="users-table table-wrapper">
                    <table class="table ">
                        <thead class="">
                        <tr>
                            <th>#N°</th>
                            <th style="width: 20%">Client</th>
                            <th>Priorité</th>
                            <th>Machine</th>
                            <th>Modele</th>
                            <th>Status</th>
                            <th>Probleme</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody id="set-rows">
                        @foreach($agents as $key=>$agent)
                            <tr>
                                <td>{{$agents->firstitem()+$key}}</td>
                                <td>
                                    <a href="{{route('piecedetache.edit',[$agent['id']])}}" class="d-block font-size-sm text-body">
                                        {{$agent['user']->name}}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-dark">{{$agent['priorite']}}</span>
                                </td>
                                <td>
                                    {{$agent['machine']->libelle}}
                                </td>
                                <td>
                                    {{$agent['machine']->model}}
                                </td>
                                <td>
                                    @if($agent['status']==\App\Models\DemandeDepannage::ENVOYE)
                                        <span class="badge bg-dark">{{$agent['status']}}</span>
                                    @endif
                                        @if($agent['status']==\App\Models\DemandeDepannage::REPARATION)
                                            <span class="badge bg-info">{{$agent['status']}}</span>
                                        @endif
                                        @if($agent['status']==\App\Models\DemandeDepannage::COMPLETED)
                                            <span class="badge bg-success">{{$agent['status']}}</span>
                                        @endif
                                </td>
                                <td id="tooltip-container">
                                   <span data-bs-toggle="tooltip" data-bs-container="#tooltip-container" data-bs-placement="top" title="{{$agent['description']}}">{{ \Illuminate\Support\Str::limit($agent['description'],150,'...')}}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a data-bs-toggle="tooltip" data-bs-placement="right" title="Fiche de depannage" class="btn btn-sm btn-secondary"
                                           href="{{route('fiche.create',[$agent['id']])}}">
                                            <i class="mdi mdi-file" aria-hidden="true"></i>
                                        </a>
                                        <a onclick="getItem({{$agent['id']}})" class="btn btn-sm btn-danger"
                                           data-toggle="modal" data-target="#bs-delete-modal-sm">
                                            <i class="mdi mdi-trash-can" aria-hidden="true"></i>
                                        </a>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

    </div>

    <div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Ajouter une piece</h4>
                    <button type="button" class="button-error" data-dismiss="modal" aria-label="Close"><i data-feather="delete"></i></button>
                </div>
                <div class="">
                    <form class="form" method="POST" action="{{route('piecedetache.store')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label-wrapper">
                                    <p class="form-label">Libelle</p>
                                    <input class="form-input" type="text" name="libelle" placeholder="" required>
                                </label>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label-wrapper">
                                    <p class="form-label">Modele</p>
                                    <input class="form-input" type="text" name="modele" placeholder="" required>
                                </label>
                           </div>
                            <div class="col-md-12">
                                <label class="form-label-wrapper">
                                    <p class="form-label">Marque</p>
                                    <input class="form-input" type="text" name="marque" placeholder="" required>
                                </label></div>
                            <div class="col-md-12">
                                <label class="form-label-wrapper">
                                    <p class="form-label">Quantite</p>
                                    <input class="form-input" type="number" min="0" name="quantite" placeholder="" required>
                                </label></div>

                        </div>
                        <div class="mb-3 d-grid text-center">
                            <button class="btn btn-success" type="submit"> Enregistrer </button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="bs-delete-modal-sm" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Supprimer la caisse</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Cette action est irreverssible</p>
                    <form>
                        {{csrf_field()}}

                        <div class="mb-3 d-grid text-center">
                            <button class="btn btn-danger" type="button" id="delete_btn_caisse"> Supprimer </button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection


