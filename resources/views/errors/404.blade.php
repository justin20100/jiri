<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jiri</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="mainContainer">
    <main class="errorPage">
        <div class="errorPage__logoContainer">
            <a href="/" wire:navigate class="errorPage__logoContainer__link">
                <x-application-logo/>
            </a>
        </div>
        <section class="error">
            <div class="wrapper">
                <div class="error__contentContainer">
                    <h1 class="error__contentContainer__title">
                        {{__("404")}}
                    </h1>
                    <p class="error__contentContainer__message">{{__("Page non trouvée")}}</p>
                    <div class="error__contentContainer__left__content__button">
                        @if(auth()->check())
                            <a href="{{route('dashboard')}}" class="error__contentContainer__left__content__button__link button">{{__("Dashboard")}}</a>
                        @else
                            <a href="/" class="error__contentContainer__left__content__button__link button">{{__("Retour à l'accueil")}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
</html>
