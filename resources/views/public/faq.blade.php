@extends('layouts.app')

@section('title', 'FAQ - SeiyaSphere')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-16">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Frequently Asked Questions</h1>
        <p class="text-xl text-gray-600">Find answers to common questions about SeiyaSphere</p>
    </div>

    <div class="space-y-6">
        @foreach($faqs as $index => $faq)
        <div class="bg-white rounded-2xl shadow-lg border border-purple-100 overflow-hidden">
            <button class="w-full text-left p-6 focus:outline-none" onclick="toggleFAQ({{ $index }})">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $faq['question'] }}</h3>
                    <span id="icon-{{ $index }}" class="text-purple-600 transform transition-transform">▼</span>
                </div>
                <div id="answer-{{ $index }}" class="mt-4 text-gray-600 hidden">
                    {{ $faq['answer'] }}
                </div>
            </button>
        </div>
        @endforeach
    </div>

    <!-- Additional Help Section -->
    <div class="mt-16 text-center bg-purple-50 rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Still have questions?</h2>
        <p class="text-gray-600 mb-6">Can't find the answer you're looking for? Please reach out to our friendly team.</p>
        <a href="{{ route('contact') }}" 
           class="inline-block bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition">
            Contact Support
        </a>
    </div>
</div>

<script>
function toggleFAQ(index) {
    const answer = document.getElementById('answer-' + index);
    const icon = document.getElementById('icon-' + index);
    
    answer.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}
</script>

<style>
.rotate-180 {
    transform: rotate(180deg);
}
</style>
@endsection