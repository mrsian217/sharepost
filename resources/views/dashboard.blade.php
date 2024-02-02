@extends('layouts.app')

@section('content')
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
@endsection
