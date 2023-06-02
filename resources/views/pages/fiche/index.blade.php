@extends('base')

@section('content')
    <div class="container">
        <h2 class="main-title">Bons de sortie</h2>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <div class="btn-group">
             </div>
        </div>
        <div class="white-block">
                <div class="users-table table-wrapper">
                    <table class="posts-table"><thead class="thead-light">
                        <tr>
                            <th>#N°</th>
                            <th>Date </th>
                            <th style="width: 20%">Client</th>
                            <th>Machine</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody id="set-rows">
                        @foreach($agents as $key=>$agent)
                            <tr>
                                <td>{{$agents->firstitem()+$key}}</td>
                                <td>
                                    <a class="d-block font-size-sm text-body">
                                        {{$agent['fiche_depannage']->demande->created_at}}
                                    </a>
                                </td>
                                <td>
                                    {{$agent['fiche_depannage']->demande->user->name}}
                                </td>
                                <td>
                                    {{$agent['fiche_depannage']->demande->machine->marque}}
                                </td>
                                <td>
                                    {{$agent['fiche_depannage']->total}}
                                </td>
                                <td>
                                    <a class="btn-sm btn-secondary p-1 pr-2 m-1"
                                       href="{{route('piecedetache.edit',[$agent['id']])}}">
                                        <i class="mdi mdi-file-pdf pl-1" aria-hidden="true"></i>
                                    </a>
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
                    <button type="button" class="button-error" data-bs-dismiss="modal" aria-label="Close"><i data-feather="delete"></i></button>
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


