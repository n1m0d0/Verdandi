<div>
    <x-template-status>
        <x-slot name='card0'>
            <div class="p-4 max-w-md bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                        {{ __('Generated documents') }}</h5>
                </div>
                <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-3 sm:py-2">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <x-feathericon-archive class="mb-3 w-5 h-5 shadow-lg text-blue-500 mr-2" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ __('Tickets') }}
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $tickets->count() }}
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-2">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <x-feathericon-archive class="mb-3 w-5 h-5 shadow-lg text-blue-500 mr-2" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ __('Received') }}
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $received->count() }}
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-2">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <x-feathericon-archive class="mb-3 w-5 h-5 shadow-lg text-blue-500 mr-2" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ __('Pendings') }}
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $pendings->count() }}
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-2">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <x-feathericon-archive class="mb-3 w-5 h-5 shadow-lg text-blue-500 mr-2" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ __('Sent') }}
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $sent->count() }}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </x-slot>

        <x-slot name='card1'>
            <x-card>
                <x-slot name='icon'>
                    <x-feathericon-file-text class="mb-3 w-10 h-10 rounded-full shadow-lg text-blue-500 mr-2" />
                </x-slot>
                <x-slot name='text'>
                    {{ __('Roadmap') }}
                </x-slot>
                <x-slot name='count'>

                </x-slot>
                <x-slot name='link'>
                    <a href="#"
                        class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        {{ __('Register') }}
                    </a>
                </x-slot>
            </x-card>
        </x-slot>

        <x-slot name='card1'>
            <x-card>
                <x-slot name='icon'>
                    <x-feathericon-file-text class="mb-3 w-10 h-10 rounded-full shadow-lg text-blue-500 mr-2" />
                </x-slot>
                <x-slot name='text'>
                    {{ __('Roadmap') }}
                </x-slot>
                <x-slot name='count'>

                </x-slot>
                <x-slot name='link'>
                    <a href="#"
                        class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        {{ __('Register') }}
                    </a>
                </x-slot>
            </x-card>
        </x-slot>

        <x-slot name='card2'>
            <x-card>
                <x-slot name='icon'>
                    <x-feathericon-file-text class="mb-3 w-10 h-10 rounded-full shadow-lg text-blue-500 mr-2" />
                </x-slot>
                <x-slot name='text'>
                    {{ __('Roadmap') }}
                </x-slot>
                <x-slot name='count'>

                </x-slot>
                <x-slot name='link'>
                    <a href="#"
                        class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        {{ __('Register') }}
                    </a>
                </x-slot>
            </x-card>
        </x-slot>

        <x-slot name='card3'>
            <x-card>
                <x-slot name='icon'>
                    <x-feathericon-file-text class="mb-3 w-10 h-10 rounded-full shadow-lg text-blue-500 mr-2" />
                </x-slot>
                <x-slot name='text'>
                    {{ __('Roadmap') }}
                </x-slot>
                <x-slot name='count'>

                </x-slot>
                <x-slot name='link'>
                    <a href="#"
                        class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        {{ __('Register') }}
                    </a>
                </x-slot>
            </x-card>
        </x-slot>

        <x-slot name='card4'>
            <x-card>
                <x-slot name='icon'>
                    <x-feathericon-file-text class="mb-3 w-10 h-10 rounded-full shadow-lg text-blue-500 mr-2" />
                </x-slot>
                <x-slot name='text'>
                    {{ __('Roadmap') }}
                </x-slot>
                <x-slot name='count'>

                </x-slot>
                <x-slot name='link'>
                    <a href="#"
                        class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        {{ __('Register') }}
                    </a>
                </x-slot>
            </x-card>
        </x-slot>
    </x-template-status>
</div>