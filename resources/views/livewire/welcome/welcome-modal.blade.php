<div class="welcomeModal">
    {{--    Buttons  --}}
    <div wire:click="setModal('login')" class="button button--light login-button">{{__("Login")}}</div>
    <div wire:click="setModal('register')" class="button">{{__("Register")}}</div>

    {{--    Template    --}}
    @if($isOpen)
        <div class="modal" wire:keydown.escape.window="closeWelcomeModal" wire:click.self="closeWelcomeModal">
            <div class="modal__contentContainer  modal__contentContainer--welcomeModal">
                <div class="modal__contentContainer__content">
                    {{--     Splitter    --}}
                    <div class="modal__contentContainer__content__splitter">
                        {{--   Left part   --}}
                        <div class="modal__contentContainer__content__splitter__left">
                            <img src="{{asset('/images/welcome/welcome-fifth-illu.jpg')}}" alt="" class="modal__contentContainer__content__splitter__left__illu modal__contentContainer__content__splitter__left__illu--first">
                            <img src="{{asset('/images/welcome/welcome-sixth-illu.jpg')}}" alt="" class="modal__contentContainer__content__splitter__left__illu modal__contentContainer__content__splitter__left__illu--second">
                            <p class="modal__contentContainer__content__splitter__left__welcome">
                                @if($modalType=="login"){{__("Welcome back !")}}
                                @elseif($modalType=="register"){{__("Welcome !")}}
                                @elseif($modalType=="forgotPassword"){{__("Almost back !")}}@endif
                            </p>
                            <a href="/" wire:navigate class="modal__contentContainer__content__splitter__left__logo">
                                <x-application-logo/>
                            </a>
                            @if($modalType=="login")
                                <span class="modal__contentContainer__content__splitter__left__register">{{__("Not already registered ?")}}<span wire:click="setModal('register')" title="Login" class="fakeLink"> {{__("Register now !")}}</span></span>
                            @elseif($modalType=="register")
                                <span class="modal__contentContainer__content__splitter__left__register">{{__("Already registered ?")}}<span wire:click="setModal('login')" title="register" class="fakeLink">{{__("Login !")}}</span></span>
                            @elseif($modalType=="forgotPassword")
                                <span class="modal__contentContainer__content__splitter__left__register">{{__("Already registered ?")}}<span wire:click="setModal('login')" title="login" class="fakeLink">{{__("Login !")}}</span></span>
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
                                @if($modalType=="login")
                                    @livewire('auth.login-modal')
                                @elseif($modalType=="register")
                                    @livewire('auth.register-modal')
                                @elseif($modalType=="forgotPassword")
                                    @livewire('auth.forgot-password-modal')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
