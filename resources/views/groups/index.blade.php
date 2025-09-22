<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Groups') }}
            </h2>
            {{--            @can('create groups')--}}
            {{--                @include('groups.partials.create-group')--}}
            {{--            @endcan--}}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('groups.partials.group-list')
            </div>
            {{ $groups->links() }}
        </div>
    </div>
</x-app-layout>
