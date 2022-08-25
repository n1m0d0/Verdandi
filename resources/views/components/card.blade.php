<div class="w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <div class="flex flex-col items-center pb-10 pt-6">
        {{ $icon }}
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $text }}</h5>
        <span class="text-xl text-gray-500 dark:text-gray-400">{{ $count }}</span>
        <div class="flex mt-4 space-x-3 lg:mt-6">
            {{ $link }}
        </div>
    </div>
</div>