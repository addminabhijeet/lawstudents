@php
$setting = $whatsapp->first();
@endphp

<form action="{{ route('updateWhatsapp', ['id' => $setting ? $setting->id : 1]) }}" method="POST">
    @csrf

    <input type="text"
           name="whatsapp_number"
           placeholder="WhatsApp Number"
           value="{{ $setting ? $setting->whatsapp_number : '' }}">

    <textarea name="pre_message">{{ $setting ? $setting->pre_message : 'Hello LawStudents, I am interested in...' }}</textarea>

    <button type="submit">Save</button>
</form>