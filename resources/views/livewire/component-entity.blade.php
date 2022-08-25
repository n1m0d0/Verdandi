<div>
    <x-template-form>
        <x-slot name='search'>
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
        </x-slot>
        <x-slot name='form'>
            <div class="p-2">
                <div class="relative z-0 w-full mb-6 group">
                    <label for="parent_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Entity') }}</label>
                    <select id="parent_id" wire:model="parent_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="null">Seleccione un opcion</option>
                        @foreach ($entities as $entity)
                            @if ($action == 'create')
                                <option value="{{ $entity->id }}">{{ $entity->name }}</option>
                            @else
                                @if ($entity->id != $entity_id)
                                    <option value="{{ $entity->id }}">{{ $entity->name }}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="floating_name" wire:model="name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="floating_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Name') }}
                    </label>
                    <x-jet-input-error for="name" class="mt-2" />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="floating_abbreviation" wire:model="abbreviation"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="floating_abbreviation"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Abbreviation') }}
                    </label>
                    <x-jet-input-error for="abbreviation" class="mt-2" />
                </div>
                @if ($action == 'create')
                    <button wire:click='store'
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ __('Save') }}
                    </button>
                @else
                    <button wire:click='update'
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        {{ __('Update') }}
                    </button>
                @endif
            </div>
        </x-slot>
        <x-slot name='table'>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Name') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Abbreviation') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Dependents') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Options</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entities as $entity)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ $entity->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $entity->abbreviation }}
                                </td>
                                <td class="px-6 py-4">
                                    <ul
                                        class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        @foreach ($entity->entities as $child)
                                            <li class="w-full px-4 py-2 border-b border-gray-200 dark:border-gray-600">
                                                {{ $child->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a wire:click='edit({{ $entity->id }})'
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">{{ __('Edit') }}</a>
                                    <a wire:click='modalDelete({{ $entity->id }})'
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer pl-2">{{ __('Delete') }}</a>
                                    <a href="{{ route('page.position', $entity->id) }}"
                                        class="font-medium text-green-600 dark:text-green-500 hover:underline cursor-pointer pl-2">{{ __('Positions') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
        <x-slot name='paginate'>
            {{ $entities->links('vendor.livewire.custom') }}
        </x-slot>
    </x-template-form>

    <x-dialog-modal wire:model="deleteModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-red-500 mr-2" />
                {{ __('Delete entity') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex col-span-6 sm:col-span-4 items-center gap-2">
                <x-feathericon-trash class="h-20 w-20 text-red-500 mr-2" />
                <p>
                    {{ __('Once deleted, the record cannot be recovered.') }}
                </p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('deleteModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='delete' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>