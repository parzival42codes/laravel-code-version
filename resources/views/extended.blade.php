@include('layouts.partials.header')
<div id="extendedException">
    <div class="container-flex"
         style="flex-direction: column;">
        <div class="card">
            <div class="card-header text-center extendedException-title">
                {{ $title }}
            </div>

            <div class="card-body">
                <div class="text-center">{{ $text }}</div>
            </div>
        </div>

        @debug()
        <div style="display:flex;">
            <div class="card" style="flex:2;">
                <div class="card-header text-center">Debug Message</div>
                <div class="card-body">
                    {!! $debugMessage ?? '' !!}
                </div>
            </div>
            <div class="card" style="flex: 1;">
                <div class="card-header text-center">Message Hashed</div>
                <div class="card-body" style="overflow: auto; line-break: anywhere;max-height: 5em;">
                    {!! $messageHashed ?? '' !!}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center">Context</div>
            <div class="card-body" style="white-space: pre;overflow: auto; max-height: 10em;">
                {!! $contextFormatted ?? '' !!}
            </div>
        </div>
        <div class="card">
            <div class="card-header text-center">Backtrace</div>
            <div class="card-body">
                {!! $backtraceTable ?? '' !!}
            </div>
        </div>
        @debugEnd()
    </div>
</div>
@include('layouts.partials.footer')
