@extends('PermissionsUI::layout')

@section('content')
    <div class="mb-4 flex">
        <a class="rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold text-white hover:bg-gray-700" href="{{ route(config('permission_ui.route_name_prefix') . 'roles.create') }}">{{ __('PermissionsUI::permissions.global.create') }}</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full table-auto rounded-xl border border-gray-300 bg-white text-left shadow-sm divide-y">
            <thead>
                <tr class="bg-gray-500/5">
                    <th class="px-4">{{ __('PermissionsUI::permissions.roles.fields.id') }}</th>
                    <th>{{ __('PermissionsUI::permissions.roles.fields.name') }}</th>
                    <th>{{ __('PermissionsUI::permissions.roles.fields.permissions') }}</th>
                    <th>{{ __('PermissionsUI::permissions.roles.fields.created_at') }}</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @forelse($roles as $role)
                    <tr>
                        <td class="px-4 py-2">{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach($role->permissions as $permission)
                                <span class="rounded-xl bg-blue-300 px-2 py-1 text-xs text-blue-700">{{ $permission->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $role->created_at }}</td>
                        <td class="px-4 divide-x-2">
                            <a class="rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold text-white hover:bg-gray-700" href="{{ route(config('permission_ui.route_name_prefix') . 'roles.edit', $role) }}">
                                {{ __('PermissionsUI::permissions.global.edit') }}
                            </a>

                            <form action="{{ route(config('permission_ui.route_name_prefix') . 'roles.destroy', $role) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold text-white hover:bg-gray-700" type="submit" onclick="return confirm({{ __('PermissionsUI::permissions.global.confirm_action') }})">
                                    {{ __('PermissionsUI::permissions.global.delete') }}
                                </button>
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
@endsection
