<div>
    @if ($messages)
        <div class="flash">
            <div class="flash__container">
                @foreach($messages as $index => $flash)
                    <div class="flash__container__type flash__container__type--{{ $flash['type'] }}"
                         x-data="{ show: true }"
                         x-init="setTimeout(() => show = false, 6000)"
                         x-show="show">
                        <p class="flash__container__type__name">
                            {{ $flash['title'] }}
                        </p>
                        @if($flash['message'])
                            <p class="flash__container__type__message">
                                {{ $flash['message'] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
