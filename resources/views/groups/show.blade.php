<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <x-aui::button-link size="icon" class="justify-center" variant="outline"
                                href="{{ route('groups.index') }}">
                <x-lucide-chevron-left class="w-6 h-6"/>
            </x-aui::button-link>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Group Details') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $group->name }}</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ $group->description }}</p>
                    </div>
                    @include('groups.partials.create-related-group-task', ['group' => $group])
                </div>
                <div class="mt-4">
                    @include('groups.partials.related-group-task-list', ['tasks' => $tasks])                </div>
            </div>
            {{ $tasks->links() }}
        </div>
    </div>
</x-app-layout>
