@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp

<section>
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($tasks as $task)
            @php
                $due = $task->due_date ? Carbon::parse($task->due_date)->setTimezone('Asia/Jakarta') : null;
                $today = Carbon::now('Asia/Jakarta')->startOfDay();
                $daysLeft = $due ? $today->diffInDays($due, false) : null;
            @endphp
            <x-aui::card class="md:w-[350px]">
                <x-slot:title>{{ $task->title }}</x-slot:title>
                <x-slot:description>
                    <p class="text-sm text-muted-foreground">{{ $task->description }}</p>
                    <p class="text-sm">
                        <span class="text-gray-500">Project:</span>
                        <a href="{{ route('projects.show', $task->project) }}"
                           class="font-semibold text-black hover:underline hover:underline-offset-4">
                            {{ $task->project->name }}
                        </a>
                    </p>
                    <p class="text-sm">
                        <span class="text-gray-500">Assigned to:</span>
                        <span class="font-semibold text-black">
                                                                            {{ $task->assignedTo ? $task->assignedTo->name : 'Unassigned' }}
                                                                        </span>
                    </p>
                    <div class="flex items-center gap-4 mt-4 mb-2 p-2 bg-gray-100 rounded">
                        <p class="font-medium">Status:</p>
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
                                <option value="completed" @if($task->status === 'completed') selected @endif>Completed
                                </option>
                            </x-aui::select>
                        </form>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">
                        @if($due)
                            {{ $due->translatedFormat('l, d F Y') }}
                            @if($daysLeft > 0)
                                ({{ $daysLeft }} hari lagi)
                            @elseif($daysLeft === 0)
                                (Deadline hari ini)
                            @else
                                (Deadline terlewat {{ abs($daysLeft) }} hari)
                            @endif
                        @else
                            Tidak ada deadline
                        @endif
                    </p>
                </x-slot:description>
                <x-slot:footer class="flex flex-wrap gap-4 mt-4">
                    <x-aui::button-link variant="outline" href="{{ route('tasks.show', $task) }}">
                        {{ __('View Task') }}
                    </x-aui::button-link>
                    @can('edit tasks')
                        @include('tasks.partials.edit-task', ['task' => $task, 'users' => $users])
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
