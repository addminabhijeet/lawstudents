<div class="form-check mt-2">
    <input type="hidden" name="show_watermark" value="0">
    <input class="form-check-input" type="checkbox" name="show_watermark" value="1"
        id="{{ $watermarkInputId ?? 'uploadWatermark' }}" @checked(old('show_watermark', true))>
    <label class="form-check-label" for="{{ $watermarkInputId ?? 'uploadWatermark' }}">Show watermark</label>
</div>
