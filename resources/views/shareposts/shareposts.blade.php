@if (isset($shareposts))
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4">
        @foreach ($shareposts as $sharepost)
            <div class="flex flex-col items-start mb-8 border-b pb-4 border-l border-r px-2 border-gray-300 sm:w-full md:w-full"">
                {{-- ユーザー情報（アバター画像とユーザー名） --}}
                <div class="flex items-center mb-2">
                    <div class="w-8 h-8 rounded-full overflow-hidden">
                        {{-- Gravatarの表示 --}}
                        <img src="{{ Gravatar::get($sharepost->user->email) }}" alt="" class="w-full h-full object-cover" />
                    </div>
                    <a class="link link-hover text-info ml-2" href="{{ route('users.show', $sharepost->user->id) }}">{{ $sharepost->user->name }}</a>
                </div>
　　　　　　　　
                {{-- 画像の表示 --}}
                @if($sharepost->img_path)
                    <img src="{{ Storage::url($sharepost->img_path) }}" class="w-full h-full object-cover object-center mb-2">
                @endif

                {{-- タイトルと文章 --}}
                <div class="flex flex-col">
                    <p class="text-lg font-semibold">{{ $sharepost->title }}</p>
                    <p class="text-sm">{{ $sharepost->comment }}</p>
                </div>
                    {{-- 投稿日時 --}}
                    <div class="flex items-center mt-2">
                        <span class="text-muted text-gray-500 mt-2 text-center">{{ $sharepost->created_at }}</span>
                        @if (Auth::id() == $sharepost->user_id)
                                {{-- 投稿削除ボタンのフォーム --}}
                            <form method="POST" action="{{ route('shareposts.destroy', $sharepost->id) }}">
                            @csrf
                            @method('DELETE')
                                    
                            <button type="submit" class="btn btn-disabled btn-sm normal-case ml-24 " 
                                onclick="return confirm('Delete id = {{ $sharepost->id }} ?')">Delete</button>
                        </form>
                    @endif
                </div>
                </div>           
        @endforeach
    </div>
    
    {{-- ページネーションのリンク --}}
    {{ $shareposts->links() }}
@endif