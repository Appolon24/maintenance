@extends('base')

@section('content')
    <div class="container">
        <h2 class="main-title">Fiches de depannage</h2>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm"
                        data-toggle="modal" data-target="#bs-example-modal-sm">
                    <i class="mdi mdi-plus-circle"></i>Ajouter une fiche
                </button>

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
                            <th>Technicien</th>
                            <th>Status</th>
                            <th>Observation</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody id="set-rows">
                        @foreach($agents as $key=>$agent)
                            <tr>
                                <td>{{$agents->firstitem()+$key}}</td>
                                <td>
                                    {{$agent['created_at']}}
                                </td>
                                <td>
                                    <a href="{{route('users.edit',[$agent['demande']->user->id])}}" class="d-block font-size-sm text-body">
                                        {{$agent['demande']->user->name}}
                                    </a>
                                </td>
                                <td>
                                    {{$agent['demande']->machine->libelle}}
                                </td>
                                <td>
                                    {{$agent['user']->name}}
                                </td>
                                <td>
                                    @if($agent['isclose'])
                                        <span class="badge badge-success">terminé</span>
                                    @else
                                        <span class="badge badge-pending">encours</span>
                                    @endif
                                </td>
                                <td>
                                    {{$agent['observation']}}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn-sm btn-secondary p-1 pr-2 m-1" title="detail"
                                           href="{{route('fiche.edit',[$agent['id']])}}">
                                            <i class="mdi mdi-pencil pl-1" aria-hidden="true"></i>
                                        </a>
                                        <a class="btn-sm btn-dark p-1 pr-2 m-1" title="Imprimer le pdf"
                                           href="{{route('fiche.print',[$agent['id']])}}">
                                            <i class="mdi mdi-file-pdf pl-1" aria-hidden="true"></i>
                                        </a>
                                        <a onclick="getItem({{$agent['id']}})" class="btn-sm btn-danger p-1 pr-2 m-1"
                                           data-toggle="modal" data-target="#bs-delete-modal-sm">
                                            <i class="mdi mdi-trash-can pl-1" aria-hidden="true"></i>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Liste de demandes</h4>
                    <button type="button" class="button-error" data-dismiss="modal" aria-label="Close"><i data-feather="delete"></i></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Client</th>
                            <th>Machine</th>
                            <th>Probleme</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($demandes as $demande)
                        <tr>

                            <td>{{$demande->user->name}}</td>
                            <td>{{$demande->user->name}}</td>
                            <td>{{$demande->machine->marque}}</td>
                            <td>{{$demande->description}}</td>
                            <td><a class="btn btn-sm btn-outline-success">generer la fiche</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
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


