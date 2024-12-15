@extends('layouts.app')

{{-- @section('title', 'Home') --}}

@section('content')
    <h1 class="text-center">Hello world!</h1>
    <h2>Not centered teeext</h2>
    <p>This is lorem ipsum text </p>
    <div class="d-flex align-items-center justify-content-center py-5">
        <span class="me-2">Light</span>
        <label class="theme-switch">
            <input type="checkbox" id="theme-switch">
            <span class="slider"></span>
        </label>
        <span class="ms-2">Dark</span>
    </div>
@endSection
