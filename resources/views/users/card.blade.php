<div class="card border border-base-300 w-64 h-80 ml-24 mt-16">
    <div class="card-body text-4xl">
        <h2 class="card-title">{{ $user->name }}</h2>
    </div>
    <figure>
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <img src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
    </figure>
</div>
@include('user_follow.follow_button')