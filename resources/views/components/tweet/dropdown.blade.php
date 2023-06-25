<div class="flex flex-shrink-0 self-center">
    <div id="overlay" class="hidden fixed top-0 left-0 bg-opacity-100 w-full h-full z-5"></div>
    <div class="relative inline-block text-left">
        <div>
            <button type="button" class="options-button -m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600" id="menu-0-button" aria-expanded="false" aria-haspopup="true" data-target="drop-menu-{{ $tweet->id }}" data-overlay="overlay-{{ $tweet->id }}">
                <span class="sr-only">Open options</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                </svg>
            </button>
        </div>
        <div id="drop-menu-{{ $tweet->id }}" class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-0-button" tabindex="-1">
            <div class="py-1" role="none">
                @if (!in_array(Auth::id(), array_column($tweet->favorites->toArray(), 'user_id'), true))
                    <form action="#" method="post" class="text-gray-700 group flex items-center px-4 py-2 text-sm cursor-pointer" role="menuitem" tabindex="-1">
                        @csrf
                        <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                        <button type="button" class="favorite-button flex" data-favorite="{{ $tweet->id }}">
                            <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p>お気に入り</p>
                        </button>
                    </form>
                @else
                    <form action="#" method="post" class="text-gray-700 group flex items-center px-4 py-2 text-sm cursor-pointer" role="menuitem" tabindex="-1">
                        @csrf
                        <button type="button" class="unfavorite-button flex" data-favorite="{{ $tweet->id }}">
                            <svg class="mr-3 h-5 w-5 text-yellow-400 group-hover:text-yellow-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p>お気に入り解除</p>
                        </button>
                    </form>
                @endif
                @if ($tweet->user_id === Auth::id())
                    <p class="edit-tweet-button text-gray-700 group flex items-center px-4 py-2 text-sm cursor-pointer" role="menuitem" tabindex="-1" data-target="edit-tweet-{{ $tweet->id }}">
                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                            <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                        </svg>
                        編集する
                    </p>
                    <p class="delete-tweet-button text-gray-700 group flex items-center px-4 py-2 text-sm cursor-pointer" role="menuitem" tabindex="-1" data-target="delete-modal-{{ $tweet->id }}">
                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                clip-rule="evenodd" />
                        </svg>
                        削除する
                    </p>
                @endif
            </div>
        </div>
    </div>

</div>
