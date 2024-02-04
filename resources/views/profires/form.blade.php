@extends('layouts.app')

@section('content')
    <div class="sm:flex sm:flex-row sm:gap-10">
        <div class="sm:w-1/2 mt-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
        </div>
        <div class="sm:w-1/2 mt-4">
            @if (Auth::id() == $user->id)
                <form action="{{ route('profires.update') }}" method="POST" enctype="multipart/form-data" class="flex">
                @csrf
                    <div class="form-control my-4 ml-28">
                        <label for="content" class="label">
                            <span class="label-text">profire:</span>
                        </label>
                        <input type="text" name="content" class="input input-bordered w-64 h-48">
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection