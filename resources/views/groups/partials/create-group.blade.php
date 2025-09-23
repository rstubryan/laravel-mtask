<section xmlns:x-aui="http://www.w3.org/1999/html">
    <x-aui::dialog dismissable="true" x-cloak>
        <x-slot:trigger>
            <x-aui::button>
                Create Group
            </x-aui::button>
        </x-slot:trigger>
        <x-slot:content class="sm:max-w-[425px]">
            <form method="POST" action="{{ route('groups.store') }}" class="max-w-2xl">
                @csrf
                @method('POST')
                <x-aui::dialog-header>
                    <x-slot:title>
                        Create Group
                    </x-slot:title>
                    <x-slot:description>
                        Fill in the details to create a new group.
                    </x-slot:description>
                </x-aui::dialog-header>
                <div class="grid gap-4 py-4">
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="name" class="text-right">Name</x-aui::label>
                        <x-aui::input id="name" class="col-span-3" name="name" required autofocus
                                      value="{{ old('name') }}"/>
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="description" class="text-right">Description</x-aui::label>
                        <x-textarea class="col-span-3" id="description" name="description"
                        >
                            {{ old('description') }}
                        </x-textarea>
                    </div>
                </div>
                <x-aui::dialog-footer>
                    <x-aui::button class="justify-center" type="submit">Save changes</x-aui::button>
                </x-aui::dialog-footer>
            </form>
        </x-slot:content>
    </x-aui::dialog>
</section>
