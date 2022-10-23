@extends('layouts.main')
@push('meta')
    <title>Oliva - Settings</title>
@endpush

@section('content')
<h1>Settings</h1>
{{--    <livewire:settings-api-status/>--}}
    <div class="grid mt-5 grid-cols-4 gap-5">
        <div class="col-span-1">
            <livewire:settings-invoice-email-template/>
        </div>
        <div class="col-span-1">
            <livewire:settings-intro-email-template/>
        </div>
    </div>
@endsection
