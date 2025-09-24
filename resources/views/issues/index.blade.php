<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Issues') }}
            </h2>
            @can('create issues')
                @include('issues.partials.create-issue', ['tasks' => $tasks, 'users' => $users])
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('issues.partials.issue-filter-by-status')
                @include('issues.partials.issue-list', ['issues' => $issues])
            </div>
            {{ $issues->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>
