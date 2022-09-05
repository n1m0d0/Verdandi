<div>

    <div class="flex flex-col col-span-1 md:col-span-12 items-center bg-gray-50 rounded dark:bg-gray-800 mb-1">
        <div class="flex items-center w-full p-2">
            <div class="relative w-full">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="simple-search" wire:model="search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="{{ __('Search') }}" required>
            </div>
            @if ($search != null)
                <button wire:click='resetSearch'
                    class="p-2.5 ml-2 text-sm font-medium text-white bg-red-700 rounded-lg border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    <x-feathericon-x-square class="w-5 h-5" />
                </button>
            @endif
        </div>

        @if ($list && $roadmaps->count() > 0)
            <div class="flex w-full h-60 col-span-1 md:col-span-12 gap-2 p-2 overflow-auto">
                <div
                    class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach ($roadmaps as $roadmap)
                        <a wire:click='record({{ $roadmap->id }})'>
                            <div
                                class="py-2 px-4 w-full border-gray-200 dark:border-gray-600 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-gray-500 dark:focus:bg-gray-500 transition cursor-pointer">
                                {{ __('Roadmap') }}: {{ $roadmap->id }}
                                <br>
                                {{ __('Created') }}: {{ $roadmap->user->name }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @if ($timeline != false)
        <div class="col-span-1 sm:col-span-12 bg-gray-50 rounded dark:bg-gray-800 p-8">

            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 mb-4">
                <div class="flex justify-between items-start p-4 rounded-t  dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ __('Roadmap') }}: {{ $roadmap->id }}
                        @if ($roadmap->status == 3)
                            <span class="text-orange-500">
                                {{ __('Archive') }}
                            </span>
                        @endif
                    </h3>
                    <button wire:click="$set('timeline', false)"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <ol class="relative border-l border-gray-200 dark:border-gray-700">
                @foreach ($roadmap->roads as $road)
                    <li class="mb-10 ml-4">
                        <div
                            class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                        </div>
                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                            {{ $road->created_at }}
                        </time>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ __('Sent by') }} <span
                                class="text-lg text-gray-700 dark:text-gray-400">{{ $road->sentBy->user->name }}</span>
                        </h3>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ __('Sent to') }} <span
                                class="text-lg text-gray-700 dark:text-gray-400">{{ $road->sentTo->user->name }}</span>
                        </h3>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ __('Reference') }}:
                        </h3>
                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                            {{ $road->reference }}
                        </p>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ __('Sent on') }} <span
                                class="text-lg text-gray-700 dark:text-gray-400">{{ $road->sent_on }}</span>
                        </h3>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ __('Delivered on') }} <span
                                class="text-lg text-gray-700 dark:text-gray-400">{{ $road->delivered_on }}</span>
                        </h3>
                        @if ($road->file != null)
                            <a wire:click='downloadFile({{ $road->id }})'
                                class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline cursor-pointer pl-2">{{ __('File') }}</a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    @endif
</div>
