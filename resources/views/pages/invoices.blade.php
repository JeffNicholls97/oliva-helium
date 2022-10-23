@extends('layouts.main')
@push('meta')
    <title>Oliva - Invoices</title>
@endpush

@section('content')
    <livewire:invoices-table />
@endsection
