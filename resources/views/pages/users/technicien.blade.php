@extends('base')

@section('content')
    <div class="container">
        <h2 class="main-title">Techniciens</h2>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-sm"
                        data-toggle="modal" data-target="#bs-example-modal-sm">
                    <i class="mdi mdi-plus-circle"></i>Ajouter un technicien
                </button>

            </div>
        </div>
        <div class="white-block">
            <div class="users-table table-wrapper">
                <table class="posts-table"><thead class="thead-light">
                    <tr>
                        <th>#N°</th>
                        <th style="width: 20%">Nom complet</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    @foreach($agents as $key=>$agent)
                        <tr>
                            <td>{{$agents->firstitem()+$key}}</td>
                            {{--      <td>
                                      <img class="rounded-circle" height="60px" width="60px" style="cursor: pointer"
                                           onclick="location.href='{{route('estheticien.edit',[$agent['id']])}}'"

                                           src="{{asset('storage/app/public/agent')}}/{{$agent['image']}}">
                                  </td>--}}
                            <td>
                                <a href="{{route('users.edit',[$agent['id']])}}" class="d-block font-size-sm text-body">
                                    {{$agent['name']}}
                                </a>
                            </td>
                            <td>
                                {{$agent['email']}}
                            </td>
                            <td>
                                {{$agent['phone']}}
                            </td>
                            <td>
                                {{$agent['adresse']}}
                            </td>
                            <td>
                                <a class="btn-sm btn-secondary p-1 pr-2 m-1"
                                   href="{{route('users.edit',[$agent['id']])}}">
                                    <i class="mdi mdi-pencil pl-1" aria-hidden="true"></i>
                                </a>
                                <a onclick="getItem({{$agent['id']}})" class="btn-sm btn-danger p-1 pr-2 m-1"
                                   data-toggle="modal" data-target="#bs-delete-modal-sm">
                                    <i class="mdi mdi-trash-can pl-1" aria-hidden="true"></i>
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
                    <h4 class="modal-title" id="mySmallModalLabel">Ajouter un technicien</h4>
                    <button type="button" class="button-error" data-dismiss="modal" aria-label="Close"><i data-feather="delete"></i></button>
                </div>
                <div class="">
                    <form class="form" method="POST" action="{{route('users.store')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label-wrapper">
                                    <p class="form-label">Nom complet</p>
                                    <input class="form-input" type="text" name="name" placeholder="" required>
                                </label>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label-wrapper">
                                    <p class="form-label">Téléphone</p>
                                    <input class="form-input" type="text" name="phone" placeholder="" required>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-wrapper">
                                    <p class="form-label">Email</p>
                                    <input class="form-input" type="email" name="email" placeholder="" required>
                                </label></div>
                            <div class="col-md-6">
                                <label class="form-label-wrapper">
                                    <p class="form-label">Password</p>
                                    <input class="form-input" type="password" name="password" placeholder="" required>
                                </label></div>
                            <div class="col-md-12">
                                <label class="form-label-wrapper">
                                    <p class="form-label">Adresse</p>
                                    <input class="form-input" type="text"  name="adresse" placeholder="" required>
                                </label></div>
                            <input class="form-input" value="1" type="text" hidden  name="user_type" placeholder="" required>

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


