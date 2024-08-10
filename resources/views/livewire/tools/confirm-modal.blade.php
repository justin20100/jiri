<div>
    @if($show)
        <div class="confirmModal">
            <div class="confirmModal__contentContainer">
                <p class="confirmModal__contentContainer__message">{{$message}}</p>
                <div class="confirmModal__contentContainer__buttons">
                    <button wire:click="cancel" class="confirmModal__contentContainer__buttons__button confirmModal__contentContainer__buttons__button--cancel button button--red">Annuler</button>
                    <button wire:click="confirm" class="confirmModal__contentContainer__buttons__button confirmModal__contentContainer__buttons__button--confirm button">Confirmer</button>
                </div>
            </div>
        </div>
    @endif
</div>
