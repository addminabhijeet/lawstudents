<!-- Session Timeout Warning Modal -->
<div class="modal fade" id="sessionTimeoutModal" tabindex="-1" aria-labelledby="sessionTimeoutLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-warning">
            <div class="modal-header bg-soft-warning">
                <h5 class="modal-title text-warning" id="sessionTimeoutLabel">
                    <i class="feather-alert-triangle me-2"></i>Session Timeout Warning
                </h5>
            </div>
            <div class="modal-body">
                <p class="mb-3">Your session is about to expire due to inactivity.</p>
                <div class="alert alert-info mb-3">
                    <strong>Time remaining:</strong> <span id="timeRemaining">5:00</span> minutes
                </div>
                <p class="text-muted small mb-0">
                    Click "Stay Logged In" to refresh your session and continue working, or your account will be logged out automatically.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" id="logoutButton">
                    <i class="feather-log-out me-2"></i>Logout Now
                </button>
                <button type="button" class="btn btn-primary" id="stayLoggedInButton">
                    <i class="feather-check-circle me-2"></i>Stay Logged In
                </button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    // Session timeout: 120 minutes (from .env SESSION_LIFETIME)
    const SESSION_TIMEOUT_MS = 120 * 60 * 1000;
    // Show warning at: 115 minutes (5 minutes before timeout)
    const WARNING_TIME_MS = 115 * 60 * 1000;

    let sessionTimer = null;
    let warningTimer = null;
    let countdownInterval = null;

    function showTimeRemaining(ms) {
        const totalSeconds = Math.floor(ms / 1000);
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;
        document.getElementById('timeRemaining').textContent =
            minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    }

    function startWarningCountdown() {
        let remainingMs = SESSION_TIMEOUT_MS - WARNING_TIME_MS;

        if (countdownInterval) {
            clearInterval(countdownInterval);
        }

        countdownInterval = setInterval(function() {
            remainingMs -= 1000;
            showTimeRemaining(remainingMs);

            if (remainingMs <= 0) {
                clearInterval(countdownInterval);
                // Auto-logout after final countdown
                document.getElementById('logout-form').submit();
            }
        }, 1000);
    }

    function showWarning() {
        const modal = new bootstrap.Modal(document.getElementById('sessionTimeoutModal'));
        modal.show();
        startWarningCountdown();
    }

    function resetSessionTimer() {
        // Clear all timers
        if (sessionTimer) clearTimeout(sessionTimer);
        if (warningTimer) clearTimeout(warningTimer);
        if (countdownInterval) clearInterval(countdownInterval);

        // Hide modal if shown
        const modal = bootstrap.Modal.getInstance(document.getElementById('sessionTimeoutModal'));
        if (modal) modal.hide();

        // Start new session timer: show warning at 115 minutes
        warningTimer = setTimeout(showWarning, WARNING_TIME_MS);
    }

    // Activity events that reset the session timer
    const activityEvents = ['mousedown', 'keydown', 'scroll', 'touchstart', 'click'];

    function setupActivityListeners() {
        activityEvents.forEach(event => {
            document.addEventListener(event, resetSessionTimer, true);
        });
    }

    // Logout button handler
    document.getElementById('logoutButton').addEventListener('click', function() {
        document.getElementById('logout-form').submit();
    });

    // Stay logged in handler
    document.getElementById('stayLoggedInButton').addEventListener('click', function() {
        // Make a request to refresh the session (Laravel will refresh it automatically)
        fetch('{{ route("student.dashboard") }}', {
            method: 'GET',
            credentials: 'same-origin'
        }).then(() => {
            resetSessionTimer();
        }).catch(err => {
            console.error('Failed to refresh session:', err);
        });
    });

    // Initialize on page load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setupActivityListeners();
            resetSessionTimer();
        });
    } else {
        setupActivityListeners();
        resetSessionTimer();
    }
})();
</script>
