@php
    use App\Models\WhatsappSetting;

    $whatsapp = WhatsappSetting::first();
    $number = $whatsapp ? $whatsapp->whatsapp_number : '';
    $message = $whatsapp ? urlencode($whatsapp->pre_message) : urlencode('Hello LawStudents, I am interested in...');
@endphp

@if ($number)
    <a href="https://wa.me/{{ $number }}?text={{ $message }}" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp whatsapp-icon"></i>
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            left: 20px;   /* changed from right to left */
            background: #25D366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            text-decoration: none;
        }

        .whatsapp-icon {
            font-size: 30px;
        }
    </style>
@endif