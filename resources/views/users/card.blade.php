@if(isset($user))
    <!-- $user が存在する場合のコード -->
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
    <div>
    @if (isset($user) && $user->profire)
    　　<div class="ml-24 mt-2">
        　　<p class="text">Profile:</p>
        　　<div class="border border-gray-300 px-4 w-60 h-32">
            　　<p class="text-sm">{{ $user->profire->content }}</p>
        　　</div>
    　　</div>
　　@endif
    </div>
        
@else
    <!-- $user が存在しない場合のコード -->
    <p>User not found</p>
@endif