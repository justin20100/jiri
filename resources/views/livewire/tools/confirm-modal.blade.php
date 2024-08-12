<div>
    @if($show)
        <div class="confirmModal">
            <div class="confirmModal__contentContainer">
                @if($titleMessage)
                    <p class="confirmModal__contentContainer__titleMessage">{{$titleMessage}}</p>
                @endif
                @if($message)
                    <p class="confirmModal__contentContainer__message">{{$message}}</p>
                @endif
                <div class="confirmModal__contentContainer__buttons">
                    <button wire:click="cancel" class="confirmModal__contentContainer__buttons__button confirmModal__contentContainer__buttons__button--cancel button button--small button--red">
                        {{__('Cancel')}}</button>
                    <button wire:click="confirm" class="confirmModal__contentContainer__buttons__button confirmModal__contentContainer__buttons__button--confirm button button--small">
                        {{__('Confirm')}}</button>
                </div>
            </div>
        </div>
    @endif
</div>
