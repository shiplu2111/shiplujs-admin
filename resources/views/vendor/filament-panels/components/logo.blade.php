@php
    $setting = DB::table('settings')->first();
     $url = 'storage/' . $setting->logo;
@endphp
<img  src="{{ asset($url) }}" alt="Logo" class="w-auto h-16">
