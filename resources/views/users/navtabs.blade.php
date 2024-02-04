<div class="tabs">
    {{-- フォロワー一覧タブ --}}
    <a href="{{ route('users.followers', $user->id) }}" class="tab tab-lifted grow {{ Request::routeIs('users.followers') ? 'tab-active' : '' }}">
        Followers
        <div class="badge ml-1">{{ $user->followers_count }}</div>
    </a>
</div>