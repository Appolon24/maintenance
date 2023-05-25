@extends('front.base')

@section('content')
    <div class="container">
        <main class="page-center">
            @include("_partials.errors-and-messages")
            <article class="sign-up">
                <h1 class="sign-up__title">Ajouter une demande de depannage</h1>
                <p class="sign-up__subtitle">Connecter vous pour soumettre un probleme</p>
                <form class="sign-up-form form"  method="POST" action="{{ route('adddemande') }}" >
                    {{csrf_field()}}
                    <div id="first">
                        <label class="form-label-wrapper">
                            <p class="form-label">Libelle</p>
                            <input class="form-input" type="text" name="type" placeholder="" required>
                        </label>
                       {{-- <label class="form-label-wrapper">
                            <p class="form-label">Urgence</p>
                            <select name="machine" class="form-input">
                                <option value="1">Pas urgent</option>
                                <option value="2">Urgence moyenne</option>
                                <option value="3">Tres urgent</option>
                            </select>
                        </label>--}}
                        <label class="form-label-wrapper">
                            <p class="form-label">Description du probleme</p>
                            <textarea class="form-textarea" rows="8" name="description"  placeholder="" required>
                        </textarea>
                        </label>

                        <button type="button" id="next" class="form-btn primary-default-btn transparent-btn mb-1">Suivant</button>

                    </div>
                    <div id="second">
                        <label class="form-label-wrapper">
                            <p class="form-label">Choisir une machine</p>
                            <select name="machine" class="form-input">
                                <option value="0">Choisir une de vos machines</option>
                                @foreach($machines as $machine)
                                    <option value="{{$machine->id}}">{{$machine->libelle}}</option>
                                @endforeach
                            </select>
                        </label>
                        <hr>
                        <p class="sign-up__subtitle">Ou ajouter votre machine</p>
                        <label class="form-label-wrapper">
                            <p class="form-label">Marque</p>
                            <input class="form-input" type="text" name="marque" placeholder="">
                        </label>
                        <label class="form-label-wrapper">
                            <p class="form-label">Model</p>
                            <input class="form-input" type="text" name="model" placeholder="">
                        </label>
                        <label class="form-label-wrapper">
                            <p class="form-label">Couleur</p>
                            <input class="form-input" type="color" name="couleur" placeholder="">
                        </label>
                        <button type="submit" class="form-btn primary-default-btn transparent-btn mb-1">Enregistrer</button>

                    </div>

                </form>
            </article>
        </main>

    </div>

@endsection
