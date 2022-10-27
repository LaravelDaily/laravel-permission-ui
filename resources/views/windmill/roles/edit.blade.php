<x-app-layout>
    <x-slot name="header">
        {{ __('PermissionsUI::permissions.global.edit') }} {{ __('PermissionsUI::permissions.roles.title_singular') }}
    </x-slot>

    <div class="rounded-lg bg-white p-4 shadow-md">

        <form action="{{ route(config('permission_ui.route_name_prefix') . 'roles.update', $role) }}" method="POST">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="name" :value="__('PermissionsUI::permissions.roles.fields.name')"/>
                <x-text-input type="text"
                         id="name"
                         name="name"
                         class="block w-full"
                         value="{{ old('name', $role->name) }}"
                         required/>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            @if($permissions->count())
                <div class="mt-4 space-y-2">
                    <x-input-label for="permissions" :value="__('PermissionsUI::permissions.roles.fields.permissions')" />
                    <div class="space-x-2">
                        @foreach($permissions as $id => $name)
                            <div class="inline-flex space-x-1">
                                <input class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple" type="checkbox" name="permissions[]" id="permission-{{ $id }}" value="{{ $id }}" @checked(in_array($id, old('permissions', [])) || $role->permissions->contains($id))>
                                <x-input-label for="permission-{{ $id }}">{{ $name }}</x-input-label>
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
