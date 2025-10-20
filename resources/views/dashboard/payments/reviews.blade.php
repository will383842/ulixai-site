@extends('dashboard.layouts.master')

@section('title', 'Reviews')

@section('content')
<!-- Layout Wrapper -->
<div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-6 lg:p-10">
        <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 max-w-3xl mx-auto">
            <h2 class="text-blue-900 font-bold text-lg mb-6 uppercase text-center sm:text-left">
                Give your review to your Ulysse to trigger the payment
            </h2>

            <!-- Step 1: Star Rating -->
            <form action="{{ route('review-ulysse', ['mission' => $mission->id]) }}" method="POST">
                @csrf
                <div class="mb-6">
                    <p class="text-sm font-semibold mb-2 flex items-center gap-2">
                        <span class="bg-blue-500 text-white rounded-full px-2">1</span> Give a rating out of 5
                    </p>
                    <div class="flex gap-2 text-2xl" id="starRating">
                        <span class="star" data-rating="1">★</span>
                        <span class="star" data-rating="2">★</span>
                        <span class="star" data-rating="3">★</span>
                        <span class="star" data-rating="4">★</span>
                        <span class="star" data-rating="5">★</span>
                    </div>
                    <input type="hidden" name="rating" id="rating" value="0">
                </div>

                <!-- Step 2: Service Success -->
                <div class="mb-6">
                    <p class="text-sm font-semibold mb-2 flex items-center gap-2">
                        <span class="bg-blue-500 text-white rounded-full px-2">2</span> Did the service go well?
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 text-sm">
                        <label><input type="radio" name="service_success" value="yes" class="mr-1" checked> Yes</label>
                        <label><input type="radio" name="service_success" value="no" class="mr-1"> No</label>
                    </div>
                </div>

                <!-- Step 3: Service Attributes -->
                <div class="mb-6">
                    <p class="text-sm font-semibold mb-2 flex items-center gap-2">
                        <span class="bg-blue-500 text-white rounded-full px-2">3</span> How was your service provider?
                    </p>
                    <div class="space-y-2">
                    @php
                        $attributes = ['Nice', 'Efficient', 'Punctual', 'Very professional'];
                    @endphp
                    @foreach ($attributes as $index => $attr)
                        <div class="flex justify-between items-center border rounded-full px-4 py-2 text-sm bg-white shadow-sm">
                            <span>{{ $attr }}</span>
                            <div class="flex gap-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="provider_attribute" value="{{ $attr }}" class="form-radio text-blue-500" @if($index == 0) checked @endif>
                                </label>
                            </div>
                        </div>
                    @endforeach
                    </div>

                </div>

                <!-- Step 4: Comment -->
                <div class="mb-6">
                    <p class="text-sm font-semibold mb-2 flex items-center gap-2">
                        <span class="bg-blue-500 text-white rounded-full px-2">4</span> Leave a comment on your Ulysse
                    </p>
                    <textarea name="comment" rows="4" class="w-full border rounded-xl p-4 text-sm placeholder-gray-400 resize-none" placeholder="Leave the comment here" required></textarea>
                    <p class="text-xs text-gray-500 mt-2">
                        By clicking <strong>I confirm</strong>, you acknowledge that the service was completed and approve the payment.
                    </p>
                </div>

                <!-- Service not carried out -->
                <div class="mb-6">
                    <a href="reviewoptions.php" class="text-sm font-semibold text-blue-600 underline block text-center sm:text-left">The service was not carried out</a>
                </div>

                <!-- Confirm Button -->
                <div class="text-center sm:text-right">
                    <button type="submit" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full font-semibold text-sm transition duration-300">
                        I CONFIRM
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<!-- JS: Star Rating -->
<script>
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = parseInt(star.getAttribute('data-rating'));
            stars.forEach(s => {
                s.classList.toggle('selected', parseInt(s.getAttribute('data-rating')) <= rating);
            });
            ratingInput.value = rating;
        });
    });
</script>
<style>
    .star {
        cursor: pointer;
        font-size: 1.75rem;
        color: #d1d5db;
    }
    .star.selected {
        color: #fbbf24;
    }
</style>

@endsection
