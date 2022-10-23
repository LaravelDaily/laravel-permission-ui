<x-app-layout>
    <x-slot name="header">
        {{ __('PermissionsUI::permissions.global.create') }} {{ __('PermissionsUI::permissions.permissions.title_singular') }}
    </x-slot>

    <div class="rounded-lg bg-white p-4 shadow-md">

        <form action="{{ route(config('permission_ui.route_name_prefix') . 'permissions.store') }}" method="POST">
            @csrf

            <div>
                <x-input-label for="name" :value="__('PermissionsUI::permissions.permissions.fields.name')"/>
                <x-text-input type="text"
                         id="name"
                         name="name"
                         class="block w-full"
                         value="{{ old('name') }}"
                         required/>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-primary-button>
                    {{ __('PermissionsUI::permissions.global.save') }}
                </x-primary-button>
            </div>
        </form>

    </div>
</x-app-layout>
