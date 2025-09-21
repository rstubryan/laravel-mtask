<section>
    <div class="mt-6 space-y-6">
        @foreach ($projects as $project)
            <div class="p-4 border border-gray-200 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900">{{ $project->name }}</h3>
                <p class="mt-1 text-sm text-gray-600">{{ $project->description }}</p>
                <div class="mt-4 flex gap-4">
                    <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:underline">
                        {{ __('View Project') }}
                    </a>
                    @can('delete projects')
                        <form action="{{ route('projects.destroy', $project) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this project?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        @endforeach
    </div>
</section>
