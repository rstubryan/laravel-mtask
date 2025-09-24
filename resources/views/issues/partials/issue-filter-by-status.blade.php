<section>
    <form method="GET" action="{{ route('tasks.index') }}" class="mb-6">
        <x-aui::label for="status">Filter by Status:</x-aui::label>
        <x-select
            id="status"
            name="status"
            :options="['' => 'All', 'open' => 'Open', 'in_progress' => 'In Progress', 'resolved' => 'Resolved', 'closed' => 'Closed']"
            :value="request('status', '')"
            onchange="this.form.submit()"
            class="w-48"
        />
    </form>
</section>
