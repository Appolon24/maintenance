@extends('front.base')

@section('content')
    <div class="container">
        <main class="page-cente">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-success" href="{{route('adddemande')}}">Ajouter une demande</a>
                </div>
                <div class="card-body">
                    <h4 class="header-title mb-4">Mon espace</h4>

                    <ul class="nav nav-pills navtab-bg nav-justified">
                        <li class="nav-item">
                            <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Mes depannages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#messages1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                Changer mot de passe
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">
                        <div class="tab-pane show active" id="home1">
                       <table class="table">
                           <thead>
                           <tr>
                               <th>#</th>
                               <th>Date</th>
                               <th>Machine</th>
                               <th>Description</th>
                               <th>Status</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($depannages as $key=>$agent)
                               <tr>
                                   <td>{{$depannages->firstitem()+$key}}</td>
                                   <td>{{$agent['created_at']}}</td>
                                   <td>{{$agent['machine']->libelle}}</td>
                                   <td>{{$agent['description']}}</td>
                                   <td> @if($agent['status']==\App\Models\DemandeDepannage::ENVOYE)
                                           <span class="badge badge-dark">{{$agent['status']}}</span>
                                       @endif
                                       @if($agent['status']==\App\Models\DemandeDepannage::REPARATION)
                                           <span class="badge badge-info">{{$agent['status']}}</span>
                                       @endif
                                       @if($agent['status']==\App\Models\DemandeDepannage::COMPLETED)
                                           <span class="badge badge-success">{{$agent['status']}}</span>
                                       @endif</td>
                                   <td>
                                       @if($agent['status']==\App\Models\DemandeDepannage::REPARATION)
                                       <a class="btn-sm btn-dark p-1 pr-2 m-1" title="Imprimer le pdf"
                                          href="{{route('fiche.print',[$agent['id']])}}">
                                           <i class="mdi mdi-file-pdf pl-1" aria-hidden="true"></i>
                                       </a>
                                       @endif
                                           @if($agent['status']==\App\Models\DemandeDepannage::ENVOYE)
                                               <a class="btn-sm btn-primary p-1 pr-2 m-1" title="Modifier"
                                                  href="{{route('editdemande',[$agent['id']])}}">
                                                   <i class="mdi mdi-book-edit pl-1" aria-hidden="true"></i>
                                               </a>
                                           @endif
                                   </td>
                           </tr>
                           @endforeach
                           </tbody>

                       </table>
                        </div>
                        <div class="tab-pane" id="profile1">
                            <form class="sign-up-form form" action="{{ route('saveprofil') }}" method="POST">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Nom complet</p>
                                            <input class="form-input" value="{{$user->name}}" name="name" type="text" placeholder="Entrer votre nom" required>
                                        </label>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Email</p>
                                            <input class="form-input" value="{{$user->email}}" name="email" type="email" placeholder="Entrer votre email" required>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Téléphone</p>
                                            <input class="form-input"  value="{{$user->phone}}" name="phone" type="text" placeholder="Entrer votre téléphone" required>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Adresse</p>
                                            <input class="form-input"  value="{{$user->adresse}}" name="adresse" type="text" placeholder="Entrer votre adresse" required>
                                        </label>
                                    </div>
                                </div>

                                <button class="form-btn primary-default-btn transparent-btn">Modifier</button>

                            </form>
                        </div>
                        <div class="tab-pane" id="messages1">
                            <form class="sign-up-form form" action="{{ route('changepassword') }}" method="POST">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Ancien mot de passe</p>
                                            <input class="form-input"  name="oldpassword" type="password" placeholder="Entrer votre nom" required>
                                        </label>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-wrapper">
                                            <p class="form-label">Nouveau mot de passe</p>
                                            <input class="form-input" name="newpassword" type="password" placeholder="Entrer votre email" required>
                                        </label>
                                    </div>

                                </div>

                                <button class="form-btn primary-default-btn transparent-btn">Modifier</button>

                            </form>
                         </div>
                    </div>
                </div>
            </div> <!-- end card-->
        </main>
    </div>

@endsection
