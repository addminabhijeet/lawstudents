@foreach ($categories as $category)
    @php
        // Create indentation with &nbsp; entities and dashes
        $indent = str_repeat('&nbsp;&nbsp;&nbsp;', $depth);
        $prefix = $depth > 0 ? str_repeat('—&nbsp;', $depth) : '';
    @endphp

    <option value="{{ $category->id }}" data-depth="{{ $depth }}">
        {!! $indent . $prefix !!}{{ $category->name }}
    </option>

    {{-- Recursively load child categories --}}
    @if($category->children->count() > 0)
        @include('course.partials.category-select-tree', [
            'categories' => $category->children,
            'depth' => $depth + 1
        ])
    @endif
@endforeach
