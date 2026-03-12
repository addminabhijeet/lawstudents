@include('layouts.partials.student.dashboard')
<main class="nxl-container apps-container apps-notes">
    <div class="container py-4">

        <div class="row">

            <!-- LEFT SIDE -->
            <div class="col-lg-8">

                <div class="card mb-4">

                    <div class="card-body">

                        <h2 class="fw-bold">{{ $course->title }}</h2>

                        <p class="text-muted">
                            Category : <b>{{ $course->category->name }}</b>
                        </p>

                        <p class="text-muted">
                            Level : {{ $course->level }}
                        </p>

                        <p class="text-muted">
                            Duration : {{ $course->duration }}
                        </p>

                        <p>
                            <b>Price :</b>
                            ₹{{ $course->price }}
                        </p>

                        <p>
                            <b>Instructor :</b>
                            {{ $course->instructor_id }}
                        </p>

                        <p>
                            <b>Total Notes :</b>
                            {{ $course->notes->count() }}
                        </p>


                        <hr>

                        <h5>Description</h5>

                        <p>
                            {{ $course->description }}
                        </p>



                    </div>
                </div>


                <!-- COURSE NOTES -->
                <div class="card">

                    <div class="card-header">
                        <h4 class="mb-0">Course Materials</h4>
                    </div>

                    <div class="card-body">

                        @forelse($course->notes as $note)
                            <div class="d-flex justify-content-between align-items-center border-bottom py-3">

                                <div>

                                    <h6 class="mb-1">{{ $note->title }}</h6>

                                    <small class="text-muted">
                                        {{ $note->formatted_size }}
                                        |
                                        {{ $note->page_count }} pages
                                    </small>

                                </div>

                                <div>

                                    <a href="{{ asset('storage/' . $note->file_path) }}" target="_blank"
                                        class="btn btn-sm btn-primary">
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

        </div>

    </div>
</main>
@include('layouts.partials.student.theme')
