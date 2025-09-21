<section>
    <form method="POST" action="{{ route('projects.store') }}" class="max-w-2xl">
        @csrf
        @method('POST')
        <x-aui::dialog dismissable="true">
            <x-slot:trigger>
                <x-aui::button variant="outline">
                    Create Project
                </x-aui::button>
            </x-slot:trigger>
            <x-slot:content class="sm:max-w-[425px]">
                <x-aui::dialog-header>
                    <x-slot:title>
                        Create Project
                    </x-slot:title>
                    <x-slot:description>
                        Fill in the details to create a new project.
                    </x-slot:description>
                </x-aui::dialog-header>
                <div class="grid gap-4 py-4">
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="name" class="text-right">Name</x-aui::label>
                        <x-aui::input id="name" class="col-span-3" name="name" required autofocus/>
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <x-aui::label for="description" class="text-right">Description</x-aui::label>
                        <x-aui::input class="col-span-3" id="description" name="description"/>
                    </div>
                </div>
                <x-aui::dialog-footer>
                    <x-aui::button class="justify-center">Save changes</x-aui::button>
                </x-aui::dialog-footer>
            </x-slot:content>
        </x-aui::dialog>
    </form>
</section>
