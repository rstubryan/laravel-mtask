<section>
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($tasks as $task)
            <x-aui::card class="md:w-[350px]">
                <x-slot:title>{{ $task->title }}</x-slot:title>
                <x-slot:description>
                    <p>{{ $task->description }}</p>
                    <p class="text-sm text-gray-500">
                        {{ $task->due_date ? 'Due: ' . $task->due_date : 'No due date' }}
                    </p>
                    <p class="text-sm text-gray-500">Status: {{ ucfirst(str_replace('_', ' ', $task->status)) }}</p>
                </x-slot:description>
                <x-slot:footer class="flex flex-wrap gap-4 mt-4">
                    <x-aui::button-link variant="outline" href="{{ route('tasks.show', $task) }}">
                        {{ __('View Task') }}
                    </x-aui::button-link>
                    @can('edit tasks')
                        @include('tasks.partials.edit-task', ['task' => $task])
                    @endcan
                    @can('delete tasks')
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this task?');">
                            @csrf
                            @method('DELETE')
                            <x-aui::button type="submit">
                                {{ __('Delete') }}
                            </x-aui::button>
                        </form>
                    @endcan
                </x-slot:footer>
            </x-aui::card>
        @endforeach
    </div>
</section>
