<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ホーム') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <img class="inline-block h-10 w-10 rounded-full" src="{{ asset('storage/' . Auth::user()->image) }}">
                        </div>
                        <div class="min-w-0 flex-1">
                            <form action="{{ route('tweets.store') }}" method="post">
                                @csrf
                                <div class="border-b border-gray-200 focus-within:border-indigo-600">
                                    <label for="comment" class="sr-only">投稿を追加する</label>
                                    <textarea rows="3" name="tweet" id="tweet" class="block w-full resize-none border-0 border-b border-transparent p-0 pb-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-0 sm:text-sm sm:leading-6" placeholder="投稿を追加する"></textarea>
                                </div>
                                <div class="flex justify-end pt-2">
                                    <div class="flex items-center justify-between space-x-3 px-2 py-2 sm:px-3">
                                        <div class="flex">
                                            <label class="group -my-2 -ml-2 inline-flex items-center rounded-full px-3 py-2 text-left text-gray-400">
                                                <svg class="-ml-1 mr-2 h-5 w-5 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-sm italic text-gray-500 group-hover:text-gray-600">ファイルを追加する</span>
                                                <input id="image" name="image" type="file" class="sr-only">
                                            </label>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">投稿する</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @foreach ($tweets as $tweet)
                        <div class="bg-white px-4 py-5 sm:px-6 border-b border-gray-200 pb-5">
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $tweet->user->image) }}" alt="">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">
                                                <a href="#" class="hover:underline">{{ $tweet->user->name }}</a>
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                <a href="#" class="hover:underline">{{ $tweet->created_at->diffForHumans() }}</a>
                                            </p>
                                        </div>
                                        @if ($tweet->user_id === Auth::id())
                                            <div class="flex flex-shrink-0 self-center">
                                                <div class="relative inline-block text-left">
                                                    <div>
                                                        <button type="button" class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600" id="menu-0-button" aria-expanded="false" aria-haspopup="true">
                                                            <span class="sr-only">Open options</span>
                                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <!--
                                                    Dropdown menu, show/hide based on menu state.

                                                    Entering: "transition ease-out duration-100"
                                                    From: "transform opacity-0 scale-95"
                                                    To: "transform opacity-100 scale-100"
                                                    Leaving: "transition ease-in duration-75"
                                                    From: "transform opacity-100 scale-100"
                                                    To: "transform opacity-0 scale-95"
                                                -->
                                                    <div class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-0-button" tabindex="-1">
                                                        <div class="py-1" role="none">
                                                            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                                            <a href="#" class="text-gray-700 flex px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-0">
                                                                <svg class="mr-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                <span>いいね</span>
                                                            </a>
                                                            <a href="#" class="text-gray-700 flex px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-1">
                                                                <svg class="mr-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M6.28 5.22a.75.75 0 010 1.06L2.56 10l3.72 3.72a.75.75 0 01-1.06 1.06L.97 10.53a.75.75 0 010-1.06l4.25-4.25a.75.75 0 011.06 0zm7.44 0a.75.75 0 011.06 0l4.25 4.25a.75.75 0 010 1.06l-4.25 4.25a.75.75 0 01-1.06-1.06L17.44 10l-3.72-3.72a.75.75 0 010-1.06zM11.377 2.011a.75.75 0 01.612.867l-2.5 14.5a.75.75 0 01-1.478-.255l2.5-14.5a.75.75 0 01.866-.612z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                <span>Embed</span>
                                                            </a>
                                                            <a href="#" class="text-gray-700 flex px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-0-item-2">
                                                                <svg class="mr-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path d="M3.5 2.75a.75.75 0 00-1.5 0v14.5a.75.75 0 001.5 0v-4.392l1.657-.348a6.449 6.449 0 014.271.572 7.948 7.948 0 005.965.524l2.078-.64A.75.75 0 0018 12.25v-8.5a.75.75 0 00-.904-.734l-2.38.501a7.25 7.25 0 01-4.186-.363l-.502-.2a8.75 8.75 0 00-5.053-.439l-1.475.31V2.75z" />
                                                                </svg>
                                                                <span>Report content</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="mt-2 text-gray-500">{{ $tweet->tweet }}</p>
                                    @if (!$tweet->image === null)
                                        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                                            <!-- We've used 3xl here, but feel free to try other max-widths based on your needs -->
                                            <div class="mx-auto max-w-3xl">
                                                <img src="{{ 'storage/' . $tweet->image }}">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
