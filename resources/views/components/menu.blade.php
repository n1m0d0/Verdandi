<aside class="w-64" aria-label="Sidebar">
    <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
        <a href="https://flowbite.com/" class="flex items-center pl-2.5 mb-5">
            <x-feathericon-inbox class="block mr-3 h-6 sm:h-7 w-auto dark:text-white" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ __('Mailbox') }}</span>
        </a>
        <ul class="space-y-2">
            {{ $items }}
        </ul>
    </div>
</aside>