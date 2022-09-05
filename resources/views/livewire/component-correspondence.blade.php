<div>
    <div class="p-2 grid grid-cols-1 md:grid-cols-12 gap-4 bg-gray-50 dark:bg-gray-900">
        <div class="col-span-1 sm:col-span-3 mx-auto sm:px-6 lg:px-8">
            <x-menu>
                <x-slot name="items">
                    <li>
                        <x-item-menu wire:click='tickets'>
                            <x-slot name="text">
                                {{ __('Tickets') }}
                            </x-slot>
                        </x-item-menu>
                    </li>
                    <li>
                        <x-item-menu wire:click='received'>
                            <x-slot name="text">
                                {{ __('Received') }}
                            </x-slot>
                        </x-item-menu>
                    </li>
                    <li>
                        <x-item-menu wire:click='pendings'>
                            <x-slot name="text">
                                {{ __('Pendings') }}
                            </x-slot>
                        </x-item-menu>
                    </li>
                    <li>
                        <x-item-menu wire:click='sent'>
                            <x-slot name="text">
                                {{ __('Sent') }}
                            </x-slot>
                        </x-item-menu>
                    </li>
                </x-slot>
            </x-menu>
        </div>

        <div class="col-span-1 sm:col-span-9 bg-gray-50 rounded dark:bg-gray-800">
            <div class="flex col-span-1 md:col-span-12 items-center gap-2">
                <div class="flex items-center w-full p-2">
                    <div class="relative w-full">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                    <button wire:click="$set('writeModal', true)"
                        class="p-2.5 ml-2 text-sm font-medium text-white bg-green-700 rounded-lg border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        {{ __('Write') }}
                    </button>
                </div>
            </div>

            <div class="col-span-1 md:col-span-8 p-2">
                <div class="overflow-x-auto">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        @if ($action == 'tickets' || $action == 'received')
                                            {{ __('Sent by') }}
                                        @endif
                                        @if ($action == 'pendings' || $action == 'sent')
                                            {{ __('Sent to') }}
                                        @endif
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Document') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('Reference') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Options</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roads as $road)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        @if ($action == 'tickets' || $action == 'received')
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                {{ $road->sentBy->user->name }}
                                                <br>
                                                <span
                                                    class="dark:text-gray-400">{{ $road->sentBy->position->name }}</span>
                                            </th>
                                        @endif
                                        @if ($action == 'pendings' || $action == 'sent')
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                {{ $road->sentTo->user->name }}
                                                <br>
                                                <span
                                                    class="dark:text-gray-400">{{ $road->sentTo->position->name }}</span>
                                            </th>
                                        @endif
                                        <td class="px-6 py-4">
                                            {{ $road->document->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $road->reference }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if ($road->file != null)
                                                <a wire:click='downloadFile({{ $road->id }})'
                                                    class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline cursor-pointer pl-2">{{ __('File') }}</a>
                                            @endif
                                            @if ($road->file == null)
                                                <a wire:click='modalUpload({{ $road->id }})'
                                                    class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline cursor-pointer pl-2">{{ __('Upload file') }}</a>
                                            @endif
                                            @if ($action == 'tickets')
                                                <a wire:click='modalAccept({{ $road->id }})'
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">{{ __('Accept') }}</a>
                                            @endif
                                            @if ($action == 'received')
                                                <a wire:click='modalResponse({{ $road->id }})'
                                                    class="font-medium text-green-600 dark:text-green-500 hover:underline cursor-pointer">{{ __('Answer') }}</a>
                                                <a wire:click='modalArchive({{ $road->id }})'
                                                    class="font-medium text-orange-600 dark:text-orange-500 hover:underline cursor-pointer">{{ __('Archive it') }}</a>
                                            @endif
                                            @if ($action == 'pendings')
                                                <a wire:click='modalSend({{ $road->id }})'
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">{{ __('Send') }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pt-2">
                    {{ $roads->links('vendor.livewire.custom') }}
                </div>
            </div>
        </div>
    </div>

    <x-dialog-modal wire:model="acceptModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-blue-500 mr-2" />
                {{ __('Accept roadmap') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex col-span-6 sm:col-span-4 items-center gap-2">
                <x-feathericon-archive class="h-20 w-20 text-blue-500 mr-2" />
                <p>
                    {{ __('Once accepted, the registration cannot be returned.') }}
                </p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('acceptModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='acceptRoad' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="writeModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-green-500 mr-2" />
                {{ __('Create roadmap') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 items-center gap-2">
                <div class="relative z-0 w-full mb-6 group">
                    <label for="sent_by"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Sent by') }}</label>
                    <select id="sent_by" wire:model="sent_by"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="null">{{ __('Select an option') }}</option>
                        @foreach ($myAssignments as $assignment)
                            <option value="{{ $assignment->id }}">
                                {{ $assignment->user->name }} - {{ $assignment->position->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="sent_by" class="mt-2" />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="sent_to"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Sent to') }}</label>
                    <select id="sent_to" wire:model="sent_to"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="null">{{ __('Select an option') }}</option>
                        @foreach ($assignments as $assignment)
                            <option value="{{ $assignment->id }}">
                                {{ $assignment->user->name }} - {{ $assignment->position->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="sent_to" class="mt-2" />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="document_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Document') }}</label>
                    <select id="document_id" wire:model="document_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="null">{{ __('Select an option') }}</option>
                        @foreach ($documents as $document)
                            <option value="{{ $document->id }}">
                                {{ $document->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="document_id" class="mt-2" />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="floating_reference" wire:model="reference"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="floating_reference"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Reference') }}
                    </label>
                    <x-jet-input-error for="reference" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="closeWrite" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='writeRoad' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="sendModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-blue-500 mr-2" />
                {{ __('Send roadmap') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex col-span-6 sm:col-span-4 items-center gap-2">
                <x-feathericon-archive class="h-20 w-20 text-blue-500 mr-2" />
                <p>
                    {{ __('Once the roadmap has been sent, it cannot be returned.') }}
                </p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('sendModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='sendRoad' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="uploadModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-yellow-500 mr-2" />
                {{ __('Upload file') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 items-center gap-2">
                <div class="relative z-0 w-full mb-6 group">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        for="file_input">{{ __('File') }}</label>
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <input wire:model="file"
                            class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="upload{{ $iteration }}" type="file">
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    <x-jet-input-error for="file" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('uploadModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='uploadRoad' wire:loading.attr="disabled"
                wire:target="uploadRoad, file">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="responseModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-green-500 mr-2" />
                {{ __('Response roadmap') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4 items-center gap-2">
                <div class="relative z-0 w-full mb-6 group">
                    <label for="sent_by"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Sent by') }}</label>
                    <select id="sent_by" wire:model="sent_by"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="null">{{ __('Select an option') }}</option>
                        @foreach ($myAssignments as $assignment)
                            <option value="{{ $assignment->id }}">
                                {{ $assignment->user->name }} - {{ $assignment->position->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="sent_by" class="mt-2" />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="sent_to"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Sent to') }}</label>
                    <select id="sent_to" wire:model="sent_to"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="null">{{ __('Select an option') }}</option>
                        @foreach ($assignments as $assignment)
                            <option value="{{ $assignment->id }}">
                                {{ $assignment->user->name }} - {{ $assignment->position->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="sent_to" class="mt-2" />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="document_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ __('Document') }}</label>
                    <select id="document_id" wire:model="document_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="null">{{ __('Select an option') }}</option>
                        @foreach ($documents as $document)
                            <option value="{{ $document->id }}">
                                {{ $document->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="document_id" class="mt-2" />
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="floating_reference" wire:model="reference"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="floating_reference"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('Reference') }}
                    </label>
                    <x-jet-input-error for="reference" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('responseModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='responseRoad' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="archiveModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-orange-500 mr-2" />
                {{ __('Archive the roadmap') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex col-span-6 sm:col-span-4 items-center gap-2">
                <x-feathericon-archive class="h-20 w-20 text-orange-500 mr-2" />
                <p>
                    {{ __('Once archive, the registration cannot be returned.') }}
                </p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('archiveModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-danger-button>
            <x-jet-secondary-button class="ml-2" wire:click='archive' wire:loading.attr="disabled">
                {{ __('Accept') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
