<div>
    <p class="text-sm mb-2">profile:</p>
    <div class="border border-gray-300 p-4">
        @if (isset($profires))
            @foreach ($profires as $profire)
                <p class="text-sm">{{ $profire->content }}</p>
            @endforeach
        @endif
    </div>
</div>