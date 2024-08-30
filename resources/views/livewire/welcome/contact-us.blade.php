<form wire:submit="submitForm" action="#" class="contact__contentContainer__formContainer__form welcome-form">
    <div class="welcome-form__row">
        {{--  FIRSTNAME INPUT  --}}
        <div class="welcome-form__inputContainer">
            <label for="firstname" class="welcome-form__inputContainer__label">{{__("Firstname")}}</label>
            <input wire:model="form.firstname" type="text" id="firstname" class="welcome-form__inputContainer__input" placeholder="{{__("Your firstname")}}">
            @error('form.firstname')
                <div class="errorContainer">
                    <span class="errorContainer__error">{{ $message }}</span>
                </div>
            @enderror
        </div>
        {{--  LASTNAME INPUT  --}}
        <div class="welcome-form__inputContainer">
            <label for="name" class="welcome-form__inputContainer__label">{{__("Lastname")}}</label>
            <input wire:model="form.lastname" type="text" id="name" class="welcome-form__inputContainer__input" placeholder="{{__("Your lastname")}}">
            @error('form.lastname')
                <div class="errorContainer">
                    <span class="errorContainer__error">{{ $message }}</span>
                </div>
            @enderror
        </div>
    </div>
    {{--  EMAIL INPUT  --}}
    <div class="welcome-form__inputContainer">
        <label for="email" class="welcome-form__inputContainer__label">{{__("Email")}}</label>
        <input wire:model="form.email" type="email" id="email" class="welcome-form__inputContainer__input" placeholder="{{__("Your email")}}">
        @error('form.email')
            <div class="errorContainer">
                <span class="errorContainer__error">{{ $message }}</span>
            </div>
        @enderror
    </div>
    {{--  MESSAGE INPUT  --}}
    <div class="welcome-form__inputContainer">
        <label for="message" class="welcome-form__inputContainer__label">{{__("Message")}}</label>
        <textarea wire:model="form.message" name="message" id="message" class="welcome-form__inputContainer__textarea" placeholder="{{__("Your message")}}"></textarea>
        @error('form.message')
            <div class="errorContainer">
                <span class="errorContainer__error">{{ $message }}</span>
            </div>
        @enderror
    </div>
    @if (session()->has('success'))
        {{--  SUCCESS  --}}
        <div class="success">
            <svg class="success__icon">
                <use xlink:href="{{asset("images/sprite.svg#check")}}"></use>
            </svg>
            <p class="success__text">{{ __('Your message has been successfully sent!') }}</p>
        </div>
        @else
        {{--  BUTTON  --}}
        <button type="submit" class="welcome-form__button button">{{__("Send message")}}</button>
    @endif
</form>
