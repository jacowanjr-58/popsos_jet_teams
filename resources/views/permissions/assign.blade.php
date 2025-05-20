@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Assign Permissions to {{ $user->name }}</h2>

    <form method="POST" action="{{ route('permissions.assign', $user) }}">
        @csrf

        @foreach($permissionGroups as $group => $data)
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">{{ $data['icon'] }} {{ $group }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($data['permissions'] as $permission)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="permissions[]" value="{{ $permission }}"
                                {{ in_array($permission, $assignedPermissions) ? 'checked' : '' }}
                                class="form-checkbox text-blue-600">
                            <span class="ml-2">{{ Str::after($permission, '.') }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">Save Permissions</button>
    </form>
</div>
@endsection
