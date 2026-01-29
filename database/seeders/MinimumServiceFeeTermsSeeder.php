<?php

namespace Database\Seeders;

use App\Models\TermsSection;
use Illuminate\Database\Seeder;

class MinimumServiceFeeTermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Adds the minimum service fee section to the provider terms and conditions.
     */
    public function run(): void
    {
        // Get the last order number for provider terms
        $lastOrder = TermsSection::where('type', TermsSection::TYPE_PROVIDER)
            ->max('number') ?? 0;

        // Check if the section already exists
        $existingSection = TermsSection::where('slug', 'provider-minimum-service-fee')->first();

        if ($existingSection) {
            // Update existing section
            $existingSection->update([
                'title' => 'Minimum Service Fee / Frais de Service Minimum',
                'body' => $this->getBody(),
                'is_active' => true,
                'version' => 'v1.0',
                'effective_date' => now(),
            ]);
            $this->command->info('Updated existing minimum service fee terms section.');
        } else {
            // Create new section
            TermsSection::create([
                'number' => $lastOrder + 1,
                'title' => 'Minimum Service Fee / Frais de Service Minimum',
                'slug' => 'provider-minimum-service-fee',
                'body' => $this->getBody(),
                'type' => TermsSection::TYPE_PROVIDER,
                'is_active' => true,
                'version' => 'v1.0',
                'effective_date' => now(),
            ]);
            $this->command->info('Created minimum service fee terms section.');
        }
    }

    /**
     * Get the HTML body content for the minimum service fee section.
     */
    private function getBody(): string
    {
        return <<<'HTML'
<h3>Minimum Service Fee</h3>

<p>A minimum service fee applies to all transactions processed through the Ulixai platform. This ensures the sustainability of our services and fair compensation for platform operations.</p>

<h4>Fee Structure</h4>
<ul>
    <li><strong>Euro (EUR):</strong> A minimum service fee of <strong>10€</strong> per transaction applies.</li>
    <li><strong>US Dollar (USD):</strong> A minimum service fee of <strong>$12</strong> per transaction applies.</li>
</ul>

<h4>How It Works</h4>
<p>For each completed mission, a service fee is calculated based on a percentage of the transaction amount (currently 15%). If this calculated fee is less than the minimum service fee for your currency, the minimum fee will be applied instead.</p>

<p><strong>Example:</strong></p>
<ul>
    <li>Mission amount: 50€</li>
    <li>Calculated fee (15%): 7.50€</li>
    <li>Since 7.50€ is less than the minimum of 10€, a fee of <strong>10€</strong> will be deducted.</li>
    <li>You receive: 50€ - 10€ = <strong>40€</strong></li>
</ul>

<p>For transactions where the calculated fee exceeds the minimum, the percentage-based fee applies:</p>
<ul>
    <li>Mission amount: 100€</li>
    <li>Calculated fee (15%): 15€</li>
    <li>Since 15€ is greater than the minimum of 10€, a fee of <strong>15€</strong> will be deducted.</li>
    <li>You receive: 100€ - 15€ = <strong>85€</strong></li>
</ul>

<h4>Currency-Specific Considerations</h4>
<p>The minimum fee is determined by the currency of the mission. If you accept missions in different currencies, the corresponding minimum fee for each currency will apply.</p>

<h4>Transparency</h4>
<p>The applicable fee (whether minimum or percentage-based) is always displayed before you accept a mission offer, ensuring full transparency in your earnings.</p>

<hr>

<h3>Frais de Service Minimum (Français)</h3>

<p>Des frais de service minimum s'appliquent à toutes les transactions traitées via la plateforme Ulixai. Cela garantit la pérennité de nos services et une compensation équitable pour les opérations de la plateforme.</p>

<h4>Structure des Frais</h4>
<ul>
    <li><strong>Euro (EUR) :</strong> Des frais de service minimum de <strong>10€</strong> par transaction s'appliquent.</li>
    <li><strong>Dollar américain (USD) :</strong> Des frais de service minimum de <strong>12$</strong> par transaction s'appliquent.</li>
</ul>

<h4>Comment ça fonctionne</h4>
<p>Pour chaque mission complétée, des frais de service sont calculés sur la base d'un pourcentage du montant de la transaction (actuellement 15%). Si ces frais calculés sont inférieurs aux frais de service minimum pour votre devise, les frais minimum seront appliqués à la place.</p>

<p><strong>Exemple :</strong></p>
<ul>
    <li>Montant de la mission : 50€</li>
    <li>Frais calculés (15%) : 7,50€</li>
    <li>Puisque 7,50€ est inférieur au minimum de 10€, des frais de <strong>10€</strong> seront déduits.</li>
    <li>Vous recevez : 50€ - 10€ = <strong>40€</strong></li>
</ul>

<p>Pour les transactions où les frais calculés dépassent le minimum, les frais basés sur le pourcentage s'appliquent :</p>
<ul>
    <li>Montant de la mission : 100€</li>
    <li>Frais calculés (15%) : 15€</li>
    <li>Puisque 15€ est supérieur au minimum de 10€, des frais de <strong>15€</strong> seront déduits.</li>
    <li>Vous recevez : 100€ - 15€ = <strong>85€</strong></li>
</ul>

<h4>Considérations spécifiques aux devises</h4>
<p>Les frais minimum sont déterminés par la devise de la mission. Si vous acceptez des missions dans différentes devises, les frais minimum correspondants pour chaque devise s'appliqueront.</p>

<h4>Transparence</h4>
<p>Les frais applicables (minimum ou basés sur le pourcentage) sont toujours affichés avant que vous n'acceptiez une offre de mission, garantissant une transparence totale sur vos revenus.</p>
HTML;
    }
}
