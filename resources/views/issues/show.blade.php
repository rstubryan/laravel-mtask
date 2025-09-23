@php
    use Carbon\Carbon;
    Carbon::setLocale('id');
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4 justify-between">
            <div class="flex items-center gap-4">
                <x-aui::button-link size="icon" class="justify-center" variant="outline"
                                    href="{{ route('issues.index') }}">
                    <x-lucide-chevron-left class="w-6 h-6"/>
                </x-aui::button-link>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Issue Details') }}
                </h2>
            </div>
            @can('edit issues')
                @include('issues.partials.edit-issue', [
                    'issue' => $issue,
                    'tasks' => $tasks,
                    'users' => $users
                ])
            @endcan
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $issue->title }}</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ $issue->description }}</p>
                    <p class="text-sm mt-2">
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
                    <p class="text-sm mt-1">
                        <span class="text-gray-500">Assigned to:</span>
                        <span class="font-semibold text-black">
                                        {{ $issue->assignedTo ? $issue->assignedTo->name : 'Unassigned' }}
                                    </span>
                    </p>
                    <p class="text-sm mt-1">
                        <span class="text-gray-500">Status:</span>
                        <span class="font-semibold text-black">
                                        {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
                                    </span>
                    </p>
                    @php
                        $due = $issue->due_date ? Carbon::parse($issue->due_date)->setTimezone('Asia/Jakarta') : null;
                        $today = Carbon::now('Asia/Jakarta')->startOfDay();
                        $daysLeft = $due ? $today->diffInDays($due, false) : null;
                    @endphp
                    <p class="text-sm text-gray-500 mt-1">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
