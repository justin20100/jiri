<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jiri</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="mainContainer">
            <main class="welcomePage">
                <header class="header">
                    <div class="wrapper">
                        <div class="header__contentContainer">
                            <div class="header__contentContainer__content">
                                <div class="header__contentContainer__content__logo">
                                    <a href="" class="header__contentContainer__content__logo__link">
                                        <img src="{{asset('/images/logo-jiri.svg')}}" alt="Jiri logo" class="header__contentContainer__content__logo__link__img">
                                    </a>
                                </div>
                                @if (Route::has('login'))
                                    <livewire:welcome.navigation/>
                                @endif
                            </div>
                        </div>
                    </div>
                </header>
            </main>
        </div>
    </body>
</html>
