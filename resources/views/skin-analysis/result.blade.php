@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    @livewire('skin-analysis-result', ['session_id' => $session_id])
</div>
@endsection