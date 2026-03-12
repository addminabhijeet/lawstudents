@include('layouts.partials.student.dashboard')
<main class="nxl-container apps-container apps-notes">
    <div class="nxl-content without-header nxl-full-content">

        <div class="main-content">
            <div class="content-area">
                <div class="content-area-body pb-0">

                    <!-- COURSE HEADER -->
                    <div class="card mb-4 bg-light">
                        <div class="card-body">

                            <h2 class="fw-bold">{{ $course->title }}</h2>

                            <p class="text-muted mb-2">
                                {{ $course->description }}
                            </p>

                            <div class="d-flex flex-wrap gap-3">

                                <span class="badge bg-primary">
                                    {{ $course->category->name }}
                                </span>

                                <span class="text-muted">
                                    Level : {{ $course->level }}
                                </span>

                                <span class="text-muted">
                                    Duration : {{ $course->duration }}
                                </span>

                                <span class="fw-bold text-success">
                                    ₹{{ $course->price }}
                                </span>

                            </div>

                        </div>
                    </div>


                    <div class="row">

                        <!-- LEFT CONTENT -->
                        <div class="col-lg-8">

                            <!-- COURSE DESCRIPTION -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Course Description</h5>
                                </div>

                                <div class="card-body">
                                    <p>{{ $course->description }}</p>
                                </div>
                            </div>


                            <!-- COURSE MATERIALS -->
                            <div class="card">

                                <div class="card-header d-flex justify-content-between">
                                    <h5 class="mb-0">Course Materials</h5>

                                    <span class="badge bg-secondary">
                                        {{ $course->notes->count() }} Notes
                                    </span>
                                </div>

                                <div class="card-body">

                                    @forelse($course->notes as $note)
                                        <div
                                            class="d-flex justify-content-between align-items-center border-bottom py-3">

                                            <div class="d-flex align-items-center gap-3">

                                                <div
                                                    class="icon-md bg-light rounded d-flex align-items-center justify-content-center">
                                                    📄
                                                </div>

                                                <div>
                                                    <h6 class="mb-1">
                                                        {{ $note->title }}
                                                    </h6>

                                                    <small class="text-muted">
                                                        {{ $note->formatted_size }}
                                                        |
                                                        {{ $note->page_count }} pages
                                                    </small>
                                                </div>

                                            </div>

                                            <div class="d-flex gap-2">

                                                <a href="{{ asset('storage/' . $note->file_path) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary">
                                                    View
                                                </a>

                                                @if ($note->is_downloadable)
                                                    <a href="{{ asset('storage/' . $note->file_path) }}" download
                                                        class="btn btn-sm btn-success">
                                                        Download
                                                    </a>
                                                @endif

                                            </div>

                                        </div>

                                    @empty

                                        <p class="text-muted">No materials available.</p>
                                    @endforelse

                                </div>

                            </div>

                        </div>


                        <!-- RIGHT SIDEBAR -->
                        <div class="col-lg-4">

                            <div class="card sticky-top" style="top:100px">

                                <div class="card-body">

                                    <h5 class="fw-bold mb-3">
                                        Course Details
                                    </h5>

                                    <ul class="list-unstyled mb-4">

                                        <li class="mb-2">
                                            <b>Price :</b>
                                            ₹{{ $course->price }}
                                        </li>

                                        <li class="mb-2">
                                            <b>Level :</b>
                                            {{ $course->level }}
                                        </li>

                                        <li class="mb-2">
                                            <b>Duration :</b>
                                            {{ $course->duration }}
                                        </li>

                                        <li class="mb-2">
                                            <b>Total Notes :</b>
                                            {{ $course->notes->count() }}
                                        </li>

                                        <li class="mb-2">
                                            <b>Instructor :</b>
                                            {{ $course->instructor_id }}
                                        </li>

                                    </ul>

                                    <button class="btn btn-primary w-100 mb-2">
                                        Start Course
                                    </button>

                                    <button class="btn btn-outline-secondary w-100">
                                        Add to Wishlist
                                    </button>

                                </div>

                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>

    </div>
</main>
@include('layouts.partials.student.theme')
