<form wire:submit="submitForm" action="#" class="contact__contentContainer__formContainer__form welcome-form">
    <div class="welcome-form__row">
        <div class="welcome-form__inputContainer">
            <label for="firstname" class="welcome-form__inputContainer__label">Prénom</label>
            <input wire:model="form.firstname" type="text" id="firstname" class="welcome-form__inputContainer__input" placeholder="Votre prénom">
            @error('form.firstname')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="welcome-form__inputContainer">
            <label for="name" class="welcome-form__inputContainer__label">Nom</label>
            <input wire:model="form.lastname" type="text" id="name" class="welcome-form__inputContainer__input" placeholder="Votre nom">
            @error('form.lastname')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="welcome-form__inputContainer">
        <label for="email" class="welcome-form__inputContainer__label">Email</label>
        <input wire:model="form.email" type="email" id="email" class="welcome-form__inputContainer__input" placeholder="Votre email">
        @error('form.email')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div class="welcome-form__inputContainer">
        <label for="message" class="welcome-form__inputContainer__label">Message</label>
        <textarea wire:model="form.message" name="message" id="message" class="welcome-form__inputContainer__textarea" placeholder="Votre message"></textarea>
        @error('form.message')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="welcome-form__button button">Envoyer</button>
</form>
