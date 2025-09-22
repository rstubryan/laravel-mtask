<section>
    <x-aui::dialog dismissable="true" x-cloak>
        <x-slot:trigger>
            <x-aui::button>
                Link Related Tasks
            </x-aui::button>
        </x-slot:trigger>
        <x-slot:content class="sm:max-w-[425px]">
            <form method="POST" action="{{ route('grouptasks.update', $group->id) }}" class="max-w-2xl">
                @csrf
                @method('PUT')
                <x-aui::dialog-header>
                    <x-slot:title>
                        Link Related Tasks
                    </x-slot:title>
                    <x-slot:description>
                        Select tasks to associate with this group.
                    </x-slot:description>
                </x-aui::dialog-header>
                <div class="grid gap-4 py-4">
                    <input type="hidden" name="group_id" value="{{ $group->id }}">
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="task_id" class="text-right">Tasks</x-aui::label>
                        <x-aui::select id="task_id" name="task_id[]" class="col-span-3 flex flex-wrap min-h-[48px]"
                                       multiple required>
                            @foreach($allTasks as $task)
                                <option value="{{ $task->id }}"
                                        @if(collect(old('task_id', $group->tasks->pluck('id')->toArray()))->contains($task->id)) selected
                                        @endif
                                        class="truncate line-clamp-1 max-w-[220px]">
                                    {{ $task->title }}
                                </option>
                            @endforeach
                        </x-aui::select>
                    </div>
                </div>
                <x-aui::dialog-footer>
                    <x-aui::button class="justify-center" type="submit">Save changes</x-aui::button>
                </x-aui::dialog-footer>
            </form>
        </x-slot:content>
    </x-aui::dialog>
</section>
