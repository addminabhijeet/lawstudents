@include('layouts.partials.admin.dashboard')
<main class="nxl-container apps-container apps-notes">
    <div class="nxl-content without-header nxl-full-content">
        <!-- [ Main Content ] start -->
        <div class="main-content d-flex">
            <!-- [ Content Sidebar  ] end -->
            <!-- [ Main Area  ] start -->
            <div class="content-area-body pb-0">
                <div class="row note-has-grid">
                    @forelse ($clienteles as $clientele)
                        @if (!empty($clientele->pdfs))
                            @foreach ($clientele->pdfs as $item)
                                <div class="col-xxl-4 col-xl-6 col-lg-4 col-sm-6 single-note-item">
                                    <div class="card card-body mb-4 stretch stretch-full">
                                        <span class="side-stick"></span>

                                        <h5 class="note-title text-truncate w-75 mb-1">
                                            {{ pathinfo($item['file'], PATHINFO_FILENAME) }}
                                        </h5>

                                        <p class="fs-11 text-muted note-date">
                                            Uploaded: {{ $clientele->created_at->format('d F Y') }}
                                        </p>

                                        <div class="note-content flex-grow-1">
                                            <p class="text-muted note-inner-content text-truncate-3-line">
                                                {{ $item['description'] ?? '' }}
                                            </p>
                                        </div>

                                        <div class="d-flex gap-2 mt-2">
                                            <a href="{{ asset('storage/' . $item['file']) }}" target="_blank"
                                                class="btn btn-sm btn-primary">View</a>
                                            {{-- Optional: Delete individual file --}}
                                            <form method="POST"
                                                action="{{ route('admin.clientelefiledelete', [$clientele->id]) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="file" value="{{ $item['file'] }}">
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this file?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @empty
                        <p class="text-center">No Clientele Files Found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.partials.admin.theme')
