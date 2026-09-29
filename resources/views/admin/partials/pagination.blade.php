@php
    $pageName = $paginator->getPageName();
    $current = $paginator->currentPage();
    $last = $paginator->lastPage();
    $pages = collect([1, $last])->merge(range(max(1, $current - 1), min($last, $current + 1)))->unique()->sort()->values();
    $query = request()->except([$pageName, 'per_page']);
    $sizeId = 'page-size-' . $pageName;
@endphp
<div class="admin-pagination" data-admin-pagination>
    <div class="admin-pagination__summary" role="status">
        <strong>Showing {{ number_format($paginator->firstItem() ?? 0) }}–{{ number_format($paginator->lastItem() ?? 0) }} of {{ number_format($paginator->total()) }} records</strong>
        <span>Page {{ number_format($current) }} of {{ number_format($last) }}</span>
    </div>
    <form method="GET" action="{{ request()->url() }}" class="admin-pagination__size">
        @foreach (\Illuminate\Support\Arr::dot($query) as $key => $value)
            @if (is_scalar($value))
                @php $parts = explode('.', $key); $field = array_shift($parts); foreach ($parts as $part) { $field .= '[' . $part . ']'; } @endphp
                <input type="hidden" name="{{ $field }}" value="{{ $value }}">
            @endif
        @endforeach
        <label for="{{ $sizeId }}">Per page</label>
        <select id="{{ $sizeId }}" name="per_page" class="form-select form-select-sm" aria-label="Records per page">
            @foreach (collect(\App\Support\AdminListing::PAGE_SIZES)->push($paginator->perPage())->unique()->sort() as $size)
                <option value="{{ $size }}" @selected($paginator->perPage() === $size)>{{ $size }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-sm btn-outline-secondary">Apply</button>
    </form>
    @if ($paginator->hasPages())
        <nav aria-label="Record pages">
            <ul class="pagination pagination-sm mb-0">
                @foreach (['First' => 1, 'Previous' => max(1, $current - 1)] as $label => $number)
                    <li class="page-item {{ $current === 1 ? 'disabled' : '' }}">
                        @if ($current === 1)<span class="page-link" aria-disabled="true">{{ $label }}</span>
                        @else<a class="page-link" href="{{ $paginator->url($number) }}" @if ($label === 'Previous') rel="prev" @endif>{{ $label }}</a>@endif
                    </li>
                @endforeach
                @php $previous = 0; @endphp
                @foreach ($pages as $number)
                    @if ($previous && $number - $previous > 1)<li class="page-item disabled"><span class="page-link" aria-hidden="true">…</span></li>@endif
                    <li class="page-item {{ $number === $current ? 'active' : '' }}">
                        @if ($number === $current)<span class="page-link" aria-current="page"><span class="visually-hidden">Page </span>{{ $number }}</span>
                        @else<a class="page-link" href="{{ $paginator->url($number) }}" aria-label="Page {{ $number }}">{{ $number }}</a>@endif
                    </li>
                    @php $previous = $number; @endphp
                @endforeach
                @foreach (['Next' => min($last, $current + 1), 'Last' => $last] as $label => $number)
                    <li class="page-item {{ $current === $last ? 'disabled' : '' }}">
                        @if ($current === $last)<span class="page-link" aria-disabled="true">{{ $label }}</span>
                        @else<a class="page-link" href="{{ $paginator->url($number) }}" @if ($label === 'Next') rel="next" @endif>{{ $label }}</a>@endif
                    </li>
                @endforeach
            </ul>
        </nav>
    @endif
</div>
