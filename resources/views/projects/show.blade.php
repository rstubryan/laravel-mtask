<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <x-aui::button-link size="icon" class="justify-center" variant="outline"
                                href="{{ route('projects.index') }}">
                <x-lucide-chevron-left class="w-6 h-6"/>
            </x-aui::button-link>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Project Details') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $project->name }}</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ $project->description }}</p>
                    </div>
                    @include('projects.partials.create-related-task', ['project' => $project])
                </div>
                <div class="mt-4">
                    @include('projects.partials.task-list', ['tasks' => $project->tasks])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
