@extends('admin.dashboard.index')
@section('title', 'SEO & Analytics')

@section('admin-content')
<div class="container-fluid px-3 py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Visiteurs — 30 derniers jours (GA4)</h5>
        <a href="/admin/seo/export?section=visitors" class="small text-decoration-none">Exportateur CSV</a>
    </div>

    <div class="card">
        <div class="card-body">
            <canvas id="ga4VisitorsChart" height="88"></canvas>
            @if(empty($visitorsTrend))
                <p class="text-muted mt-3 mb-0">Aucune donnée disponible (GA4 inactif ou pas encore de trafic).</p>
            @endif
        </div>
    </div>

    <hr class="my-4"/>

    <div class="row g-3">
        {{-- Bing summary --}}
        <div class="col-12 col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Backlinks (Bing)</span>
                    @if(($metrics['bing']['connected'] ?? false))
                        <span class="badge bg-success">Connecté</span>
                    @else
                        <span class="badge bg-secondary">Hors ligne</span>
                    @endif
                </div>
                <div class="card-body">
                    @if(!empty($metrics['bing']['summary']))
                        <pre class="mb-0" style="white-space:pre-wrap">{{ json_encode($metrics['bing']['summary'], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
                    @else
                        <p class="text-muted mb-0">Connecte l’API Bing Webmaster pour voir le résumé.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Open PageRank --}}
        <div class="col-12 col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Open PageRank</span>
                    @if(($metrics['opr']['connected'] ?? false))
                        <span class="badge bg-success">Connecté</span>
                    @else
                        <span class="badge bg-secondary">Hors ligne</span>
                    @endif
                </div>
                <div class="card-body">
                    @if(!is_null($metrics['opr']['rank'] ?? null))
                        <div class="display-6">{{ $metrics['opr']['rank'] }}</div>
                        <p class="text-muted mb-0">Rank actuel du domaine.</p>
                    @else
                        <p class="text-muted mb-0">Ajoute la clé OPEN_PAGERANK_API_KEY dans .env pour l’afficher.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function () {
    const ctx = document.getElementById('ga4VisitorsChart');
    if (!ctx) return;

    // Données passées par le contrôleur (tableau {YYYY-MM-DD: value})
    const trend = @json($visitorsTrend ?? []);
    const labels = Object.keys(trend);
    const values = Object.values(trend);

    // Si pas de données, on initialise un graph vide (pas d’erreur)
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Visiteurs actifs',
                data: values,
                tension: 0.3,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { maxRotation: 0 }, grid: { display: false } },
                y: { beginAtZero: true }
            }
        }
    });
})();
</script>
@endpush
