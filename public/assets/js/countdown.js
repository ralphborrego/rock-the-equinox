// Countdown to the festival. Reads the target from data-event-start (ISO datetime).
(function () {
    var el = document.getElementById('countdown');
    if (!el) return;
    var target = new Date(el.getAttribute('data-event-start'));
    if (isNaN(target.getTime())) {
        el.style.display = 'none';
        var label = document.getElementById('countdown-label');
        if (label) label.textContent = 'Dates announced soon';
        return;
    }
    function pad(n) { return (n < 10 ? '0' : '') + n; }
    function tick() {
        var diff = target - new Date();
        if (diff <= 0) {
            el.innerHTML = '<div><div class="num">NOW</div><div class="lbl">Rocking</div></div>';
            return;
        }
        var d = Math.floor(diff / 864e5),
            h = Math.floor(diff / 36e5) % 24,
            m = Math.floor(diff / 6e4) % 60,
            s = Math.floor(diff / 1e3) % 60;
        el.innerHTML =
            '<div><div class="num">' + d + '</div><div class="lbl">Days</div></div>' +
            '<div><div class="num">' + pad(h) + '</div><div class="lbl">Hours</div></div>' +
            '<div><div class="num">' + pad(m) + '</div><div class="lbl">Minutes</div></div>' +
            '<div><div class="num">' + pad(s) + '</div><div class="lbl">Seconds</div></div>';
    }
    tick();
    setInterval(tick, 1000);
})();
