<div>
    <x-template-information>
        <x-slot name='cards'>
            <x-card>
                <x-slot name='icon'>
                    <x-feathericon-users class="mb-3 w-10 h-10 rounded-full shadow-lg text-blue-500 mr-2" />
                </x-slot>
                <x-slot name='text'>
                    {{ __('User') }}
                </x-slot>
                <x-slot name='count'>
                    {{ count($users) }}
                </x-slot>
                <x-slot name='link'>
                    <a href="{{ route('page.user') }}"
                        class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        {{ __('Register') }}
                    </a>
                </x-slot>
            </x-card>

            <x-card>
                <x-slot name='icon'>
                    <x-feathericon-briefcase class="mb-3 w-10 h-10 rounded-full shadow-lg text-blue-500 mr-2" />
                </x-slot>
                <x-slot name='text'>
                    {{ __('Entity') }}
                </x-slot>
                <x-slot name='count'>
                    {{ count($entities) }}
                </x-slot>
                <x-slot name='link'>
                    <a href="{{ route('page.entity') }}"
                        class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        {{ __('Register') }}
                    </a>
                </x-slot>
            </x-card>

            <x-card>
                <x-slot name='icon'>
                    <x-feathericon-file-text class="mb-3 w-10 h-10 rounded-full shadow-lg text-blue-500 mr-2" />
                </x-slot>
                <x-slot name='text'>
                    {{ __('Roadmap') }}
                </x-slot>
                <x-slot name='count'>
                    {{ count($roadmaps) }}
                </x-slot>
                <x-slot name='link'>
                    <a href="#"
                        class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        {{ __('Register') }}
                    </a>
                </x-slot>
            </x-card>
        </x-slot>
    </x-template-information>
</div>