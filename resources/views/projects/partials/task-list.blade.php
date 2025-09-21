<section>
    @if($tasks->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach($tasks as $task)
                <x-aui::card class="md:w-[350px]">
                    <x-slot:title>{{ $task->title }}</x-slot:title>
                    <x-slot:description>
                        <div class="flex items-center gap-4 ">
                            <p>Status:</p>
                            <form id="status-form-{{ $task->id }}" method="POST"
                                  action="{{ route('tasks.updateStatus', $task) }}" class="flex-1">
                                @csrf
                                @method('PATCH')
                                <x-aui::select class="w-max" name="status"
                                               onchange="document.getElementById('status-form-{{ $task->id }}').submit()">
                                    <option value="pending" @if($task->status === 'pending') selected @endif>Pending
                                    </option>
                                    <option value="in_progress" @if($task->status === 'in_progress') selected @endif>In
                                        Progress
                                    </option>
                                    <option value="completed" @if($task->status === 'completed') selected @endif>
                                        Completed
                                    </option>
                                </x-aui::select>
                            </form>
                        </div>
                        <div class="">
                            @if($task->due_date)
                                <p class="text-sm text-gray-500">Due: {{ $task->due_date }}</p>
                            @else
                                <p class="text-sm text-gray-500">No due date</p>
                            @endif
                        </div>
                    </x-slot:description>
                    <x-slot:content>
                        <p class="text-gray-600">{{ $task->description }}</p>
                    </x-slot:content>
                </x-aui::card>
            @endforeach
        </div>
    @else
        <p class="mt-6 text-gray-500">No tasks for this project.</p>
    @endif
</section>
