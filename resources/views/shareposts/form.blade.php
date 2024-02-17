@extends('layouts.app')

@section('content')
 <h1 class="text-4xl font-bold ml-8 mt-16 text-yellow-500">Let's share today!!!</h1>
@if (Auth::id() == $user->id)
    <div class="my-24 mx-auto flex justify-center">
        <form action="{{ route('shareposts.store') }}" method="POST" enctype="multipart/form-data" class="flex">
            @csrf
            <div class="mr-12">
                <h3 class="mb-4">The best photo of the day↓↓↓</h3>
                <div class="relative">
                    <input type="file" name="img_path" id="img_path" class="hidden" onchange="displayImagePreview(this)(this)">
                    <button type="button" class="bg-gray-100 w-80 h-12 cursor-pointer flex items-center justify-center border border-gray-400 rounded" onclick="document.getElementById('img_path').click()">
                        <span class="text-gray-600 text-sm">画像を選択</span>
                    </button>
                    <img id="imagePreview" class="hidden mt-4" style="max-width: 320px;" alt="Selected Image Preview">
                </div>
            </div>

            <div class="flex-1">
                <div class="form-control my-4 ml-28">
                    <label for="title" class="label">
                        <span class="label-text">today's title:</span>
                    </label>
                    <input type="text" name="title" class="input input-bordered w-80">
                </div>

                <div class="form-control my-4 mx-28">
                    <label for="content" class="label">
                        <span class="label-text">comment:</span>
                    </label>
                    <input type="text" name="comment" class="input input-bordered w-80 h-24">
                </div>

                <button type="submit" class="bg-red-500 text-black py-2 px-8 ml-96 rounded cursor-pointer">go!</button>
            </div>
        </form>
    </div>
@endif
　　<script>
        function displayImagePreview(input) {
            var preview = document.getElementById('imagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
