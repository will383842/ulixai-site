<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('code', 5)->unique();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // 150 langues mondiales
        $languages = [
            // === TIER 1 : Les 25 plus parlées (1-25) ===
            ['name' => 'English', 'code' => 'en'],
            ['name' => 'Mandarin Chinese', 'code' => 'zh'],
            ['name' => 'Spanish', 'code' => 'es'],
            ['name' => 'Hindi', 'code' => 'hi'],
            ['name' => 'Arabic', 'code' => 'ar'],
            ['name' => 'French', 'code' => 'fr'],
            ['name' => 'Bengali', 'code' => 'bn'],
            ['name' => 'Russian', 'code' => 'ru'],
            ['name' => 'Portuguese', 'code' => 'pt'],
            ['name' => 'Indonesian', 'code' => 'id'],
            ['name' => 'Urdu', 'code' => 'ur'],
            ['name' => 'German', 'code' => 'de'],
            ['name' => 'Japanese', 'code' => 'ja'],
            ['name' => 'Swahili', 'code' => 'sw'],
            ['name' => 'Marathi', 'code' => 'mr'],
            ['name' => 'Telugu', 'code' => 'te'],
            ['name' => 'Turkish', 'code' => 'tr'],
            ['name' => 'Tamil', 'code' => 'ta'],
            ['name' => 'Vietnamese', 'code' => 'vi'],
            ['name' => 'Korean', 'code' => 'ko'],
            ['name' => 'Italian', 'code' => 'it'],
            ['name' => 'Thai', 'code' => 'th'],
            ['name' => 'Gujarati', 'code' => 'gu'],
            ['name' => 'Persian', 'code' => 'fa'],
            ['name' => 'Polish', 'code' => 'pl'],
            
            // === EUROPE OCCIDENTALE (26-45) ===
            ['name' => 'Dutch', 'code' => 'nl'],
            ['name' => 'Catalan', 'code' => 'ca'],
            ['name' => 'Galician', 'code' => 'gl'],
            ['name' => 'Basque', 'code' => 'eu'],
            ['name' => 'Portuguese (Brazil)', 'code' => 'pt-BR'],
            ['name' => 'Spanish (Latin America)', 'code' => 'es-LA'],
            ['name' => 'French (Canadian)', 'code' => 'fr-CA'],
            ['name' => 'Flemish', 'code' => 'vls'],
            ['name' => 'Luxembourgish', 'code' => 'lb'],
            ['name' => 'Romansh', 'code' => 'rm'],
            ['name' => 'Occitan', 'code' => 'oc'],
            ['name' => 'Corsican', 'code' => 'co'],
            ['name' => 'Breton', 'code' => 'br'],
            ['name' => 'Welsh', 'code' => 'cy'],
            ['name' => 'Irish', 'code' => 'ga'],
            ['name' => 'Scottish Gaelic', 'code' => 'gd'],
            ['name' => 'Manx', 'code' => 'gv'],
            ['name' => 'Cornish', 'code' => 'kw'],
            ['name' => 'Faroese', 'code' => 'fo'],
            ['name' => 'Greenlandic', 'code' => 'kl'],
            
            // === EUROPE NORDIQUE (46-55) ===
            ['name' => 'Swedish', 'code' => 'sv'],
            ['name' => 'Norwegian', 'code' => 'no'],
            ['name' => 'Danish', 'code' => 'da'],
            ['name' => 'Finnish', 'code' => 'fi'],
            ['name' => 'Icelandic', 'code' => 'is'],
            ['name' => 'Sami', 'code' => 'se'],
            ['name' => 'Norwegian (Nynorsk)', 'code' => 'nn'],
            ['name' => 'Norwegian (Bokmål)', 'code' => 'nb'],
            ['name' => 'Karelian', 'code' => 'krl'],
            ['name' => 'Veps', 'code' => 'vep'],
            
            // === EUROPE CENTRALE & EST (56-75) ===
            ['name' => 'Czech', 'code' => 'cs'],
            ['name' => 'Slovak', 'code' => 'sk'],
            ['name' => 'Hungarian', 'code' => 'hu'],
            ['name' => 'Romanian', 'code' => 'ro'],
            ['name' => 'Bulgarian', 'code' => 'bg'],
            ['name' => 'Croatian', 'code' => 'hr'],
            ['name' => 'Serbian', 'code' => 'sr'],
            ['name' => 'Bosnian', 'code' => 'bs'],
            ['name' => 'Slovenian', 'code' => 'sl'],
            ['name' => 'Macedonian', 'code' => 'mk'],
            ['name' => 'Albanian', 'code' => 'sq'],
            ['name' => 'Ukrainian', 'code' => 'uk'],
            ['name' => 'Belarusian', 'code' => 'be'],
            ['name' => 'Lithuanian', 'code' => 'lt'],
            ['name' => 'Latvian', 'code' => 'lv'],
            ['name' => 'Estonian', 'code' => 'et'],
            ['name' => 'Moldovan', 'code' => 'mo'],
            ['name' => 'Montenegrin', 'code' => 'cnr'],
            ['name' => 'Kashubian', 'code' => 'csb'],
            ['name' => 'Sorbian', 'code' => 'hsb'],
            
            // === EUROPE SUD (76-80) ===
            ['name' => 'Greek', 'code' => 'el'],
            ['name' => 'Maltese', 'code' => 'mt'],
            ['name' => 'Cypriot Greek', 'code' => 'grc'],
            ['name' => 'Sicilian', 'code' => 'scn'],
            ['name' => 'Sardinian', 'code' => 'sc'],
            
            // === ASIE DU SUD (81-100) ===
            ['name' => 'Punjabi', 'code' => 'pa'],
            ['name' => 'Kannada', 'code' => 'kn'],
            ['name' => 'Malayalam', 'code' => 'ml'],
            ['name' => 'Odia', 'code' => 'or'],
            ['name' => 'Assamese', 'code' => 'as'],
            ['name' => 'Nepali', 'code' => 'ne'],
            ['name' => 'Sinhala', 'code' => 'si'],
            ['name' => 'Sindhi', 'code' => 'sd'],
            ['name' => 'Pashto', 'code' => 'ps'],
            ['name' => 'Dari', 'code' => 'prs'],
            ['name' => 'Balochi', 'code' => 'bal'],
            ['name' => 'Konkani', 'code' => 'kok'],
            ['name' => 'Dogri', 'code' => 'doi'],
            ['name' => 'Kashmiri', 'code' => 'ks'],
            ['name' => 'Santali', 'code' => 'sat'],
            ['name' => 'Manipuri', 'code' => 'mni'],
            ['name' => 'Mizo', 'code' => 'lus'],
            ['name' => 'Bodo', 'code' => 'brx'],
            ['name' => 'Maithili', 'code' => 'mai'],
            ['name' => 'Bhojpuri', 'code' => 'bho'],
            
            // === ASIE DU SUD-EST (101-115) ===
            ['name' => 'Malay', 'code' => 'ms'],
            ['name' => 'Tagalog', 'code' => 'tl'],
            ['name' => 'Cebuano', 'code' => 'ceb'],
            ['name' => 'Javanese', 'code' => 'jv'],
            ['name' => 'Sundanese', 'code' => 'su'],
            ['name' => 'Burmese', 'code' => 'my'],
            ['name' => 'Khmer', 'code' => 'km'],
            ['name' => 'Lao', 'code' => 'lo'],
            ['name' => 'Hmong', 'code' => 'hmn'],
            ['name' => 'Karen', 'code' => 'kar'],
            ['name' => 'Shan', 'code' => 'shn'],
            ['name' => 'Mon', 'code' => 'mnw'],
            ['name' => 'Tetum', 'code' => 'tet'],
            ['name' => 'Ilocano', 'code' => 'ilo'],
            ['name' => 'Hiligaynon', 'code' => 'hil'],
            
            // === ASIE DE L'EST (116-122) ===
            ['name' => 'Cantonese', 'code' => 'yue'],
            ['name' => 'Wu Chinese', 'code' => 'wuu'],
            ['name' => 'Min Nan', 'code' => 'nan'],
            ['name' => 'Hakka', 'code' => 'hak'],
            ['name' => 'Tibetan', 'code' => 'bo'],
            ['name' => 'Mongolian', 'code' => 'mn'],
            ['name' => 'Uyghur', 'code' => 'ug'],
            
            // === MOYEN-ORIENT (123-132) ===
            ['name' => 'Hebrew', 'code' => 'he'],
            ['name' => 'Kurdish', 'code' => 'ku'],
            ['name' => 'Sorani', 'code' => 'ckb'],
            ['name' => 'Aramaic', 'code' => 'arc'],
            ['name' => 'Assyrian', 'code' => 'aii'],
            ['name' => 'Coptic', 'code' => 'cop'],
            ['name' => 'Berber', 'code' => 'ber'],
            ['name' => 'Tamazight', 'code' => 'tzm'],
            ['name' => 'Kabyle', 'code' => 'kab'],
            ['name' => 'Egyptian Arabic', 'code' => 'arz'],
            
            // === AFRIQUE (133-145) ===
            ['name' => 'Amharic', 'code' => 'am'],
            ['name' => 'Hausa', 'code' => 'ha'],
            ['name' => 'Yoruba', 'code' => 'yo'],
            ['name' => 'Igbo', 'code' => 'ig'],
            ['name' => 'Zulu', 'code' => 'zu'],
            ['name' => 'Afrikaans', 'code' => 'af'],
            ['name' => 'Somali', 'code' => 'so'],
            ['name' => 'Tigrinya', 'code' => 'ti'],
            ['name' => 'Oromo', 'code' => 'om'],
            ['name' => 'Shona', 'code' => 'sn'],
            ['name' => 'Chichewa', 'code' => 'ny'],
            ['name' => 'Kinyarwanda', 'code' => 'rw'],
            ['name' => 'Kirundi', 'code' => 'rn'],
            
            // === CAUCASE & ASIE CENTRALE (146-150) ===
            ['name' => 'Armenian', 'code' => 'hy'],
            ['name' => 'Azerbaijani', 'code' => 'az'],
            ['name' => 'Georgian', 'code' => 'ka'],
            ['name' => 'Kazakh', 'code' => 'kk'],
            ['name' => 'Uzbek', 'code' => 'uz'],
        ];

        foreach ($languages as $language) {
            DB::table('languages')->insert([
                'name' => $language['name'],
                'code' => $language['code'],
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down()
    {
        Schema::dropIfExists('languages');
    }
};