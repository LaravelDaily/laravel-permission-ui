<x-app-layout>
    <x-slot name="header">
        {{ __('My profile') }}
    </x-slot>

    @if ($message = Session::get('success'))
        <div class="mb-4 inline-flex w-full overflow-hidden rounded-lg bg-white shadow-md">
            <div class="flex w-12 items-center justify-center bg-green-500">
                <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                    </path>
                </svg>
            </div>

            <div class="-mx-3 px-4 py-2">
                <div class="mx-3">
                    <span class="font-semibold text-green-500">Success</span>
                    <p class="text-sm text-gray-600">{{ $message }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="rounded-lg bg-white p-4 shadow-md">

        <form action="{{ route(config('permission_ui.route_name_prefix') . 'users.update', $user) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="text-base font-medium text-gray-700">
                {{ __('PermissionsUI::permissions.users.fields.name') }}: <span class="font-bold">{{ $user->name }}</span>
            </div>

            @if($roles->count())
                <div class="mt-4 space-y-2">
                    <label class="block text-base font-medium text-gray-700" for="permissions">{{ __('PermissionsUI::permissions.users.fields.roles') }}</label>
                    <div class="space-x-2">
                        @foreach($roles as $id => $name)
                            <div class="inline-flex space-x-1">
                                <input class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple" type="checkbox" name="roles[]" id="role-{{ $id }}" value="{{ $id }}" @checked(in_array($id, old('roles', [])) || $user->roles->contains($id))>
                                <x-input-label for="role-{{ $id }}" :value="$name" />
                            </div>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                </div>
            @endif

            <div class="mt-4">
                <x-primary-button>
                    {{ __('PermissionsUI::permissions.global.save') }}
                </x-primary-button>
            </div>
        </form>

    </div>
</x-app-layout>