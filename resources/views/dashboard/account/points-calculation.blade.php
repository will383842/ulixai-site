@extends('dashboard.layouts.master')

@section('title', 'Calcul des Points')

@section('content')

@php
  $user = auth()->user();
  if($user && $user->user_role === 'service_provider') {
    $reputationPoints = $user->serviceprovider->points ?? 0;
    $points = $reputationPoints ?? 0;
    $maxPoints = 300;
    $progress = min(100, round(($points ?? 0) / $maxPoints * 100)) ?? 0;
    $remainingPoints = max(0, $maxPoints - $points);
    
    $milestones = [
        ['label' => 'Ulysse', 'point' => 0, 'icon' => 'fa-star'],
        ['label' => 'Ulysse ++', 'point' => 100, 'icon' => 'fa-star-half-stroke'],
        ['label' => 'Top Ulysse', 'point' => 200, 'icon' => 'fa-certificate'],
        ['label' => 'Ulysse Diamond', 'point' => 300, 'icon' => 'fa-gem'],
    ];
    
    $nextMilestone = collect($milestones)->first(fn($m) => $m['point'] > $points);
    $pointsToNext = $nextMilestone ? $nextMilestone['point'] - $points : 0;
  }
@endphp

<div class="min-h-screen pb-24 sm:pb-20 lg:pb-8">
  
  <!-- Hero Stats -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <div class="stat-card bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-6 text-white shadow-lg" role="region" aria-labelledby="points-heading">
      <div class="flex items-center justify-between mb-2">
        <span class="text-sm font-medium opacity-90" id="points-heading">Vos Points</span>
        <i class="fas fa-award text-2xl opacity-80" aria-hidden="true"></i>
      </div>
      <div class="text-4xl font-bold mb-1" aria-live="polite">{{ $points }}</div>
      <div class="text-sm opacity-75">sur {{ $maxPoints }} points</div>
    </div>

    <div class="stat-card bg-white rounded-2xl p-6 shadow-sm border border-gray-100" role="region" aria-labelledby="progress-heading">
      <div class="flex items-center justify-between mb-2">
        <span class="text-sm font-medium text-gray-600" id="progress-heading">Progression</span>
        <i class="fas fa-chart-line text-2xl text-blue-600" aria-hidden="true"></i>
      </div>
      <div class="text-4xl font-bold text-blue-600 mb-1" aria-live="polite">{{ $progress }}%</div>
      <div class="text-sm text-gray-500">vers le niveau max</div>
    </div>

    <div class="stat-card bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sm:col-span-2 lg:col-span-1" role="region" aria-labelledby="next-heading">
      <div class="flex items-center justify-between mb-2">
        <span class="text-sm font-medium text-gray-600" id="next-heading">Prochain palier</span>
        <i class="fas fa-bullseye text-2xl text-orange-500" aria-hidden="true"></i>
      </div>
      <div class="text-4xl font-bold text-gray-800 mb-1" aria-live="polite">{{ $pointsToNext }}</div>
      <div class="text-sm text-gray-500">points restants</div>
    </div>
  </div>

  <!-- Progress Bar Section -->
  <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6" aria-labelledby="progress-section">
    <h2 id="progress-section" class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
      <i class="fas fa-trophy text-blue-600" aria-hidden="true"></i>
      Votre Progression
    </h2>

    <div class="relative bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-2xl p-6 mb-6">
      <div class="relative h-12 flex items-center mb-8" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100" aria-label="Progression vers le niveau maximum">
        <div class="absolute left-0 right-0 top-1/2 -translate-y-1/2 h-3 bg-gray-200 rounded-full"></div>
        <div class="absolute left-0 top-1/2 -translate-y-1/2 h-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-700 shadow-lg motion-safe:animate-progress" style="width: {{ $progress }}%"></div>
        
        <div class="relative flex justify-between items-center w-full z-10">
          @foreach ($milestones as $index => $milestone)
            <div class="flex flex-col items-center" style="width: {{ 100 / count($milestones) }}%">
              <button 
                type="button"
                class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 {{ $points >= $milestone['point'] ? 'bg-blue-600 shadow-lg scale-110' : 'bg-white border-2 border-gray-300' }}"
                aria-label="{{ $milestone['label'] }} - {{ $milestone['point'] }} points {{ $points >= $milestone['point'] ? '(atteint)' : '' }}"
                tabindex="0">
                <i class="fas {{ $milestone['icon'] }} {{ $points >= $milestone['point'] ? 'text-white' : 'text-gray-400' }}" aria-hidden="true"></i>
              </button>
            </div>
          @endforeach
        </div>
      </div>

      <div class="grid grid-cols-4 gap-2 text-center mb-4">
        @foreach ($milestones as $milestone)
          <div>
            <div class="text-xs sm:text-sm font-semibold {{ $points >= $milestone['point'] ? 'text-blue-700' : 'text-gray-600' }}">
              {{ $milestone['label'] }}
            </div>
            <div class="text-xs text-gray-500 mt-1">{{ $milestone['point'] }} pts</div>
          </div>
        @endforeach
      </div>

      <div class="text-center">
        <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-sm">
          <i class="fas fa-star text-yellow-500" aria-hidden="true"></i>
          <span class="text-sm font-semibold text-gray-700">{{ $points }} / {{ $maxPoints }} points</span>
        </div>
      </div>
    </div>
  </section>

  <!-- How to Earn Points -->
  <section class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl shadow-lg p-6 mb-6 text-white" aria-labelledby="earn-heading">
    <h2 id="earn-heading" class="text-xl font-bold mb-4 flex items-center gap-2">
      <i class="fas fa-lightbulb" aria-hidden="true"></i>
      Comment gagner des points ?
    </h2>
    <p class="text-sm opacity-90 mb-6">
      Plus vous avez de points, plus vous êtes visible et plus vous recevez de demandes de service !
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div class="info-card bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
        <div class="flex items-center gap-3 mb-3">
          <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
            <i class="fas fa-star text-white" aria-hidden="true"></i>
          </div>
          <div class="flex-1">
            <h3 class="font-semibold">Évaluations positives</h3>
          </div>
        </div>
        <dl class="space-y-2 text-sm">
          <div class="flex justify-between items-center">
            <dt class="opacity-90">5 étoiles</dt>
            <dd class="font-bold text-green-300">+20 points</dd>
          </div>
          <div class="flex justify-between items-center">
            <dt class="opacity-90">4 étoiles</dt>
            <dd class="font-bold text-green-300">+5 points</dd>
          </div>
          <div class="flex justify-between items-center">
            <dt class="opacity-90">3 étoiles</dt>
            <dd class="font-bold">+0 points</dd>
          </div>
        </dl>
      </div>

      <div class="info-card bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
        <div class="flex items-center gap-3 mb-3">
          <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
            <i class="fas fa-exclamation-triangle text-white" aria-hidden="true"></i>
          </div>
          <div class="flex-1">
            <h3 class="font-semibold">Pénalités</h3>
          </div>
        </div>
        <dl class="space-y-2 text-sm">
          <div class="flex justify-between items-center">
            <dt class="opacity-90">2 étoiles</dt>
            <dd class="font-bold text-red-300">-20 points</dd>
          </div>
          <div class="flex justify-between items-center">
            <dt class="opacity-90">1 étoile</dt>
            <dd class="font-bold text-red-300">-50 points</dd>
          </div>
          <div class="flex justify-between items-center">
            <dt class="opacity-90">Annulation</dt>
            <dd class="font-bold text-red-300">-150 points</dd>
          </div>
        </dl>
      </div>
    </div>
  </section>

  <!-- Benefits Cards -->
  <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6" aria-labelledby="benefits-heading">
    <h2 id="benefits-heading" class="sr-only">Avantages d'avoir plus de points</h2>
    
    <article class="benefit-card bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
        <i class="fas fa-eye text-blue-600 text-xl" aria-hidden="true"></i>
      </div>
      <h3 class="font-semibold text-gray-800 mb-2">Visibilité maximale</h3>
      <p class="text-sm text-gray-600">Apparaissez en premier dans les résultats de recherche</p>
    </article>

    <article class="benefit-card bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
      <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
        <i class="fas fa-users text-green-600 text-xl" aria-hidden="true"></i>
      </div>
      <h3 class="font-semibold text-gray-800 mb-2">Plus de demandes</h3>
      <p class="text-sm text-gray-600">Recevez plus de propositions de missions</p>
    </article>

    <article class="benefit-card bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:col-span-2 lg:col-span-1">
      <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
        <i class="fas fa-badge-check text-purple-600 text-xl" aria-hidden="true"></i>
      </div>
      <h3 class="font-semibold text-gray-800 mb-2">Badge de confiance</h3>
      <p class="text-sm text-gray-600">Obtenez un badge qui rassure les clients</p>
    </article>
  </section>

  <!-- Tips Section -->
  <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" aria-labelledby="tips-heading">
    <h2 id="tips-heading" class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
      <i class="fas fa-rocket text-orange-500" aria-hidden="true"></i>
      Conseils pour progresser rapidement
    </h2>
    <ul class="space-y-3" role="list">
      <li class="flex items-start gap-3">
        <div class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
          <i class="fas fa-check text-blue-600 text-xs" aria-hidden="true"></i>
        </div>
        <p class="text-sm text-gray-700">Répondez rapidement aux demandes de service</p>
      </li>
      <li class="flex items-start gap-3">
        <div class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
          <i class="fas fa-check text-blue-600 text-xs" aria-hidden="true"></i>
        </div>
        <p class="text-sm text-gray-700">Maintenez une communication claire avec vos clients</p>
      </li>
      <li class="flex items-start gap-3">
        <div class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
          <i class="fas fa-check text-blue-600 text-xs" aria-hidden="true"></i>
        </div>
        <p class="text-sm text-gray-700">Livrez un travail de qualité pour obtenir 5 étoiles</p>
      </li>
      <li class="flex items-start gap-3">
        <div class="w-6 h-6 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
          <i class="fas fa-check text-blue-600 text-xs" aria-hidden="true"></i>
        </div>
        <p class="text-sm text-gray-700">Évitez les annulations de dernière minute</p>
      </li>
    </ul>
  </section>
</div>

<style>
/* Animations optimisées avec prefers-reduced-motion */
@media (prefers-reduced-motion: no-preference) {
  @keyframes progress {
    from {
      width: 0;
    }
  }
  
  .motion-safe\:animate-progress {
    animation: progress 1s ease-out;
  }
  
  .stat-card, .benefit-card, .info-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  
  .stat-card:hover, .benefit-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
  }
}

/* Focus visible pour l'accessibilité clavier */
.focus-visible:focus {
  outline: 2px solid #3b82f6;
  outline-offset: 2px;
}

/* Amélioration du contraste */
@media (prefers-contrast: high) {
  .text-gray-600 {
    color: #1f2937;
  }
  .text-gray-500 {
    color: #374151;
  }
}

/* Responsive optimisé */
@media (max-width: 640px) {
  .grid-cols-4 > div {
    font-size: 0.7rem;
  }
}
</style>

@endsection