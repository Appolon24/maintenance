@extends('front.base')

@section('content')
    <div class="container">
        <main class="page-center">
            @include("_partials.errors-and-messages")
            <article class="sign-up">
                <h1 class="sign-up__title">Modifier la demande de depannage</h1>
                <form class="sign-up-form form"  method="POST" action="{{ route('editdemande',['id'=>$demande->id]) }}" >
                    {{csrf_field()}}
                    <div id="first">
                        <label class="form-label-wrapper">
                            <p class="form-label">Libelle</p>
                            <input class="form-input" type="text" value="{{$demande->type}}" name="type" placeholder="" required>
                        </label>
                        <label class="form-label-wrapper">
                            <p class="form-label">Description du probleme</p>
                            <textarea class="form-textarea" rows="8" name="description"  placeholder="" required>
                     {{$demande->description}}
                        </textarea>
                            <hr>
                            <p class="sign-up__subtitle">Detail machine</p>
                        </label>
                        <label class="form-label-wrapper">
                            <p class="form-label">Marque</p>
                            <input class="form-input" value="{{$demande->machine->marque}}" type="text" name="marque" placeholder="">
                        </label>
                        <label class="form-label-wrapper">
                            <p class="form-label">Model</p>
                            <input class="form-input" value="{{$demande->machine->modele}}" type="text" name="model" placeholder="">
                        </label>
                        <label class="form-label-wrapper">
                            <p class="form-label">Couleur</p>
                            <input class="form-input" value="{{$demande->machine->couleur}}" type="color" name="couleur" placeholder="">
                        </label>
                        <button type="submit" class="form-btn primary-default-btn transparent-btn mb-1">Modifier</button>

                    </div>


                </form>
            </article>
        </main>

    </div>

@endsection
