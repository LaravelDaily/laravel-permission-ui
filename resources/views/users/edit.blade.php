@extends('PermissionsUI::layout')

@section('content')
    <form class="space-y-2" action="{{ route('permission_ui.users.update', $user) }}" method="post">
        @csrf
        @method('PATCH')

        <div class="text-base font-medium text-gray-700">{{ __('PermissionsUI::permissions.users.fields.name') }}: <span class="font-bold">{{ $user->name }}</span></div>

        @if($roles->count())
            <div class="space-y-2">
                <label class="block text-base font-medium text-gray-700" for="permissions">{{ __('PermissionsUI::permissions.users.fields.roles') }}</label>
                <div class="space-x-2">
                    @foreach($roles as $id => $name)
                        <div class="inline-flex space-x-1">
                            <input class="rounded-md border-gray-300 shadow-sm" type="checkbox" name="roles[]" id="role-{{ $id }}" value="{{ $id }}" @checked(in_array($id, old('roles', [])) || $user->roles->contains($id))>
                            <label class="text-sm font-medium text-gray-700" for="role-{{ $id }}">{{ $name }}</label>
                        </div>
                    @endforeach
                </div>
                @error('permissions')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
        @endif

        <button class="rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold text-white hover:bg-gray-700" type="submit">
            {{ __('PermissionsUI::permissions.global.save') }}
        </button>
    </form>
@endsection
