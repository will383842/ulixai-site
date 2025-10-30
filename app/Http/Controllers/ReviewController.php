<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ReviewController extends Controller
{
    /**
     * ⚠️ AVIS CODÉS EN DUR - À utiliser tant que la table ulixai_reviews n'existe pas
     * Ces avis seront remplacés par la DB une fois la migration effectuée
     */
    private function getHardcodedFeaturedReviews()
    {
        $reviews = [];
        
        $reviews[] = [
            'id' => 1, 'name' => 'Sarah Mitchell', 'nationality' => 'British', 'flag' => '🇬🇧',
            'country' => 'France', 'language' => 'English', 'image' => 'https://i.pravatar.cc/150?img=47',
            'rating' => 5, 'date' => '2025-10-12', 'service' => 'Health Insurance', 'serviceSlug' => 'health-insurance',
            'shortText' => 'Ulixai platform made finding the right health insurance expert incredibly easy. The provider profiles with verified reviews helped me choose confidently.',
            'fullText' => 'I needed health insurance help for my move to Paris and honestly dreaded the search. But Ulixai\'s platform completely changed that experience. Within minutes of posting my request, I received proposals from 5 different insurance advisors - all with detailed profiles, client reviews, and transparent pricing. What impressed me most was how easy it was to compare them: their languages, specializations, past client ratings, and response times were all clearly displayed. I chose an advisor with 4.9 stars who spoke English and specialized in expat health insurance. The messaging system on Ulixai made communication smooth, and the secure payment gave me peace of mind. The platform\'s verification system meant I was dealing with legitimate professionals, not random people online. I\'d been burned before on other platforms, so this level of transparency was refreshing. Ulixai didn\'t just connect me with an expert - it gave me confidence in my choice.',
            'slug' => 'health-insurance-france-sarah-mitchell-1', 'is_featured' => true, 'is_early_beta' => true,
            'display_pages' => ['recruitment', 'homepage', 'all']
        ];
        
        $reviews[] = [
            'id' => 2, 'name' => 'Carlos Rodriguez', 'nationality' => 'Spanish', 'flag' => '🇪🇸',
            'country' => 'Germany', 'language' => 'Spanish', 'image' => 'https://i.pravatar.cc/150?img=12',
            'rating' => 5, 'date' => '2025-08-28', 'service' => 'Housing Rental', 'serviceSlug' => 'housing-rental',
            'shortText' => 'Amazing platform! Found a Berlin housing agent who spoke Spanish in under 2 hours. The review system helped me avoid bad providers.',
            'fullText' => 'The Berlin housing market is insane, and I needed help fast. I posted my request on Ulixai late on a Sunday evening, honestly not expecting much. By Monday morning, I had 8 proposals from different housing agents - and 3 of them spoke Spanish! This was huge for me because my German is still basic. What really sold me on Ulixai was the review system. Each provider had detailed reviews from past clients: not just star ratings, but actual written feedback about responsiveness, professionalism, and results. I could see which agents had successfully helped other expats find apartments in my price range and preferred neighborhoods. I chose an agent with 47 reviews and a 4.8-star average. The platform\'s messaging system let me ask questions before committing, and the secure payment meant I didn\'t have to wire money to a stranger. Two weeks later, I had my apartment - thanks to both the agent AND Ulixai\'s transparent platform that let me choose wisely.',
            'slug' => 'housing-rental-germany-carlos-rodriguez-2', 'is_featured' => true, 'is_early_beta' => true,
            'display_pages' => ['affiliate', 'homepage', 'all']
        ];
        
        $reviews[] = [
            'id' => 3, 'name' => 'Priya Sharma', 'nationality' => 'Indian', 'flag' => '🇮🇳',
            'country' => 'Canada', 'language' => 'English', 'image' => 'https://i.pravatar.cc/150?img=45',
            'rating' => 5, 'date' => '2025-09-15', 'service' => 'Career Services', 'serviceSlug' => 'career-services',
            'shortText' => 'As a newcomer to Toronto, Ulixai helped me find a career coach with Canadian experience. The platform is intuitive and trustworthy.',
            'fullText' => 'Moving to Canada with no local work experience was terrifying. I knew I needed help but didn\'t know where to find trustworthy career coaches. A friend recommended Ulixai, and I\'m so glad she did. The platform immediately stood out because of how well-organized it is: I could filter career coaches by specialization (tech industry), language (English/Hindi), and even by whether they understood immigrant challenges. I posted my request describing my situation, and within hours had proposals from 6 coaches. Each profile showed their background, success stories, client testimonials, and pricing. One coach had amazing reviews specifically from other Indian tech professionals who\'d successfully found jobs in Toronto - that social proof was invaluable. The platform\'s built-in chat let me ask detailed questions before booking, and the payment protection meant I could request a refund if unsatisfied. What I loved most was the transparency: no hidden fees, clear pricing, and honest reviews. Ulixai gave me confidence to invest in professional help, and it paid off - I landed my job 8 weeks after working with the coach I found there.',
            'slug' => 'career-services-canada-priya-sharma-3', 'is_featured' => true, 'is_early_beta' => true,
            'display_pages' => ['partnerships', 'homepage', 'all']
        ];
        
        $reviews[] = [
            'id' => 4, 'name' => 'Lars Andersen', 'nationality' => 'Norwegian', 'flag' => '🇳🇴',
            'country' => 'Portugal', 'language' => 'English', 'image' => 'https://i.pravatar.cc/150?img=52',
            'rating' => 5, 'date' => '2025-08-18', 'service' => 'Tax Advisory', 'serviceSlug' => 'tax-advisory',
            'shortText' => 'Found a tax advisor on Ulixai who specialized in Norway-Portugal cases. The platform filtering system saved me weeks of research.',
            'fullText' => 'Retiring abroad comes with complex tax implications, and I needed an expert who understood both Norwegian and Portuguese tax law. Google searches gave me thousands of results but no way to verify quality or relevance. Then I found Ulixai. The platform search filters were incredibly specific - I could search for tax advisors with Norway-Portugal expertise, see their qualifications, read reviews from other Scandinavian retirees, and even check their response time (average 2 hours). This level of detail was exactly what I needed. I posted my request explaining my situation, and got 4 proposals within 24 hours. Each advisor profile showed their certifications, years of experience, and most importantly - real reviews from past clients in similar situations. One advisor had glowing reviews specifically mentioning NHR program success stories. The platform secure messaging meant I could discuss sensitive financial details safely, and the payment protection gave me confidence. What impressed me most was Ulixai customer support - when I had a question about how payments worked, they responded within an hour. For something as important as international tax planning, I needed a platform I could trust, and Ulixai delivered.',
            'slug' => 'tax-advisory-portugal-lars-andersen-4', 'is_featured' => true, 'is_early_beta' => true,
            'display_pages' => ['recruitment', 'all']
        ];
        
        $reviews[] = [
            'id' => 5, 'name' => 'Amara Okafor', 'nationality' => 'Nigerian', 'flag' => '🇳🇬',
            'country' => 'United Kingdom', 'language' => 'English', 'image' => 'https://i.pravatar.cc/150?img=38',
            'rating' => 5, 'date' => '2025-10-05', 'service' => 'Education Support', 'serviceSlug' => 'education-support',
            'shortText' => 'Moving from Lagos to London with kids was stressful. Ulixai connected me with an education consultant who had 50+ positive reviews.',
            'fullText' => 'Relocating internationally with children is overwhelming - schools, curricula, applications, everything is different. I needed expert guidance but was nervous about finding someone trustworthy online. Ulixai completely changed my experience. Unlike random Facebook groups or sketchy websites, Ulixai verified every education consultant on their platform. I could see each consultant credentials, specializations (UK school system, international families, visa coordination), and most importantly - dozens of detailed reviews from other parents. One consultant stood out with 50+ reviews, almost all 5-stars, with specific mentions of helping Nigerian families navigate the British school system. Reading those reviews from people in my exact situation gave me confidence. The platform made it easy to send my initial questions through their messaging system before committing to payment. I appreciated the transparent pricing - no surprise fees or upselling. The secure payment system protected both me and the consultant. What really impressed me was Ulixai dispute resolution service - knowing there was a safety net if something went wrong made me comfortable using the platform. My consultant was amazing, but I credit Ulixai for creating a marketplace where I could find her confidently.',
            'slug' => 'education-support-united-kingdom-amara-okafor-5', 'is_featured' => true, 'is_early_beta' => true,
            'display_pages' => ['affiliate', 'all']
        ];
        
        $reviews[] = [
            'id' => 6, 'name' => 'Giovanni Rossi', 'nationality' => 'Italian', 'flag' => '🇮🇹',
            'country' => 'Netherlands', 'language' => 'Italian', 'image' => 'https://i.pravatar.cc/150?img=61',
            'rating' => 5, 'date' => '2025-09-22', 'service' => 'Business Setup', 'serviceSlug' => 'business-setup',
            'shortText' => 'Ulixai platform connected me with vetted business consultants in Amsterdam. The multilingual support and verified profiles were game-changers.',
            'fullText' => 'Starting a business in a foreign country requires multiple experts - lawyers, accountants, tax advisors. Finding them individually would have taken months. Ulixai solved this completely. The platform let me post one request describing my fintech startup needs, and within 48 hours I had proposals from complete teams who specialized in exactly what I needed. The beauty of Ulixai is the transparency: every consultant profile showed their qualifications, past startup successes, client reviews, and even their typical response times. I could filter by language (Italian/English), specialization (fintech compliance), and location (Amsterdam). The review system was incredibly detailed - clients did not just rate stars, they wrote about communication quality, deadline adherence, and cost-effectiveness. One team had 38 reviews with consistent praise for excellent follow-through and transparent pricing - exactly what I needed. Ulixai messaging system let me interview three different teams before choosing. The platform secure payment meant my deposit was protected until milestones were met. What surprised me most was Ulixai customer support - when I had a question about contract templates, their team responded within the hour with helpful resources. For entrepreneurs, time is money, and Ulixai saved me months of research.',
            'slug' => 'business-setup-netherlands-giovanni-rossi-6', 'is_featured' => true, 'is_early_beta' => true,
            'display_pages' => ['partnerships', 'all']
        ];
        
        $reviews[] = [
            'id' => 7, 'name' => 'Diego Fernández', 'nationality' => 'Mexican', 'flag' => '🇲🇽',
            'country' => 'Japan', 'language' => 'Spanish', 'image' => 'https://i.pravatar.cc/150?img=59',
            'rating' => 5, 'date' => '2025-09-05', 'service' => 'Visa Assistance', 'serviceSlug' => 'visa-assistance',
            'shortText' => 'Found a Japanese visa specialist on Ulixai who spoke Spanish! The platform filtering by language and specialty was perfect.',
            'fullText' => 'Japanese work visas are notoriously complicated, and my Japanese is limited. I needed a specialist who spoke Spanish and understood Mexican document requirements - a nearly impossible combination to find. Then I discovered Ulixai. The platform advanced filters let me search for visa specialists with Japanese work visa expertise who spoke Spanish - and I found THREE! This was unbelievable. Each specialist profile showed their success rate, processing time averages, client reviews in Spanish, and exact pricing. No hidden fees, no vague quotes - everything transparent upfront. I read through dozens of reviews from other Latin Americans who had successfully obtained Japanese visas through these specialists. The reviews mentioned specific details like responded to questions within 2 hours and caught document errors that would have caused rejection - this level of detail gave me confidence. I posted my request, got proposals from all three specialists, and could compare their approaches directly through Ulixai messaging system. The platform document sharing feature was secure and easy - no sketchy email attachments. What sealed the deal was Ulixai payment protection: my money was held in escrow until my visa was approved. That eliminated all risk for me. The platform did not just connect me with an expert - it gave me peace of mind throughout the entire stressful visa process.',
            'slug' => 'visa-assistance-japan-diego-fernandez-7', 'is_featured' => true, 'is_early_beta' => true,
            'display_pages' => ['recruitment', 'affiliate', 'all']
        ];
        
        $reviews[] = [
            'id' => 8, 'name' => 'Olivia Chen', 'nationality' => 'Chinese', 'flag' => '🇨🇳',
            'country' => 'United Arab Emirates', 'language' => 'Chinese', 'image' => 'https://i.pravatar.cc/150?img=49',
            'rating' => 5, 'date' => '2025-08-09', 'service' => 'Relocation Services', 'serviceSlug' => 'relocation-services',
            'shortText' => 'Relocated my family to Dubai using Ulixai. Found a coordinator with 67 reviews and Chinese language support.',
            'fullText' => 'Relocating an entire family internationally is overwhelming - visas, housing, schools, shipping, everything. I needed a relocation coordinator but was terrified of choosing the wrong one. Ulixai platform completely eliminated that fear. The filtering system let me search specifically for relocation coordinators who: spoke Chinese, had UAE expertise, specialized in families with children, and had experience with corporate relocations. I found a coordinator with 67 reviews - almost all 5-stars - and many reviews were in Chinese from other families who had relocated to Dubai. Reading their detailed experiences made me feel like I was talking to friends who had done this before. The reviews mentioned everything: responded to WeChat messages immediately, found excellent international schools, negotiated villa rental terms, and met family at airport. This granular feedback was invaluable. Through Ulixai platform, I could message the coordinator, ask detailed questions about school options, and even video call (integrated right into the platform!) before paying anything. The pricing was transparent - no hidden fees or surprise charges. Ulixai payment protection meant my deposit was secure, and I could release payment in milestones as services were completed. What impressed me most was how professional the whole platform felt. It was not like Facebook groups or random websites - it was clearly designed for serious, high-stakes services. The Ulixai team even checked in with me during my move to make sure everything was going smoothly. That level of care and professionalism throughout the platform made an incredibly stressful life event manageable.',
            'slug' => 'relocation-services-uae-olivia-chen-8', 'is_featured' => true, 'is_early_beta' => true,
            'display_pages' => ['partnerships', 'homepage', 'all']
        ];
        
        return $reviews;
    }
    
    /**
     * Récupère les avis selon la page demandée
     * LOGIQUE HYBRIDE: Utilise la DB si elle existe, sinon fallback sur hardcoded
     * 
     * @param string|null $page Page cible ('recruitment', 'affiliate', 'partnerships', 'homepage', 'all')
     * @param int|null $limit Nombre d'avis à retourner
     * @return array
     */
    public function getFeaturedReviews($page = null, $limit = null)
    {
        // Vérifier si la table ulixai_reviews existe
        if (Schema::hasTable('ulixai_reviews')) {
            try {
                // Charger le modèle dynamiquement pour éviter les erreurs si pas encore créé
                $reviewClass = 'App\\Models\\UlixaiReview';
                if (class_exists($reviewClass)) {
                    $query = $reviewClass::where('source', 'featured')
                        ->where('status', 'approved')
                        ->where('is_featured', true);
                    
                    // Filtrer par page si spécifié
                    if ($page && $page !== 'all') {
                        $query->where(function($q) use ($page) {
                            $q->whereJsonContains('display_pages', $page)
                              ->orWhereJsonContains('display_pages', 'all');
                        });
                    }
                    
                    // Limiter le nombre de résultats
                    if ($limit) {
                        $query->limit($limit);
                    }
                    
                    return $query->latest()
                        ->get()
                        ->map(function($review) {
                            return [
                                'id' => $review->id,
                                'name' => $review->reviewer_name,
                                'nationality' => $review->reviewer_nationality,
                                'flag' => $review->reviewer_flag,
                                'country' => $review->destination_country,
                                'language' => $review->language,
                                'image' => $review->avatar_url ?: 'https://ui-avatars.com/api/?name=' . urlencode($review->reviewer_name) . '&background=random',
                                'rating' => $review->rating,
                                'date' => $review->created_at->format('Y-m-d'),
                                'service' => $review->category->name ?? 'Service',
                                'serviceSlug' => $review->category->slug ?? 'service',
                                'shortText' => $review->short_testimonial,
                                'fullText' => $review->full_testimonial,
                                'slug' => $review->slug,
                                'is_featured' => true,
                                'is_early_beta' => false,
                                'trust_badges' => $review->trust_badges,
                                'display_pages' => $review->display_pages
                            ];
                        })
                        ->toArray();
                }
            } catch (\Exception $e) {
                Log::warning('Error loading reviews from DB, using hardcoded fallback: ' . $e->getMessage());
            }
        }
        
        // FALLBACK: Utiliser les avis codés en dur
        $hardcodedReviews = $this->getHardcodedFeaturedReviews();
        
        // Filtrer par page si spécifié
        if ($page && $page !== 'all') {
            $hardcodedReviews = array_filter($hardcodedReviews, function($review) use ($page) {
                return in_array($page, $review['display_pages']) || in_array('all', $review['display_pages']);
            });
        }
        
        // Limiter le nombre si spécifié
        if ($limit) {
            $hardcodedReviews = array_slice($hardcodedReviews, 0, $limit);
        }
        
        return $hardcodedReviews;
    }
    
    /**
     * Récupère les VRAIS avis utilisateurs depuis ProviderReview (ancien système)
     * ⚠️ Cette méthode sera dépréciée une fois la migration vers ulixai_reviews complète
     */
    public function getUserReviews()
    {
        // Si la nouvelle table existe, l'utiliser
        if (Schema::hasTable('ulixai_reviews')) {
            try {
                $reviewClass = 'App\\Models\\UlixaiReview';
                if (class_exists($reviewClass)) {
                    return $reviewClass::with(['user', 'category'])
                        ->where('source', 'real')
                        ->where('status', 'approved')
                        ->where('rating', '>=', 4)
                        ->latest()
                        ->get()
                        ->map(function($review) {
                            $userCountry = $this->normalizeCountryName($review->reviewer_country ?? 'International');
                            $destinationCountry = $this->normalizeCountryName($review->destination_country ?? 'International');
                            $categorySlug = $review->category->slug ?? 'service';
                            $slug = $review->slug ?: $this->generateSlug($categorySlug, $destinationCountry, $review->reviewer_name, $review->id);
                            
                            return [
                                'id' => 'user-' . $review->id,
                                'name' => $review->reviewer_name,
                                'nationality' => $review->reviewer_nationality,
                                'flag' => $review->reviewer_flag,
                                'country' => $destinationCountry,
                                'language' => $review->language,
                                'image' => $review->avatar_url ?: 'https://ui-avatars.com/api/?name=' . urlencode($review->reviewer_name) . '&background=random',
                                'rating' => $review->rating,
                                'date' => $review->created_at->format('Y-m-d'),
                                'service' => $review->category->name ?? 'Service',
                                'serviceSlug' => $categorySlug,
                                'shortText' => $review->short_testimonial,
                                'fullText' => $review->full_testimonial,
                                'slug' => $slug,
                                'is_user_review' => true,
                                'is_featured' => false,
                                'is_early_beta' => false,
                                'trust_badges' => $review->trust_badges
                            ];
                        })
                        ->toArray();
                }
            } catch (\Exception $e) {
                Log::warning('Error loading user reviews from ulixai_reviews: ' . $e->getMessage());
            }
        }
        
        // FALLBACK: Utiliser l'ancien système ProviderReview
        try {
            if (!Schema::hasTable('provider_reviews')) {
                return [];
            }
            
            $reviewClass = 'App\\Models\\ProviderReview';
            if (!class_exists($reviewClass)) {
                return [];
            }
            
            return $reviewClass::with(['user', 'provider', 'mission.category', 'mission.subcategory', 'mission.subcategory.subcategory'])
                ->whereNotNull('comment')
                ->where('rating', '>=', 4)
                ->whereHas('user', function($query) {
                    $query->whereNotNull('country')->whereNotNull('preferred_language')->whereNotNull('name');
                })
                ->whereHas('mission', function($query) {
                    $query->whereNotNull('location_country');
                })
                ->latest()
                ->get()
                ->map(function($review) {
                    $rawCountry = $review->user->country ?? 'Unknown';
                    $userCountry = $this->normalizeCountryName($rawCountry);
                    $flag = $this->getFlagEmojiFromCountryName($userCountry);
                    $destinationCountry = $this->normalizeCountryName($review->mission->location_country ?? 'international');
                    $userName = $review->user->name;
                    $language = $review->user->preferred_language ?? 'English';
                    
                    if (isset($review->mission->subcategory->subcategory)) {
                        $categoryName = $review->mission->subcategory->subcategory->name;
                        $categorySlug = $review->mission->subcategory->subcategory->slug;
                    } elseif (isset($review->mission->subcategory)) {
                        $categoryName = $review->mission->subcategory->name;
                        $categorySlug = $review->mission->subcategory->slug;
                    } elseif (isset($review->mission->category)) {
                        $categoryName = $review->mission->category->name;
                        $categorySlug = $review->mission->category->slug;
                    } else {
                        $categoryName = 'Service';
                        $categorySlug = 'service';
                    }
                    
                    $categorySlug = $this->optimizeSlug($categorySlug);
                    $slug = Str::slug($categorySlug . '-' . strtolower($destinationCountry) . '-' . Str::slug($userName)) . '-' . $review->id;
                    
                    return [
                        'id' => 'user-' . $review->id,
                        'name' => $userName,
                        'nationality' => $this->getNationalityFromCountryName($userCountry),
                        'flag' => $flag,
                        'country' => $destinationCountry,
                        'language' => $language,
                        'image' => $review->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=random',
                        'rating' => $review->rating,
                        'date' => $review->created_at->format('Y-m-d'),
                        'service' => $categoryName,
                        'serviceSlug' => $categorySlug,
                        'shortText' => Str::limit($review->comment, 150),
                        'fullText' => $review->comment,
                        'slug' => $slug,
                        'is_user_review' => true,
                        'is_featured' => false,
                        'is_early_beta' => false
                    ];
                })
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error loading user reviews from ProviderReview: ' . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Méthodes spécifiques par page pour faciliter l'utilisation
     */
    public function getRecruitmentReviews($limit = 3)
    {
        return $this->getFeaturedReviews('recruitment', $limit);
    }
    
    public function getAffiliateReviews($limit = 3)
    {
        return $this->getFeaturedReviews('affiliate', $limit);
    }
    
    public function getPartnershipReviews($limit = 3)
    {
        return $this->getFeaturedReviews('partnerships', $limit);
    }
    
    public function getHomepageReviews($limit = 6)
    {
        return $this->getFeaturedReviews('homepage', $limit);
    }
    
    /**
     * Génère un slug optimisé pour SEO
     */
    private function generateSlug($categorySlug, $country, $name, $id)
    {
        $optimizedCategory = $this->optimizeSlug($categorySlug);
        return Str::slug($optimizedCategory . '-' . strtolower($country) . '-' . Str::slug($name)) . '-' . $id;
    }
    
    public function optimizeSlug($slug, $maxLength = 35)
    {
        $stopWords = ['assistance', 'services', 'service', 'support', 'help', 'for', 'the', 'and', 'or', 'of', 'in', 'to', 'a', 'an', 'with', 'by', 'from', 'international', 'professional', 'expert', 'consultancy', 'consulting', 'solutions'];
        $words = explode('-', $slug);
        $importantWords = array_filter($words, function($word) use ($stopWords) {
            return !in_array($word, $stopWords) && strlen($word) > 2;
        });
        $importantWords = array_slice($importantWords, 0, 3);
        $optimizedSlug = implode('-', $importantWords);
        if (strlen($optimizedSlug) > $maxLength) {
            $importantWords = array_slice(array_values($importantWords), 0, 2);
            $optimizedSlug = implode('-', $importantWords);
        }
        if (strlen($optimizedSlug) > $maxLength) {
            $optimizedSlug = substr($optimizedSlug, 0, $maxLength);
            if (strrpos($optimizedSlug, '-') !== false) {
                $optimizedSlug = substr($optimizedSlug, 0, strrpos($optimizedSlug, '-'));
            }
        }
        return $optimizedSlug ?: 'service';
    }
    
    public function getFlagEmojiFromCountryName($countryName)
    {
        $flags = [
            'Afghanistan' => '🇦🇫', 'Albania' => '🇦🇱', 'Algeria' => '🇩🇿', 'Andorra' => '🇦🇩',
            'Angola' => '🇦🇴', 'Antigua and Barbuda' => '🇦🇬', 'Argentina' => '🇦🇷', 'Armenia' => '🇦🇲',
            'Australia' => '🇦🇺', 'Austria' => '🇦🇹', 'Azerbaijan' => '🇦🇿', 'Bahamas' => '🇧🇸',
            'Bahrain' => '🇧🇭', 'Bangladesh' => '🇧🇩', 'Barbados' => '🇧🇧', 'Belarus' => '🇧🇾',
            'Belgium' => '🇧🇪', 'Belize' => '🇧🇿', 'Benin' => '🇧🇯', 'Bhutan' => '🇧🇹',
            'Bolivia' => '🇧🇴', 'Bosnia and Herzegovina' => '🇧🇦', 'Botswana' => '🇧🇼', 'Brazil' => '🇧🇷',
            'Brunei' => '🇧🇳', 'Bulgaria' => '🇧🇬', 'Burkina Faso' => '🇧🇫', 'Burundi' => '🇧🇮',
            'Cambodia' => '🇰🇭', 'Cameroon' => '🇨🇲', 'Canada' => '🇨🇦', 'Cape Verde' => '🇨🇻',
            'Central African Republic' => '🇨🇫', 'Chad' => '🇹🇩', 'Chile' => '🇨🇱', 'China' => '🇨🇳',
            'Colombia' => '🇨🇴', 'Comoros' => '🇰🇲', 'Congo' => '🇨🇬', 'Costa Rica' => '🇨🇷',
            'Croatia' => '🇭🇷', 'Cuba' => '🇨🇺', 'Cyprus' => '🇨🇾', 'Czech Republic' => '🇨🇿',
            'Czechia' => '🇨🇿', 'Denmark' => '🇩🇰', 'Djibouti' => '🇩🇯', 'Dominica' => '🇩🇲',
            'Dominican Republic' => '🇩🇴', 'Ecuador' => '🇪🇨', 'Egypt' => '🇪🇬', 'El Salvador' => '🇸🇻',
            'Equatorial Guinea' => '🇬🇶', 'Eritrea' => '🇪🇷', 'Estonia' => '🇪🇪', 'Eswatini' => '🇸🇿',
            'Ethiopia' => '🇪🇹', 'Fiji' => '🇫🇯', 'Finland' => '🇫🇮', 'France' => '🇫🇷',
            'Gabon' => '🇬🇦', 'Gambia' => '🇬🇲', 'Georgia' => '🇬🇪', 'Germany' => '🇩🇪',
            'Ghana' => '🇬🇭', 'Greece' => '🇬🇷', 'Grenada' => '🇬🇩', 'Guatemala' => '🇬🇹',
            'Guinea' => '🇬🇳', 'Guinea-Bissau' => '🇬🇼', 'Guyana' => '🇬🇾', 'Haiti' => '🇭🇹',
            'Honduras' => '🇭🇳', 'Hungary' => '🇭🇺', 'Iceland' => '🇮🇸', 'India' => '🇮🇳',
            'Indonesia' => '🇮🇩', 'Iran' => '🇮🇷', 'Iraq' => '🇮🇶', 'Ireland' => '🇮🇪',
            'Israel' => '🇮🇱', 'Italy' => '🇮🇹', 'Jamaica' => '🇯🇲', 'Japan' => '🇯🇵',
            'Jordan' => '🇯🇴', 'Kazakhstan' => '🇰🇿', 'Kenya' => '🇰🇪', 'Kiribati' => '🇰🇮',
            'Kosovo' => '🇽🇰', 'Kuwait' => '🇰🇼', 'Kyrgyzstan' => '🇰🇬', 'Laos' => '🇱🇦',
            'Latvia' => '🇱🇻', 'Lebanon' => '🇱🇧', 'Lesotho' => '🇱🇸', 'Liberia' => '🇱🇷',
            'Libya' => '🇱🇾', 'Liechtenstein' => '🇱🇮', 'Lithuania' => '🇱🇹', 'Luxembourg' => '🇱🇺',
            'Madagascar' => '🇲🇬', 'Malawi' => '🇲🇼', 'Malaysia' => '🇲🇾', 'Maldives' => '🇲🇻',
            'Mali' => '🇲🇱', 'Malta' => '🇲🇹', 'Marshall Islands' => '🇲🇭', 'Mauritania' => '🇲🇷',
            'Mauritius' => '🇲🇺', 'Mexico' => '🇲🇽', 'Micronesia' => '🇫🇲', 'Moldova' => '🇲🇩',
            'Monaco' => '🇲🇨', 'Mongolia' => '🇲🇳', 'Montenegro' => '🇲🇪', 'Morocco' => '🇲🇦',
            'Mozambique' => '🇲🇿', 'Myanmar' => '🇲🇲', 'Namibia' => '🇳🇦', 'Nauru' => '🇳🇷',
            'Nepal' => '🇳🇵', 'Netherlands' => '🇳🇱', 'New Zealand' => '🇳🇿', 'Nicaragua' => '🇳🇮',
            'Niger' => '🇳🇪', 'Nigeria' => '🇳🇬', 'North Korea' => '🇰🇵', 'North Macedonia' => '🇲🇰',
            'Norway' => '🇳🇴', 'Oman' => '🇴🇲', 'Pakistan' => '🇵🇰', 'Palau' => '🇵🇼',
            'Palestine' => '🇵🇸', 'Panama' => '🇵🇦', 'Papua New Guinea' => '🇵🇬', 'Paraguay' => '🇵🇾',
            'Peru' => '🇵🇪', 'Philippines' => '🇵🇭', 'Poland' => '🇵🇱', 'Portugal' => '🇵🇹',
            'Qatar' => '🇶🇦', 'Romania' => '🇷🇴', 'Russia' => '🇷🇺', 'Rwanda' => '🇷🇼',
            'Saint Kitts and Nevis' => '🇰🇳', 'Saint Lucia' => '🇱🇨', 'Saint Vincent and the Grenadines' => '🇻🇨',
            'Samoa' => '🇼🇸', 'San Marino' => '🇸🇲', 'Sao Tome and Principe' => '🇸🇹', 'Saudi Arabia' => '🇸🇦',
            'Senegal' => '🇸🇳', 'Serbia' => '🇷🇸', 'Seychelles' => '🇸🇨', 'Sierra Leone' => '🇸🇱',
            'Singapore' => '🇸🇬', 'Slovakia' => '🇸🇰', 'Slovenia' => '🇸🇮', 'Solomon Islands' => '🇸🇧',
            'Somalia' => '🇸🇴', 'South Africa' => '🇿🇦', 'South Korea' => '🇰🇷', 'South Sudan' => '🇸🇸',
            'Spain' => '🇪🇸', 'Sri Lanka' => '🇱🇰', 'Sudan' => '🇸🇩', 'Suriname' => '🇸🇷',
            'Sweden' => '🇸🇪', 'Switzerland' => '🇨🇭', 'Syria' => '🇸🇾', 'Taiwan' => '🇹🇼',
            'Tajikistan' => '🇹🇯', 'Tanzania' => '🇹🇿', 'Thailand' => '🇹🇭', 'Timor-Leste' => '🇹🇱',
            'Togo' => '🇹🇬', 'Tonga' => '🇹🇴', 'Trinidad and Tobago' => '🇹🇹', 'Tunisia' => '🇹🇳',
            'Turkey' => '🇹🇷', 'Turkmenistan' => '🇹🇲', 'Tuvalu' => '🇹🇻', 'Uganda' => '🇺🇬',
            'Ukraine' => '🇺🇦', 'United Arab Emirates' => '🇦🇪', 'UAE' => '🇦🇪',
            'United Kingdom' => '🇬🇧', 'UK' => '🇬🇧', 'United States' => '🇺🇸', 'USA' => '🇺🇸',
            'Uruguay' => '🇺🇾', 'Uzbekistan' => '🇺🇿', 'Vanuatu' => '🇻🇺', 'Vatican City' => '🇻🇦',
            'Venezuela' => '🇻🇪', 'Vietnam' => '🇻🇳', 'Yemen' => '🇾🇪', 'Zambia' => '🇿🇲',
            'Zimbabwe' => '🇿🇼'
        ];
        
        $countryName = trim($countryName);
        if (isset($flags[$countryName])) return $flags[$countryName];
        
        $countryLower = strtolower($countryName);
        foreach ($flags as $name => $flag) {
            if (strtolower($name) === $countryLower) return $flag;
        }
        
        Log::warning("Country flag not found for: " . $countryName);
        return '🌍';
    }
    
    public function getNationalityFromCountryName($countryName)
    {
        $nationalities = [
            'Afghanistan' => 'Afghan', 'Albania' => 'Albanian', 'Algeria' => 'Algerian', 'Andorra' => 'Andorran',
            'Angola' => 'Angolan', 'Antigua and Barbuda' => 'Antiguan', 'Argentina' => 'Argentine', 'Armenia' => 'Armenian',
            'Australia' => 'Australian', 'Austria' => 'Austrian', 'Azerbaijan' => 'Azerbaijani', 'Bahamas' => 'Bahamian',
            'Bahrain' => 'Bahraini', 'Bangladesh' => 'Bangladeshi', 'Barbados' => 'Barbadian', 'Belarus' => 'Belarusian',
            'Belgium' => 'Belgian', 'Belize' => 'Belizean', 'Benin' => 'Beninese', 'Bhutan' => 'Bhutanese',
            'Bolivia' => 'Bolivian', 'Bosnia and Herzegovina' => 'Bosnian', 'Botswana' => 'Motswana', 'Brazil' => 'Brazilian',
            'Brunei' => 'Bruneian', 'Bulgaria' => 'Bulgarian', 'Burkina Faso' => 'Burkinabe', 'Burundi' => 'Burundian',
            'Cambodia' => 'Cambodian', 'Cameroon' => 'Cameroonian', 'Canada' => 'Canadian', 'Cape Verde' => 'Cape Verdean',
            'Central African Republic' => 'Central African', 'Chad' => 'Chadian', 'Chile' => 'Chilean', 'China' => 'Chinese',
            'Colombia' => 'Colombian', 'Comoros' => 'Comorian', 'Congo' => 'Congolese', 'Costa Rica' => 'Costa Rican',
            'Croatia' => 'Croatian', 'Cuba' => 'Cuban', 'Cyprus' => 'Cypriot', 'Czech Republic' => 'Czech',
            'Czechia' => 'Czech', 'Denmark' => 'Danish', 'Djibouti' => 'Djiboutian', 'Dominica' => 'Dominican',
            'Dominican Republic' => 'Dominican', 'Ecuador' => 'Ecuadorian', 'Egypt' => 'Egyptian', 'El Salvador' => 'Salvadoran',
            'Equatorial Guinea' => 'Equatorial Guinean', 'Eritrea' => 'Eritrean', 'Estonia' => 'Estonian', 'Eswatini' => 'Swazi',
            'Ethiopia' => 'Ethiopian', 'Fiji' => 'Fijian', 'Finland' => 'Finnish', 'France' => 'French',
            'Gabon' => 'Gabonese', 'Gambia' => 'Gambian', 'Georgia' => 'Georgian', 'Germany' => 'German',
            'Ghana' => 'Ghanaian', 'Greece' => 'Greek', 'Grenada' => 'Grenadian', 'Guatemala' => 'Guatemalan',
            'Guinea' => 'Guinean', 'Guinea-Bissau' => 'Bissau-Guinean', 'Guyana' => 'Guyanese', 'Haiti' => 'Haitian',
            'Honduras' => 'Honduran', 'Hungary' => 'Hungarian', 'Iceland' => 'Icelandic', 'India' => 'Indian',
            'Indonesia' => 'Indonesian', 'Iran' => 'Iranian', 'Iraq' => 'Iraqi', 'Ireland' => 'Irish',
            'Israel' => 'Israeli', 'Italy' => 'Italian', 'Jamaica' => 'Jamaican', 'Japan' => 'Japanese',
            'Jordan' => 'Jordanian', 'Kazakhstan' => 'Kazakh', 'Kenya' => 'Kenyan', 'Kiribati' => 'I-Kiribati',
            'Kosovo' => 'Kosovar', 'Kuwait' => 'Kuwaiti', 'Kyrgyzstan' => 'Kyrgyz', 'Laos' => 'Laotian',
            'Latvia' => 'Latvian', 'Lebanon' => 'Lebanese', 'Lesotho' => 'Mosotho', 'Liberia' => 'Liberian',
            'Libya' => 'Libyan', 'Liechtenstein' => 'Liechtensteiner', 'Lithuania' => 'Lithuanian', 'Luxembourg' => 'Luxembourger',
            'Madagascar' => 'Malagasy', 'Malawi' => 'Malawian', 'Malaysia' => 'Malaysian', 'Maldives' => 'Maldivian',
            'Mali' => 'Malian', 'Malta' => 'Maltese', 'Marshall Islands' => 'Marshallese', 'Mauritania' => 'Mauritanian',
            'Mauritius' => 'Mauritian', 'Mexico' => 'Mexican', 'Micronesia' => 'Micronesian', 'Moldova' => 'Moldovan',
            'Monaco' => 'Monégasque', 'Mongolia' => 'Mongolian', 'Montenegro' => 'Montenegrin', 'Morocco' => 'Moroccan',
            'Mozambique' => 'Mozambican', 'Myanmar' => 'Burmese', 'Namibia' => 'Namibian', 'Nauru' => 'Nauruan',
            'Nepal' => 'Nepali', 'Netherlands' => 'Dutch', 'New Zealand' => 'New Zealander', 'Nicaragua' => 'Nicaraguan',
            'Niger' => 'Nigerien', 'Nigeria' => 'Nigerian', 'North Korea' => 'North Korean', 'North Macedonia' => 'Macedonian',
            'Norway' => 'Norwegian', 'Oman' => 'Omani', 'Pakistan' => 'Pakistani', 'Palau' => 'Palauan',
            'Palestine' => 'Palestinian', 'Panama' => 'Panamanian', 'Papua New Guinea' => 'Papua New Guinean',
            'Paraguay' => 'Paraguayan', 'Peru' => 'Peruvian', 'Philippines' => 'Filipino', 'Poland' => 'Polish',
            'Portugal' => 'Portuguese', 'Qatar' => 'Qatari', 'Romania' => 'Romanian', 'Russia' => 'Russian',
            'Rwanda' => 'Rwandan', 'Saint Kitts and Nevis' => 'Kittitian', 'Saint Lucia' => 'Saint Lucian',
            'Saint Vincent and the Grenadines' => 'Vincentian', 'Samoa' => 'Samoan', 'San Marino' => 'Sammarinese',
            'Sao Tome and Principe' => 'Sao Tomean', 'Saudi Arabia' => 'Saudi', 'Senegal' => 'Senegalese',
            'Serbia' => 'Serbian', 'Seychelles' => 'Seychellois', 'Sierra Leone' => 'Sierra Leonean', 'Singapore' => 'Singaporean',
            'Slovakia' => 'Slovak', 'Slovenia' => 'Slovenian', 'Solomon Islands' => 'Solomon Islander', 'Somalia' => 'Somali',
            'South Africa' => 'South African', 'South Korea' => 'South Korean', 'South Sudan' => 'South Sudanese',
            'Spain' => 'Spanish', 'Sri Lanka' => 'Sri Lankan', 'Sudan' => 'Sudanese', 'Suriname' => 'Surinamese',
            'Sweden' => 'Swedish', 'Switzerland' => 'Swiss', 'Syria' => 'Syrian', 'Taiwan' => 'Taiwanese',
            'Tajikistan' => 'Tajik', 'Tanzania' => 'Tanzanian', 'Thailand' => 'Thai', 'Timor-Leste' => 'Timorese',
            'Togo' => 'Togolese', 'Tonga' => 'Tongan', 'Trinidad and Tobago' => 'Trinidadian', 'Tunisia' => 'Tunisian',
            'Turkey' => 'Turkish', 'Turkmenistan' => 'Turkmen', 'Tuvalu' => 'Tuvaluan', 'Uganda' => 'Ugandan',
            'Ukraine' => 'Ukrainian', 'United Arab Emirates' => 'Emirati', 'UAE' => 'Emirati',
            'United Kingdom' => 'British', 'UK' => 'British', 'United States' => 'American', 'USA' => 'American',
            'Uruguay' => 'Uruguayan', 'Uzbekistan' => 'Uzbek', 'Vanuatu' => 'Ni-Vanuatu', 'Vatican City' => 'Vatican',
            'Venezuela' => 'Venezuelan', 'Vietnam' => 'Vietnamese', 'Yemen' => 'Yemeni', 'Zambia' => 'Zambian',
            'Zimbabwe' => 'Zimbabwean'
        ];
        
        $countryName = trim($countryName);
        if (isset($nationalities[$countryName])) return $nationalities[$countryName];
        
        $countryLower = strtolower($countryName);
        foreach ($nationalities as $name => $nationality) {
            if (strtolower($name) === $countryLower) return $nationality;
        }
        
        return 'International';
    }
    
    public function normalizeCountryName($countryName)
    {
        $countryName = trim($countryName);
        
        if (strlen($countryName) > 2) {
            $variations = [
                'United States of America' => 'United States',
                'Great Britain' => 'United Kingdom',
            ];
            return $variations[$countryName] ?? $countryName;
        }
        
        $isoToCountry = [
            'AF' => 'Afghanistan', 'AL' => 'Albania', 'DZ' => 'Algeria', 'AD' => 'Andorra',
            'AO' => 'Angola', 'AG' => 'Antigua and Barbuda', 'AR' => 'Argentina', 'AM' => 'Armenia',
            'AU' => 'Australia', 'AT' => 'Austria', 'AZ' => 'Azerbaijan', 'BS' => 'Bahamas',
            'BH' => 'Bahrain', 'BD' => 'Bangladesh', 'BB' => 'Barbados', 'BY' => 'Belarus',
            'BE' => 'Belgium', 'BZ' => 'Belize', 'BJ' => 'Benin', 'BT' => 'Bhutan',
            'BO' => 'Bolivia', 'BA' => 'Bosnia and Herzegovina', 'BW' => 'Botswana', 'BR' => 'Brazil',
            'BN' => 'Brunei', 'BG' => 'Bulgaria', 'BF' => 'Burkina Faso', 'BI' => 'Burundi',
            'KH' => 'Cambodia', 'CM' => 'Cameroon', 'CA' => 'Canada', 'CV' => 'Cape Verde',
            'CF' => 'Central African Republic', 'TD' => 'Chad', 'CL' => 'Chile', 'CN' => 'China',
            'CO' => 'Colombia', 'KM' => 'Comoros', 'CG' => 'Congo', 'CR' => 'Costa Rica',
            'HR' => 'Croatia', 'CU' => 'Cuba', 'CY' => 'Cyprus', 'CZ' => 'Czech Republic',
            'DK' => 'Denmark', 'DJ' => 'Djibouti', 'DM' => 'Dominica', 'DO' => 'Dominican Republic',
            'EC' => 'Ecuador', 'EG' => 'Egypt', 'SV' => 'El Salvador', 'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea', 'EE' => 'Estonia', 'SZ' => 'Eswatini', 'ET' => 'Ethiopia',
            'FJ' => 'Fiji', 'FI' => 'Finland', 'FR' => 'France', 'GA' => 'Gabon',
            'GM' => 'Gambia', 'GE' => 'Georgia', 'DE' => 'Germany', 'GH' => 'Ghana',
            'GR' => 'Greece', 'GD' => 'Grenada', 'GT' => 'Guatemala', 'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau', 'GY' => 'Guyana', 'HT' => 'Haiti', 'HN' => 'Honduras',
            'HU' => 'Hungary', 'IS' => 'Iceland', 'IN' => 'India', 'ID' => 'Indonesia',
            'IR' => 'Iran', 'IQ' => 'Iraq', 'IE' => 'Ireland', 'IL' => 'Israel',
            'IT' => 'Italy', 'JM' => 'Jamaica', 'JP' => 'Japan', 'JO' => 'Jordan',
            'KZ' => 'Kazakhstan', 'KE' => 'Kenya', 'KI' => 'Kiribati', 'XK' => 'Kosovo',
            'KW' => 'Kuwait', 'KG' => 'Kyrgyzstan', 'LA' => 'Laos', 'LV' => 'Latvia',
            'LB' => 'Lebanon', 'LS' => 'Lesotho', 'LR' => 'Liberia', 'LY' => 'Libya',
            'LI' => 'Liechtenstein', 'LT' => 'Lithuania', 'LU' => 'Luxembourg', 'MG' => 'Madagascar',
            'MW' => 'Malawi', 'MY' => 'Malaysia', 'MV' => 'Maldives', 'ML' => 'Mali',
            'MT' => 'Malta', 'MH' => 'Marshall Islands', 'MR' => 'Mauritania', 'MU' => 'Mauritius',
            'MX' => 'Mexico', 'FM' => 'Micronesia', 'MD' => 'Moldova', 'MC' => 'Monaco',
            'MN' => 'Mongolia', 'ME' => 'Montenegro', 'MA' => 'Morocco', 'MZ' => 'Mozambique',
            'MM' => 'Myanmar', 'NA' => 'Namibia', 'NR' => 'Nauru', 'NP' => 'Nepal',
            'NL' => 'Netherlands', 'NZ' => 'New Zealand', 'NI' => 'Nicaragua', 'NE' => 'Niger',
            'NG' => 'Nigeria', 'KP' => 'North Korea', 'MK' => 'North Macedonia', 'NO' => 'Norway',
            'OM' => 'Oman', 'PK' => 'Pakistan', 'PW' => 'Palau', 'PS' => 'Palestine',
            'PA' => 'Panama', 'PG' => 'Papua New Guinea', 'PY' => 'Paraguay', 'PE' => 'Peru',
            'PH' => 'Philippines', 'PL' => 'Poland', 'PT' => 'Portugal', 'QA' => 'Qatar',
            'RO' => 'Romania', 'RU' => 'Russia', 'RW' => 'Rwanda', 'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia', 'VC' => 'Saint Vincent and the Grenadines', 'WS' => 'Samoa',
            'SM' => 'San Marino', 'ST' => 'Sao Tome and Principe', 'SA' => 'Saudi Arabia',
            'SN' => 'Senegal', 'RS' => 'Serbia', 'SC' => 'Seychelles', 'SL' => 'Sierra Leone',
            'SG' => 'Singapore', 'SK' => 'Slovakia', 'SI' => 'Slovenia', 'SB' => 'Solomon Islands',
            'SO' => 'Somalia', 'ZA' => 'South Africa', 'KR' => 'South Korea', 'SS' => 'South Sudan',
            'ES' => 'Spain', 'LK' => 'Sri Lanka', 'SD' => 'Sudan', 'SR' => 'Suriname',
            'SE' => 'Sweden', 'CH' => 'Switzerland', 'SY' => 'Syria', 'TW' => 'Taiwan',
            'TJ' => 'Tajikistan', 'TZ' => 'Tanzania', 'TH' => 'Thailand', 'TL' => 'Timor-Leste',
            'TG' => 'Togo', 'TO' => 'Tonga', 'TT' => 'Trinidad and Tobago', 'TN' => 'Tunisia',
            'TR' => 'Turkey', 'TM' => 'Turkmenistan', 'TV' => 'Tuvalu', 'UG' => 'Uganda',
            'UA' => 'Ukraine', 'AE' => 'United Arab Emirates', 'GB' => 'United Kingdom',
            'US' => 'United States', 'UY' => 'Uruguay', 'UZ' => 'Uzbekistan', 'VU' => 'Vanuatu',
            'VA' => 'Vatican City', 'VE' => 'Venezuela', 'VN' => 'Vietnam', 'YE' => 'Yemen',
            'ZM' => 'Zambia', 'ZW' => 'Zimbabwe'
        ];
        
        $countryCode = strtoupper($countryName);
        if (isset($isoToCountry[$countryCode])) return $isoToCountry[$countryCode];
        
        Log::warning("Unknown country code or name: " . $countryName);
        return $countryName;
    }
    
    /**
     * Page principale des avis clients
     */
    public function index(Request $request)
    {
        $userReviews = $this->getUserReviews();
        $realReviewsCount = count($userReviews);
        
        $featuredReviews = [];
        if ($realReviewsCount < 30) {
            $featuredReviews = $this->getFeaturedReviews('all');
        }
        
        $allReviews = array_merge($featuredReviews, $userReviews);
        usort($allReviews, function($a, $b) { 
            return strtotime($b['date']) - strtotime($a['date']); 
        });
        
        $perPage = 12;
        $currentPage = $request->get('page', 1);
        $totalReviews = count($allReviews);
        $totalPages = ceil($totalReviews / $perPage);
        $offset = ($currentPage - 1) * $perPage;
        $reviewsForPage = array_slice($allReviews, $offset, $perPage);
        
        return view('pages.customerreviews', [
            'reviews' => $reviewsForPage,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'totalReviews' => $totalReviews,
            'perPage' => $perPage
        ]);
    }
    
    /**
     * Page détaillée d'un avis
     */
    public function show($slug)
    {
        $userReviews = $this->getUserReviews();
        $realReviewsCount = count($userReviews);
        
        $featuredReviews = [];
        if ($realReviewsCount < 30) {
            $featuredReviews = $this->getFeaturedReviews('all');
        }
        
        $allReviews = array_merge($featuredReviews, $userReviews);
        $review = collect($allReviews)->firstWhere('slug', $slug);
        
        if (!$review) {
            if (preg_match('/-(\d+)$/', $slug, $matches)) {
                $reviewId = (int)$matches[1];
                if ($reviewId >= 1 && $reviewId <= 8) {
                    return redirect()->route('reviews.index', [], 301)
                        ->with('info', 'This early beta review is no longer available. We now have over 30 verified customer reviews!');
                }
            }
            
            abort(404);
        }
        
        return view('pages.review-single', ['review' => $review]);
    }
    
    /**
     * Page de recrutement
     */
    public function recruitment()
    {
        $allCountries = Country::where('status', 1)->orderBy('country')->get();
        $reviews = $this->getRecruitmentReviews(3);
        
        return view('pages.recruitment', [
            'reviews' => $reviews,
            'allCountries' => $allCountries
        ]);
    }
    
    /**
     * Page de partenariats stratégiques
     * 🆕 NOUVELLE MÉTHODE AJOUTÉE
     */
    public function partnerships()
    {
        $reviews = $this->getPartnershipReviews(3);
        
        return view('pages.partnerships', [
            'reviews' => $reviews
        ]);
    }
}