<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{env('APP_NAME')}} | Connexion</title>
    <link rel="stylesheet" href="{{asset('css/style.min.css')}}">
</head>
<body>
<div class="layer"></div>
<main class="page-center">
    @include("_partials.errors-and-messages")
    <article class="sign-up">
        <h1 class="sign-up__title">Bon retour!</h1>
        <p class="sign-up__subtitle">Connecter vous pour continuer</p>
            <form class="sign-up-form form"  method="POST" action="{{ route('loginstore') }}" >
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
            <button class="form-btn primary-default-btn transparent-btn">Se connecter</button>
        </form>
    </article>
</main>
{{--<div class="account-pages">
    <div class="container">

        <div class="row justify-content-center mt-3">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="text-center">
                    <a href="/">
                       --}}{{-- <img src="{{asset('storage/images/oxfam.png')}}" alt="" height="50" class="mx-auto">--}}{{--
                    </a>
                    <p class="text-muted mt-2 mb-4">{{env('APP_NAME')}}</p>

                </div>
                @include("_partials.errors-and-messages")
                <div class="card">
                    <div class="card-body p-4">

                        <div class="text-center mb-4">
                            <h4 class="text-uppercase mt-0">Connexion</h4>
                        </div>

                        <form method="POST" action="{{ route('loginstore') }}" >
                            {{csrf_field()}}
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Adresse mail</label>
                                <input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="Votre email">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input class="form-control" name="password" type="password" required="" id="password" placeholder="Votre mot de passe">
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                    <label class="form-check-label" for="checkbox-signin">Se souvenir de moi</label>
                                </div>
                            </div>

                            <div class="mb-3 d-grid text-center">
                                <button class="btn btn-primary" type="submit"> Se connecter </button>
                            </div>
                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p> <a href="{{route('reset_password')}}" class="text-muted ms-1"><i class="fa fa-lock me-1"></i>Mot de passe oublié?</a></p>
                        <p class="text-muted">Avez vous deja un compte? <a href="{{route('register')}}" class="text-dark ms-1"><b>S'inscrire</b></a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>--}}
<!-- end page -->

<!-- Icons library -->
<script src="{{asset('js/feather.min.js') }}"></script>
<!-- Custom scripts -->

<script src="{{asset('js/script.js') }}"></script>

</body>

</html>
