@if(auth()->user()->roles->isEmpty())
    @php $request = \App\Models\RoleRequest::where('user_id', auth()->id())->latest()->first(); @endphp
    @if(!$request)
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded shadow mb-6">
            You don't have an assigned role. <a href="{{ route('role.request') }}" class="underline font-medium">Request a Role</a>
        </div>
    @elseif($request->status === 'pending')
        <div class="bg-blue-100 text-blue-800 p-4 rounded shadow mb-6">
            Your request for <strong>{{ $request->desired_role }}</strong> is currently <strong>pending approval</strong>.
        </div>
    @elseif($request->status === 'rejected')
        <div class="bg-red-100 text-red-800 p-4 rounded shadow mb-6">
            Your role request was <strong>rejected</strong>. <a href="{{ route('role.request') }}" class="underline font-medium">Resubmit</a>
        </div>
    @endif
@endif
<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
