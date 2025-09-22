<section>
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($groups as $group)
            <x-aui::card class="md:w-[350px]">
                <x-slot:title>{{ $group->name }}</x-slot:title>
                <x-slot:description>
                    {{ $group->description }}
                </x-slot:description>
                <x-slot:footer class="flex flex-wrap gap-4 mt-4">
                    <x-aui::button-link variant="outline" href="{{ route('groups.show', $group) }}">
                        {{ __('View Group') }}
                    </x-aui::button-link>
                    {{--                    @can('edit groups')--}}
                    {{--                        @include('groups.partials.edit-group', ['group' => $group])--}}
                    {{--                    @endcan--}}
                    @can('delete groups')
                        <form action="{{ route('groups.destroy', $group) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this group?');">
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
