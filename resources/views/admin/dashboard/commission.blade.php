<!-- Commission Settings -->
<div class="bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-bold text-blue-700 mb-4">Commission Settings</h3>
    <form method="POST" action="{{ route('admin.commission.update') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Client-side commission (%)</label>
            <input type="number" step="0.01" min="0" max="100" name="client_fee" value="{{ config('ulixai.fees.client', 5) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Provider-side commission (%)</label>
            <input type="number" step="0.01" min="0" max="100" name="provider_fee" value="{{ config('ulixai.fees.provider', 15) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Affiliate commission (%)</label>
            <input type="number" step="0.01" min="0" max="100" name="affiliate_fee" value="{{ config('ulixai.fees.affiliate', 30) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded font-semibold hover:bg-blue-700">Update Commissions</button>
    </form>
</div>

<!-- Affiliate Program Summary -->
<div class="bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-bold text-blue-700 mb-4">Affiliate Program</h3>
    <div class="flex flex-col gap-2">
        <div>Affiliate Rate: <span class="font-semibold">{{ config('ulixai.fees.affiliate', 30) }}%</span></div>
        <div>Eligibility Period: <span class="font-semibold">30 days</span></div>
        <div>Affiliate Role: <span class="font-semibold">All</span></div>
    </div>
</div>