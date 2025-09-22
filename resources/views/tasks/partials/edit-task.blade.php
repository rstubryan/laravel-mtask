@php use Carbon\Carbon; @endphp

<section>
    <x-aui::dialog dismissable="true">
        <x-slot:trigger>
            <x-aui::button variant="outline">
                Edit Task
            </x-aui::button>
        </x-slot:trigger>
        <x-slot:content class="sm:max-w-[425px]">
            <x-aui::dialog-header>
                <x-slot:title>
                    Edit Task
                </x-slot:title>
                <x-slot:description>
                    Fill in the details to update the task.
                </x-slot:description>
            </x-aui::dialog-header>
            <form id="edit-task-form-{{ $task->id }}" method="POST" action="{{ route('tasks.update', $task->id) }}">
                @csrf
                @method('PUT')
                <div class="grid gap-4 py-4">
                    <input type="hidden" name="project_id" value="{{ $task->project_id }}">
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="title" class="text-right">Title</x-aui::label>
                        <x-aui::input id="title" class="col-span-3" name="title" required autofocus
                                      value="{{ old('title', $task->title) }}"/>
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="description" class="text-right">Description</x-aui::label>
                        <x-textarea name="description" class="col-span-3">
                            {{ old('description', $task->description) }}
                        </x-textarea>
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="due_date" class="text-right">Due Date</x-aui::label>
                        <x-aui::input
                            type="date"
                            id="due_date"
                            class="col-span-3"
                            name="due_date"
                            value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                            min="{{ Carbon::today()->format('Y-m-d') }}"
                        />
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="status" class="text-right">Status</x-aui::label>
                        <x-select
                            name="status"
                            :options="[
        'pending' => 'Pending',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
    ]"
                            :value="$task->status"
                            required
                            class="col-span-3"
                        />
                    </div>
                </div>
                <x-aui::dialog-footer>
                    <x-aui::button class="justify-center" type="submit">Save changes</x-aui::button>
                </x-aui::dialog-footer>
            </form>
        </x-slot:content>
    </x-aui::dialog>
</section>
