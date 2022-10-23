<x-app-layout>
    <x-slot name="header">
        {{ __('PermissionsUI::permissions.permissions.title') }}
    </x-slot>

    <div class="mb-4 flex">
        <a class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring" href="{{ route(config('permission_ui.route_name_prefix') . 'permissions.create') }}">
            {{ __('PermissionsUI::permissions.global.create') }}
        </a>
    </div>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-2">{{ __('PermissionsUI::permissions.permissions.fields.id') }}</th>
                            <th class="px-4 py-3">{{ __('PermissionsUI::permissions.permissions.fields.name') }}</th>
                            <th class="px-4 py-3">{{ __('PermissionsUI::permissions.permissions.fields.created_at') }}</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse($permissions as $permission)
                            <tr>
                                <td class="px-4 py-3 text-sm">{{ $permission->id }}</td>
                                <td class="px-4 py-3 text-sm">{{ $permission->name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $permission->created_at }}</td>
                                <td class="px-4 divide-x-2">
                                    <a class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring" href="{{ route(config('permission_ui.route_name_prefix') . 'permissions.edit', $permission) }}">
                                        {{ __('PermissionsUI::permissions.global.edit') }}
                                    </a>

                                    <form action="{{ route(config('permission_ui.route_name_prefix') . 'permissions.destroy', $permission) }}" method="POST" onsubmit="return confirm('{{ __('PermissionsUI::permissions.global.confirm_action') }}')" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button>
                                            {{ __('PermissionsUI::permissions.global.delete') }}
                                        </x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-4" colspan="4">{{ __('PermissionsUI::permissions.global.no_records') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
