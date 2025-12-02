@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-xl p-6">

        <h2 class="text-2xl font-bold mb-3">
            {{ $dataset['title'] ?? $dataset['name'] }}
        </h2>

        <p class="text-gray-700 mb-6">
            {{ $dataset['notes'] ?? 'No description' }}
        </p>

        <h3 class="font-semibold text-lg mb-2">Resources</h3>

        <ul class="space-y-3">
            @foreach ($dataset['resources'] as $r)
                <li class="p-3 border rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                    <a href="{{ $r['url'] }}" target="_blank" class="text-blue-600 font-medium">
                        {{ $r['name'] ?? $r['url'] }}
                    </a>
                </li>
            @endforeach
        </ul>

    </div>
@endsection
