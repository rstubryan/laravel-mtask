@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp

<section>
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($issues as $issue)
            @php
                $due = $issue->due_date ? Carbon::parse($issue->due_date)->setTimezone('Asia/Jakarta') : null;
                $today = Carbon::now('Asia/Jakarta')->startOfDay();
                $daysLeft = $due ? $today->diffInDays($due, false) : null;
            @endphp
            <x-aui::card class="md:w-[350px]">
                <x-slot:title>{{ $issue->title }}</x-slot:title>
                <x-slot:description>
                    <p class="text-sm text-muted-foreground">{{ $issue->description }}</p>
                    <p class="text-sm">
                        <span class="text-gray-500">Task:</span>
                        @if($issue->task)
                            <a href="{{ route('tasks.show', $issue->task) }}"
                               class="font-semibold text-black hover:underline hover:underline-offset-4">
                                {{ $issue->task->title }}
                            </a>
                        @else
                            <span class="font-semibold text-black">-</span>
                        @endif
                    </p>
                    <p class="text-sm">
                        <span class="text-gray-500">Assigned to:</span>
                        <span class="font-semibold text-black">
                                                                {{ $issue->assignedTo ? $issue->assignedTo->name : 'Unassigned' }}
                                                            </span>
                    </p>
                    <div class="flex items-center gap-4 mt-4 mb-2 p-2 bg-gray-100 rounded">
                        <p class="font-medium">Status:</p>
                        @can('update issue status')
                            <form id="status-form-{{ $issue->id }}" method="POST"
                                  action="{{ route('issues.updateStatus', $issue) }}" class="flex-1">
                                @csrf
                                @method('PATCH')
                                <x-aui::select class="w-max" name="status"
                                               onchange="document.getElementById('status-form-{{ $issue->id }}').submit()">
                                    <option value="open" @if($issue->status === 'open') selected @endif>Open</option>
                                    <option value="in_progress" @if($issue->status === 'in_progress') selected @endif>In
                                        Progress
                                    </option>
                                    <option value="resolved" @if($issue->status === 'resolved') selected @endif>
                                        Resolved
                                    </option>
                                    <option value="closed" @if($issue->status === 'closed') selected @endif>Closed
                                    </option>
                                </x-aui::select>
                            </form>
                        @else
                            <span class="font-semibold text-black">
                                                                    {{ ucfirst(str_replace('_', ' ', $issue->status ?? 'open')) }}
                                                                </span>
                        @endcan
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
                    <x-aui::button-link variant="outline" href="{{ route('issues.show', $issue) }}">
                        {{ __('View Issue') }}
                    </x-aui::button-link>
                    @can('edit issues')
                        @include('issues.partials.edit-issue', ['issue' => $issue, 'tasks' => $tasks, 'users' => $users])
                    @endcan
                    @can('delete issues')
                        <form action="{{ route('issues.destroy', $issue) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this issue?');">
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
