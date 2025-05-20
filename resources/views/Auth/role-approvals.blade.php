@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-semibold mb-4">Pending Role Requests</h2>

    @if($roleRequests instanceof \Illuminate\Support\Collection && $roleRequests->first() instanceof \Illuminate\Support\Collection)
    {{-- Grouped by role --}}
    @foreach($roleRequests as $role => $requests)
        <h2 class="text-xl font-bold mt-6 mb-4">{{ ucfirst(str_replace('_', ' ', $role)) }} Requests</h2>
        <table class="min-w-full bg-white border border-gray-300 mb-8">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">User</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Franchise</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td class="py-2 px-4 border-b" align="center">{{ $request->user->name }}</td>
                        <td class="py-2 px-4 border-b" align="center">
                            <a href="mailto:{{ $request->user->email }}" class="text-blue-600 hover:underline">
                                {{ $request->user->email }}
                            </a>
                        </td>
                        <td class="py-2 px-4 border-b" align="center">{{ implode(', ', $request->franchise_ids) }}</td>
                        <td class="py-2 px-4 border-b" align="center">{{ ucfirst($request->status) }}</td>
                        <td class="py-2 px-4 border-b" align="center">
                            <form method="POST" action="{{ route('role-request.approve', $request) }}" class="inline">@csrf
                                <button class="bg-green-500 text-white px-3 py-1 rounded">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('role-request.reject', $request) }}" class="inline ml-2">@csrf
                                <button class="bg-red-500 text-white px-3 py-1 rounded">Reject</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
@else
    {{-- Flat list for non-super users --}}
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">User</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Requested Role</th>
                <th class="py-2 px-4 border-b">Franchise</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roleRequests as $request)
                <tr>
                    <td class="py-2 px-4 border-b" align="center">{{ $request->user->name }}</td>
                    <td class="py-2 px-4 border-b" align="center">
                        <a href="mailto:{{ $request->user->email }}" class="text-blue-600 hover:underline">
                            {{ $request->user->email }}
                        </a>
                    </td>
                    <td class="py-2 px-4 border-b" align="center">{{ $request->desired_role }}</td>
                    <td class="py-2 px-4 border-b" align="center">{{ implode(', ', $request->franchise_ids) }}</td>
                    <td class="py-2 px-4 border-b" align="center">{{ ucfirst($request->status) }}</td>
                    <td class="py-2 px-4 border-b" align="center">
                        <form method="POST" action="{{ route('role-request.approve', $request) }}" class="inline">@csrf
                            <button class="bg-green-500 text-white px-3 py-1 rounded">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('role-request.reject', $request) }}" class="inline ml-2">@csrf
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
</div>
@endsection
