<x-app-layout>
    <x-slot name="header">
        {{ __('PermissionsUI::permissions.global.edit') }} {{ __('PermissionsUI::permissions.users.title_singular') }}
    </x-slot>

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
                                <input class="text-purple-600 form-checkbox focus:shadow-outline-purple focus:border-purple-400 focus:outline-none" type="checkbox" name="roles[]" id="role-{{ $id }}" value="{{ $id }}" @checked(in_array($id, old('roles', [])) || $user->roles->contains($id))>
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