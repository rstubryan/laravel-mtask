<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @can('create projects')
                    @include('projects.partials.create-project')
                @endcan
                <div>
                    @include('projects.partials.project-list')
                </div>
            </div>
            {{ $projects->links() }}
        </div>
    </div>
</x-app-layout>
