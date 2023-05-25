@extends('base')

@section('content')
    <div class="content-page">
        <div class="container">
            <h2 class="main-title">Fiche de depannage N° {{$file->id}}</h2>
            <!-- Start Content-->
<input type="hidden" value="{{$file->id}}" id="fiche">
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <form class="form" method="POST" action="{{route('fiche.create',['id'=>$file->demande_depannage_id])}}">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label-wrapper">
                                        <p class="form-label">Observation</p>
                                        <textarea class="form-textarea" rows="8" value="{{$file->observation}}" type="text" name="libelle" placeholder="" required>
                                        </textarea></label>
                                </div>
                            </div>
                            <p class="sign-up__subtitle">Pieces détachées utilisées</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label-wrapper">
                                        <p class="form-label">Piece detache</p>
                                        <select id="piece" class="form-input">
                                            <option value="0">Choisir une piece</option>
                                            @foreach($pieces as $machine)
                                                <option value="{{$machine->id}}">{{$machine->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label-wrapper">
                                        <p class="form-label">Quantite</p>
                                        <input id="quantite" class="form-input" type="number" min="1" placeholder="">
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-outline-dark mt-5" type="button" id="addpiece"><i class="mdi mdi-plus"></i> ajouter </a>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table" id="table_piece">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Libelle</th>
                                        <th>quantite</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lines as $line)
                                        <tr>
                                            <td></td>
                                            <td>{{$line->piece->libelle}}</td>
                                            <td>{{$line->quantite}}</td>
                                            <td><a onclick='removeRow({{$line->id}})' class='btn btn-sm btn-danger'>Del</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <div class="mb-3 mt-3 text-center">
                                <a class="btn btn-warning" type="button" href="{{route('fiche.depannage')}}"><i class="mdi mdi-arrow-left"></i> annuler </a>
                                <button class="btn btn-success" type="submit"> Modifier </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection



