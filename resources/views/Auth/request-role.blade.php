@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-semibold mb-4">Request a Role</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('role.request.store') }}">
        @csrf

        <div class="mb-4">
            <label for="desired_role" class="block font-medium">Select Role</label>
            <select name="desired_role" id="desired_role" class="w-full p-2 border rounded" required>
                <option value="">-- Choose Role --</option>
                <option value="franchise_staff">Franchise Staff</option>
                <option value="franchise_manager">Franchise Manager</option>
                <option value="franchise_admin">Franchise Owner</option>
                <option value="corporate_admin">Corporate Admin</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="franchise_ids" class="block font-medium">Select Franchise(s)</label>
            <select name="franchise_ids[]" id="franchise_ids" class="w-full p-2 border rounded" multiple required>
                @foreach($franchisees as $franchise)
                    <option value="{{ $franchise->id }}">{{ $franchise->name }}</option>
                @endforeach
            </select>
            <p class="text-sm text-gray-500">Hold Ctrl or Cmd to select multiple if applying for Franchise Owner</p>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Submit Request
        </button>
    </form>
</div>
@endsection
