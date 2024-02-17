<div class="tabs">
    {{-- フォロワー一覧タブ --}}
    <a href="{{ route('users.followers', $user->id) }}" class="tab tab-lifted grow mb-4 mt-0 ml-80 {{ Request::routeIs('users.followers') ? 'tab-active' : '' }}">
        Followers
        <div class="badge ml-1">{{ $user->followers_count }}</div>
    </a>
</div>