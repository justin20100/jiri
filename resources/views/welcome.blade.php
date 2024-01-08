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
                <section class="banner">
                    <div class="wrapper">
                        <div class="banner__contentContainer">
                            <div class="banner__contentContainer__content">
                                <h1 class="banner__ContentContainer__content__title">Simplifiez, digitalisez et  centralisez vos données lors de jurys</h1>
                                <p class="banner__ContentContainer__content__text">Créez des contacts ainsi que des projets pour en faire un Jiri. Ce Jiri une fois crée, donne aux jurys de celui-ci accès à une interface pour noter les étudiants sur un ou plusieurs projets.</p>
                                <div class="banner__ContentContainer__content__buttonContainer">
                                    <a href="{{route('register')}}" class="banner__ContentContainer__content__buttonContainer__button">Créer un compte</a>
                                    <a href="{{route('login')}}" class="banner__ContentContainer__content__buttonContainer__button">En savoir plus</a>
                                </div>
                            </div>
                            <div class="banner__contentContainer__image">
                                <img src="{{asset('/images/welcome/welcome-screen-capture.jpg')}}" alt="" class="banner__ContentContainer__image__img">
                            </div>
                            <img src="{{asset('/images/welcome/welcome-first-illu.jpg')}}" alt="" class="banner__contentContainer__Illu--first">
                            <img src="{{asset('/images/welcome/welcome-second-illu.jpg')}}" alt="" class="banner__contentContainer__Illu--second">
                        </div>
                    </div>
                </section>
                <section class="features">
                    <div class="wrapper">
                        <div class="features__contentContainer">
                            <h2 class="features__contentContainer__title">{{__('Fontionnalités')}}</h2>
                            <div class="features__contentContainer__list">

                                <div class="features__contentContainer__list__item">
                                    <div class="features__contentContainer__list__item__iconContainer">
                                        <svg class="features__contentContainer__list__item__iconContainer__icon">
                                            <use xlink:href="#lala"></use>
                                        </svg>
                                    </div>
                                    <h3 class="features__contentContainer__list__item__title">Simplification de l’encodage des cotes par le jury</h3>
                                    <p class="features__contentContainer__list__item__text">
                                        Plus besoin de feuille ou de tableau Excel ou les fautes d’encodages sont vite arrivées. Une interface web simple est a disposition du jury.
                                    </p>
                                </div>

                                <div class="features__contentContainer__list__item">
                                    <div class="features__contentContainer__list__item__iconContainer">
                                        <svg class="features__contentContainer__list__item__iconContainer__icon">
                                            <use xlink:href="#lala"></use>
                                        </svg>
                                    </div>
                                    <h3 class="features__contentContainer__list__item__title">Centralisation de vos jurys sur cette application</h3>
                                    <p class="features__contentContainer__list__item__text">
                                        Gardez un historique des jurys, faite grandir votre liste de contacts, certains étudiants deviendront peut-être jury
                                    </p>
                                </div>

                                <div class="features__contentContainer__list__item">
                                    <div class="features__contentContainer__list__item__iconContainer">
                                        <svg class="features__contentContainer__list__item__iconContainer__icon">
                                            <use xlink:href="#lala"></use>
                                        </svg>
                                    </div>
                                    <h3 class="features__contentContainer__list__item__title">Exportation de vos tableaux de cotes une fois clôturés</h3>
                                    <p class="features__contentContainer__list__item__text">
                                        Plus besoin d’encoder toutes les cotes, exportez directement vos tableaux
                                    </p>
                                </div>

                                <div class="features__contentContainer__list__item">
                                    <div class="features__contentContainer__list__item__iconContainer">
                                        <svg class="features__contentContainer__list__item__iconContainer__icon">
                                            <use xlink:href="#lala"></use>
                                        </svg>
                                    </div>
                                    <h3 class="features__contentContainer__list__item__title">Invitation automatique des membres du jury</h3>
                                    <p class="features__contentContainer__list__item__text">
                                        Chaque membre du jury recois un mail pour se connecter a l’interface automatiquement
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
