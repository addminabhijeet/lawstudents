@php
    $paddingLeft = $depth * 30;
@endphp

<tr>
    <td>{{ $loop->iteration }}</td>
    <td>
        <div style="padding-left: {{ $paddingLeft }}px; display: flex; align-items: center; gap: 8px;">
            @if ($category->children->count() > 0)
                <i class="feather-folder" style="color: #128C7E; font-size: 16px;"></i>
            @else
                <i class="feather-tag" style="color: #6b7280; font-size: 14px;"></i>
            @endif
            <span style="font-weight: {{ $depth > 0 ? 'normal' : '600' }};">
                {{ $category->name }}
            </span>
            @if ($category->children->count() > 0)
                <span class="badge bg-info">{{ $category->children->count() }} sub</span>
            @endif
        </div>
    </td>
    <td>{{ $category->courses->count() }}</td>
    <td>
        <span class="badge {{ $category->status ? 'bg-success' : 'bg-warning' }}">
            {{ $category->status ? 'Active' : 'Inactive' }}
        </span>
    </td>
    <td class="text-end">
        <div class="hstack gap-2 justify-content-end">
            <a href="javascript:void(0)" class="btn btn-sm btn-light edit-category"
                data-id="{{ $category->id }}">
                <i class="feather-edit"></i>
            </a>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-category"
                data-id="{{ $category->id }}">
                <i class="feather-trash-2"></i>
            </a>
        </div>
    </td>
</tr>

{{-- Recursively display child categories --}}
@foreach ($category->children as $child)
    @include('course.partials.admin-category-row', [
        'category' => $child,
        'depth' => $depth + 1,
        'loop' => $loop
    ])
@endforeach
