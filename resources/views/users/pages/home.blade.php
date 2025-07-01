@extends('users.layout.user')

@section('user')
    <section class="flex flex-col w-full items-center pb-24">

        @foreach ( $posts as $post )
        
        <div class="card-contents w-[400px] bg-gray-200 px-4 py-2 flex flex-col gap-4 border-b border-gray-300">
            <div class="card-profile flex items-center justify-between gap-4">
                <div class="left-profile flex items-center gap-4">
                    <img src="{{ asset('img/profile.png') }}" alt="" class="w-10 rounded-full">
                    <p>Arya</p>
                </div>
                <div class="right-profile">
                    <i class="ri-more-fill"></i>
                </div>
            </div>
            <div class="card-content">
                <img src="{{ route('image.show', $post->image) }}" alt="" class="w-full rounded-xl">
                <p class="mt-1">{{$post->text}}</p>
            </div>
            <div class="card-action flex items-center gap-3">
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

    </section>
@endsection