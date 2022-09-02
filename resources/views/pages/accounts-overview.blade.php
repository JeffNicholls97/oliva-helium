@extends('layouts.main')

@section('content')
<h1 class="text-2xl font-bold">Account Overview</h1>
<livewire:account-metrics :accountProfile="$accountId" />
@endsection