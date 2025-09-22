@props([
        'name',
        'options' => [],
        'value' => null,
        'required' => false,
    ])

<select id="{{ $name }}"
        name="{{ $name }}" {{ $required ? 'required' : '' }} {{ $attributes->merge(['class' => 'flex ring-offset-background disabled:cursor-not-allowed disabled:opacity-50 border text-sm bg-background h-10 px-3 py-2 file:border-0 file:bg-transparent file:text-sm file:text-foreground file:font-medium placeholder:text-muted-foreground rounded-md focus-visible:outline-none border-input focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 accent-primary col-span-3 cursor-pointer']) }}>
    @foreach ($options as $key => $label)
        <option value="{{ $key }}" @if(old($name, $value) == $key) selected @endif>
            {{ $label }}
        </option>
    @endforeach
</select>
