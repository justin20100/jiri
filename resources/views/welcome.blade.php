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
    <livewire:tools.flash-message></livewire:tools.flash-message>
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
                                <livewire:welcome.navigation/>
                            </div>
                        </div>
                    </div>
                </header>
                <section class="banner">
                    <div class="wrapper">
                        <div class="banner__contentContainer">
                            <div class="banner__contentContainer__content">
                                <h1 class="banner__contentContainer__content__title">{{__("Digitize and centralize your jury data for smoother evaluations")}}</h1>
                                <p class="banner__contentContainer__content__text">{{__("Once your projects are set up, our platform allows jurors to easily evaluate students on multiple projects through an intuitive interface.")}}</p>
                                <div class="banner__contentContainer__content__buttonContainer">
                                    <a href="#features" class="banner__contentContainer__content__buttonContainer__button button button--light">{{__("Learn more")}}</a>
                                    <a href="#contact" class="banner__contentContainer__content__buttonContainer__button button">{{__("Contact us")}}</a>
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
                            <h2 class="features__contentContainer__title">{{__('Features')}}</h2>
                            <div class="features__contentContainer__list">
                                <div class="features__contentContainer__list__item">
                                    <div class="features__contentContainer__list__item__top">
                                        <div class="features__contentContainer__list__item__top__iconContainer features__contentContainer__list__item__top__iconContainer--1">
                                            <svg class="features__contentContainer__list__item__top__iconContainer__icon">
                                                <use xlink:href="{{asset("images/sprite.svg#feature1")}}"></use>
                                            </svg>
                                        </div>
                                        <h3 class="features__contentContainer__list__item__top__title">{{__("Streamlining the
                                            jury's grading process")}}</h3>
                                    </div>
                                    <p class="features__contentContainer__list__item__text">
                                        {{__("No more paper sheets or Excel spreadsheets prone to errors. A simple web
                                        interface is available for the jury.")}}
                                    </p>
                                </div>

                                <div class="features__contentContainer__list__item">
                                    <div class="features__contentContainer__list__item__top">
                                        <div class="features__contentContainer__list__item__top__iconContainer features__contentContainer__list__item__top__iconContainer--2">
                                            <svg class="features__contentContainer__list__item__top__iconContainer__icon">
                                                <use xlink:href="{{asset("images/sprite.svg#feature2")}}"></use>
                                            </svg>
                                        </div>
                                        <h3 class="features__contentContainer__list__item__top__title">{{__("Centralize your
                                            juries with this application")}}</h3>
                                    </div>
                                    <p class="features__contentContainer__list__item__text">
                                        {{__("Keep a history of your juries, grow your contact list, and watch as some
                                        students may become jurors themselves.")}}
                                    </p>
                                </div>

                                <div class="features__contentContainer__list__item">
                                    <div class="features__contentContainer__list__item__top">
                                        <div class="features__contentContainer__list__item__top__iconContainer features__contentContainer__list__item__top__iconContainer--3">
                                            <svg class="features__contentContainer__list__item__top__iconContainer__icon">
                                                <use xlink:href="{{asset("images/sprite.svg#feature3")}}"></use>
                                            </svg>
                                        </div>
                                        <h3 class="features__contentContainer__list__item__top__title">{{__("Export your grading tables once they are finalized")}}</h3>
                                    </div>
                                    <p class="features__contentContainer__list__item__text">
                                        {{__("No need to manually enter all the grades; simply export your tables directly.")}}
                                    </p>
                                </div>

                                <div class="features__contentContainer__list__item">
                                    <div class="features__contentContainer__list__item__top">
                                        <div class="features__contentContainer__list__item__top__iconContainer features__contentContainer__list__item__top__iconContainer--4">
                                            <svg class="features__contentContainer__list__item__top__iconContainer__icon">
                                                <use xlink:href="{{asset("images/sprite.svg#feature4")}}"></use>
                                            </svg>
                                        </div>
                                        <h3 class="features__contentContainer__list__item__top__title">{{__("Automatically
                                            invite jury members")}}</h3>
                                    </div>
                                    <p class="features__contentContainer__list__item__text">
                                        {{("Each jury member automatically receives an email to log in to the interface")}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="contact" id="contact">
                    <div class="contact__illustrationContainer">
                        <img src="{{asset('/images/welcome/welcome-third-illu.jpg')}}" alt="" class="contact__illustrationContainer__illu contact__illustrationContainer__illu--first">
                        <img src="{{asset('/images/welcome/welcome-fourth-illu.jpg')}}" alt="" class="contact__illustrationContainer__illu contact__illustrationContainer__illu--second">
                    </div>
                    <div class="wrapper">
                        <div class="contact__contentContainer">
                            <div class="contact__contentContainer__heading">
                                <p class="contact__contentContainer__heading__question">{{__("A question ?")}}</p>
                                <h2 class="contact__contentContainer__heading__title">{{__("Contact us")}}</h2>
                            </div>
                            <did class="contact__contentContainer__formContainer">
                                <livewire:welcome.contact-us/>
                            </did>
                        </div>
                    </div>
                </section>
                <footer class="footer">
                    <div class="wrapper">
                        <div class="footer__contentContainer">
                            <div class="footer__contentContainer__links">
                                <div class="footer__contentContainer__links__buttonsContainer">
                                    <div>
                                        <livewire:welcome.navigation/>
                                    </div>
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
