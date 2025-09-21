<section>
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($projects as $project)
            <x-aui::card class="md:w-[350px]">
                <x-slot:title>{{ $project->name }}</x-slot:title>
                <x-slot:description>
                    {{ $project->description }}
                </x-slot:description>
                <x-slot:footer class="flex flex-wrap gap-4 mt-4">
                    <x-aui::button-link variant="outline" href="{{ route('projects.show', $project) }}">
                        {{ __('View Project') }}
                    </x-aui::button-link>
                    @can('edit projects')
                        @include('projects.partials.edit-project', ['project' => $project])
                    @endcan
                    @can('delete projects')
                        <form action="{{ route('projects.destroy', $project) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this project?');">
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
