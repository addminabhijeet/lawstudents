@foreach ($categories as $category)
    @php
        $padding = 14 + ($depth * 24);
        $bgColor = $depth % 2 === 0 ? '#fff' : '#fafbfc';
    @endphp

    <!-- Category Item -->
    <div class="dropdown-category-item" data-category-id="{{ $category->id }}" data-depth="{{ $depth }}"
        style="padding:14px 16px; padding-left:{{ $padding }}px; cursor:pointer; border-bottom:1px solid #f3f4f6;
                display:flex; justify-content:space-between; align-items:center;
                transition: all 0.2s ease; font-weight:500; color:#1f2937; background:{{ $bgColor }};">
        <span style="display:flex; align-items:center; flex:1;">
            @if($depth === 0)
                <i class="fa-solid fa-folder" style="margin-right:8px; color:#128C7E; font-size:14px;"></i>
            @else
                <i class="fa-solid fa-tag" style="margin-right:8px; color:#25D366; font-size:11px;"></i>
            @endif
            <span style="font-size:{{ $depth > 0 ? '13px' : '14px' }};">{{ $category->name }}</span>
        </span>
        @if($category->children->count() > 0)
        <i class="fa-solid fa-chevron-right" style="font-size:11px; color:#d1d5db; transition: transform 0.2s ease; margin-left:8px;"></i>
        @endif
    </div>

    <!-- Recursive Child Categories -->
    @if($category->children->count() > 0)
        @include('course.partials.category-tree', ['categories' => $category->children, 'depth' => $depth + 1])
    @endif
@endforeach
