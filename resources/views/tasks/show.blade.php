@php use App\Models\User; @endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 justify-between">
            <div class="flex items-center gap-4">
                <x-aui::button-link size="icon" class="justify-center" variant="outline"
                                    href="{{ route('tasks.index') }}">
                    <x-lucide-chevron-left class="w-6 h-6"/>
                </x-aui::button-link>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Task Details') }}
                </h2>
            </div>
            @can('edit tasks')
                @include('tasks.partials.edit-task', ['task' => $task, 'users' => User::all()])
            @endcan
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex items-center ">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ $task->description }}</p>
                        <p class="text-sm mt-2">
                            <span class="text-gray-500">Project:</span>
                            <a href="{{ route('projects.show', $task->project) }}"
                               class="font-semibold text-black hover:underline hover:underline-offset-4">
                                {{ $task->project->name }}
                            </a>
                        </p>
                        <p class="text-sm mt-1">
                            <span class="text-gray-500">Assigned to:</span>
                            <span class="font-semibold text-black">
                                {{ $task->assignedTo ? $task->assignedTo->name : 'Unassigned' }}
                            </span>
                        </p>
                        <p class="text-sm mt-1">
                            <span class="text-gray-500">Status:</span>
                            <span
                                class="font-semibold text-black">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            @if($task->due_date)
                                Due: {{ $task->due_date->translatedFormat('l, d F Y') }}
                            @else
                                No due date
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
