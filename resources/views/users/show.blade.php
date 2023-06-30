<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('プロフィール') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message />
                    <div>
                        <div>
                            <img class="h-32 w-full object-cover lg:h-48" src="{{ asset('storage/' . $user->background_image) }}">
                        </div>
                        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                            <div class="-mt-12 sm:-mt-16 sm:flex sm:items-end sm:space-x-5">
                                <div class="flex">
                                    <img class="h-24 w-24 rounded-full ring-4 ring-white sm:h-32 sm:w-32 bg-white" src="{{ asset('storage/' . $user->image) }}" alt="">
                                </div>
                                <div class="mt-6 sm:flex sm:min-w-0 sm:flex-1 sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                                    <div class="mt-6 min-w-0 flex-1 sm:hidden md:block">
                                        <h1 class="truncate text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                                    </div>
                                    @if ($user->isFollow(Auth::id()) === true)
                                        <form action="{{ route('followers.destroy', ['follower' => $user->id]) }}" method="post" class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-x-4 sm:space-y-0">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                                <span>フォロー中</span>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('followers.store') }}" method="post" class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-x-4 sm:space-y-0">
                                            @csrf
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                                            <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                <span>フォローする</span>
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                            <div class="px-4 py-5 sm:px-6">
                                <p class="mt-1 text-sm text-gray-500">{{ $user->description }}</p>
                            </div>
                        </div>
                    </div>
                    <x-user.tablist :user="$user" :tweets="$user->tweets" :favoriteTweets="$favoriteTweets" />
                </div>
            </div>
        </div>
    </div>
    <script>
        'use strict';

        {
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabBtns.forEach(clickedBtn => {
                clickedBtn.addEventListener('click', e => {
                    e.preventDefault();

                    //全てのボタンに対してスタイルを変更する
                    tabBtns.forEach(btn => {
                        btn.classList.remove('border-indigo-500', 'text-indigo-600');
                        btn.classList.add('border-transparent', 'text-gray-500', 'hover:border-gray-300', 'hover:text-gray-700');
                    });

                    clickedBtn.classList.add('border-indigo-500', 'text-indigo-600');
                    clickedBtn.classList.remove('border-transparent', 'text-gray-500', 'hover:border-gray-300', 'hover:text-gray-700');

                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });

                    //クリックされたボタンに連動するコンテンツのid属性を取得する
                    document.getElementById(clickedBtn.dataset.id).classList.remove('hidden');
                });
            });
        }
    </script>
</x-app-layout>
