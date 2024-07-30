<div class="welcomeModal">
    {{--    BUttons  --}}
    <div wire:click="openLoginModal" class="button button--light login-button">Se connecter</div>
    <div wire:click="openRegisterModal" class="button">Créer un compte</div>

    {{--    Template    --}}
    @if($isOpen!="none")
        <div class="modal" wire:keydown.escape.prevent="closeWelcomeModal">
            <div class="modal__contentContainer">
                <div class="modal__contentContainer__content">
                    {{--     Splitter    --}}
                    <div class="modal__contentContainer__content__splitter">
                        {{--   Left part   --}}
                        <div class="modal__contentContainer__content__splitter__left">
                            <img src="{{asset('/images/welcome/welcome-fifth-illu.jpg')}}" alt="" class="modal__contentContainer__content__splitter__left__illu modal__contentContainer__content__splitter__left__illu--first">
                            <img src="{{asset('/images/welcome/welcome-sixth-illu.jpg')}}" alt="" class="modal__contentContainer__content__splitter__left__illu modal__contentContainer__content__splitter__left__illu--second">
                            <p class="modal__contentContainer__content__splitter__left__welcome">Bienvenue&nbsp;!</p>
                            <a href="/" wire:navigate class="modal__contentContainer__content__splitter__left__logo">
                                <x-application-logo/>
                            </a>
                            @if($isOpen=="login")
                                <span class="modal__contentContainer__content__splitter__left__register">Pas encore de compte ? <span wire:click="openRegisterModal" title="Login" class="fakeLink"> Inscrivez-vous !</span></span>
                            @elseif($isOpen=="register")
                                <span class="modal__contentContainer__content__splitter__left__register">Déjà un compte ? <span wire:click="openLoginModal" title="register" class="fakeLink"> Connectez-vous !</span></span>
                            @endif
                        </div>
                        {{--     Right part   --}}
                        <div class="modal__contentContainer__content__splitter__right">
                            <a wire:click="closeWelcomeModal" class="modal__contentContainer__content__splitter__right__closeContainer">
                                <svg class="modal__contentContainer__content__splitter__right__closeContainer__svg">
                                    <use xlink:href="{{asset("images/sprite.svg#close")}}"></use>
                                </svg>
                            </a>
                            {{--   Forms  --}}
                            <div class="modal__contentContainer__content__splitter__right__formContainer">
                                @if($isOpen=="login")
                                    @livewire('auth.login-modal')
                                @elseif($isOpen=="register")
                                    @livewire('auth.register-modal')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
