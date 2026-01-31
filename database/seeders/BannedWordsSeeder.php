<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\Global_Moderations\Models\BannedWord;

class BannedWordsSeeder extends Seeder
{
    /**
     * Langues supportées par la plateforme
     */
    private const SUPPORTED_LANGUAGES = ['fr', 'en', 'de', 'ru', 'zh', 'es', 'pt', 'ar', 'hi'];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedUniversalWords();
        $this->seedFrenchWords();
        $this->seedEnglishWords();
        $this->seedGermanWords();
        $this->seedRussianWords();
        $this->seedChineseWords();
        $this->seedSpanishWords();
        $this->seedPortugueseWords();
        $this->seedArabicWords();
        $this->seedHindiWords();

        $this->command->info('Banned words seeded for all 9 languages.');
    }

    /**
     * Mots universels (toutes langues) - patterns regex et termes anglais internationaux
     */
    private function seedUniversalWords(): void
    {
        $universalCritical = [
            // Patterns regex universels
            ['word' => 's[e3]x[e]?', 'category' => 'sexual', 'is_regex' => true],
            ['word' => 'p[o0]rn[o0]?', 'category' => 'sexual', 'is_regex' => true],
            ['word' => 'xxx+', 'category' => 'sexual', 'is_regex' => true],
            ['word' => 'onlyfans', 'category' => 'sexual'],
            ['word' => 'webcam.*adult', 'category' => 'sexual', 'is_regex' => true],
            ['word' => 'cam\s?girl', 'category' => 'sexual', 'is_regex' => true],
            ['word' => 'sugar\s?(daddy|baby|mommy)', 'category' => 'sexual', 'is_regex' => true],
            ['word' => 'escort', 'category' => 'sexual'],

            // Drogues (termes internationaux)
            ['word' => 'mdma', 'category' => 'illegal'],
            ['word' => 'lsd', 'category' => 'illegal'],
            ['word' => 'cocaine', 'category' => 'illegal'],
            ['word' => 'heroin', 'category' => 'illegal'],
            ['word' => 'crystal\s?meth', 'category' => 'illegal', 'is_regex' => true],

            // Réseaux sociaux (contact interdit)
            ['word' => 'whatsapp', 'category' => 'contact_info'],
            ['word' => 'telegram', 'category' => 'contact_info'],
            ['word' => 'signal\s?(app)?', 'category' => 'contact_info', 'is_regex' => true],
            ['word' => 'viber', 'category' => 'contact_info'],
            ['word' => 'wechat', 'category' => 'contact_info'],
            ['word' => 'snapchat', 'category' => 'contact_info'],
            ['word' => '@[a-zA-Z0-9._]+', 'category' => 'contact_info', 'is_regex' => true, 'notes' => 'Usernames sociaux'],
        ];

        foreach ($universalCritical as $word) {
            BannedWord::updateOrCreate(
                ['word' => $word['word'], 'language' => '*'],
                array_merge($word, [
                    'severity' => 'critical',
                    'language' => '*',
                    'is_regex' => $word['is_regex'] ?? false,
                    'is_active' => true,
                ])
            );
        }

        $this->command->info('  - Universal patterns: ' . count($universalCritical));
    }

    /**
     * Mots français
     */
    private function seedFrenchWords(): void
    {
        $critical = [
            // Sexuel
            ['word' => 'escorte', 'category' => 'sexual'],
            ['word' => 'massage tantrique', 'category' => 'sexual'],
            ['word' => 'massage sensuel', 'category' => 'sexual'],
            ['word' => 'massage erotique', 'category' => 'sexual'],
            ['word' => 'services intimes', 'category' => 'sexual'],
            ['word' => 'compagnie nocturne', 'category' => 'sexual'],
            ['word' => 'accompagnement prive', 'category' => 'sexual'],
            ['word' => 'relation discrete', 'category' => 'sexual'],
            ['word' => 'plan cul', 'category' => 'sexual'],
            ['word' => 'prostitu', 'category' => 'sexual'],

            // Politique
            ['word' => 'campagne electorale', 'category' => 'political'],
            ['word' => 'parti politique', 'category' => 'political'],
            ['word' => 'propagande', 'category' => 'political'],
            ['word' => 'militant politique', 'category' => 'political'],
            ['word' => 'votez pour', 'category' => 'political'],
            ['word' => 'extreme droite', 'category' => 'political'],
            ['word' => 'extreme gauche', 'category' => 'political'],

            // Illégal
            ['word' => 'drogue', 'category' => 'illegal'],
            ['word' => 'cannabis', 'category' => 'illegal'],
            ['word' => 'arme a feu', 'category' => 'illegal'],
            ['word' => 'faux papiers', 'category' => 'illegal'],
            ['word' => 'blanchiment', 'category' => 'illegal'],

            // Haine
            ['word' => 'terroriste', 'category' => 'hate_speech'],
            ['word' => 'negre', 'category' => 'hate_speech'],
            ['word' => 'nazi', 'category' => 'hate_speech'],
        ];

        $warning = [
            ['word' => 'secte', 'category' => 'religious'],
            ['word' => 'proselytisme', 'category' => 'religious'],
            ['word' => 'evangelisation', 'category' => 'religious'],
            ['word' => 'conversion religieuse', 'category' => 'religious'],
            ['word' => 'massage', 'category' => 'other', 'notes' => 'Peut etre legitime'],
            ['word' => 'argent facile', 'category' => 'spam'],
            ['word' => 'revenu passif', 'category' => 'spam'],
            ['word' => 'devenez riche', 'category' => 'spam'],
            ['word' => 'opportunite unique', 'category' => 'spam'],
        ];

        $this->insertWords($critical, 'critical', 'fr');
        $this->insertWords($warning, 'warning', 'fr');
        $this->command->info('  - French: ' . (count($critical) + count($warning)));
    }

    /**
     * Mots anglais
     */
    private function seedEnglishWords(): void
    {
        $critical = [
            // Sexual
            ['word' => 'call girl', 'category' => 'sexual'],
            ['word' => 'erotic massage', 'category' => 'sexual'],
            ['word' => 'sensual massage', 'category' => 'sexual'],
            ['word' => 'intimate services', 'category' => 'sexual'],
            ['word' => 'adult entertainment', 'category' => 'sexual'],
            ['word' => 'happy ending', 'category' => 'sexual'],
            ['word' => 'hookup', 'category' => 'sexual'],
            ['word' => 'one night stand', 'category' => 'sexual'],
            ['word' => 'prostitut', 'category' => 'sexual'],

            // Political
            ['word' => 'political campaign', 'category' => 'political'],
            ['word' => 'vote for', 'category' => 'political'],
            ['word' => 'political party', 'category' => 'political'],
            ['word' => 'propaganda', 'category' => 'political'],
            ['word' => 'far right', 'category' => 'political'],
            ['word' => 'far left', 'category' => 'political'],
            ['word' => 'extremist', 'category' => 'political'],

            // Illegal
            ['word' => 'drugs', 'category' => 'illegal'],
            ['word' => 'weed', 'category' => 'illegal'],
            ['word' => 'marijuana', 'category' => 'illegal'],
            ['word' => 'firearms', 'category' => 'illegal'],
            ['word' => 'fake documents', 'category' => 'illegal'],
            ['word' => 'money laundering', 'category' => 'illegal'],

            // Hate speech
            ['word' => 'terrorist', 'category' => 'hate_speech'],
            ['word' => 'racial slur', 'category' => 'hate_speech'],
            ['word' => 'white supremacy', 'category' => 'hate_speech'],
        ];

        $warning = [
            ['word' => 'cult', 'category' => 'religious'],
            ['word' => 'proselytism', 'category' => 'religious'],
            ['word' => 'religious conversion', 'category' => 'religious'],
            ['word' => 'massage', 'category' => 'other'],
            ['word' => 'easy money', 'category' => 'spam'],
            ['word' => 'passive income', 'category' => 'spam'],
            ['word' => 'get rich quick', 'category' => 'spam'],
            ['word' => 'unique opportunity', 'category' => 'spam'],
            ['word' => 'crypto investment', 'category' => 'spam'],
            ['word' => 'forex trading', 'category' => 'spam'],
        ];

        $this->insertWords($critical, 'critical', 'en');
        $this->insertWords($warning, 'warning', 'en');
        $this->command->info('  - English: ' . (count($critical) + count($warning)));
    }

    /**
     * Mots allemands
     */
    private function seedGermanWords(): void
    {
        $critical = [
            // Sexuel
            ['word' => 'erotische massage', 'category' => 'sexual'],
            ['word' => 'sinnliche massage', 'category' => 'sexual'],
            ['word' => 'begleitservice', 'category' => 'sexual'],
            ['word' => 'intime dienste', 'category' => 'sexual'],
            ['word' => 'escort service', 'category' => 'sexual'],
            ['word' => 'prostituierte', 'category' => 'sexual'],

            // Politique
            ['word' => 'wahlkampf', 'category' => 'political'],
            ['word' => 'politische partei', 'category' => 'political'],
            ['word' => 'propaganda', 'category' => 'political'],
            ['word' => 'rechtsextrem', 'category' => 'political'],
            ['word' => 'linksextrem', 'category' => 'political'],

            // Illégal
            ['word' => 'drogen', 'category' => 'illegal'],
            ['word' => 'waffen', 'category' => 'illegal'],
            ['word' => 'gefalschte dokumente', 'category' => 'illegal'],
            ['word' => 'geldwasche', 'category' => 'illegal'],

            // Haine
            ['word' => 'terrorist', 'category' => 'hate_speech'],
            ['word' => 'nazi', 'category' => 'hate_speech'],
            ['word' => 'rassismus', 'category' => 'hate_speech'],
        ];

        $warning = [
            ['word' => 'sekte', 'category' => 'religious'],
            ['word' => 'missionierung', 'category' => 'religious'],
            ['word' => 'schnelles geld', 'category' => 'spam'],
            ['word' => 'passives einkommen', 'category' => 'spam'],
        ];

        $this->insertWords($critical, 'critical', 'de');
        $this->insertWords($warning, 'warning', 'de');
        $this->command->info('  - German: ' . (count($critical) + count($warning)));
    }

    /**
     * Mots russes
     */
    private function seedRussianWords(): void
    {
        $critical = [
            // Sexuel (translittéré et cyrillique)
            ['word' => 'эскорт', 'category' => 'sexual'],
            ['word' => 'интим услуги', 'category' => 'sexual'],
            ['word' => 'массаж эротический', 'category' => 'sexual'],
            ['word' => 'проститу', 'category' => 'sexual'],
            ['word' => 'досуг для взрослых', 'category' => 'sexual'],

            // Politique
            ['word' => 'политическая партия', 'category' => 'political'],
            ['word' => 'пропаганда', 'category' => 'political'],
            ['word' => 'голосуйте за', 'category' => 'political'],
            ['word' => 'экстремизм', 'category' => 'political'],

            // Illégal
            ['word' => 'наркотики', 'category' => 'illegal'],
            ['word' => 'оружие', 'category' => 'illegal'],
            ['word' => 'поддельные документы', 'category' => 'illegal'],

            // Haine
            ['word' => 'террорист', 'category' => 'hate_speech'],
            ['word' => 'нацист', 'category' => 'hate_speech'],
        ];

        $warning = [
            ['word' => 'секта', 'category' => 'religious'],
            ['word' => 'легкие деньги', 'category' => 'spam'],
            ['word' => 'пассивный доход', 'category' => 'spam'],
        ];

        $this->insertWords($critical, 'critical', 'ru');
        $this->insertWords($warning, 'warning', 'ru');
        $this->command->info('  - Russian: ' . (count($critical) + count($warning)));
    }

    /**
     * Mots chinois
     */
    private function seedChineseWords(): void
    {
        $critical = [
            // Sexuel
            ['word' => '色情', 'category' => 'sexual'],
            ['word' => '性服务', 'category' => 'sexual'],
            ['word' => '陪酒', 'category' => 'sexual'],
            ['word' => '援交', 'category' => 'sexual'],
            ['word' => '小姐服务', 'category' => 'sexual'],
            ['word' => '按摩服务', 'category' => 'sexual', 'notes' => 'Context dependent'],

            // Politique
            ['word' => '政治运动', 'category' => 'political'],
            ['word' => '政党', 'category' => 'political'],
            ['word' => '宣传', 'category' => 'political'],
            ['word' => '投票给', 'category' => 'political'],

            // Illégal
            ['word' => '毒品', 'category' => 'illegal'],
            ['word' => '大麻', 'category' => 'illegal'],
            ['word' => '武器', 'category' => 'illegal'],
            ['word' => '假证件', 'category' => 'illegal'],
            ['word' => '洗钱', 'category' => 'illegal'],

            // Haine
            ['word' => '恐怖分子', 'category' => 'hate_speech'],
        ];

        $warning = [
            ['word' => '邪教', 'category' => 'religious'],
            ['word' => '传教', 'category' => 'religious'],
            ['word' => '轻松赚钱', 'category' => 'spam'],
            ['word' => '被动收入', 'category' => 'spam'],
        ];

        $this->insertWords($critical, 'critical', 'zh');
        $this->insertWords($warning, 'warning', 'zh');
        $this->command->info('  - Chinese: ' . (count($critical) + count($warning)));
    }

    /**
     * Mots espagnols
     */
    private function seedSpanishWords(): void
    {
        $critical = [
            // Sexuel
            ['word' => 'escort', 'category' => 'sexual'],
            ['word' => 'masaje erotico', 'category' => 'sexual'],
            ['word' => 'masaje sensual', 'category' => 'sexual'],
            ['word' => 'servicios intimos', 'category' => 'sexual'],
            ['word' => 'acompanante', 'category' => 'sexual'],
            ['word' => 'prostitu', 'category' => 'sexual'],
            ['word' => 'dama de compania', 'category' => 'sexual'],

            // Politique
            ['word' => 'campana electoral', 'category' => 'political'],
            ['word' => 'partido politico', 'category' => 'political'],
            ['word' => 'propaganda', 'category' => 'political'],
            ['word' => 'vota por', 'category' => 'political'],
            ['word' => 'extrema derecha', 'category' => 'political'],
            ['word' => 'extrema izquierda', 'category' => 'political'],

            // Illégal
            ['word' => 'drogas', 'category' => 'illegal'],
            ['word' => 'marihuana', 'category' => 'illegal'],
            ['word' => 'armas de fuego', 'category' => 'illegal'],
            ['word' => 'documentos falsos', 'category' => 'illegal'],
            ['word' => 'lavado de dinero', 'category' => 'illegal'],

            // Haine
            ['word' => 'terrorista', 'category' => 'hate_speech'],
            ['word' => 'nazi', 'category' => 'hate_speech'],
        ];

        $warning = [
            ['word' => 'secta', 'category' => 'religious'],
            ['word' => 'proselitismo', 'category' => 'religious'],
            ['word' => 'dinero facil', 'category' => 'spam'],
            ['word' => 'ingresos pasivos', 'category' => 'spam'],
            ['word' => 'hazte rico', 'category' => 'spam'],
        ];

        $this->insertWords($critical, 'critical', 'es');
        $this->insertWords($warning, 'warning', 'es');
        $this->command->info('  - Spanish: ' . (count($critical) + count($warning)));
    }

    /**
     * Mots portugais
     */
    private function seedPortugueseWords(): void
    {
        $critical = [
            // Sexuel
            ['word' => 'acompanhante', 'category' => 'sexual'],
            ['word' => 'massagem erotica', 'category' => 'sexual'],
            ['word' => 'massagem sensual', 'category' => 'sexual'],
            ['word' => 'servicos intimos', 'category' => 'sexual'],
            ['word' => 'garota de programa', 'category' => 'sexual'],
            ['word' => 'prostitu', 'category' => 'sexual'],

            // Politique
            ['word' => 'campanha eleitoral', 'category' => 'political'],
            ['word' => 'partido politico', 'category' => 'political'],
            ['word' => 'propaganda', 'category' => 'political'],
            ['word' => 'vote em', 'category' => 'political'],
            ['word' => 'extrema direita', 'category' => 'political'],
            ['word' => 'extrema esquerda', 'category' => 'political'],

            // Illégal
            ['word' => 'drogas', 'category' => 'illegal'],
            ['word' => 'maconha', 'category' => 'illegal'],
            ['word' => 'armas de fogo', 'category' => 'illegal'],
            ['word' => 'documentos falsos', 'category' => 'illegal'],
            ['word' => 'lavagem de dinheiro', 'category' => 'illegal'],

            // Haine
            ['word' => 'terrorista', 'category' => 'hate_speech'],
            ['word' => 'nazista', 'category' => 'hate_speech'],
        ];

        $warning = [
            ['word' => 'seita', 'category' => 'religious'],
            ['word' => 'proselitismo', 'category' => 'religious'],
            ['word' => 'dinheiro facil', 'category' => 'spam'],
            ['word' => 'renda passiva', 'category' => 'spam'],
            ['word' => 'fique rico', 'category' => 'spam'],
        ];

        $this->insertWords($critical, 'critical', 'pt');
        $this->insertWords($warning, 'warning', 'pt');
        $this->command->info('  - Portuguese: ' . (count($critical) + count($warning)));
    }

    /**
     * Mots arabes
     */
    private function seedArabicWords(): void
    {
        $critical = [
            // Sexuel
            ['word' => 'مرافقة', 'category' => 'sexual'],
            ['word' => 'خدمات حميمة', 'category' => 'sexual'],
            ['word' => 'تدليك مثير', 'category' => 'sexual'],
            ['word' => 'بغاء', 'category' => 'sexual'],

            // Politique
            ['word' => 'حملة انتخابية', 'category' => 'political'],
            ['word' => 'حزب سياسي', 'category' => 'political'],
            ['word' => 'دعاية', 'category' => 'political'],
            ['word' => 'صوت لـ', 'category' => 'political'],
            ['word' => 'تطرف', 'category' => 'political'],

            // Illégal
            ['word' => 'مخدرات', 'category' => 'illegal'],
            ['word' => 'حشيش', 'category' => 'illegal'],
            ['word' => 'اسلحة', 'category' => 'illegal'],
            ['word' => 'وثائق مزورة', 'category' => 'illegal'],
            ['word' => 'غسيل اموال', 'category' => 'illegal'],

            // Haine
            ['word' => 'ارهابي', 'category' => 'hate_speech'],
            ['word' => 'نازي', 'category' => 'hate_speech'],
        ];

        $warning = [
            ['word' => 'طائفة', 'category' => 'religious'],
            ['word' => 'تبشير', 'category' => 'religious'],
            ['word' => 'مال سهل', 'category' => 'spam'],
            ['word' => 'دخل سلبي', 'category' => 'spam'],
        ];

        $this->insertWords($critical, 'critical', 'ar');
        $this->insertWords($warning, 'warning', 'ar');
        $this->command->info('  - Arabic: ' . (count($critical) + count($warning)));
    }

    /**
     * Mots hindi
     */
    private function seedHindiWords(): void
    {
        $critical = [
            // Sexuel
            ['word' => 'एस्कॉर्ट', 'category' => 'sexual'],
            ['word' => 'अंतरंग सेवाएं', 'category' => 'sexual'],
            ['word' => 'मसाज पार्लर', 'category' => 'sexual'],
            ['word' => 'वेश्या', 'category' => 'sexual'],
            ['word' => 'कॉल गर्ल', 'category' => 'sexual'],

            // Politique
            ['word' => 'चुनाव प्रचार', 'category' => 'political'],
            ['word' => 'राजनीतिक दल', 'category' => 'political'],
            ['word' => 'प्रचार', 'category' => 'political'],
            ['word' => 'वोट करें', 'category' => 'political'],
            ['word' => 'चरमपंथी', 'category' => 'political'],

            // Illégal
            ['word' => 'नशीली दवाएं', 'category' => 'illegal'],
            ['word' => 'गांजा', 'category' => 'illegal'],
            ['word' => 'हथियार', 'category' => 'illegal'],
            ['word' => 'नकली दस्तावेज', 'category' => 'illegal'],
            ['word' => 'मनी लॉन्ड्रिंग', 'category' => 'illegal'],

            // Haine
            ['word' => 'आतंकवादी', 'category' => 'hate_speech'],
            ['word' => 'नाज़ी', 'category' => 'hate_speech'],
        ];

        $warning = [
            ['word' => 'पंथ', 'category' => 'religious'],
            ['word' => 'धर्म प्रचार', 'category' => 'religious'],
            ['word' => 'आसान पैसा', 'category' => 'spam'],
            ['word' => 'निष्क्रिय आय', 'category' => 'spam'],
        ];

        $this->insertWords($critical, 'critical', 'hi');
        $this->insertWords($warning, 'warning', 'hi');
        $this->command->info('  - Hindi: ' . (count($critical) + count($warning)));
    }

    /**
     * Helper pour insérer les mots
     */
    private function insertWords(array $words, string $severity, string $language): void
    {
        foreach ($words as $word) {
            BannedWord::updateOrCreate(
                ['word' => $word['word'], 'language' => $language],
                array_merge($word, [
                    'severity' => $severity,
                    'language' => $language,
                    'is_regex' => $word['is_regex'] ?? false,
                    'is_active' => true,
                ])
            );
        }
    }
}
