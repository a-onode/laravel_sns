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
                            <form action="{{ route('tweets.store') }}" method="post" enctype="multipart/form-data">
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
                                                        <button type="button" class="options-button -m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600" id="menu-0-button" aria-expanded="false" aria-haspopup="true" data-target="drop-menu-{{ $tweet->id }}">
                                                            <span class="sr-only">Open options</span>
                                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div id="drop-menu-{{ $tweet->id }}" class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-0-button" tabindex="-1">
                                                        <div class="py-1" role="none">
                                                            <form action="{{ route('comments.store') }}" method="post" class="text-gray-700 group flex items-center px-4 py-2 text-sm cursor-pointer" role="menuitem" tabindex="-1">
                                                                @csrf
                                                                <input type="hidden" name="favorite" value="{{ $tweet->id }}">
                                                                <button type="submit" class="flex">
                                                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                        <path
                                                                            d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z" />
                                                                    </svg>
                                                                    お気に入り
                                                                </button>

                                                            </form>
                                                            <p class="edit-tweet-button text-gray-700 group flex items-center px-4 py-2 text-sm cursor-pointer" role="menuitem" tabindex="-1" data-target="edit-tweet-{{ $tweet->id }}">
                                                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                                                    <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                                                </svg>
                                                                編集する
                                                            </p>
                                                            <p class="text-gray-700 group flex items-center px-4 py-2 text-sm cursor-pointer" role="menuitem" tabindex="-1" id="menu-item-6">
                                                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                削除する
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="mt-2 text-gray-500">{{ $tweet->tweet }}</p>
                                    @if (!is_null($tweet->image))
                                        <div class="mx-auto max-w-7xl px-4 pt-4 sm:px-6 lg:px-8">
                                            <div class="flex justify-center mx-auto max-w-4xl">
                                                <img src="{{ 'storage/' . $tweet->image }}" class="rounded-lg shadow-md">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div id="edit-tweet-{{ $tweet->id }}" class="edit-modal hidden relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-20 transition-opacity"></div>

                                    <div class="fixed inset-0 z-10 overflow-y-auto">
                                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                                            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-lg transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                                <div class="flex items-start space-x-4">
                                                    <div class="flex-shrink-0">
                                                        <img class="inline-block h-10 w-10 rounded-full" src="{{ asset('storage/' . Auth::user()->image) }}">
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <form action="{{ route('tweets.update', ['tweet' => $tweet->id]) }}" method="post" enctype="multipart/form-data">
                                                            @method('put')
                                                            @csrf
                                                            <div class="border-b border-gray-200 focus-within:border-indigo-600">
                                                                <label for="tweet" class="sr-only">投稿を編集する</label>
                                                                <textarea rows="3" name="tweet" id="tweet" class="block w-full resize-none border-0 border-b border-transparent p-0 pb-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-0 sm:text-sm sm:leading-6" placeholder="投稿を編集する">{{ $tweet->tweet }}</textarea>
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
                                                                        <button type="button" class="close-modal-button inline-flex items-center rounded-md px-3 py-2 text-sm font-semibold ttext-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" data-target="close-moodal-{{ $tweet->id }}">キャンセル</button>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">編集する</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
