@php
    use App\Models\WhatsappSetting;

    $whatsapp = WhatsappSetting::first();
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 99999;
            text-decoration: none;
            cursor: grab;
        }

        .whatsapp-float:active {
            cursor: grabbing;
        }

        .whatsapp-icon {
            font-size: 30px;
            pointer-events: none;
        }
    </style>

    <script>
        const dragItem = document.getElementById("whatsappFloat");

        let active = false;
        let currentX;
        let currentY;
        let initialX;
        let initialY;
        let xOffset = 0;
        let yOffset = 0;

        dragItem.addEventListener("mousedown", dragStart);
        document.addEventListener("mouseup", dragEnd);
        document.addEventListener("mousemove", drag);

        function dragStart(e) {
            initialX = e.clientX - xOffset;
            initialY = e.clientY - yOffset;
            active = true;
        }

        function dragEnd() {
            initialX = currentX;
            initialY = currentY;
            active = false;
        }

        function drag(e) {
            if (active) {
                e.preventDefault();
                currentX = e.clientX - initialX;
                currentY = e.clientY - initialY;

                xOffset = currentX;
                yOffset = currentY;

                setTranslate(currentX, currentY, dragItem);
            }
        }

        function setTranslate(xPos, yPos, el) {
            el.style.transform = "translate(" + xPos + "px, " + yPos + "px)";
        }
    </script>
@endif