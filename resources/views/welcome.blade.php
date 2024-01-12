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
                                <h1 class="banner__contentContainer__content__title">Simplifiez, digitalisez et  centralisez vos données lors de jurys</h1>
                                <p class="banner__contentContainer__content__text">Créez des contacts ainsi que des projets pour en faire un Jiri. Ce Jiri une fois crée, donne aux jurys de celui-ci accès à une interface pour noter les étudiants sur un ou plusieurs projets.</p>
                                <div class="banner__contentContainer__content__buttonContainer">
                                    <a href="#features" class="banner__contentContainer__content__buttonContainer__button button button--light">En savoir plus</a>
                                    <a href="{{route('register')}}" class="banner__contentContainer__content__buttonContainer__button button">Créer un compte</a>
                                </div>
                            </div>
                            <div class="banner__contentContainer__screen">
                                    <img src="{{asset('/images/welcome/welcome-screen-capture.jpg')}}" alt="" class="banner__contentContainer__screen__img">
                            </div>
                            <img src="{{asset('/images/welcome/welcome-first-illu.jpg')}}" alt="" class="banner__contentContainer__illu banner__contentContainer__illu--first">
                            <img src="{{asset('/images/welcome/welcome-second-illu.jpg')}}" alt="" class="banner__contentContainer__illu banner__contentContainer__illu--second">
                        </div>
                    </div>
                </section>
                <section class="features" id="features">
                    <div class="wrapper">
                        <div class="features__contentContainer">
                            <h2 class="features__contentContainer__title">{{__('Fontionnalités')}}</h2>
                            <div class="features__contentContainer__list">

                                <div class="features__contentContainer__list__item">
                                    <div class="features__contentContainer__list__item__top">
                                        <div class="features__contentContainer__list__item__top__iconContainer features__contentContainer__list__item__top__iconContainer--1">
                                            <svg class="features__contentContainer__list__item__top__iconContainer__icon">
                                                <use xlink:href="{{asset("images/sprite.svg#feature1")}}"></use>
                                            </svg>
                                        </div>
                                        <h3 class="features__contentContainer__list__item__top__title">Simplification de l’encodage des cotes par le jury</h3>
                                    </div>
                                    <p class="features__contentContainer__list__item__text">
                                        Plus besoin de feuille ou de tableau Excel ou les fautes d’encodages sont vite arrivées. Une interface web simple est a disposition du jury.
                                    </p>
                                </div>

                                <div class="features__contentContainer__list__item">
                                    <div class="features__contentContainer__list__item__top">
                                        <div class="features__contentContainer__list__item__top__iconContainer features__contentContainer__list__item__top__iconContainer--2">
                                            <svg class="features__contentContainer__list__item__top__iconContainer__icon">
                                                <use xlink:href="{{asset("images/sprite.svg#feature2")}}"></use>
                                            </svg>
                                        </div>
                                        <h3 class="features__contentContainer__list__item__top__title">Centralisation de vos jurys sur cette application</h3>
                                    </div>
                                    <p class="features__contentContainer__list__item__text">
                                        Gardez un historique des jurys, faite grandir votre liste de contacts, certains étudiants deviendront peut-être jury
                                    </p>
                                </div>

                                <div class="features__contentContainer__list__item">
                                    <div class="features__contentContainer__list__item__top">
                                        <div class="features__contentContainer__list__item__top__iconContainer features__contentContainer__list__item__top__iconContainer--3">
                                            <svg class="features__contentContainer__list__item__top__iconContainer__icon">
                                                <use xlink:href="{{asset("images/sprite.svg#feature3")}}"></use>
                                            </svg>
                                        </div>
                                        <h3 class="features__contentContainer__list__item__top__title">Exportation de vos tableaux de cotes une fois clôturés</h3>
                                    </div>
                                    <p class="features__contentContainer__list__item__text">
                                        Plus besoin d’encoder toutes les cotes, exportez directement vos tableaux
                                    </p>
                                </div>

                                <div class="features__contentContainer__list__item">
                                    <div class="features__contentContainer__list__item__top">
                                        <div class="features__contentContainer__list__item__top__iconContainer features__contentContainer__list__item__top__iconContainer--4">
                                            <svg class="features__contentContainer__list__item__top__iconContainer__icon">
                                                <use xlink:href="{{asset("images/sprite.svg#featur4")}}"></use>
                                            </svg>
                                        </div>
                                        <h3 class="features__contentContainer__list__item__top__title">Invitation automatique des membres du jury</h3>
                                    </div>
                                    <p class="features__contentContainer__list__item__text">
                                        Chaque membre du jury reçoit un mail pour se connecter a l’interface automatiquement
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="footer">
                    <div class="wrapper">
                        <div class="footer__contentContainer">
                            <div class="footer__contentContainer__links">
                                <div class="footer__contentContainer__links__buttonsContainer">
                                    <a href="{{route('login')}}" class="footer__contentContainer__links__buttonsContainer__button button button--white">Se connecter</a>
                                    <a href="{{route('register')}}" class="footer__contentContainer__links__buttonsContainer__button button">Créer un compte</a>
                                </div>
                            </div>
                            <div class="footer__contentContainer__legal">
                                <a href="#" class="footer__contentContainer__legal__link">Mentions légales</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </main>
        </div>
    </body>
</html>
