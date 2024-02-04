@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="sm:flex sm:flex-row ml-0 mr-2 sm:gap-10 mx-auto">
            <div class="sm:w-1/2 mt-4">
            {{-- ユーザ情報 --}}
               @include('users.card')
               <a class="mt-16 w-64 ml-24 btn btn-warning" href="{{ route('shareposts.create') }}">Let's share today!</a>
            </div>
            <div class="sm:w-1/2 mt-4">
            {{-- 投稿一覧 --}}
               @include('shareposts.shareposts')
            </div>
        </div>
    @else
            <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
                <div class="mt-3 hero-content text-center my-10">
                    <div class="max-w-md mb-10">
                    <h2 style="margin-bottom: 0.05rem;">Welcome to the Share:Me!!</h2>
            　　      <h3 style="margin-top: 0; font-size: 1rem;">Let's start to share your today^^</h3>
                      {{-- ユーザ登録ページへのリンク --}}
                    <a class="btn btn-warning btn-lg normal-case" href="{{ route('register') }}">Sign up now!</a>
                    </div>
                </div>
            </div>
    @endif
@endsection
