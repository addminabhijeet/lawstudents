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

                                                <button class="btn btn-sm btn-outline-primary"
                                                    onclick="openPDF('{{ route('student.viewnote', $note->id) }}')">
                                                    View
                                                </button>

                                                @if ($note->is_downloadable)
                                                    <a href="{{ route('student.downloadnote', $note->id) }}"
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
<div class="modal fade" id="pdfModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">PDF Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-0 position-relative">

                <!-- Watermark -->
                <div id="pdfWatermark"
                    style="position:absolute; top:10px; right:15px; z-index:5;
                    background:rgba(255,255,255,0.7); padding:6px 10px; font-size:11px;
                    border-radius:4px; pointer-events:none;">
                    <b>LAW NOTES</b><br>
                    Downloaded by: {{ Auth::guard('student')->user()->email ?? 'student' }}
                </div>

                <!-- Viewer Controls -->
                <div style="position:absolute; top:10px; left:10px; z-index:5;">
                    <button class="btn btn-sm btn-primary" onclick="printPDF()">Print</button>
                    <button class="btn btn-sm btn-success" onclick="downloadPDF()">Download</button>
                </div>

                <iframe id="pdfFrame" src="" width="100%" height="600px" style="border:none;">
                </iframe>

            </div>

        </div>
    </div>
</div>
<script>
    function openPDF(url) {

        document.getElementById('pdfFrame').src = url;

        let modal = new bootstrap.Modal(document.getElementById('pdfModal'));
        modal.show();
    }
</script>
<script>
    document.addEventListener("contextmenu", function(e) {
        if (document.getElementById("pdfModal").classList.contains("show")) {
            e.preventDefault();
        }
    });

    document.addEventListener("keydown", function(e) {

        // Disable CTRL+S / CTRL+P / CTRL+U
        if ((e.ctrlKey && e.key === "s") ||
            (e.ctrlKey && e.key === "p") ||
            (e.ctrlKey && e.key === "u")) {
            e.preventDefault();
        }

    });
</script>
<script>
function openPDF(url) {

    let token = btoa(Date.now()); // simple temporary token

    document.getElementById('pdfFrame').src = url + '?viewer=' + token;

    let modal = new bootstrap.Modal(document.getElementById('pdfModal'));
    modal.show();

    trackPageView(url);
}

function trackPageView(url)
{
    fetch("/student/pdf-view-log", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            pdf:url,
            student:"{{ Auth::guard('student')->id() }}"
        })
    });
}
</script>
<script>

let progressTracked = 0;

document.getElementById("pdfFrame").addEventListener("load", function(){

    let iframe = this;

    iframe.contentWindow.addEventListener("scroll", function(){

        let scrollTop = iframe.contentWindow.scrollY;
        let height = iframe.contentDocument.body.scrollHeight;
        let view = iframe.contentWindow.innerHeight;

        let percent = Math.round((scrollTop / (height-view))*100);

        if(percent > progressTracked + 10){
            progressTracked = percent;

            fetch("/student/pdf-progress",{
                method:"POST",
                headers:{
                    "Content-Type":"application/json",
                    "X-CSRF-TOKEN":"{{ csrf_token() }}"
                },
                body:JSON.stringify({
                    progress:percent
                })
            });
        }

    });

});

</script>
<script>
function printPDF(){
    let frame = document.getElementById("pdfFrame");
    frame.contentWindow.print();
}
</script>
<script>

let currentPDF = "";

function openPDF(url){
    currentPDF = url;
    document.getElementById('pdfFrame').src = url;
    let modal = new bootstrap.Modal(document.getElementById('pdfModal'));
    modal.show();
}

function downloadPDF(){
    window.open(currentPDF.replace("viewnote","downloadnote"));
}

</script>
@include('layouts.partials.student.theme')
