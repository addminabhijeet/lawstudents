@php
$user = \App\Models\User::first();
@endphp
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        body {
            background-color: #444;
            padding: 0 10px;
            margin: 0;
            min-width: fit-content;
        }
        .page-container {
            margin: 10px auto;
            width: fit-content;
        }
        .page {
            overflow: hidden;
            position: relative;
            background-color: white;
        }
        .annotations-container {
            position: absolute;
            pointer-events: none;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 3;
        }
        .annotations-container > div {
            position: absolute; pointer-events: auto; -webkit-user-select: none; user-select: none;
        }
        .annotations-container > div:hover {
            background-color: rgba(255, 255, 0, 0.25);
            cursor: pointer;
        }
    </style>
    <style class="shared-css" type="text/css" >
.t {
	transform-origin: bottom left;
	z-index: 2;
	position: absolute;
	white-space: pre;
	overflow: visible;
	line-height: 1.5;
}
.text-container {
	white-space: pre;
}
@supports (-webkit-touch-callout: none) {
	.text-container {
		white-space: normal;
	}
}
.invoice-container{
    position:relative;
    width:fit-content;
    margin:20px auto;
}

.invoice-toolbar{
    position:sticky;
    top:0;
    z-index:9999;

    display:flex;
    justify-content:flex-end;
    gap:10px;

    padding:10px 12px;

    background:#ffffff;
    border-bottom:1px solid #ddd;
    box-shadow:0 2px 6px rgba(0,0,0,.12);
}

.invoice-toolbar .avatar-text{
    display:flex;
    align-items:center;
    justify-content:center;

    width:40px;
    height:40px;

    border-radius:50%;
    cursor:pointer;

    background:#0d6efd;
    color:#fff;
}

.invoice-toolbar .avatar-text:hover{
    opacity:.9;
}
</style>

<style type="text/css" >

.s0{font-size:16px;font-family:BookAntiqua-Bold_n;color:#000;}
.s1{font-size:16px;font-family:BookAntiqua-Bold_n;color:#00F;}
.s2{font-size:18px;font-family:BookAntiqua-Bold_n;color:#000;}
.s3{font-size:15px;font-family:BookAntiqua-Bold_n;color:#000;}
.s4{font-size:15px;font-family:TimesNewRoman-Bold_k;color:#000;}
.s5{font-size:15px;font-family:BookAntiqua-Bold_n;color:#00F;}
.s6{font-size:24px;font-family:BookAntiqua-Bold_n;color:#000;}
.s7{font-size:16px;font-family:TimesNewRoman-Bold_k;color:#000;}
</style>

</head>
<body>
@if ($notFound)
<div class="alert alert-warning text-center">
    <strong>Please Complete Your Payment</strong>
</div>
@endif

@if (!$notFound && $payments->count())
@foreach ($payments as $payment)
<div class="invoice-container">

    <div class="invoice-toolbar">
        <!-- Print button -->
        <a href="javascript:void(0);"
           id="print-btn-{{ $payment->id }}"
           class="d-flex me-1 printBTN"
           onclick="printInvoice(this.closest('.invoice-container'))">
            <div class="avatar-text avatar-md"
                 data-bs-toggle="tooltip"
                 title="Print Invoice">
                <i class="fas fa-print"></i>
            </div>
        </a>

        <!-- Download button -->
        <a href="javascript:void(0);"
           id="download-btn-{{ $payment->id }}"
           class="d-flex me-1 file-download"
           onclick="downloadInvoice(this.closest('.invoice-container'))">
            <div class="avatar-text avatar-md"
                 data-bs-toggle="tooltip"
                 title="Download Invoice">
                <i class="fas fa-download"></i>
            </div>
        </a>
    </div>

    <div class="card-body p-0">

<div class="page-container">
    
<section class="page" style="width: 909px; height: 1286px;" aria-label="Page 1">
<div id="pg1Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none; user-select: none;"></div>
<div id="pg1" style="-webkit-user-select: none; user-select: none;"><img id="pdf1" style="width:909px; height:1286px;" src="data:image/svg+xml,%3Csvg viewBox='0 0 909 1286' version='1.1' xmlns='http://www.w3.org/2000/svg'%3E%0A%3Cdefs%3E%0A%3CclipPath id='c0'%3E%3Cpath d='M-.2 1232.7V54.3H909.3V1232.7Z'/%3E%3C/clipPath%3E%0A%3Cstyle%3E%0A.g0%7Bfill:%23000%3B%7D%0A.g1%7Bfill:%23FF0%3B%7D%0A.g2%7Bfill:%23FFF%3B%7D%0A%3C/style%3E%0A%3C/defs%3E%0A%3Cpath clip-path='url(%23c0)' fill-rule='evenodd' d='M-32.2 201.3H910.1v-2.2H-32.2v2.2Z' class='g0'/%3E%0A%3Cpath d='M107.1 365.2h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.1 365.2h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.8 365.2h51.7v-.7H107.8v.7Z' class='g0'/%3E%0A%3Cpath d='M159.5 365.2h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M160.2 365.2H306.9v-.7H160.2v.7Z' class='g0'/%3E%0A%3Cpath d='M306.9 365.2h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M307.6 365.2H612.7v-.7H307.6v.7Z' class='g0'/%3E%0A%3Cpath d='M612.7 365.2h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M613.4 365.2H862.8v-.7H613.4v.7Z' class='g0'/%3E%0A%3Cpath d='M862.8 365.2h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M862.8 365.2h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.1 424.2h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M159.5 424.2h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M306.9 424.2h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M612.7 424.2h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M862.8 424.2h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M107.1 425h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M107.8 425h51.7v-.8H107.8v.8Z' class='g0'/%3E%0A%3Cpath d='M159.5 425h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M160.2 425H306.9v-.8H160.2v.8Z' class='g0'/%3E%0A%3Cpath d='M306.9 425h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M307.6 425H612.7v-.8H307.6v.8Z' class='g0'/%3E%0A%3Cpath d='M612.7 425h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M613.4 425H862.8v-.8H613.4v.8Z' class='g0'/%3E%0A%3Cpath d='M862.8 425h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M107.1 474.5h.7V425h-.7v49.5Z' class='g0'/%3E%0A%3Cpath d='M159.5 474.5h.7V425h-.7v49.5Z' class='g0'/%3E%0A%3Cpath d='M306.9 474.5h.7V425h-.7v49.5Z' class='g0'/%3E%0A%3Cpath d='M612.7 474.5h.7V425h-.7v49.5Z' class='g0'/%3E%0A%3Cpath d='M862.8 474.5h.7V425h-.7v49.5Z' class='g0'/%3E%0A%3Cpath d='M107.1 475.2h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.8 475.2h51.7v-.7H107.8v.7Z' class='g0'/%3E%0A%3Cpath d='M159.5 475.2h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M160.2 475.2H306.9v-.7H160.2v.7Z' class='g0'/%3E%0A%3Cpath d='M306.9 475.2h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M307.6 475.2H612.7v-.7H307.6v.7Z' class='g0'/%3E%0A%3Cpath d='M612.7 475.2h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M613.4 475.2H862.8v-.7H613.4v.7Z' class='g0'/%3E%0A%3Cpath d='M862.8 475.2h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.1 534.2h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M159.5 534.2h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M306.9 534.2h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M612.7 534.2h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M862.8 534.2h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M107.1 535h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M107.8 535h51.7v-.8H107.8v.8Z' class='g0'/%3E%0A%3Cpath d='M159.5 535h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M160.2 535H306.9v-.8H160.2v.8Z' class='g0'/%3E%0A%3Cpath d='M306.9 535h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M307.6 535H612.7v-.8H307.6v.8Z' class='g0'/%3E%0A%3Cpath d='M612.7 535h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M613.4 535H862.8v-.8H613.4v.8Z' class='g0'/%3E%0A%3Cpath d='M862.8 535h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M107.1 653.4h.7V535h-.7V653.4Z' class='g0'/%3E%0A%3Cpath d='M159.5 653.4h.7V535h-.7V653.4Z' class='g0'/%3E%0A%3Cpath d='M306.9 653.4h.7V535h-.7V653.4Z' class='g0'/%3E%0A%3Cpath d='M612.7 653.4h.7V535h-.7V653.4Z' class='g0'/%3E%0A%3Cpath d='M862.8 653.4h.7V535h-.7V653.4Z' class='g0'/%3E%0A%3Cpath d='M107.1 654.1h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.8 654.1h51.7v-.7H107.8v.7Z' class='g0'/%3E%0A%3Cpath d='M159.5 654.1h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M160.2 654.1H306.9v-.7H160.2v.7Z' class='g0'/%3E%0A%3Cpath d='M306.9 654.1h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M307.6 654.1H612.7v-.7H307.6v.7Z' class='g0'/%3E%0A%3Cpath d='M612.7 654.1h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M613.4 654.1H862.8v-.7H613.4v.7Z' class='g0'/%3E%0A%3Cpath d='M862.8 654.1h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.1 713.5h.7V654.1h-.7v59.4Z' class='g0'/%3E%0A%3Cpath d='M159.5 713.5h.7V654.1h-.7v59.4Z' class='g0'/%3E%0A%3Cpath d='M306.9 713.5h.7V654.1h-.7v59.4Z' class='g0'/%3E%0A%3Cpath d='M612.7 713.5h.7V654.1h-.7v59.4Z' class='g0'/%3E%0A%3Cpath d='M862.8 713.5h.7V654.1h-.7v59.4Z' class='g0'/%3E%0A%3Cpath d='M107.1 714.3h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M107.8 714.3h51.7v-.8H107.8v.8Z' class='g0'/%3E%0A%3Cpath d='M159.5 714.3h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M160.2 714.3H306.9v-.8H160.2v.8Z' class='g0'/%3E%0A%3Cpath d='M306.9 714.3h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M307.6 714.3H612.7v-.8H307.6v.8Z' class='g0'/%3E%0A%3Cpath d='M612.7 714.3h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M613.4 714.3H862.8v-.8H613.4v.8Z' class='g0'/%3E%0A%3Cpath d='M862.8 714.3h.7v-.8h-.7v.8Z' class='g0'/%3E%0A%3Cpath d='M107.1 773.3h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M159.5 773.3h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M306.9 773.3h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M612.7 773.3h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M862.8 773.3h.7v-59h-.7v59Z' class='g0'/%3E%0A%3Cpath d='M107.1 774h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.8 774h51.7v-.7H107.8v.7Z' class='g0'/%3E%0A%3Cpath d='M159.5 774h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M160.2 774H306.9v-.7H160.2v.7Z' class='g0'/%3E%0A%3Cpath d='M306.9 774h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M307.6 774H612.7v-.7H307.6v.7Z' class='g0'/%3E%0A%3Cpath d='M612.7 774h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M613.4 774H862.8v-.7H613.4v.7Z' class='g0'/%3E%0A%3Cpath d='M862.8 774h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.1 813.3h.7V774h-.7v39.3Z' class='g0'/%3E%0A%3Cpath d='M159.5 813.3h.7V774h-.7v39.3Z' class='g0'/%3E%0A%3Cpath d='M306.9 813.3h.7V774h-.7v39.3Z' class='g0'/%3E%0A%3Cpath d='M612.7 813.3h.7V774h-.7v39.3Z' class='g0'/%3E%0A%3Cpath d='M862.8 813.3h.7V774h-.7v39.3Z' class='g0'/%3E%0A%3Cpath d='M621.1 833.8H808.9V814H621.1v19.8Z' class='g1'/%3E%0A%3Cpath d='M107.1 814h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.8 814h51.7v-.7H107.8v.7Z' class='g0'/%3E%0A%3Cpath d='M159.5 814h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M160.2 814H306.9v-.7H160.2v.7Z' class='g0'/%3E%0A%3Cpath d='M306.9 814h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M307.6 814H612.7v-.7H307.6v.7Z' class='g0'/%3E%0A%3Cpath d='M612.7 814h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M613.4 814H862.8v-.7H613.4v.7Z' class='g0'/%3E%0A%3Cpath d='M862.8 814h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.1 834.2h.7V814h-.7v20.2Z' class='g0'/%3E%0A%3Cpath d='M107.1 834.9h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.1 834.9h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M107.8 834.9h51.7v-.7H107.8v.7Z' class='g0'/%3E%0A%3Cpath d='M159.5 834.2h.7V814h-.7v20.2Z' class='g0'/%3E%0A%3Cpath d='M159.5 834.9h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M160.2 834.9H306.9v-.7H160.2v.7Z' class='g0'/%3E%0A%3Cpath d='M306.9 834.2h.7V814h-.7v20.2Z' class='g0'/%3E%0A%3Cpath d='M306.9 834.9h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M307.6 834.9H612.7v-.7H307.6v.7Z' class='g0'/%3E%0A%3Cpath d='M612.7 834.2h.7V814h-.7v20.2Z' class='g0'/%3E%0A%3Cpath d='M612.7 834.9h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M613.4 834.9H862.8v-.7H613.4v.7Z' class='g0'/%3E%0A%3Cpath d='M862.8 834.2h.7V814h-.7v20.2Z' class='g0'/%3E%0A%3Cpath d='M862.8 834.9h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath d='M862.8 834.9h.7v-.7h-.7v.7Z' class='g0'/%3E%0A%3Cpath clip-path='url(%23c0)' fill-rule='evenodd' d='M-32.2 1164.5H931.7v-2.2H-32.2v2.2Z' class='g0'/%3E%0A%3Cpath fill-rule='evenodd' d='M514.8 193.2H900.5V70.4H514.8V193.2Z' class='g2'/%3E%0A%3Cpath fill-rule='evenodd' d='M20.2 181.1H333.3V76.3H20.2V181.1Z' class='g2'/%3E%0A%3Cpath fill-rule='evenodd' d='M304.3 182.6H606.1V108.2H304.3v74.4Z' class='g2'/%3E%0A%3Cpath fill-rule='evenodd' d='M308.7 1139.2H555.5v-77.3H308.7v77.3Z' class='g2'/%3E%0A%3Cpath fill-rule='evenodd' d='M164.6 1223.9H814.4v-52H164.6v52Z' class='g2'/%3E%0A%3Cpath fill-rule='evenodd' d='M564.7 331.5H879.3v-113H564.7v113Z' class='g2'/%3E%0A%3Cpath fill-rule='evenodd' d='M583 1153.2H878.2V1006.9H583v146.3Z' class='g2'/%3E%0A%3C/svg%3E"/></div>
<div class="text-container"><span class="t s0" style="left:107px;bottom:1058px;letter-spacing:0.22px;">To </span>
<span class="t s0" style="left:107px;bottom:1038px;letter-spacing:0.12px;word-spacing:0.37px;">Ms. Sayantani Roy </span>
<span class="t s0" style="left:107px;bottom:1019px;letter-spacing:0.19px;word-spacing:-0.05px;">Natun Gram. Moyanapur. </span>
<span class="t s0" style="left:107px;bottom:999px;letter-spacing:0.16px;">Bankura-722038. </span>
<span class="t s0" style="left:107px;bottom:979px;letter-spacing:0.18px;word-spacing:-0.07px;">Email ID- </span><span class="t s1" style="left:184px;bottom:979px;letter-spacing:0.16px;word-spacing:0.33px;">sayantani1996.roy @gmail.com </span>
<span class="t s0" style="left:107px;bottom:960px;letter-spacing:0.15px;word-spacing:0.09px;">Contact No- +91-89183 63476. </span>
<span class="t s0" style="left:107px;bottom:940px;letter-spacing:0.15px;word-spacing:0.15px;">Alternate No. +91-9474725644. </span>
<span class="t s0" style="left:126px;bottom:898px;">Sl </span>
<span class="t s0" style="left:120px;bottom:878px;letter-spacing:0.14px;">No. </span>
<span class="t s0" style="left:184px;bottom:898px;letter-spacing:0.16px;word-spacing:0.32px;">Subjects: WB </span>
<span class="t s0" style="left:175px;bottom:878px;letter-spacing:0.15px;word-spacing:-0.05px;">Judicial Service </span>
<span class="t s0" style="left:184px;bottom:858px;letter-spacing:0.17px;">Examination. </span>
<span class="t s0" style="left:413px;bottom:898px;letter-spacing:0.23px;word-spacing:-0.1px;">Monthly Fee </span>
<span class="t s0" style="left:363px;bottom:878px;letter-spacing:0.15px;word-spacing:0.34px;">(Enrollment Fee one-time) </span>
<span class="t s0" style="left:661px;bottom:898px;letter-spacing:0.15px;word-spacing:0.33px;">Receiver’s Signature </span>
<span class="t s0" style="left:168px;bottom:838px;letter-spacing:0.18px;">Saturday </span>
<span class="t s0" style="left:168px;bottom:818px;letter-spacing:0.21px;word-spacing:0.3px;">&amp; Sunday </span>
<span class="t s0" style="left:324px;bottom:838px;letter-spacing:0.13px;word-spacing:0.3px;">Enrollment FEE + Spoken English &amp; </span>
<span class="t s0" style="left:319px;bottom:818px;letter-spacing:0.14px;word-spacing:0.19px;">Judicial Preli Fee +Main -All Subjects </span>
<span class="t s0" style="left:621px;bottom:838px;letter-spacing:0.2px;word-spacing:-0.06px;">Payment Received </span>
<span class="t s0" style="left:142px;bottom:788px;letter-spacing:0.38px;">1. </span><span class="t s0" style="left:168px;bottom:788px;letter-spacing:0.29px;word-spacing:-0.15px;">Nov, 2025 </span><span class="t s0" style="left:315px;bottom:788px;letter-spacing:0.18px;word-spacing:0.13px;">English +Preli+ Main </span><span class="t s0" style="left:621px;bottom:788px;letter-spacing:0.13px;">Received </span>
<span class="t s0" style="left:621px;bottom:768px;letter-spacing:0.13px;word-spacing:0.22px;">Rs. 5500/- on 21/11/2025 </span>
<span class="t s0" style="left:621px;bottom:748px;letter-spacing:0.13px;word-spacing:0.22px;">Rs, 7500/- on 27/11/2025 </span>
<span class="t s0" style="left:142px;bottom:728px;letter-spacing:0.38px;">2. </span><span class="t s0" style="left:168px;bottom:728px;letter-spacing:0.18px;word-spacing:0.29px;">Dec, 2025 </span><span class="t s0" style="left:315px;bottom:728px;letter-spacing:0.17px;word-spacing:0.13px;">English +Preli+ Main </span>
<span class="t s0" style="left:315px;bottom:708px;letter-spacing:0.17px;word-spacing:0.13px;">English +Preli+ Main </span>
<span class="t s0" style="left:315px;bottom:689px;letter-spacing:0.18px;word-spacing:-0.05px;">Rs. (1500+3500+10500+1000) </span>
<span class="t s0" style="left:315px;bottom:669px;letter-spacing:0.16px;word-spacing:0.32px;">=Rs. 16500/-Discount=Rs. 2500.00/- </span>
<span class="t s0" style="left:315px;bottom:649px;letter-spacing:0.19px;word-spacing:-0.07px;">After discount payable = Rs. 14,000/- </span>
<span class="t s0" style="left:315px;bottom:629px;letter-spacing:0.16px;word-spacing:0.32px;">(included Bengali) </span>
<span class="t s0" style="left:621px;bottom:728px;letter-spacing:0.13px;">Received </span>
<span class="t s0" style="left:621px;bottom:708px;letter-spacing:0.12px;word-spacing:0.23px;">Rs. 6500/- on 27-12-2025 </span>
<span class="t s0" style="left:621px;bottom:689px;letter-spacing:0.12px;word-spacing:0.23px;">Rs. 7500/- on 28-12-2025 </span>
<span class="t s0" style="left:142px;bottom:609px;letter-spacing:0.38px;">3. </span><span class="t s0" style="left:168px;bottom:609px;letter-spacing:0.14px;word-spacing:0.32px;">Jan, 2026 </span><span class="t s0" style="left:315px;bottom:609px;letter-spacing:0.16px;word-spacing:0.2px;">English +Preli+ Main=Rs. 14,000/- </span><span class="t s0" style="left:621px;bottom:609px;letter-spacing:0.13px;">Received </span>
<span class="t s0" style="left:621px;bottom:589px;letter-spacing:0.13px;word-spacing:0.34px;">Rs. 7500/- 30/01/2026 </span>
<span class="t s0" style="left:621px;bottom:570px;letter-spacing:0.13px;word-spacing:0.34px;">Rs. 6500/-02/02/2026 </span>
<span class="t s0" style="left:142px;bottom:549px;letter-spacing:0.38px;">4. </span><span class="t s0" style="left:168px;bottom:549px;letter-spacing:0.17px;word-spacing:0.29px;">Feb, 2026 </span><span class="t s0" style="left:315px;bottom:549px;letter-spacing:0.16px;word-spacing:0.2px;">English +Preli+ Main=Rs. 14,000/- </span><span class="t s0" style="left:621px;bottom:549px;letter-spacing:0.13px;">Received </span>
<span class="t s0" style="left:621px;bottom:530px;letter-spacing:0.12px;word-spacing:0.35px;">Rs. 7500/- 10-03-2026 </span>
<span class="t s0" style="left:621px;bottom:510px;letter-spacing:0.11px;word-spacing:0.35px;">Rs. 6500/- 13-03.2026 </span>
<span class="t s0" style="left:142px;bottom:489px;letter-spacing:0.38px;">5. </span><span class="t s0" style="left:168px;bottom:489px;letter-spacing:0.18px;word-spacing:-0.06px;">March, 2026 </span><span class="t s0" style="left:315px;bottom:489px;letter-spacing:0.16px;word-spacing:0.2px;">English +Preli+ Main=Rs. 14,000/- </span><span class="t s0" style="left:621px;bottom:489px;letter-spacing:0.13px;">Received </span>
<span class="t s0" style="left:621px;bottom:469px;letter-spacing:0.12px;word-spacing:0.35px;">Rs. 1400/- 11-04-2026 </span>
<span class="t s0" style="left:142px;bottom:449px;letter-spacing:0.38px;">6. </span><span class="t s0" style="left:168px;bottom:449px;letter-spacing:0.18px;word-spacing:0.29px;">April, 2026 </span><span class="t s0" style="left:315px;bottom:449px;letter-spacing:0.16px;word-spacing:0.2px;">English +Preli+ Main=Rs. 14,000/- </span><span class="t s0" style="left:621px;bottom:449px;letter-spacing:0.17px;word-spacing:-0.05px;">Payment Due: Rs. 14000/- </span>
<span class="t s2" style="left:107px;bottom:427px;letter-spacing:-0.07px;word-spacing:0.12px;">Terms &amp; Conditions: </span>
<span class="t s3" style="left:134px;bottom:399px;letter-spacing:-0.17px;">1. </span><span class="t s3" style="left:161px;bottom:399px;letter-spacing:-0.08px;word-spacing:0.11px;">Classes are for two days a week. </span>
<span class="t s3" style="left:134px;bottom:381px;letter-spacing:-0.17px;">2. </span><span class="t s3" style="left:161px;bottom:381px;letter-spacing:-0.1px;word-spacing:0.22px;">Class will be scheduled with any other Batch if the class is missed for any genuine Reason </span>
<span class="t s3" style="left:161px;bottom:363px;letter-spacing:-0.12px;word-spacing:0.4px;">(Max-1 or 2). </span>
<span class="t s3" style="left:134px;bottom:345px;letter-spacing:-0.17px;">3. </span><span class="t s3" style="left:161px;bottom:345px;letter-spacing:-0.07px;word-spacing:0.04px;">MCQ questions will be provided as Mock Tests after finishing each subject chapter-wise. </span>
<span class="t s3" style="left:134px;bottom:327px;letter-spacing:-0.17px;">4. </span><span class="t s3" style="left:161px;bottom:327px;letter-spacing:-0.09px;word-spacing:0.19px;">PDF notes will be provided. </span>
<span class="t s3" style="left:134px;bottom:309px;letter-spacing:-0.17px;">5. </span><span class="t s3" style="left:161px;bottom:309px;letter-spacing:-0.11px;word-spacing:0.24px;">Fee will be paid in Advance before the start of next month to 5th day of every month. </span>
<span class="t s3" style="left:134px;bottom:291px;letter-spacing:-0.17px;">6. </span><span class="t s3" style="left:161px;bottom:291px;letter-spacing:-0.09px;word-spacing:0.25px;">The fee is non-refundable. </span>
<span class="t s0" style="left:107px;bottom:186px;letter-spacing:0.18px;">Signature: </span>
<span class="t s0" style="left:107px;bottom:166px;letter-spacing:0.16px;">Sd/- </span>
<span class="t s0" style="left:107px;bottom:146px;letter-spacing:0.22px;word-spacing:0.32px;">(SAYANTANI ROY) </span>
<span class="t s4" style="left:571px;bottom:1190px;letter-spacing:-0.04px;word-spacing:-0.05px;">STUDY CENTRE: </span><span class="t s4" style="left:700px;bottom:1190px;letter-spacing:-0.13px;word-spacing:0.22px;">NBCC VIBGYOR TOWERS. </span>
<span class="t s4" style="left:623px;bottom:1173px;letter-spacing:-0.05px;word-spacing:-0.03px;">Action Area-I. Newtown. Kolkata-700156. </span>
<span class="t s4" style="left:704px;bottom:1156px;letter-spacing:-0.08px;word-spacing:0.18px;">Bus Stop: Newtown Bus Stop </span>
<span class="t s4" style="left:665px;bottom:1138px;letter-spacing:-0.1px;word-spacing:0.31px;">Landmark: Near 3 no Water Tank. </span>
<span class="t s3" style="left:691px;bottom:1122px;letter-spacing:-0.09px;word-spacing:0.28px;">Contact No: +91- 801332 4949. </span>
<span class="t s3" style="left:631px;bottom:1103px;letter-spacing:-0.09px;word-spacing:0.37px;">Email id: </span><span class="t s5" style="left:697px;bottom:1103px;letter-spacing:-0.07px;">lawstudents.edu@gmail.com </span>
<span class="t s3" style="left:31px;bottom:1184px;letter-spacing:-0.06px;word-spacing:-0.02px;">STUDY CENTRE: </span><span class="t s3" style="left:157px;bottom:1184px;letter-spacing:-0.13px;word-spacing:0.41px;">MIRAZ MANZIL </span>
<span class="t s3" style="left:31px;bottom:1166px;letter-spacing:-0.07px;word-spacing:0.1px;">31/1, Tiljala Road. Kolata-700046. </span>
<span class="t s3" style="left:31px;bottom:1148px;letter-spacing:-0.06px;word-spacing:-0.03px;">Landmark: Near 4 No. Darga Road </span>
<span class="t s3" style="left:31px;bottom:1130px;letter-spacing:-0.06px;word-spacing:0.16px;">crossing/Park Circus Station </span>
<span class="t s6" style="left:326px;bottom:1139px;letter-spacing:-0.09px;word-spacing:-0.06px;">Institute of LawStudent </span>
<span class="t s6" style="left:382px;bottom:1111px;letter-spacing:-0.08px;word-spacing:0.3px;">Payment Slip </span>
<span class="t s0" style="left:394px;bottom:197px;letter-spacing:0.16px;">Sd/- </span>
<span class="t s0" style="left:382px;bottom:176px;letter-spacing:0.3px;word-spacing:-0.48px;">(RIZWANA BEGUM) </span>
<span class="t s0" style="left:385px;bottom:147px;letter-spacing:0.28px;word-spacing:-0.06px;">FOR LAWSTUDENT </span>
<span class="t s0" style="left:380px;bottom:86px;letter-spacing:0.16px;word-spacing:0.36px;">Advocate Rizwana Begum </span>
<span class="t s0" style="left:185px;bottom:66px;letter-spacing:0.11px;word-spacing:0.35px;">B. A. (Hons); M. A.; LL. M. (1st Class); PGDCL (Cyber Law-NALSAR-1st Class] </span>
<span class="t s7" style="left:575px;bottom:1040px;letter-spacing:0.16px;word-spacing:0.15px;">Class Time- Saturday &amp; Sunday </span>
<span class="t s7" style="left:575px;bottom:1021px;letter-spacing:0.14px;word-spacing:-0.05px;">(Available in a separate sheet). </span>
<span class="t s7" style="left:579px;bottom:1003px;letter-spacing:0.15px;word-spacing:-0.05px;">Extra Classes: </span>
<span class="t s7" style="left:575px;bottom:983px;letter-spacing:0.1px;word-spacing:0.32px;">Tuesday: From 8:00 PM. - 9:30 PM. </span>
<span class="t s7" style="left:575px;bottom:964px;letter-spacing:0.14px;word-spacing:0.17px;">Thursday: From 8:00 PM. - 9:30 PM. </span>
<span class="t s0" style="left:698px;bottom:250px;letter-spacing:0.15px;word-spacing:0.35px;">Account Holder name: </span>
<span class="t s0" style="left:714px;bottom:227px;letter-spacing:0.22px;word-spacing:0.35px;">RIZWANA BEGUM </span>
<span class="t s0" style="left:722px;bottom:204px;letter-spacing:0.15px;word-spacing:0.08px;">State Bank of India </span>
<span class="t s0" style="left:720px;bottom:182px;letter-spacing:0.13px;word-spacing:0.35px;">A/c no. 41669065973 </span>
<span class="t s0" style="left:608px;bottom:159px;letter-spacing:0.16px;word-spacing:0.21px;">Branch: Newtown Rajarhat (05112) </span>
<span class="t s0" style="left:681px;bottom:136px;letter-spacing:0.18px;word-spacing:0.34px;">IFS CODE: SBIN0005112 </span></div>

</section>

</div>
@endforeach
@endif
<script>
    const metadata = JSON.parse(document.getElementById("metadata").text);
    document.title = metadata.title || metadata.fileName;

    const annotations = JSON.parse(document.getElementById("annotations").text);
    const pages = document.querySelectorAll(".page");

    const createAnnotation = function(container, data, pageNo) {
        if (data.type !== "Link" && data.type !== "TextLink") {
            return;
        }
        if (!data.action) {
            return;
        }

        const annotation = document.createElement("div");
        annotation.setAttribute("style", "");
        annotation.style.left = data.bounds[0] + "px";
        annotation.style.top = data.bounds[1] + "px";
        annotation.style.width = data.bounds[2] + "px";
        annotation.style.height = data.bounds[3] + "px";
        annotation.dataset.type = data.type;
        if (data.objref) {
            annotation.dataset.objref = data.objref;
        }

        if (data.appearance) {
            annotation.style.backgroundImage = "url('" + data.appearance + "')";
            annotation.style.backgroundSize = "100% 100%";
        }

        if (data.action.type === "URI") {
            const element = document.createElement("a");
            element.href = data.action.uri;
            element.title = data.action.uri;
            element.target = "_blank";
            element.style.position = "absolute";
            element.style.width = "100%";
            element.style.height = "100%";
            annotation.appendChild(element);
        } else {
            annotation.addEventListener("click", () => {
                switch (data.action.type) {
                    case "GoTo":
                        pages[data.action.page - 1].scrollIntoView();
                        break;

                    case "Named":
                        switch (data.action.name) {
                            case "NextPage":
                                pages[pageNo - 2].scrollIntoView();
                                break;
                            case "PrevPage":
                                pages[pageNo].scrollIntoView();
                                break;
                            case "FirstPage":
                                pages[0].scrollIntoView();
                                break;
                            case "LastPage":
                                pages[metadata.pagecount - 1].scrollIntoView();
                                break;
                        }
                        break;
                }
            });
        }
        container.append(annotation);
    };

    annotations.pages.forEach(pageAnnotations => {
        const pageNo = pageAnnotations.page;
        const annotationsContainer = document.createElement("div");
        annotationsContainer.className = "annotations-container";
        annotationsContainer.style.width = metadata.bounds[pageNo - 1][0];
        annotationsContainer.style.height = metadata.bounds[pageNo - 1][1];
        pageAnnotations.annotations.forEach(annotation => createAnnotation(annotationsContainer, annotation, pageNo));
        pages[pageNo - 1].appendChild(annotationsContainer);
    });
</script>
<!-- Add this in your blade file before </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.11.0/html2pdf.bundle.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    function printInvoice(invoiceContainer) {
        if (!invoiceContainer) return;

        // Get the inner card-body
        var bodyContent = invoiceContainer.querySelector('.page');
        if (!bodyContent) return;

        var printContents = bodyContent.cloneNode(true);

        var printWindow = window.open('', '', 'height=800,width=1200');
        printWindow.document.write('<html><head><title>Invoice</title>');

        // Include all CSS
        Array.from(document.querySelectorAll('link[rel="stylesheet"], style')).forEach(function(node) {
            printWindow.document.write(node.outerHTML);
        });

        printWindow.document.write('</head><body>');
        printWindow.document.body.appendChild(printContents);
        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }

    function downloadInvoice(invoiceContainer) {
        if (!invoiceContainer) return;

        // Use original rendered invoice body
        var bodyContent = invoiceContainer.querySelector('.page');
        if (!bodyContent) return;

        // Get invoice number
        var invoiceNumber = bodyContent.querySelector('.fw-bold.text-primary');
        var filename = (invoiceNumber ?
            invoiceNumber.textContent.trim() :
            'invoice') + '.pdf';

        // Wait for all images inside this invoice
        const images = bodyContent.querySelectorAll('img');

        Promise.all(
            Array.from(images).map(img => {
                return new Promise(resolve => {
                    if (img.complete && img.naturalHeight !== 0) {
                        resolve();
                    } else {
                        img.onload = resolve;
                        img.onerror = resolve;
                    }
                });
            })
        ).then(() => {

            const opt = {
                margin: 0.2,
                filename: filename,
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 3,
                    useCORS: true,
                    allowTaint: true,
                    logging: false,
                    scrollY: 0
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            html2pdf()
                .set(opt)
                .from(bodyContent)
                .save()
                .catch(function(error) {
                    console.error('PDF generation error:', error);
                    alert('Error generating PDF.');
                });

        });
    }
</script>
</body>
</html>
