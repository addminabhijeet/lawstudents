@if ($isAdmin)
    @include('layouts.partials.admin.dashboard')
@else
    @include('layouts.partials.student.dashboard')
@endif
<style>
    .monthly-receipts-list { max-height: 18rem; overflow-y: auto; align-content: flex-start; padding-bottom: .25rem; }
    .monthly-receipts-list .btn { max-width: 17rem; white-space: normal; overflow-wrap: anywhere; }
    .monthly-receipts-list .btn[hidden] { display: none !important; }
    .monthly-receipt-search { max-width: 20rem; }
    @media (min-width: 768px) {
        .monthly-receipts-table:not(.rt-cards) { table-layout: fixed; width: 100%; }
        .monthly-receipts-table:not(.rt-cards) > :not(caption) > * > * { vertical-align: top; }
        .table-responsive .monthly-receipts-table:not(.rt-cards) .ls-clamp {
            display: block;
            width: 100%;
            max-width: none;
            overflow: visible;
            -webkit-line-clamp: unset;
        }
    }
    @media (max-width: 767.98px) {
        .table-responsive .monthly-receipts-table.rt-cards tbody tr td.monthly-receipts-cell { padding: 2.25rem 14px 12px; }
        .monthly-receipts-table.rt-cards tbody tr td.monthly-receipts-cell::before { width: auto; }
        .monthly-receipts-list { width: 100%; }
        .monthly-receipts-list .btn { max-width: 100%; }
        .monthly-receipt-search { max-width: 100%; }
    }
</style>
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title"><h5 class="m-b-10">Monthly Receipts</h5></div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ $isAdmin ? route('admin.listpayment') : route('student.fees') }}">Payments</a></li>
                    <li class="breadcrumb-item">Monthly Receipts</li>
                </ul>
            </div>
            @if ($isAdmin && $studentId)
                <div class="page-header-right ms-auto">
                    <a href="{{ route('admin.monthlyreceipt.index') }}" class="btn btn-outline-primary">All receipts</a>
                </div>
            @endif
        </div>
        <div class="main-content">
            @if ($isAdmin && $studentId)
                <p class="mb-3">{{ $studentName ?: 'Student #'.$studentId }}</p>
            @endif
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover monthly-receipts-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 23%">Month</th>
                                    <th scope="col" style="width: 10%">Receipts</th>
                                    <th scope="col" style="width: 67%">Receipt list</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($months as $month => $receipts)
                                    <tr>
                                        <td class="fw-semibold">{{ $month === 'Undated' ? $month : \Carbon\Carbon::createFromFormat('!Y-m', $month)->format('F Y') }}</td>
                                        <td>{{ $receipts->count() }}</td>
                                        <td class="monthly-receipts-cell">
                                            @if ($receipts->count() > 12)
                                                <label class="visually-hidden" for="monthlySearch-{{ $month }}">Find receipt in {{ $month }}</label>
                                                <input class="form-control form-control-sm monthly-receipt-search mb-2" type="search"
                                                       id="monthlySearch-{{ $month }}" placeholder="Find receipt or student"
                                                       aria-controls="receiptList-{{ $month }}" autocomplete="off">
                                            @endif
                                            <div class="monthly-receipts-list d-flex flex-wrap gap-2" id="receiptList-{{ $month }}">
                                                @foreach ($receipts as $receipt)
                                                    <a class="btn btn-outline-primary btn-sm text-start"
                                                       href="{{ $isAdmin ? route('admin.monthlyreceipt.show', $receipt) : route('student.monthlyreceipt.show', $receipt) }}"
                                                       title="View receipt {{ $receipt->invoice_number ?: '#'.$receipt->id }}">
                                                        <i class="feather-file-text me-1" aria-hidden="true"></i>
                                                        {{ $receipt->invoice_number ?: 'Receipt #'.$receipt->id }}
                                                        @if ($isAdmin)
                                                            <span class="small"> · {{ $receipt->to_name ?: $receipt->student?->name ?: 'Student #'.$receipt->student_id }}</span>
                                                        @endif
                                                    </a>
                                                @endforeach
                                            </div>
                                            @if ($receipts->count() > 12)
                                                <p class="monthly-receipts-empty mb-0 mt-2" role="status" hidden>No matching receipts in this month.</p>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center py-4">No receipts found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@php $previewClass = $isAdmin ? 'admin-preview' : 'student-preview'; @endphp
<dialog class="{{ $previewClass }}" id="monthlyReceiptPreview" aria-labelledby="monthlyReceiptTitle">
    <header class="{{ $previewClass }}__header">
        <div class="{{ $previewClass }}__heading">
            <h2 id="monthlyReceiptTitle">Payment receipt</h2>
        </div>
        <div class="{{ $previewClass }}__actions">
            <button type="button" class="btn btn-outline-secondary" data-monthly-expand aria-pressed="false">Full screen</button>
            <button type="button" class="btn btn-primary" data-preview-close>Close</button>
        </div>
    </header>
    <p class="{{ $previewClass }}__status" id="monthlyReceiptStatus" role="status" aria-live="polite"></p>
    <div class="{{ $previewClass }}__body" id="monthlyReceiptBody"></div>
</dialog>
<script>
    (() => {
        const dialog = document.getElementById('monthlyReceiptPreview');
        if (!dialog || typeof dialog.showModal !== 'function') return;
        const body = document.getElementById('monthlyReceiptBody');
        const status = document.getElementById('monthlyReceiptStatus');
        const title = document.getElementById('monthlyReceiptTitle');
        const expand = dialog.querySelector('[data-monthly-expand]');
        let returnFocus;

        document.querySelectorAll('.monthly-receipt-search').forEach(search => {
            const list = document.getElementById(search.getAttribute('aria-controls'));
            const links = [...list.querySelectorAll('a')];
            const empty = list.parentElement.querySelector('.monthly-receipts-empty');
            search.addEventListener('input', () => {
                const term = search.value.trim().toLocaleLowerCase();
                let matches = 0;
                links.forEach(link => {
                    link.hidden = !link.textContent.toLocaleLowerCase().includes(term);
                    if (!link.hidden) matches++;
                });
                empty.hidden = matches > 0;
                list.scrollTop = 0;
            });
        });

        document.querySelectorAll('.monthly-receipts-list a').forEach(link => {
            link.addEventListener('click', event => {
                if (event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
                event.preventDefault();
                returnFocus = link;
                title.textContent = link.title || 'Payment receipt';
                status.textContent = 'Loading receipt...';
                const frame = document.createElement('iframe');
                frame.title = title.textContent;
                frame.addEventListener('load', () => { if (dialog.open) status.textContent = ''; });
                body.replaceChildren(frame);
                frame.src = link.href;
                dialog.showModal();
                document.body.classList.add('{{ $isAdmin ? 'admin-preview-open' : 'student-preview-open' }}');
            });
        });

        dialog.querySelector('[data-preview-close]').addEventListener('click', () => dialog.close());
        expand.addEventListener('click', () => {
            const active = dialog.classList.toggle('is-expanded');
            expand.setAttribute('aria-pressed', String(active));
            expand.textContent = active ? 'Exit full screen' : 'Full screen';
        });
        dialog.addEventListener('close', () => {
            body.replaceChildren();
            status.textContent = '';
            dialog.classList.remove('is-expanded');
            expand.setAttribute('aria-pressed', 'false');
            expand.textContent = 'Full screen';
            document.body.classList.remove('{{ $isAdmin ? 'admin-preview-open' : 'student-preview-open' }}');
            if (returnFocus && returnFocus.isConnected) returnFocus.focus();
        });
    })();
</script>
@if ($isAdmin)
    @include('layouts.partials.admin.theme')
@else
    @include('layouts.partials.student.theme')
@endif
