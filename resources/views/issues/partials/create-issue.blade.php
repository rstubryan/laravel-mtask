@php use Carbon\Carbon; @endphp

<section>
    <x-aui::dialog dismissable="true" x-cloak>
        <x-slot:trigger>
            <x-aui::button>
                Create Issue
            </x-aui::button>
        </x-slot:trigger>
        <x-slot:content class="sm:max-w-[425px]">
            <x-aui::dialog-header>
                <x-slot:title>
                    Create Issue
                </x-slot:title>
                <x-slot:description>
                    Fill in the details to create a new issue.
                </x-slot:description>
            </x-aui::dialog-header>
            <form method="POST" action="{{ route('issues.store') }}">
                @csrf
                <div class="grid gap-4 py-4">
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="task_id" class="text-right">Task</x-aui::label>
                        <x-select
                            name="task_id"
                            :options="$tasks->pluck('title', 'id')->toArray()"
                            :value="old('task_id')"
                            required
                            class="col-span-3"
                        />
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="title" class="text-right">Title</x-aui::label>
                        <x-aui::input id="title" class="col-span-3" name="title"
                                      value="{{ old('title') }}" required autofocus/>
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="description" class="text-right">Description</x-aui::label>
                        <x-textarea name="description" class="col-span-3">
                            {{ old('description') }}
                        </x-textarea>
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="due_date" class="text-right">Due Date</x-aui::label>
                        <x-aui::input
                            type="date"
                            id="due_date"
                            class="col-span-3"
                            name="due_date"
                            value="{{ old('due_date') }}"
                            min="{{ Carbon::today()->format('Y-m-d') }}"
                        />
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="status" class="text-right">Status</x-aui::label>
                        <x-select
                            name="status"
                            :options="[
                                'open' => 'Open',
                                'in_progress' => 'In Progress',
                                'resolved' => 'Resolved',
                                'closed' => 'Closed',
                            ]"
                            :value="old('status', 'open')"
                            required
                            class="col-span-3"
                        />
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="assigned_to" class="text-right">Assigned User</x-aui::label>
                        <x-select
                            name="assigned_to"
                            :options="$users->pluck('name', 'id')->prepend('Unassigned', '')->toArray()"
                            :value="old('assigned_to')"
                            class="col-span-3"
                        />
                    </div>
                </div>
                <x-aui::dialog-footer>
                    <x-aui::button class="justify-center" type="submit">Save Issue</x-aui::button>
                </x-aui::dialog-footer>
            </form>
        </x-slot:content>
    </x-aui::dialog>
</section>
