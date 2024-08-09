<div class="confirmModal">
    @if($show)
        <div class="confirmModal__contentContainer">
            <p class="confirmModal__contentContainer__message">{{$message}}</p>
            <div class="confirmModal__contentContainer__buttons">
                <button wire:click="confirm" class="confirmModal__contentContainer__buttons__button confirmModal__contentContainer__buttons__button--confirm">Confirmer</button>
                <button wire:click="cancel" class="confirmModal__contentContainer__buttons__button confirmModal__contentContainer__buttons__button--cancel">Annuler</button>
            </div>
        </div>
    @endif
</div>
