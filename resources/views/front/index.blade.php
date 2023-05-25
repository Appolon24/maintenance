@extends('front.base')

@section('content')
    <div class="container">
        <main class="page-center" id="login">
            @include("_partials.errors-and-messages")
            <article class="sign-up">
                <h1 class="sign-up__title">Bienvenue parmi nous</h1>
                <p class="sign-up__subtitle">Connectez vous pour soumettre un probléme</p>
                <form class="sign-up-form form"  method="POST" action="{{ route('loginstorecustomer') }}" >
                    {{csrf_field()}}
                    <label class="form-label-wrapper">
                        <p class="form-label">Email</p>
                        <input class="form-input" type="email" name="email" placeholder="Enter your email" required>
                    </label>
                    <label class="form-label-wrapper">
                        <p class="form-label">Mot de passe</p>
                        <input class="form-input" name="password" type="password" placeholder="Enter your password" required>
                    </label>
                    <a class="link-info forget-link" href="{{route('reset_password')}}">Mot de passe oublié?</a>
                    <label class="form-checkbox-wrapper">
                        <input class="form-checkbox" type="checkbox">
                        <span class="form-checkbox-label">Se souvenir de moi</span>
                    </label>
                    <button class="form-btn primary-default-btn transparent-btn mb-1">Se connecter</button>
                    <label class="form-checkbox-wrapper">
                        <span class="form-checkbox-label">Vous n'avez pas de compte?<a class="link-info forget-link" href="#" id="btn_go_register">s'inscrire</a></span>
                    </label>
                </form>
            </article>
        </main>
        <main class="page-center" id="register">
            <article class="sign-up">
                <h1 class="sign-up__title">S'inscrire</h1>
                <p class="sign-up__subtitle">Creer votre compte pour une meilleur experience</p>
                <form class="sign-up-form form" action="{{ route('register') }}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label-wrapper">
                                <p class="form-label">Nom complet</p>
                                <input class="form-input" name="name" type="text" placeholder="Entrer votre nom" required>
                            </label>
                        </div>

                        <div class="col-md-6">
                        <label class="form-label-wrapper">
                            <p class="form-label">Email</p>
                            <input class="form-input" name="email" type="email" placeholder="Entrer votre email" required>
                        </label>
                        </div>
                        <div class="col-md-6">
                        <label class="form-label-wrapper">
                            <p class="form-label">Password</p>
                            <input class="form-input" name="password" type="password" placeholder="Entrer votre mot de passe" required>
                        </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-wrapper">
                                <p class="form-label">Téléphone</p>
                                <input class="form-input" name="phone" type="text" placeholder="Entrer votre téléphone" required>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-wrapper">
                                <p class="form-label">Adresse</p>
                                <input class="form-input" name="adresse" type="text" placeholder="Entrer votre adresse" required>
                            </label>
                        </div>
                    </div>

                    <button class="form-btn primary-default-btn transparent-btn">S'inscrire</button>
                    <label class="form-checkbox-wrapper">
                        <span class="form-checkbox-label">Vous avez deja un compte?<a class="link-info forget-link" href="#" id="btn_go_login">se connecter</a></span>
                    </label>
                </form>
            </article>
        </main>

    </div>

@endsection
