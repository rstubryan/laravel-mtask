@php use Carbon\Carbon; @endphp
<section>
    <x-aui::dialog dismissable="true">
        <x-slot:trigger>
            <x-aui::button>
                Create Related Task
            </x-aui::button>
        </x-slot:trigger>
        <x-slot:content class="sm:max-w-[425px]">
            <form method="POST" action="{{ route('tasks.store') }}" class="max-w-2xl">
                @csrf
                @method('POST')
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <x-aui::dialog-header>
                    <x-slot:title>
                        Create Task for {{ $project->name }}
                    </x-slot:title>
                    <x-slot:description>
                        Fill in the details to create a new task related to this project.
                    </x-slot:description>
                </x-aui::dialog-header>
                <div class="grid gap-4 py-4">
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="title" class="text-right">Title</x-aui::label>
                        <x-aui::input id="title" class="col-span-3" name="title"
                                      value="{{ old('title') }}" required autofocus/>
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="description" class="text-right">Description</x-aui::label>
                        <x-aui::input class="col-span-3" id="description" name="description"
                                      value="{{ old('description') }}"/>
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="status" class="text-right">Status</x-aui::label>
                        <x-aui::select id="status" name="status" class="col-span-3">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </x-aui::select>
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="due_date" class="text-right">Due Date</x-aui::label>
                        <x-aui::input
                            type="date"
                            class="col-span-3"
                            id="due_date"
                            name="due_date"
                            value="{{ old('due_date') }}"
                            min="{{ Carbon::today()->format('Y-m-d') }}"
                        />
                    </div>
                </div>
                <x-aui::dialog-footer>
                    <x-aui::button class="justify-center" type="submit">Save Task</x-aui::button>
                </x-aui::dialog-footer>
            </form>
        </x-slot:content>
    </x-aui::dialog>
</section>
