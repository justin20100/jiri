<form wire:submit="submitForm" action="#" class="contact__contentContainer__formContainer__form welcome-form">
    <div class="welcome-form__row">
        <div class="welcome-form__inputContainer">
            <label for="firstname" class="welcome-form__inputContainer__label">Prénom</label>
            <input wire:model="form.firstname" type="text" id="firstname" class="welcome-form__inputContainer__input" placeholder="Votre prénom">
            @error('form.firstname')
                <div class="errorContainer">
                    <span class="errorContainer__error">{{ $message }}</span>
                </div>
            @enderror
        </div>
        <div class="welcome-form__inputContainer">
            <label for="name" class="welcome-form__inputContainer__label">Nom</label>
            <input wire:model="form.lastname" type="text" id="name" class="welcome-form__inputContainer__input" placeholder="Votre nom">
            @error('form.lastname')
                <div class="errorContainer">
                    <span class="errorContainer__error">{{ $message }}</span>
                </div>
            @enderror
        </div>
    </div>
    <div class="welcome-form__inputContainer">
        <label for="email" class="welcome-form__inputContainer__label">Email</label>
        <input wire:model="form.email" type="email" id="email" class="welcome-form__inputContainer__input" placeholder="Votre email">
        @error('form.email')
            <div class="errorContainer">
                <span class="errorContainer__error">{{ $message }}</span>
            </div>
        @enderror
    </div>
    <div class="welcome-form__inputContainer">
        <label for="message" class="welcome-form__inputContainer__label">Message</label>
        <textarea wire:model="form.message" name="message" id="message" class="welcome-form__inputContainer__textarea" placeholder="Votre message"></textarea>
        @error('form.message')
            <div class="errorContainer">
                <span class="errorContainer__error">{{ $message }}</span>
            </div>
        @enderror
    </div>
    <button type="submit" class="welcome-form__button button">Envoyer</button>
</form>
