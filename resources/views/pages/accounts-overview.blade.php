@extends('layouts.main')
@push('meta')
    <title>Oliva - {{ ucwords($minerName) }}</title>
@endpush

@section('content')
<h1 class="text-2xl font-bold">Account Overview - {{ ucwords($minerName) }}</h1>
<livewire:account-metrics :accountProfile="$accountId" />
@endsection
