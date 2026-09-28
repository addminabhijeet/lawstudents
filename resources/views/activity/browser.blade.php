<script defer src="{{ asset('assets/js/activity-tracker.js') }}?v=1"
    data-activity-context="{{ $activityContext }}"
    data-activity-endpoint="{{ route('activity.events') }}"
    data-activity-csrf="{{ csrf_token() }}"></script>
