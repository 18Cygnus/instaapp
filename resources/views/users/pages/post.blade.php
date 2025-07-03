@extends('users.layout.user')

@section('user')
    <section class="w-full flex justify-center bg-gray-200 h-screen items-start">
        <div class="flex items-center justify-between w-[500px] px-4 py-5 bg-white fixed">
            <h1 class="text-2xl font-bold">Post</h1>
        </div>

        <div class="mt-20 bg-white w-md p-4 rounded-lg">
            @if ($errors->any())
                <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error )
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('post.store')}}" class="w-sm mx-auto" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 for="user_avatar">Upload file</label>
                    <input name="image" required
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" 
                        id="image" type="file">
                </div>
                <div class="mb-5">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Caption</label>
                    <textarea id="text" required rows="4" name="text" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Leave your caption..."></textarea>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    Post
                </button>
            </form>
        </div>

    </section>
@endsection