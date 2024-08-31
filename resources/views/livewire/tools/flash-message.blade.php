<div>
    @if (session('success') || session('error'))
        <div class="flash">
            <div class="flash__container">
                @if (session('success'))
                    <div class="flash__container__type flash__container__type--success"
                         x-data="{ show: true }"
                         x-init="setTimeout(() => show = false, 8000)"
                         x-show="show"
                         @flash-message-show.window="show = true">
                        <p class="flash__container__type__name">
                            {{ $successName }}
                        </p>
                        <p class="flash__container__type__message">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif
                @if (session('error'))
                    <div class="flash__container__type flash__container__type--error"
                         x-data="{ show: true }"
                         x-init="setTimeout(() => show = false, 8000)"
                         x-show="show"
                         @flash-message-show.window="show = true">
                        <p class="flash__container__type__name">
                            {{ $errorName }}
                        </p>
                        <p class="flash__container__type__message">
                            {{ session('error') }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
