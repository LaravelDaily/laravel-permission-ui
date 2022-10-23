<x-app-layout>
    <x-slot name="header">
        {{ __('PermissionsUI::permissions.users.title') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-2">{{ __('PermissionsUI::permissions.users.fields.id') }}</th>
                            <th class="px-4 py-3">{{ __('PermissionsUI::permissions.users.fields.name') }}</th>
                            <th class="px-4 py-3">{{ __('PermissionsUI::permissions.users.fields.email') }}</th>
                            <th class="px-4 py-3">{{ __('PermissionsUI::permissions.users.fields.roles') }}</th>
                            <th class="px-4 py-3">{{ __('PermissionsUI::permissions.users.fields.created_at') }}</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($users as $user)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">{{ $user->id }}</td>
                                <td class="px-4 py-3 text-sm">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $user->email }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @foreach($user->roles as $role)
                                        <span class="rounded-xl bg-blue-300 px-2 py-1 text-blue-700">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $user->created_at }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <a class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring" href="{{ route(config('permission_ui.route_name_prefix') . 'users.edit', $user) }}">
                                        {{ __('PermissionsUI::permissions.global.edit') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($users->links())
                <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>