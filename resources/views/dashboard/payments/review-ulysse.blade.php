@extends('dashboard.layouts.master')

@section('title', 'Reviews Ulysse')

@section('content')
  <!-- Layout Wrapper -->
  <div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-6 lg:p-10">
      <div class="bg-white rounded-2xl shadow-xl px-6 py-8 sm:p-8 max-w-3xl mx-auto space-y-6">
        <h2 class="text-blue-900 font-bold text-lg sm:text-xl uppercase text-center sm:text-left">What do you think of Ulixai?</h2>

        <!-- Form to Submit Rating and Comment -->
        <form action="{{ route('submit-ulixai-review') }}" method="POST" id="reviewForm">
          @csrf

          <!-- Step 1: Star Rating -->
          <div>
            <p class="text-sm font-semibold mb-2 flex items-center gap-2">
              <span class="bg-blue-500 text-white rounded-full px-2">1</span> Give a rating out of 5
            </p>
            <div class="flex gap-2 text-2xl justify-center sm:justify-start" id="zelpyRating">
              <span class="star" data-rating="1">★</span>
              <span class="star" data-rating="2">★</span>
              <span class="star" data-rating="3">★</span>
              <span class="star" data-rating="4">★</span>
              <span class="star" data-rating="5">★</span>
            </div>
            <!-- Hidden input to store the selected rating -->
            <input type="hidden" name="rating" id="rating" value="0">
          </div>

          <!-- Step 2: Comment -->
          <div>
            <p class="text-sm font-semibold mb-2 flex items-center gap-2">
              <span class="bg-blue-500 text-white rounded-full px-2">2</span> Leave a comment on Ulixai
            </p>
            <textarea name="comment" rows="4" class="w-full border border-blue-300 rounded-xl p-4 text-sm placeholder-gray-400 resize-none" placeholder="Leave the comment here" required></textarea>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4">
            <a href="{{ route('review-options') }}" class="text-sm font-semibold text-blue-600 underline">But</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full font-semibold text-sm transition">
              I CONFIRM
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>

  <!-- Star Rating Script -->
  <script>
    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
      star.addEventListener('click', () => {
        const rating = parseInt(star.getAttribute('data-rating'));
        document.getElementById('rating').value = rating; // Set the rating in the hidden input
        stars.forEach(s => {
          s.classList.toggle('selected', parseInt(s.getAttribute('data-rating')) <= rating);
        });
      });
    });
  </script>

  <style>
    .star {
      cursor: pointer;
      font-size: 1.8rem;
      color: #cbd5e0; /* Gray-300 */
    }
    .star.selected {
      color: #3b82f6; /* Blue-500 */
    }
  </style>
@endsection
