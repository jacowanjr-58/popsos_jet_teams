@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Edit User</h2>

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold">Name</label>
            <input type="text" name="name" class="w-full border p-2 rounded" value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-6">
            <label class="block font-semibold">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded" value="{{ old('email', $user->email) }}">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">Update</button>
    </form>
</div>
@endsection
