<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mentions Légales</title>

    <!-- Styles -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="mainContainer">
    <main class="legalPage">
        <header class="header">
            <div class="wrapper">
                <div class="header__contentContainer">
                    <div class="header__contentContainer__content">
                        <div class="header__contentContainer__content__logo">
                            <a href="{{ url('/') }}" class="header__contentContainer__content__logo__link">
                                <img src="{{asset('/images/logo-jiri.svg')}}" alt="Jiri logo" class="header__contentContainer__content__logo__link__img">
                            </a>
                        </div>
                        <livewire:welcome.navigation/>
                    </div>
                </div>
            </div>
        </header>

        <section class="legal">
            <div class="wrapper">
                <div class="legal__contentContainer">
                    <h1 class="legal__contentContainer__title">{{ __("Mentions Légales") }}</h1>
                    <p class="legal__contentContainer__text">
                        <strong>1. Présentation du site :</strong><br>
                        Conformément aux dispositions des articles 6-III et 19 de la Loi n°2004-575 du 21 juin 2004 pour la Confiance dans l'économie numérique, dite L.C.E.N., il est porté à la connaissance des utilisateurs et visiteurs du site <strong>Jiri</strong> les présentes mentions légales.
                    </p>
                    <p class="legal__contentContainer__text">
                        <strong>Propriétaire du site :</strong><br>
                        Nom de l'entreprise : Justin's industry<br>
                        Responsable publication : Justin Vincent<br>
                        Adresse : Rue du dev<br>
                        Téléphone : 045865213256 <br>
                        Email : dev@justin-vincent.be
                    </p>
                    <p class="legal__contentContainer__text">
                        <strong>2. Conditions générales d'utilisation du site et des services proposés :</strong><br>
                        L'utilisation du site implique l'acceptation pleine et entière des conditions générales d'utilisation ci-après décrites. Ces conditions d'utilisation sont susceptibles d'être modifiées ou complétées à tout moment.
                    </p>
                    <p class="legal__contentContainer__text">
                        <strong>3. Propriété intellectuelle et contrefaçons :</strong><br>
                        Justin's industry est propriétaire des droits de propriété intellectuelle ou détient les droits d'usage sur tous les éléments accessibles sur le site, notamment les textes, images, graphismes, logo, icônes, etc.
                    </p>
                    <p class="legal__contentContainer__text">
                        <strong>4. Limitations de responsabilité :</strong><br>
                        Justin's industry ne pourra être tenue responsable des dommages directs et indirects causés au matériel de l'utilisateur, lors de l'accès au site Jiri, et résultant soit de l'utilisation d'un matériel ne répondant pas aux spécifications indiquées, soit de l'apparition d'un bug ou d'une incompatibilité.
                    </p>
                    <p class="legal__contentContainer__text">
                        <strong>5. Gestion des données personnelles :</strong><br>
                        Justin's industry s'engage à respecter la confidentialité des données personnelles collectées et traitées dans le cadre de l'utilisation du site. Pour plus de détails, veuillez consulter notre politique de confidentialité.
                    </p>
                    <p class="legal__contentContainer__text">
                        <strong>6. Droit applicable et attribution de juridiction :</strong><br>
                        Tout litige en relation avec l'utilisation du site Jiri est soumis au droit français. Il est fait attribution exclusive de juridiction aux tribunaux compétents.
                    </p>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
</html>
