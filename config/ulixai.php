<?php

return [
    'fees' => [
        'client' => env('ULIXAI_CLIENT_FEE', 5),
        'provider' => env('ULIXAI_PROVIDER_FEE', 15),
        'affiliate' => env('ULIXAI_AFFILIATE_FEE', 30),
    ],

    /*
    |--------------------------------------------------------------------------
    | Payment Gateway Configuration
    |--------------------------------------------------------------------------
    |
    | Stratégie de sélection automatique:
    | - Stripe: ~46 pays où Stripe fonctionne parfaitement
    | - PayPal: ~200 pays (TOUS les autres pays par défaut)
    |
    | PayPal est le fallback mondial car il couvre beaucoup plus de pays.
    |
    */
    'payment' => [
        // Passerelle par défaut (si PayPal non configuré)
        'default_gateway' => env('PAYMENT_DEFAULT_GATEWAY', 'stripe'),

        // ═══════════════════════════════════════════════════════════════════
        // STRIPE: ~46 pays où Stripe est préféré (excellente couverture)
        // Pour ces pays, Stripe offre la meilleure expérience utilisateur
        // ═══════════════════════════════════════════════════════════════════
        'stripe_preferred_countries' => [
            // Europe de l'Ouest
            'AT', // Autriche
            'BE', // Belgique
            'CH', // Suisse
            'DE', // Allemagne
            'DK', // Danemark
            'ES', // Espagne
            'FI', // Finlande
            'FR', // France
            'GB', // Royaume-Uni
            'IE', // Irlande
            'IT', // Italie
            'LU', // Luxembourg
            'NL', // Pays-Bas
            'NO', // Norvège
            'PT', // Portugal
            'SE', // Suède

            // Europe de l'Est / Centrale
            'BG', // Bulgarie
            'CY', // Chypre
            'CZ', // République Tchèque
            'EE', // Estonie
            'GR', // Grèce
            'HR', // Croatie
            'HU', // Hongrie
            'LT', // Lituanie
            'LV', // Lettonie
            'MT', // Malte
            'PL', // Pologne
            'RO', // Roumanie
            'SI', // Slovénie
            'SK', // Slovaquie

            // Amérique du Nord
            'CA', // Canada
            'US', // États-Unis
            'MX', // Mexique

            // Asie-Pacifique (marchés développés)
            'AU', // Australie
            'HK', // Hong Kong
            'JP', // Japon
            'MY', // Malaisie
            'NZ', // Nouvelle-Zélande
            'SG', // Singapour
            'TH', // Thaïlande

            // Autres
            'AE', // Émirats Arabes Unis
            'BR', // Brésil
            'IN', // Inde
        ],

        // ═══════════════════════════════════════════════════════════════════
        // PAYPAL BLOQUÉ: Pays sous sanctions où PayPal ne fonctionne pas
        // Pour ces pays, Stripe sera utilisé (s'il est disponible)
        // ═══════════════════════════════════════════════════════════════════
        'paypal_blocked_countries' => [
            'CU', // Cuba
            'IR', // Iran
            'KP', // Corée du Nord
            'SY', // Syrie
            'SD', // Soudan
            'RU', // Russie (restrictions)
            'BY', // Biélorussie (restrictions)
            'MM', // Myanmar
            'VE', // Venezuela (restrictions partielles)
        ],

        // ═══════════════════════════════════════════════════════════════════
        // PAYPAL PAR DÉFAUT: ~150+ pays non listés ci-dessus
        // ═══════════════════════════════════════════════════════════════════
        // Tous les pays NON présents dans stripe_preferred_countries
        // utiliseront automatiquement PayPal, incluant:
        //
        // - Afrique: ~54 pays (Maroc, Algérie, Tunisie, Sénégal, Côte d'Ivoire,
        //   Nigeria, Ghana, Kenya, Afrique du Sud, Égypte, etc.)
        //
        // - Amérique Latine: ~20 pays (Argentine, Chili, Colombie, Pérou,
        //   Équateur, Paraguay, Uruguay, Costa Rica, Panama, etc.)
        //
        // - Asie: ~30 pays (Philippines, Indonésie, Vietnam, Pakistan,
        //   Bangladesh, Sri Lanka, Cambodge, etc.)
        //
        // - Moyen-Orient: ~15 pays (Arabie Saoudite, Qatar, Koweït, Bahreïn,
        //   Oman, Jordanie, Liban, Irak, etc.)
        //
        // - Europe de l'Est: Pays non couverts par Stripe
        //
        // - Océanie & Pacifique: Îles diverses
        //
        // Total PayPal: ~200 pays dans le monde

        // ═══════════════════════════════════════════════════════════════════
        // CONFIGURATION ESCROW
        // ═══════════════════════════════════════════════════════════════════

        // Période d'escrow en jours avant libération automatique au prestataire
        'escrow_period_days' => env('PAYMENT_ESCROW_DAYS', 7),

        // Délai auto-start mission après paiement (heures)
        'auto_start_delay_hours' => env('PAYMENT_AUTO_START_HOURS', 24),
    ],
];
