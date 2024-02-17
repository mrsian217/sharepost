@extends('layouts.app')

@section('content')
    <div class="sm:flex sm:flex-row sm:gap-10">
        <div class="sm:w-1/2 mt-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
        </div>
        <div class="sm:w-1/2 mt-36 ml-28">
            @if (Auth::id() == $user->id)
                <form action="{{ route('profires.update', ['profire' => $profire->id]) }}" method="POST" enctype="multipart/form-data" class="flex">
                @csrf
                    <div class="form-control my-4 ">
                        <label for="content" class="label">
                            <span class="label-text text-lg">profire:</span>
                        </label>
                         <textarea name="content" class="input input-bordered text-left w-80 h-48"></textarea>
                    </div>
                    <button type="submit" class="btn btn-secondary mt-80 ml-2">update</button>
                </form>
            @endif
        </div>
    </div>
@endsection