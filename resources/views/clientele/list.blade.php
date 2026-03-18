@include('layouts.partials.admin.dashboard')
<main class="nxl-container apps-container apps-notes">
    <div class="nxl-content without-header nxl-full-content">
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="clienteleList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">
                                                <div class="btn-group mb-1">
                                                    <div class="custom-control custom-checkbox ms-1">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="checkAllClientele">
                                                        <label class="custom-control-label"
                                                            for="checkAllClientele"></label>
                                                    </div>
                                                </div>
                                            </th>
                                            <th>File Name</th>
                                            <th>Description</th>
                                            <th>Date Uploaded</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($clienteles as $clientele)
                                            @if (!empty($clientele->pdfs))
                                                @foreach ($clientele->pdfs as $key => $item)
                                                    <tr class="single-item">
                                                        <td>
                                                            <div class="item-checkbox ms-1">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox"
                                                                        class="custom-control-input checkbox"
                                                                        id="checkBox_{{ $clientele->id }}_{{ $key }}">
                                                                    <label class="custom-control-label"
                                                                        for="checkBox_{{ $clientele->id }}_{{ $key }}"></label>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            {{ pathinfo($item['file'], PATHINFO_FILENAME) }}
                                                        </td>

                                                        <td>
                                                            {{ $item['description'] ?? $clientele->description }}
                                                        </td>

                                                        <td>
                                                            {{ \Carbon\Carbon::parse($clientele->created_at)->format('Y-m-d, h:i A') }}
                                                        </td>

                                                        <td>
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <a href="{{ asset('storage/' . $item['file']) }}"
                                                                    target="_blank"
                                                                    class="btn btn-sm btn-primary">View</a>

                                                                <form method="POST"
                                                                    action="{{ route('admin.clientelefiledelete', [$clientele->id]) }}"
                                                                    class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="file"
                                                                        value="{{ $item['file'] }}">
                                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('Delete this file?')">Delete</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center">No Files Found</td>
                                                </tr>
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No Clienteles Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.partials.admin.theme')
