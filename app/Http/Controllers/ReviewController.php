<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProviderReview;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    private function optimizeSlug($slug, $maxLength = 35)
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
    
    private function getFeaturedReviews()
    {
        $reviews = [];
        
        // Review 1 - Sarah Mitchell
        $reviews[] = [
            'id' => 1,
            'name' => 'Sarah Mitchell',
            'nationality' => 'British',
            'flag' => '🇬🇧',
            'country' => 'France',
            'language' => 'English',
            'image' => 'https://i.pravatar.cc/150?img=47',
            'rating' => 5,
            'date' => '2025-10-12',
            'service' => 'Health Insurance',
            'serviceSlug' => 'health-insurance',
            'shortText' => 'Ulixai platform made finding the right health insurance expert incredibly easy. The provider profiles with verified reviews helped me choose confidently.',
            'fullText' => 'I needed health insurance help for my move to Paris and honestly dreaded the search. But Ulixai\'s platform completely changed that experience. ' .
                'Within minutes of posting my request, I received proposals from 5 different insurance advisors - all with detailed profiles, client reviews, and transparent pricing. ' .
                'What impressed me most was how easy it was to compare them: their languages, specializations, past client ratings, and response times were all clearly displayed. ' .
                'I chose an advisor with 4.9 stars who spoke English and specialized in expat health insurance. The messaging system on Ulixai made communication smooth, and the secure payment gave me peace of mind. ' .
                'The platform\'s verification system meant I was dealing with legitimate professionals, not random people online. I\'d been burned before on other platforms, so this level of transparency was refreshing. ' .
                'Ulixai didn\'t just connect me with an expert - it gave me confidence in my choice.',
            'slug' => 'health-insurance-france-sarah-mitchell-1',
            'is_featured' => true,
            'is_early_beta' => true
        ];
        
        // Review 2 - Carlos Rodriguez
        $reviews[] = [
            'id' => 2,
            'name' => 'Carlos Rodriguez',
            'nationality' => 'Spanish',
            'flag' => '🇪🇸',
            'country' => 'Germany',
            'language' => 'Spanish',
            'image' => 'https://i.pravatar.cc/150?img=12',
            'rating' => 5,
            'date' => '2025-08-28',
            'service' => 'Housing Rental',
            'serviceSlug' => 'housing-rental',
            'shortText' => 'Amazing platform! Found a Berlin housing agent who spoke Spanish in under 2 hours. The review system helped me avoid bad providers.',
            'fullText' => 'The Berlin housing market is insane, and I needed help fast. I posted my request on Ulixai late on a Sunday evening, honestly not expecting much. ' .
                'By Monday morning, I had 8 proposals from different housing agents - and 3 of them spoke Spanish! This was huge for me because my German is still basic. ' .
                'What really sold me on Ulixai was the review system. Each provider had detailed reviews from past clients: not just star ratings, but actual written feedback about responsiveness, professionalism, and results. ' .
                'I could see which agents had successfully helped other expats find apartments in my price range and preferred neighborhoods. I chose an agent with 47 reviews and a 4.8-star average. ' .
                'The platform\'s messaging system let me ask questions before committing, and the secure payment meant I didn\'t have to wire money to a stranger. ' .
                'Two weeks later, I had my apartment - thanks to both the agent AND Ulixai\'s transparent platform that let me choose wisely.',
            'slug' => 'housing-rental-germany-carlos-rodriguez-2',
            'is_featured' => true,
            'is_early_beta' => true
        ];
        
        // Review 3 - Priya Sharma
        $reviews[] = [
            'id' => 3,
            'name' => 'Priya Sharma',
            'nationality' => 'Indian',
            'flag' => '🇮🇳',
            'country' => 'Canada',
            'language' => 'English',
            'image' => 'https://i.pravatar.cc/150?img=45',
            'rating' => 5,
            'date' => '2025-06-15',
            'service' => 'Career Services',
            'serviceSlug' => 'career-services',
            'shortText' => 'As a newcomer to Toronto, Ulixai helped me find a career coach with Canadian experience. The platform is intuitive and trustworthy.',
            'fullText' => 'Moving to Canada with no local work experience was terrifying. I knew I needed help but didn\'t know where to find trustworthy career coaches. ' .
                'A friend recommended Ulixai, and I\'m so glad she did. The platform immediately stood out because of how well-organized it is: I could filter career coaches by specialization (tech industry), language (English/Hindi), and even by whether they understood immigrant challenges. ' .
                'I posted my request describing my situation, and within hours had proposals from 6 coaches. Each profile showed their background, success stories, client testimonials, and pricing. ' .
                'One coach had amazing reviews specifically from other Indian tech professionals who\'d successfully found jobs in Toronto - that social proof was invaluable. ' .
                'The platform\'s built-in chat let me ask detailed questions before booking, and the payment protection meant I could request a refund if unsatisfied. ' .
                'What I loved most was the transparency: no hidden fees, clear pricing, and honest reviews. Ulixai gave me confidence to invest in professional help, and it paid off - I landed my job 8 weeks after working with the coach I found there.',
            'slug' => 'career-services-canada-priya-sharma-3',
            'is_featured' => true,
            'is_early_beta' => true
        ];
        
        // Review 4 - Lars Andersen
        $reviews[] = [
            'id' => 4,
            'name' => 'Lars Andersen',
            'nationality' => 'Norwegian',
            'flag' => '🇳🇴',
            'country' => 'Portugal',
            'language' => 'English',
            'image' => 'https://i.pravatar.cc/150?img=52',
            'rating' => 5,
            'date' => '2025-04-03',
            'service' => 'Tax Advisory',
            'serviceSlug' => 'tax-advisory',
            'shortText' => 'Found a tax advisor on Ulixai who specialized in Norway-Portugal cases. The platform filtering system saved me weeks of research.',
            'fullText' => 'Retiring abroad comes with complex tax implications, and I needed an expert who understood both Norwegian and Portuguese tax law. ' .
                'Google searches gave me thousands of results but no way to verify quality or relevance. Then I found Ulixai. ' .
                'The platform search filters were incredibly specific - I could search for tax advisors with Norway-Portugal expertise, see their qualifications, read reviews from other Scandinavian retirees, and even check their response time (average 2 hours). ' .
                'This level of detail was exactly what I needed. I posted my request explaining my situation, and got 4 proposals within 24 hours. ' .
                'Each advisor profile showed their certifications, years of experience, and most importantly - real reviews from past clients in similar situations. ' .
                'One advisor had glowing reviews specifically mentioning NHR program success stories. The platform secure messaging meant I could discuss sensitive financial details safely, and the payment protection gave me confidence. ' .
                'What impressed me most was Ulixai customer support - when I had a question about how payments worked, they responded within an hour. ' .
                'For something as important as international tax planning, I needed a platform I could trust, and Ulixai delivered.',
            'slug' => 'tax-advisory-portugal-lars-andersen-4',
            'is_featured' => true,
            'is_early_beta' => true
        ];
        
        // Review 5 - Amara Okafor
        $reviews[] = [
            'id' => 5,
            'name' => 'Amara Okafor',
            'nationality' => 'Nigerian',
            'flag' => '🇳🇬',
            'country' => 'United Kingdom',
            'language' => 'English',
            'image' => 'https://i.pravatar.cc/150?img=38',
            'rating' => 5,
            'date' => '2025-07-22',
            'service' => 'Education Support',
            'serviceSlug' => 'education-support',
            'shortText' => 'Moving from Lagos to London with kids was stressful. Ulixai connected me with an education consultant who had 50+ positive reviews.',
            'fullText' => 'Relocating internationally with children is overwhelming - schools, curricula, applications, everything is different. ' .
                'I needed expert guidance but was nervous about finding someone trustworthy online. Ulixai completely changed my experience. ' .
                'Unlike random Facebook groups or sketchy websites, Ulixai verified every education consultant on their platform. ' .
                'I could see each consultant credentials, specializations (UK school system, international families, visa coordination), and most importantly - dozens of detailed reviews from other parents. ' .
                'One consultant stood out with 50+ reviews, almost all 5-stars, with specific mentions of helping Nigerian families navigate the British school system. ' .
                'Reading those reviews from people in my exact situation gave me confidence. The platform made it easy to send my initial questions through their messaging system before committing to payment. ' .
                'I appreciated the transparent pricing - no surprise fees or upselling. The secure payment system protected both me and the consultant. ' .
                'What really impressed me was Ulixai dispute resolution service - knowing there was a safety net if something went wrong made me comfortable using the platform. ' .
                'My consultant was amazing, but I credit Ulixai for creating a marketplace where I could find her confidently.',
            'slug' => 'education-support-united-kingdom-amara-okafor-5',
            'is_featured' => true,
            'is_early_beta' => true
        ];
        
        // Review 6 - Giovanni Rossi
        $reviews[] = [
            'id' => 6,
            'name' => 'Giovanni Rossi',
            'nationality' => 'Italian',
            'flag' => '🇮🇹',
            'country' => 'Netherlands',
            'language' => 'Italian',
            'image' => 'https://i.pravatar.cc/150?img=61',
            'rating' => 5,
            'date' => '2025-03-08',
            'service' => 'Business Setup',
            'serviceSlug' => 'business-setup',
            'shortText' => 'Ulixai platform connected me with vetted business consultants in Amsterdam. The multilingual support and verified profiles were game-changers.',
            'fullText' => 'Starting a business in a foreign country requires multiple experts - lawyers, accountants, tax advisors. Finding them individually would have taken months. Ulixai solved this completely. ' .
                'The platform let me post one request describing my fintech startup needs, and within 48 hours I had proposals from complete teams who specialized in exactly what I needed. ' .
                'The beauty of Ulixai is the transparency: every consultant profile showed their qualifications, past startup successes, client reviews, and even their typical response times. ' .
                'I could filter by language (Italian/English), specialization (fintech compliance), and location (Amsterdam). ' .
                'The review system was incredibly detailed - clients did not just rate stars, they wrote about communication quality, deadline adherence, and cost-effectiveness. ' .
                'One team had 38 reviews with consistent praise for excellent follow-through and transparent pricing - exactly what I needed. ' .
                'Ulixai messaging system let me interview three different teams before choosing. The platform secure payment meant my deposit was protected until milestones were met. ' .
                'What surprised me most was Ulixai customer support - when I had a question about contract templates, their team responded within the hour with helpful resources. ' .
                'For entrepreneurs, time is money, and Ulixai saved me months of research.',
            'slug' => 'business-setup-netherlands-giovanni-rossi-6',
            'is_featured' => true,
            'is_early_beta' => true
        ];
        
        // Review 7 - Diego Fernandez
        $reviews[] = [
            'id' => 7,
            'name' => 'Diego Fernández',
            'nationality' => 'Mexican',
            'flag' => '🇲🇽',
            'country' => 'Japan',
            'language' => 'Spanish',
            'image' => 'https://i.pravatar.cc/150?img=59',
            'rating' => 5,
            'date' => '2025-09-05',
            'service' => 'Visa Assistance',
            'serviceSlug' => 'visa-assistance',
            'shortText' => 'Found a Japanese visa specialist on Ulixai who spoke Spanish! The platform filtering by language and specialty was perfect.',
            'fullText' => 'Japanese work visas are notoriously complicated, and my Japanese is limited. I needed a specialist who spoke Spanish and understood Mexican document requirements - a nearly impossible combination to find. ' .
                'Then I discovered Ulixai. The platform advanced filters let me search for visa specialists with Japanese work visa expertise who spoke Spanish - and I found THREE! This was unbelievable. ' .
                'Each specialist profile showed their success rate, processing time averages, client reviews in Spanish, and exact pricing. No hidden fees, no vague quotes - everything transparent upfront. ' .
                'I read through dozens of reviews from other Latin Americans who had successfully obtained Japanese visas through these specialists. ' .
                'The reviews mentioned specific details like responded to questions within 2 hours and caught document errors that would have caused rejection - this level of detail gave me confidence. ' .
                'I posted my request, got proposals from all three specialists, and could compare their approaches directly through Ulixai messaging system. ' .
                'The platform document sharing feature was secure and easy - no sketchy email attachments. What sealed the deal was Ulixai payment protection: my money was held in escrow until my visa was approved. ' .
                'That eliminated all risk for me. The platform did not just connect me with an expert - it gave me peace of mind throughout the entire stressful visa process.',
            'slug' => 'visa-assistance-japan-diego-fernandez-7',
            'is_featured' => true,
            'is_early_beta' => true
        ];
        
        // Review 8 - Olivia Chen
        $reviews[] = [
            'id' => 8,
            'name' => 'Olivia Chen',
            'nationality' => 'Chinese',
            'flag' => '🇨🇳',
            'country' => 'United Arab Emirates',
            'language' => 'Chinese',
            'image' => 'https://i.pravatar.cc/150?img=49',
            'rating' => 5,
            'date' => '2025-01-18',
            'service' => 'Relocation Services',
            'serviceSlug' => 'relocation-services',
            'shortText' => 'Relocated my family to Dubai using Ulixai. Found a coordinator with 67 reviews and Chinese language support.',
            'fullText' => 'Relocating an entire family internationally is overwhelming - visas, housing, schools, shipping, everything. ' .
                'I needed a relocation coordinator but was terrified of choosing the wrong one. Ulixai platform completely eliminated that fear. ' .
                'The filtering system let me search specifically for relocation coordinators who: spoke Chinese, had UAE expertise, specialized in families with children, and had experience with corporate relocations. ' .
                'I found a coordinator with 67 reviews - almost all 5-stars - and many reviews were in Chinese from other families who had relocated to Dubai. ' .
                'Reading their detailed experiences made me feel like I was talking to friends who had done this before. The reviews mentioned everything: responded to WeChat messages immediately, found excellent international schools, negotiated villa rental terms, and met family at airport. ' .
                'This granular feedback was invaluable. Through Ulixai platform, I could message the coordinator, ask detailed questions about school options, and even video call (integrated right into the platform!) before paying anything. ' .
                'The pricing was transparent - no hidden fees or surprise charges. Ulixai payment protection meant my deposit was secure, and I could release payment in milestones as services were completed. ' .
                'What impressed me most was how professional the whole platform felt. It was not like Facebook groups or random websites - it was clearly designed for serious, high-stakes services. ' .
                'The Ulixai team even checked in with me during my move to make sure everything was going smoothly. That level of care and professionalism throughout the platform made an incredibly stressful life event manageable.',
            'slug' => 'relocation-services-uae-olivia-chen-8',
            'is_featured' => true,
            'is_early_beta' => true
        ];
        
        return $reviews;
    }
    
    private function getUserReviews()
    {
        try {
            return ProviderReview::with(['user', 'provider', 'mission.category', 'mission.subcategory', 'mission.subcategory.subcategory'])
                ->whereNotNull('comment')
                ->whereHas('user', function($query) {
                    $query->whereNotNull('country')->whereNotNull('preferred_language')->whereNotNull('name');
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
                        'nationality' => $this->getNationalityName($countryCode),
                        'flag' => $this->getFlagEmoji($countryCode),
                        'country' => $this->getCountryName($destinationCountry),
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
            \Log::error('Error loading user reviews: ' . $e->getMessage());
            return [];
        }
    }
    
    private function getFlagEmoji($cc) {
        $f = ['FR'=>'🇫🇷','GB'=>'🇬🇧','US'=>'🇺🇸','DE'=>'🇩🇪','ES'=>'🇪🇸','IT'=>'🇮🇹','JP'=>'🇯🇵','CN'=>'🇨🇳','IN'=>'🇮🇳','BR'=>'🇧🇷','CA'=>'🇨🇦','AU'=>'🇦🇺','MX'=>'🇲🇽','NL'=>'🇳🇱','SE'=>'🇸🇪','NO'=>'🇳🇴','PT'=>'🇵🇹','CH'=>'🇨🇭','AE'=>'🇦🇪','SA'=>'🇸🇦','NG'=>'🇳🇬','RU'=>'🇷🇺','NZ'=>'🇳🇿','SG'=>'🇸🇬','TH'=>'🇹🇭','IE'=>'🇮🇪','PL'=>'🇵🇱','TR'=>'🇹🇷','KR'=>'🇰🇷','ZA'=>'🇿🇦','AR'=>'🇦🇷','CL'=>'🇨🇱'];
        return $f[$cc] ?? '🌍';
    }
    
    private function getNationalityName($cc) {
        $n = ['FR'=>'French','GB'=>'British','US'=>'American','DE'=>'German','ES'=>'Spanish','IT'=>'Italian','JP'=>'Japanese','CN'=>'Chinese','IN'=>'Indian','MX'=>'Mexican','NL'=>'Dutch','SE'=>'Swedish','NO'=>'Norwegian','PT'=>'Portuguese','AE'=>'Emirati','BR'=>'Brazilian','CA'=>'Canadian','AU'=>'Australian','RU'=>'Russian','SA'=>'Saudi','NG'=>'Nigerian','NZ'=>'New Zealander','SG'=>'Singaporean','TH'=>'Thai','IE'=>'Irish','CH'=>'Swiss','PL'=>'Polish'];
        return $n[$cc] ?? 'International';
    }
    
    private function getCountryName($cc) {
        $c = ['FR'=>'France','GB'=>'United Kingdom','US'=>'United States','DE'=>'Germany','ES'=>'Spain','IT'=>'Italy','JP'=>'Japan','CN'=>'China','AU'=>'Australia','CA'=>'Canada','TH'=>'Thailand','SG'=>'Singapore','NZ'=>'New Zealand','CH'=>'Switzerland','AE'=>'UAE','NL'=>'Netherlands','PT'=>'Portugal','NO'=>'Norway','SE'=>'Sweden','MX'=>'Mexico','BR'=>'Brazil','IN'=>'India','RU'=>'Russia','SA'=>'Saudi Arabia'];
        return $c[strtoupper($cc)] ?? $cc;
    }

    public function index(Request $request)
    {
        $featuredReviews = $this->getFeaturedReviews();
        $userReviews = $this->getUserReviews();
        $allReviews = array_merge($featuredReviews, $userReviews);
        usort($allReviews, function($a, $b) { return strtotime($b['date']) - strtotime($a['date']); });
        
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

    public function show($slug)
    {
        $featuredReviews = $this->getFeaturedReviews();
        $userReviews = $this->getUserReviews();
        $allReviews = array_merge($featuredReviews, $userReviews);
        $review = collect($allReviews)->firstWhere('slug', $slug);
        if (!$review) abort(404);
        return view('pages.review-single', ['review' => $review]);
    }
}