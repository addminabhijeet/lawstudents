(function () {
    'use strict';

    const script = document.currentScript;
    const companyName = script.dataset.companyName;
    const logo = new Image();
    const logoReady = new Promise(function (resolve) {
        logo.onload = function () { resolve(true); };
        logo.onerror = function () { resolve(false); };
    });
    logo.src = script.dataset.companyLogo;

    window.drawPaidNoteWatermark = async function (canvas, outputScale) {
        const hasLogo = await logoReady;
        const ctx = canvas.getContext('2d');
        const logoWidth = Math.min(260 * outputScale, canvas.width * 0.55);
        const logoHeight = hasLogo ? logoWidth * logo.naturalHeight / logo.naturalWidth : 0;
        const rowGap = Math.max(200 * outputScale, logoHeight + 60 * outputScale);

        ctx.save();
        ctx.globalAlpha = 0.20;
        ctx.font = 'bold ' + (28 * outputScale) + 'px Arial';
        ctx.fillStyle = '#646464';
        ctx.textAlign = 'center';
        ctx.translate(canvas.width / 2, canvas.height / 2);
        ctx.rotate(-Math.PI / 6);

        for (let y = -canvas.height; y < canvas.height; y += rowGap) {
            if (hasLogo) {
                ctx.drawImage(logo, -logoWidth / 2, y - logoHeight - 12 * outputScale, logoWidth, logoHeight);
            }
            ctx.fillText(companyName, 0, y, canvas.width * 0.7);
        }

        ctx.restore();
    };
}());
