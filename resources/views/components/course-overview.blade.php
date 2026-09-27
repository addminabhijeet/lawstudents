@props(['course'])
@if (filled($course->short_description) || filled($course->description) || filled($course->level))
<div class="academic-course-details">
    @if (filled($course->level))
        <span class="academic-level">Level: {{ ucfirst($course->level) }}</span>
    @endif
    @if (filled($course->short_description))
        <p class="academic-course-overview">{{ html_entity_decode(strip_tags($course->short_description), ENT_QUOTES | ENT_HTML5, 'UTF-8') }}</p>
    @endif
    @if (filled($course->description))
        <details class="academic-course-expand">
            <summary>What this course covers</summary>
            <div class="academic-course-description">{{ html_entity_decode(strip_tags(preg_replace('/<\/(p|div|li|h[1-6])>|<br\s*\/?\s*>/i', "\n", $course->description)), ENT_QUOTES | ENT_HTML5, 'UTF-8') }}</div>
        </details>
    @endif
</div>
@endif
