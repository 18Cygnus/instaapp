@extends('users.layout.user')

@section('user')
    <section class="flex flex-col w-full items-center bg-gray-200 pb-16">
        <div class="flex items-center justify-between w-[500px] px-4 py-5 bg-white fixed">
            <h1 class="text-2xl font-bold">Instagram</h1>
            <i class="ri-chat-1-line text-2xl"></i>
        </div>
        <div class="p-3 flex w-full flex-col gap-2 pt-20">
            @foreach ( $posts as $post )
            <div class="card-contents w-full bg-white flex flex-col rounded-xl pb-4">
                <div class="card-profile px-4 py-3 flex items-center justify-between gap-4">
                    <div class="left-profile flex items-center gap-4">
                        <img src="{{ asset('img/profile.png') }}" alt="" class="w-10 rounded-full">
                        <p>Arya</p>
                    </div>
                    <div class="right-profile">
                        <i class="ri-more-fill"></i>
                    </div>
                </div>
                <div class="card-content">
                    <img src="{{ route('image.show', $post->image) }}" alt="" class="w-full">
                    <p class="mt-1 px-4">{{$post->text}}</p>
                </div>
                <div class="card-action px-4 py-1 flex items-center gap-3">
                    <div class="flex items-center gap-1">
                        <i class="ri-heart-line"></i>
                        <p>10</p>
                    </div>
                    <div class="flex items-center gap-1">
                        <i class="ri-message-3-line"></i>
                        <p>3</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </section>
@endsection