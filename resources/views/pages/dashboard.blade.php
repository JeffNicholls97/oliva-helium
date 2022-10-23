@extends('layouts.main')

@push('meta')
    <title>Oliva - Dashboard</title>
@endpush

@section('content')
<div class="h-20">
    <h1 class="px-5 py-2 inline-block rounded-lg bg-gray-100">Hi {{ Auth::user()->name }}, Good <span id="stringMessage"></span></h1>
</div>
<div class="flex gap-5 h-[calc(100%-5rem)]">
    <div class="grid w-3/5 grid-cols-2 gap-5">
        <div class="col-span-full">
            <livewire:dashboard-accounts />
        </div>
        <div class="col-span-full">
            <livewire:dashboard-invoices />
        </div>
    </div>
    <div class="w-2/5 h-full">
        <livewire:dashboard-leaderboard />
    </div>
</div>
<script>
    var today = new Date()
    var curHr = today.getHours()
    var string = document.getElementById('stringMessage')

    if (curHr < 12) {
        string.innerText = 'Morning'
    } else if (curHr < 18) {
        string.innerText = 'Afternoon'
    } else {
        string.innerText = 'Evening'
    }
</script>

@endsection
