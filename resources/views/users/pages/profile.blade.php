@extends('users.layout.user')

@section('user')
    <section class="flex flex-col justify-center w-full pb-16">
        <div class="profile-data w-full px-4">
            <div class="profile-action py-4 flex items-center w-full justify-between">
                <p class="text-xl font-semibold">Arya</p>
                <i class="ri-settings-3-line text-2xl"></i>
            </div>
            <div class="profile-stats flex items-center gap-10">
                <div class="w-[80px]">
                    <img src="{{ asset('img/profile.png') }}" alt="pic" class="size-[80px] rounded-2xl">
                </div>
                <div class="flex-1 flex items-center justify-start gap-8">
                    <div>
                        <p class="text-center font-bold">13</p>
                        <p>Post</p>
                    </div>
                    <div>
                        <p class="text-center font-bold">22</p>
                        <p>Followers</p>
                    </div>
                    <div>
                        <p class="text-center font-bold">15</p>
                        <p>Following</p>
                    </div>
                </div>
            </div>
            <div class="bio mt-3">
                <p class="font-bold text-[16px]">Arya</p>
                <p class="text-gray-500 font-medium text-[14px]">Web Developer</p>
            </div>
            <div class="profile-button mt-4 flex items-center gap-2 w-full justify-center">
                <button type="button" class="flex-1 px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Edit Profile</button>
                <button type="button" class="flex-1 px-4 py-2 text-xs font-medium text-center border-black border text-black bg-white rounded-lg hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300">Log Out</button>
            </div>
            <div class="highlight-story mt-4 gap-4 flex items-center justify-between">
                <div class="size-16 flex justify-center items-center bg-white border border-gray-500 rounded-full">
                    <i class="ri-add-line text-2xl"></i>
                </div>
                <div class="size-16 bg-gray-500 rounded-full"></div>
                <div class="size-16 bg-gray-500 rounded-full"></div>
                <div class="size-16 bg-gray-500 rounded-full"></div>
                <div class="size-16 bg-gray-500 rounded-full"></div>
                <div class="size-16 bg-gray-500 rounded-full"></div>
            </div>
        </div>
        <div class="profile-post grid grid-cols-3 flex-col w-full mt-4 gap-[1px]">
            <div class="h-[150px] bg-gray-400"></div>
            <div class="h-[150px] bg-gray-600"></div>
            <div class="h-[150px] bg-gray-800"></div>
            <div class="h-[150px] bg-gray-800"></div>
            <div class="h-[150px] bg-gray-800"></div>
            <div class="h-[150px] bg-gray-800"></div>
            <div class="h-[150px] bg-gray-800"></div>
            <div class="h-[150px] bg-gray-800"></div>
            <div class="h-[150px] bg-gray-800"></div>
            <div class="h-[150px] bg-gray-800"></div>
            <div class="h-[150px] bg-gray-800"></div>
            <div class="h-[150px] bg-gray-800"></div>
            <div class="h-[150px] bg-gray-800"></div>
            <div class="h-[150px] bg-gray-800"></div>
            <div class="h-[150px] bg-gray-800"></div>
        </div>
    </section>
@endsection