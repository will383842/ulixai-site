<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderReview;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    /**
     * ✅ Nettoie et raccourcit un slug pour le SEO
     * Garde seulement les mots-clés essentiels
     * Limite à 35 caractères max
     */
    private function optimizeSlug($slug, $maxLength = 35)
    {
        // Mots inutiles à supprimer (stop words)
        $stopWords = [
            'assistance', 'services', 'service', 'support', 'help',
            'for', 'the', 'and', 'or', 'of', 'in', 'to', 'a', 'an',
            'with', 'by', 'from', 'international', 'professional',
            'expert', 'consultancy', 'consulting', 'solutions'
        ];
        
        // Séparer le slug en mots
        $words = explode('-', $slug);
        
        // Garder les 3 premiers mots importants
        $importantWords = array_filter($words, function($word) use ($stopWords) {
            return !in_array($word, $stopWords) && strlen($word) > 2;
        });
        
        // Reconstruire avec max 3 mots
        $importantWords = array_slice($importantWords, 0, 3);
        $optimizedSlug = implode('-', $importantWords);
        
        // Si encore trop long, tronquer intelligemment
        if (strlen($optimizedSlug) > $maxLength) {
            // Garder seulement les 2 premiers mots
            $importantWords = array_slice(array_values($importantWords), 0, 2);
            $optimizedSlug = implode('-', $importantWords);
        }
        
        // Si ENCORE trop long, tronquer brutalement
        if (strlen($optimizedSlug) > $maxLength) {
            $optimizedSlug = substr($optimizedSlug, 0, $maxLength);
            // Supprimer le dernier mot incomplet
            if (strrpos($optimizedSlug, '-') !== false) {
                $optimizedSlug = substr($optimizedSlug, 0, strrpos($optimizedSlug, '-'));
            }
        }
        
        return $optimizedSlug ?: 'service'; // Fallback si vide
    }
    
    // ✅ 15 AVIS STATIQUES avec SLUGS OPTIMISÉS
    private function getAllReviews()
    {
        return [
            [
                'id' => 1,
                'name' => 'Sarah Mitchell',
                'nationality' => 'British',
                'flag' => '🇬🇧',
                'country' => 'France',
                'language' => 'English',
                'image' => 'https://i.pravatar.cc/150?img=47',
                'rating' => 5,
                'date' => '2024-12-15',
                'service' => 'Health Insurance',
                'serviceSlug' => 'health-insurance',
                'shortText' => 'Ulixai made my move to France incredibly smooth. The insurance comparison tool saved me hours of research, and I found the perfect health coverage for my family.',
                'fullText' => "After accepting a job offer in Paris, I was overwhelmed with the bureaucracy and paperwork. Ulixai's platform became my lifeline during this transition. The health insurance comparison tool was particularly impressive - it showed me side-by-side comparisons of different providers, explained the French healthcare system in simple English, and even helped me understand which coverage I needed as an expat. Within two days, I had comprehensive health insurance for my entire family at a competitive price. The customer service team answered all my questions promptly, and the entire process was in English, which was a huge relief. I can't imagine navigating the French system without Ulixai's help.",
                'slug' => 'health-insurance-france-sarah-mitchell-1'
            ],
            [
                'id' => 2,
                'name' => 'Carlos Rodriguez',
                'nationality' => 'Spanish',
                'flag' => '🇪🇸',
                'country' => 'Germany',
                'language' => 'Spanish',
                'image' => 'https://i.pravatar.cc/150?img=12',
                'rating' => 5,
                'date' => '2024-11-28',
                'service' => 'Housing Rental',
                'serviceSlug' => 'housing-rental',
                'shortText' => 'Finding an apartment in Berlin was a nightmare until I used Ulixai. Got connected with local agents who understood my needs.',
                'fullText' => "The German rental market is brutal, especially in Berlin. I spent weeks searching, attending viewings with 50+ other people, and getting rejected repeatedly. Then I found Ulixai's housing service. They connected me with local agents who actually understood what expats need - agents who spoke Spanish, knew the paperwork requirements, and had access to apartments that weren't listed on the public portals. Within a week, I had three serious options. The agent Ulixai connected me with helped prepare my documents, coached me on what to say during the viewing, and even negotiated the deposit terms. I moved into my dream apartment in Kreuzberg two weeks later. The service fee was worth every cent for the stress it saved me.",
                'slug' => 'housing-rental-germany-carlos-rodriguez-2'
            ],
            [
                'id' => 3,
                'name' => 'Yuki Tanaka',
                'nationality' => 'Japanese',
                'flag' => '🇯🇵',
                'country' => 'Australia',
                'language' => 'English',
                'image' => 'https://randomuser.me/api/portraits/women/65.jpg',
                'rating' => 5,
                'date' => '2024-12-01',
                'service' => 'International Banking',
                'serviceSlug' => 'international-banking',
                'shortText' => 'As a Japanese student in Sydney, opening a bank account seemed impossible until Ulixai guided me through the process.',
                'fullText' => "I arrived in Sydney for my master's degree completely unprepared for the banking requirements. Most banks wanted proof of address, but I was staying in temporary accommodation. Others wanted employment history, which I didn't have as a student. I was getting desperate when I found Ulixai's banking service. They explained exactly which banks accept student visas, what documents I needed to prepare, and even helped me book appointments. The advisor they connected me with spoke Japanese and English, which made everything so much easier. She walked me through the entire process, helped me understand Australian banking terms, and made sure I got a student account with no monthly fees. I had my account opened within 48 hours, and my debit card arrived three days later. Absolutely essential service for international students!",
                'slug' => 'international-banking-australia-yuki-tanaka-3'
            ],
            [
                'id' => 4,
                'name' => 'Ahmed Al-Mansoori',
                'nationality' => 'Emirati',
                'flag' => '🇦🇪',
                'country' => 'United States',
                'language' => 'English',
                'image' => 'https://i.pravatar.cc/150?img=33',
                'rating' => 5,
                'date' => '2024-10-20',
                'service' => 'Vehicle Import',
                'serviceSlug' => 'vehicle-import',
                'shortText' => "Ulixai's vehicle import service helped me bring my car from Dubai to California. The process was seamless.",
                'fullText' => "Importing my luxury vehicle from Dubai to Los Angeles seemed impossible. The regulations, customs paperwork, EPA compliance, DOT standards - it was overwhelming. I contacted Ulixai's vehicle import service, and they assigned me a specialist who handled everything. They arranged the shipping, dealt with US Customs, handled all the compliance modifications needed, and even coordinated the vehicle inspection at the port. The specialist kept me updated every step of the way and answered all my questions. What I thought would take months was completed in six weeks. My car arrived in perfect condition, fully compliant with US regulations, and ready to register. The service wasn't cheap, but considering the complexity and my lack of time, it was worth every dollar. Highly recommend for anyone importing vehicles internationally.",
                'slug' => 'vehicle-import-united-states-ahmed-al-mansoori-4'
            ],
            [
                'id' => 5,
                'name' => 'Elena Petrov',
                'nationality' => 'Russian',
                'flag' => '🇷🇺',
                'country' => 'Spain',
                'language' => 'Russian',
                'image' => 'https://i.pravatar.cc/150?img=26',
                'rating' => 5,
                'date' => '2024-11-10',
                'service' => 'Legal Mediation',
                'serviceSlug' => 'legal-mediation',
                'shortText' => "When my landlord refused to return my deposit, SOS-Expat connected me with a lawyer who resolved everything.",
                'fullText' => "After living in Barcelona for two years, my landlord claimed damages that didn't exist and refused to return my €2,000 deposit. I was devastated and didn't know how to fight this in a foreign legal system. I contacted SOS-Expat through Ulixai, and they immediately connected me with a lawyer who specialized in rental disputes. The lawyer spoke both Russian and Spanish, reviewed my lease and photos, and sent a formal legal letter to my landlord. Within a week, my landlord backed down and returned my full deposit. The lawyer explained my rights clearly and made sure I understood every step. The legal fee was reasonable, especially compared to what I would have lost. This service saved me from being scammed and gave me peace of mind. Essential for any expat dealing with legal issues abroad.",
                'slug' => 'legal-mediation-spain-elena-petrov-5'
            ],
            [
                'id' => 6,
                'name' => 'Marcus Johnson',
                'nationality' => 'American',
                'flag' => '🇺🇸',
                'country' => 'Thailand',
                'language' => 'English',
                'image' => 'https://i.pravatar.cc/150?img=15',
                'rating' => 5,
                'date' => '2024-12-08',
                'service' => 'Home Renovation',
                'serviceSlug' => 'home-renovation',
                'shortText' => "Ulixai's renovation service transformed my Bangkok condo beautifully while staying on budget!",
                'fullText' => "Moving to Bangkok was exciting but overwhelming. Finding contractors was difficult, communication was challenging, and I had horror stories from other expats about renovations gone wrong. Ulixai's renovation service connected me with a vetted contractor who spoke perfect English and had experience with Western clients. They helped me create a realistic budget, chose quality materials, and managed the entire project. The contractor provided 3D renders before starting, kept me updated with photos every day, and completed the work on time. My condo went from outdated to modern and beautiful. The project coordinator from Ulixai checked in regularly to make sure everything was going smoothly. The final result exceeded my expectations, and I stayed within budget. If you're renovating in Thailand, don't try to do it alone - use Ulixai's service.",
                'slug' => 'home-renovation-thailand-marcus-johnson-6'
            ],
            [
                'id' => 7,
                'name' => 'Priya Sharma',
                'nationality' => 'Indian',
                'flag' => '🇮🇳',
                'country' => 'Canada',
                'language' => 'English',
                'image' => 'https://i.pravatar.cc/150?img=45',
                'rating' => 5,
                'date' => '2024-09-25',
                'service' => 'Career Services',
                'serviceSlug' => 'career-services',
                'shortText' => 'As a newcomer to Toronto, Ulixai helped me find a job and connect with the community. Life-changing!',
                'fullText' => "Arriving in Toronto as a permanent resident was both exciting and terrifying. I had a degree in software engineering but no Canadian work experience, which was a huge barrier. I was sending hundreds of applications with no responses. Then I found Ulixai's career services. They assigned me a career coach who understood the Canadian job market and the challenges immigrants face. She reviewed my resume, helped me reformat it to Canadian standards, coached me on networking, and connected me with other professionals in my field. Within a month, I was getting interviews. Two months later, I landed a software developer position at a great company. The coach also helped me navigate salary negotiations and understand Canadian workplace culture. This service literally changed my life. For any newcomer struggling with job search, Ulixai's career services are invaluable.",
                'slug' => 'career-services-canada-priya-sharma-7'
            ],
            [
                'id' => 8,
                'name' => 'Lars Andersen',
                'nationality' => 'Norwegian',
                'flag' => '🇳🇴',
                'country' => 'Portugal',
                'language' => 'English',
                'image' => 'https://i.pravatar.cc/150?img=52',
                'rating' => 5,
                'date' => '2024-10-30',
                'service' => 'Tax Advisory',
                'serviceSlug' => 'tax-advisory',
                'shortText' => 'Retired in Lisbon and Ulixai made the transition effortless. From healthcare to taxes, everything handled perfectly.',
                'fullText' => "After 35 years of work in Oslo, I decided to retire in Lisbon for the weather and cost of living. But I was worried about the tax implications - Norwegian pension, Portuguese residency, potential double taxation. Ulixai's tax advisory service connected me with an advisor who specialized in Norway-Portugal tax treaties. She explained everything clearly: how much tax I'd pay in each country, how to register as a Portuguese tax resident, what deductions I could claim, and how to avoid double taxation. She also helped me understand Portugal's NHR (Non-Habitual Resident) program, which saved me thousands in taxes. The advisor handled all the paperwork and even communicated with Portuguese tax authorities on my behalf. Now I'm enjoying retirement in Lisbon with complete peace of mind about my tax situation. This service was worth every cent.",
                'slug' => 'tax-advisory-portugal-lars-andersen-8'
            ],
            [
                'id' => 9,
                'name' => 'Amara Okafor',
                'nationality' => 'Nigerian',
                'flag' => '🇳🇬',
                'country' => 'United Kingdom',
                'language' => 'English',
                'image' => 'https://i.pravatar.cc/150?img=38',
                'rating' => 5,
                'date' => '2024-11-18',
                'service' => 'Education Support',
                'serviceSlug' => 'education-support',
                'shortText' => 'Moving from Lagos to London was daunting, but Ulixai helped with visas and finding schools for my kids.',
                'fullText' => "Relocating my family from Lagos to London was the most stressful thing I've ever done. Finding good schools for my two children while dealing with visa requirements felt impossible. Ulixai's education support service was a lifesaver. They provided a dedicated advisor who understood the UK school system, helped me research schools in my area, explained the application process, and even helped me prepare for school interviews. The advisor also coordinated with my immigration lawyer to ensure all the visa paperwork was correct. My children got accepted to excellent schools, and the transition was much smoother than I expected. The advisor continued to check in during the first few months to make sure everything was going well. This service took so much stress off my shoulders and made sure my children's education wasn't disrupted. Absolutely essential for families relocating internationally.",
                'slug' => 'education-support-united-kingdom-amara-okafor-9'
            ],
            [
                'id' => 10,
                'name' => 'Giovanni Rossi',
                'nationality' => 'Italian',
                'flag' => '🇮🇹',
                'country' => 'Netherlands',
                'language' => 'Italian',
                'image' => 'https://i.pravatar.cc/150?img=61',
                'rating' => 5,
                'date' => '2024-12-03',
                'service' => 'Business Setup',
                'serviceSlug' => 'business-setup',
                'shortText' => "Started my business in Amsterdam with Ulixai's support. They connected me with accountants and lawyers.",
                'fullText' => "I moved from Milan to Amsterdam to start my fintech company. The Dutch business environment is great, but the legal and accounting requirements were complex. Ulixai's business setup service connected me with a team of professionals - a business lawyer, an accountant, and a tax advisor - all of whom spoke Italian and English. They helped me choose the right company structure, register with the Chamber of Commerce, set up my accounting system, and understand Dutch tax obligations. The lawyer reviewed all my contracts, and the accountant set up my bookkeeping properly from day one. The team worked seamlessly together, saving me time and preventing costly mistakes. My company has been operating smoothly for six months now, and I still use the accountant and lawyer Ulixai connected me with. For any entrepreneur starting a business abroad, this service is essential.",
                'slug' => 'business-setup-netherlands-giovanni-rossi-10'
            ],
            [
                'id' => 11,
                'name' => 'Fatima Al-Rashid',
                'nationality' => 'Saudi',
                'flag' => '🇸🇦',
                'country' => 'Switzerland',
                'language' => 'Arabic',
                'image' => 'https://i.pravatar.cc/150?img=43',
                'rating' => 5,
                'date' => '2024-10-15',
                'service' => 'Document Translation',
                'serviceSlug' => 'document-translation',
                'shortText' => 'Studying in Geneva and Ulixai helped with student housing and document translations. Outstanding support!',
                'fullText' => "When I received my acceptance letter to study in Geneva, I was thrilled but immediately faced a mountain of bureaucracy. Swiss authorities required certified translations of my academic certificates, birth certificate, and other official documents from Arabic to French. The university recommended expensive translation services, but Ulixai's document translation service was much more affordable and faster. They provided certified translations by sworn translators, which the Swiss authorities accepted without question. The team was professional, kept me updated on progress, and delivered everything on time. They also helped me understand which documents needed apostille stamps. Beyond translations, Ulixai's housing service helped me find a studio apartment near the university, which is incredibly difficult in Geneva. The entire experience was smooth and stress-free. I recommend Ulixai to every international student I meet.",
                'slug' => 'document-translation-switzerland-fatima-al-rashid-11'
            ],
            [
                'id' => 12,
                'name' => "Michael O'Brien",
                'nationality' => 'Irish',
                'flag' => '🇮🇪',
                'country' => 'New Zealand',
                'language' => 'English',
                'image' => 'https://i.pravatar.cc/150?img=14',
                'rating' => 5,
                'date' => '2024-11-05',
                'service' => 'Property Purchase',
                'serviceSlug' => 'property-purchase',
                'shortText' => "Ulixai helped me buy my first home in Auckland. Their mortgage advisor and lawyer were top-notch.",
                'fullText' => "Buying property in New Zealand as an Irish expat was complex. I didn't understand the NZ property market, mortgage requirements, or legal process. Ulixai's property purchase service connected me with a mortgage advisor and a conveyancing lawyer who made everything simple. The mortgage advisor explained my borrowing capacity, helped me get pre-approval, and found me a competitive interest rate. The lawyer handled all the legal paperwork, explained the sales and purchase agreement in plain English, and made sure there were no issues with the title. They coordinated with my real estate agent and kept everything on track. The process took about six weeks from offer to settlement, and I now own a beautiful home in Auckland. The service fee was reasonable considering the complexity of buying property in a foreign country. I couldn't have done it without Ulixai's help.",
                'slug' => 'property-purchase-new-zealand-michael-obrien-12'
            ],
            [
                'id' => 13,
                'name' => 'Sofia Andersson',
                'nationality' => 'Swedish',
                'flag' => '🇸🇪',
                'country' => 'Singapore',
                'language' => 'English',
                'image' => 'https://i.pravatar.cc/150?img=28',
                'rating' => 5,
                'date' => '2024-12-10',
                'service' => 'Vehicle Leasing',
                'serviceSlug' => 'vehicle-leasing',
                'shortText' => 'Working remotely from Singapore and Ulixai handled work permits, taxes, and helped me lease a car!',
                'fullText' => "As a digital nomad, I decided to base myself in Singapore for a year. I needed a car but didn't want to buy one for just 12 months. Ulixai's vehicle leasing service was perfect. They connected me with leasing companies that offered flexible short-term leases, explained the different options, and helped me choose the right car for my needs and budget. The process was completely online - I submitted my documents, got approved within two days, and picked up my car at the airport when I arrived. The monthly rate included insurance, maintenance, and road tax. Everything was handled professionally, and when I wanted to extend my lease for another six months, they arranged it immediately. Having a car made exploring Singapore and Malaysia so much easier. Great service for anyone who needs temporary vehicle solutions abroad.",
                'slug' => 'vehicle-leasing-singapore-sofia-andersson-13'
            ],
            [
                'id' => 14,
                'name' => 'Diego Fernández',
                'nationality' => 'Mexican',
                'flag' => '🇲🇽',
                'country' => 'Japan',
                'language' => 'Spanish',
                'image' => 'https://i.pravatar.cc/150?img=59',
                'rating' => 5,
                'date' => '2024-09-18',
                'service' => 'Visa Assistance',
                'serviceSlug' => 'visa-assistance',
                'shortText' => 'Teaching English in Tokyo and Ulixai helped me navigate visas and find an apartment.',
                'fullText' => "Moving from Mexico City to Tokyo was my dream, but the reality was overwhelming. The Japanese work visa process is notoriously complex, and I was worried about making mistakes. Ulixai's visa assistance service was incredible. They assigned me an advisor who specialized in Japanese work visas and spoke Spanish. She reviewed my job offer, helped me gather all the required documents, checked everything for errors, and even translated some documents from Spanish to English. She explained the process timeline, what to expect at the embassy, and how to prepare for the visa interview. The advisor also gave me tips about life in Tokyo and connected me with an apartment agent. My visa was approved on the first try, and I moved to Tokyo three months later. The service saved me from potential delays and rejections. Absolutely worth it for anyone dealing with Japanese immigration.",
                'slug' => 'visa-assistance-japan-diego-fernandez-14'
            ],
            [
                'id' => 15,
                'name' => 'Olivia Chen',
                'nationality' => 'Chinese',
                'flag' => '🇨🇳',
                'country' => 'United Arab Emirates',
                'language' => 'Chinese',
                'image' => 'https://i.pravatar.cc/150?img=49',
                'rating' => 5,
                'date' => '2024-11-22',
                'service' => 'Relocation Services',
                'serviceSlug' => 'relocation-services',
                'shortText' => 'Relocated to Dubai for work and Ulixai made it seamless. From visas to finding schools—perfect!',
                'fullText' => "When my company offered me a senior position in Dubai, I knew it meant relocating my family - my husband and two school-age children. The logistics were overwhelming: visas, housing, schools, shipping our belongings, closing accounts in China. Ulixai's relocation service handled everything. They assigned us a dedicated coordinator who spoke Chinese and English. The coordinator arranged our residence visas, found us a villa in a good area, enrolled our children in an international school, set up our utilities, and even arranged the shipping of our furniture. She created a detailed timeline and checklist, which kept us organized and stress-free. When we arrived in Dubai, the coordinator met us at the airport and helped us settle in during the first week. Six months later, we're completely settled and happy. This service turned what could have been a nightmare into a smooth, well-organized process. Essential for any family relocating internationally.",
                'slug' => 'relocation-services-uae-olivia-chen-15'
            ]
        ];
    }
    
    // ✅ AVIS UTILISATEURS avec SOUS-SOUS-CATÉGORIES + OPTIMISATION DE SLUG
    private function getUserReviews()
    {
        try {
            return ProviderReview::with([
                'user', 
                'provider', 
                'mission.category',
                'mission.subcategory',
                'mission.subcategory.subcategory'
            ])
                ->whereNotNull('comment')
                ->whereHas('user', function($query) {
                    $query->whereNotNull('country')
                          ->whereNotNull('preferred_language')
                          ->whereNotNull('name');
                })
                ->whereHas('mission', function($query) {
                    $query->whereNotNull('location_country');
                })
                ->latest()
                ->get()
                ->map(function($review) {
                    $countryCode = strtoupper($review->user->country ?? 'XX');
                    $destinationCountry = $review->mission->location_country ?? 'international';
                    $userName = $review->user->name;
                    $language = $review->user->preferred_language ?? 'English';
                    
                    // ✅ PRIORISATION : Sous-sous-catégorie > Sous-catégorie > Catégorie
                    if (isset($review->mission->subcategory->subcategory)) {
                        // Meilleur cas : sous-sous-catégorie existe
                        $categoryName = $review->mission->subcategory->subcategory->name;
                        $categorySlug = $review->mission->subcategory->subcategory->slug;
                    } elseif (isset($review->mission->subcategory)) {
                        // Cas moyen : sous-catégorie existe
                        $categoryName = $review->mission->subcategory->name;
                        $categorySlug = $review->mission->subcategory->slug;
                    } elseif (isset($review->mission->category)) {
                        // Cas de base : catégorie principale
                        $categoryName = $review->mission->category->name;
                        $categorySlug = $review->mission->category->slug;
                    } else {
                        // Fallback
                        $categoryName = 'Service';
                        $categorySlug = 'service';
                    }
                    
                    // ⚡ OPTIMISATION : Raccourcir le slug si trop long
                    $categorySlug = $this->optimizeSlug($categorySlug);
                    
                    // ✅ SLUG SEO OPTIMISÉ : {categorie-courte}-{pays}-{nom}-{ID}
                    $slug = Str::slug(
                        $categorySlug . '-' . 
                        strtolower($destinationCountry) . '-' . 
                        Str::slug($userName)
                    ) . '-' . $review->id;
                    
                    return [
                        'id' => 'user-' . $review->id,
                        'name' => $userName,
                        'nationality' => $this->getNationalityName($countryCode),
                        'flag' => $this->getFlagEmoji($countryCode),
                        'country' => $this->getCountryName($destinationCountry),
                        'language' => $language,
                        'image' => $review->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=random',
                        'rating' => $review->rating,
                        'date' => $review->created_at->format('Y-m-d'),
                        'service' => $categoryName, // ✅ Nom complet pour affichage
                        'serviceSlug' => $categorySlug, // ✅ Slug court pour URL
                        'shortText' => Str::limit($review->comment, 150),
                        'fullText' => $review->comment,
                        'slug' => $slug,
                        'is_user_review' => true
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            \Log::error('Error loading user reviews: ' . $e->getMessage());
            return [];
        }
    }
    
    private function getFlagEmoji($countryCode)
    {
        $flags = [
            'FR' => '🇫🇷', 'GB' => '🇬🇧', 'US' => '🇺🇸', 'DE' => '🇩🇪',
            'ES' => '🇪🇸', 'IT' => '🇮🇹', 'JP' => '🇯🇵', 'CN' => '🇨🇳',
            'IN' => '🇮🇳', 'BR' => '🇧🇷', 'CA' => '🇨🇦', 'AU' => '🇦🇺',
            'MX' => '🇲🇽', 'NL' => '🇳🇱', 'SE' => '🇸🇪', 'NO' => '🇳🇴',
            'PT' => '🇵🇹', 'CH' => '🇨🇭', 'AE' => '🇦🇪', 'SA' => '🇸🇦',
            'NG' => '🇳🇬', 'RU' => '🇷🇺', 'NZ' => '🇳🇿', 'SG' => '🇸🇬',
            'TH' => '🇹🇭', 'IE' => '🇮🇪', 'PL' => '🇵🇱', 'TR' => '🇹🇷',
            'KR' => '🇰🇷', 'ZA' => '🇿🇦', 'AR' => '🇦🇷', 'CL' => '🇨🇱',
        ];
        return $flags[$countryCode] ?? '🌍';
    }
    
    private function getNationalityName($countryCode)
    {
        $nationalities = [
            'FR' => 'French', 'GB' => 'British', 'US' => 'American',
            'DE' => 'German', 'ES' => 'Spanish', 'IT' => 'Italian',
            'JP' => 'Japanese', 'CN' => 'Chinese', 'IN' => 'Indian',
            'MX' => 'Mexican', 'NL' => 'Dutch', 'SE' => 'Swedish',
            'NO' => 'Norwegian', 'PT' => 'Portuguese', 'AE' => 'Emirati',
            'BR' => 'Brazilian', 'CA' => 'Canadian', 'AU' => 'Australian',
            'RU' => 'Russian', 'SA' => 'Saudi', 'NG' => 'Nigerian',
            'NZ' => 'New Zealander', 'SG' => 'Singaporean', 'TH' => 'Thai',
            'IE' => 'Irish', 'CH' => 'Swiss', 'PL' => 'Polish',
        ];
        return $nationalities[$countryCode] ?? 'International';
    }
    
    private function getCountryName($countryCode)
    {
        $countries = [
            'FR' => 'France', 'GB' => 'United Kingdom', 'US' => 'United States',
            'DE' => 'Germany', 'ES' => 'Spain', 'IT' => 'Italy',
            'JP' => 'Japan', 'CN' => 'China', 'AU' => 'Australia',
            'CA' => 'Canada', 'TH' => 'Thailand', 'SG' => 'Singapore',
            'NZ' => 'New Zealand', 'CH' => 'Switzerland', 'AE' => 'UAE',
            'NL' => 'Netherlands', 'PT' => 'Portugal', 'NO' => 'Norway',
            'SE' => 'Sweden', 'MX' => 'Mexico', 'BR' => 'Brazil',
            'IN' => 'India', 'RU' => 'Russia', 'SA' => 'Saudi Arabia',
        ];
        return $countries[strtoupper($countryCode)] ?? $countryCode;
    }

    public function index()
    {
        $staticReviews = $this->getAllReviews();
        $userReviews = $this->getUserReviews();
        
        // Fusionner tous les avis
        $allReviews = array_merge($staticReviews, $userReviews);
        
        // Trier par date décroissante (plus récents en premier)
        usort($allReviews, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        
        return view('pages.customerreviews', [
            'allReviews' => $allReviews
        ]);
    }

    public function show($slug)
    {
        $staticReviews = $this->getAllReviews();
        $userReviews = $this->getUserReviews();
        
        // Chercher dans les deux tableaux
        $allReviews = array_merge($staticReviews, $userReviews);
        $review = collect($allReviews)->firstWhere('slug', $slug);
        
        if (!$review) {
            abort(404);
        }
        
        return view('pages.review-single', ['review' => $review]);
    }
}