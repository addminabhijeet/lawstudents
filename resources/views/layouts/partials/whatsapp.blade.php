@php
    use App\Models\WhatsappSetting;

    $whatsapp = WhatsappSetting::latest()->first();
    $number = $whatsapp ? $whatsapp->whatsapp_number : '';
    $message = $whatsapp ? urlencode($whatsapp->pre_message) : urlencode('Hello LawStudents, I am interested in...');
@endphp

@if ($number)
    <a href="https://wa.me/{{ $number }}?text={{ $message }}"
       class="whatsapp-float"
       id="whatsappFloat"
       target="_blank">
        <i class="fab fa-whatsapp whatsapp-icon"></i>
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: #25D366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
            z-index: 99999;
            text-decoration: none;
            cursor: grab;
            transition: box-shadow 0.3s ease;
        }

        .whatsapp-float:active {
            cursor: grabbing;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35);
        }

        .whatsapp-icon {
            font-size: 28px;
            pointer-events: none;
        }
    </style>

    <script>
        const button = document.getElementById("whatsappFloat");

        let isDragging = false;
        let offsetX, offsetY;

        // Load saved position
        const savedPosition = localStorage.getItem("whatsappPosition");
        if (savedPosition) {
            const pos = JSON.parse(savedPosition);
            button.style.left = pos.left + "px";
            button.style.top = pos.top + "px";
            button.style.bottom = "auto";
        }

        const startDrag = (e) => {
            isDragging = true;
            const rect = button.getBoundingClientRect();
            offsetX = (e.touches ? e.touches[0].clientX : e.clientX) - rect.left;
            offsetY = (e.touches ? e.touches[0].clientY : e.clientY) - rect.top;
        };

        const drag = (e) => {
            if (!isDragging) return;

            e.preventDefault();

            const clientX = e.touches ? e.touches[0].clientX : e.clientX;
            const clientY = e.touches ? e.touches[0].clientY : e.clientY;

            let left = clientX - offsetX;
            let top = clientY - offsetY;

            // Keep inside screen
            left = Math.max(0, Math.min(window.innerWidth - button.offsetWidth, left));
            top = Math.max(0, Math.min(window.innerHeight - button.offsetHeight, top));

            button.style.left = left + "px";
            button.style.top = top + "px";
            button.style.bottom = "auto";
        };

        const endDrag = () => {
            if (!isDragging) return;
            isDragging = false;

            // Snap to nearest side
            const rect = button.getBoundingClientRect();
            const snapLeft = rect.left < window.innerWidth / 2;

            button.style.left = snapLeft ? "10px" : (window.innerWidth - button.offsetWidth - 10) + "px";

            // Save position
            localStorage.setItem("whatsappPosition", JSON.stringify({
                left: button.offsetLeft,
                top: button.offsetTop
            }));
        };

        // Mouse Events
        button.addEventListener("mousedown", startDrag);
        document.addEventListener("mousemove", drag);
        document.addEventListener("mouseup", endDrag);

        // Touch Events (Mobile)
        button.addEventListener("touchstart", startDrag);
        document.addEventListener("touchmove", drag, { passive: false });
        document.addEventListener("touchend", endDrag);
    </script>
@endif