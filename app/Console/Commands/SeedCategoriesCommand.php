<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedCategoriesCommand extends Command
{
    protected $signature = 'categories:seed';
    protected $description = 'Seed the categories table with hierarchical data';

    public function handle()
    {
        $this->info('Starting categories seeding...');
        
        // Clear existing categories
        DB::table('categories')->truncate();
        
        $categories = $this->getCategoriesData();
        
        foreach ($categories as $mainCategory) {
            // Insert main category
            $mainCategoryId = DB::table('categories')->insertGetId([
                'name' => $mainCategory['name'],
                'parent_id' => null,
                'level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $this->info("Added main category: {$mainCategory['name']}");
            
            // Insert sub categories
            if (isset($mainCategory['sub_categories'])) {
                foreach ($mainCategory['sub_categories'] as $subCategory) {
                    $subCategoryId = DB::table('categories')->insertGetId([
                        'name' => $subCategory['name'],
                        'parent_id' => $mainCategoryId,
                        'level' => 2,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    
                    $this->line("  Added sub category: {$subCategory['name']}");
                    
                    // Insert sub-sub categories
                    if (isset($subCategory['sub_sub_categories'])) {
                        foreach ($subCategory['sub_sub_categories'] as $subSubCategory) {
                            DB::table('categories')->insert([
                                'name' => $subSubCategory,
                                'parent_id' => $subCategoryId,
                                'level' => 3,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                            
                            $this->line("    Added sub-sub category: {$subSubCategory}");
                        }
                    }
                }
            }
        }
        
        $this->info('Categories seeding completed successfully!');
    }
    
    private function getCategoriesData()
    {
        return [
            [
                'name' => 'Papers & Legal',
                'sub_categories' => [
                    [
                        'name' => 'Visas & Stay',
                        'sub_sub_categories' => [
                            'Prepare a visa application or renewal file',
                            'Collect and translate support document for visas',
                            'Be accompanied to an appointment for a visa or residence permit',
                            'Obtain a family medical, humanitarian or retirement visa',
                            'Correct or reread a refused file (visa approval)',
                            'Other visa related issues'
                        ]
                    ],
                    [
                        'name' => 'Nationality & Citizenship',
                        'sub_sub_categories' => [
                            'Prepare a Nationality application file',
                            'Translate the document required for the naturalization',
                            'Be accompanied to the citizenship interview',
                            'Apply for dual Nationality (file + follow up)',
                            'Other missions related to citizenship'
                        ]
                    ],
                    [
                        'name' => 'Official Acts & Documents',
                        'sub_sub_categories' => [
                            'Apply for or renew a passport or local identity card',
                            'Obtain a birth, marriage or death certificate',
                            'Report a loss or theft of papers',
                            'Request a legalization, apostille or certificate of residence',
                            'Transcribe a foreign document in the host country',
                            'Officially translate a personal or civil document',
                            'Retrieve or send an official document remotely',
                            'Other mission related to an official document'
                        ]
                    ],
                    [
                        'name' => 'Driving License & Mobility Document',
                        'sub_sub_categories' => [
                            'Convert a foreign driving license',
                            'Obtain a local or international license',
                            'Translate and validate a driving license',
                            'Make an appointment and accompany for a medical examination',
                            'Other mission related to the driving license'
                        ]
                    ],
                    [
                        'name' => 'Taxation & Retirement',
                        'sub_sub_categories' => [
                            'Declaring your taxes in the host country',
                            'Obtain a tax number or register',
                            'Correct or contest a tax situation',
                            'Apply for or transfer a pension abroad',
                            'Receive help with my contributions, statements or change of circumstances',
                            'Other mission related to taxation or retirement'
                        ]
                    ],
                    [
                        'name' => 'Administrative Assistance & Support',
                        'sub_sub_categories' => [
                            'Complete a complex administrative file',
                            'Check a file before submission',
                            'Make an appointment online or by phone',
                            'Be accompanied during an administrative meeting',
                            'Managing procedures for a loved one or a child',
                            'Other administrative assistance mission'
                        ]
                    ],
                    [
                        'name' => 'Diplomas & Equivalence',
                        'sub_sub_categories' => [
                            'Translate a diploma or transcript',
                            'Obtain academic or professional equivalence',
                            'Validate acquired skills or competencies in the country',
                            'Create a complete file for diploma recognition',
                            'Other mission linked to a diploma or equivalent'
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Housing & Daily Life',
                'sub_categories' => [
                    [
                        'name' => 'Find Accommodation',
                        'sub_sub_categories' => [
                            'Search for accommodation to rent according to my criteria',
                            'Find a shared room or shared apartment',
                            'Identify temporary accommodation (Airbnb, short term)',
                            'Visit a property for me and send me a report',
                            'Manage the search for accommodation for a family or a couple',
                            'Check or translate a lease before signing',
                            'Negotiate a rental contract with the landlord',
                            'Finding accommodation without a guarantor',
                            'Other mission related to the search for accommodation'
                        ]
                    ],
                    [
                        'name' => 'Entering a Home',
                        'sub_sub_categories' => [
                            'Organize an entry inventory',
                            'Activate services (electricity, gas, water, internet)',
                            'Take out home insurance',
                            'Translate or verify a rental contract',
                            'Have furniture or household appliances delivered and installed',
                            'Other mission related to the installation'
                        ]
                    ],
                    [
                        'name' => 'Daily Life & Home Services',
                        'sub_sub_categories' => [
                            'Call in a professional for repairs',
                            'Find occasional or regular housekeeping',
                            'Organize a major cleaning before or after moving in',
                            'Assemble, fix or move furniture',
                            'Get an ironing or laundry service',
                            'Book a home cook or meal helper',
                            'Find a caretaker for a prolonged absence',
                            'Having an animal looked after at home or elsewhere',
                            'Receive regular shopping or deliveries',
                            'Get help for small jobs (DIY, decorating)',
                            'Other mission related to daily life'
                        ]
                    ],
                    [
                        'name' => 'Leaving a Home',
                        'sub_sub_categories' => [
                            'Organize an exit inventory',
                            'Planning a local or international move',
                            'Cancel subscriptions (internet, water, etc.)',
                            'Clean the accommodation before departure',
                            'Contest a deduction from the deposit (file assistance)',
                            'Other mission related to leaving accommodation'
                        ]
                    ],
                    [
                        'name' => 'Works & Renovations',
                        'sub_sub_categories' => [
                            'Find a skilled craftsman or worker',
                            'Carry out painting, plumbing, electrical work',
                            'Renovate a room or the entire home',
                            'Have an urgent repair carried out',
                            'Coordinate several service providers for a project',
                            'Get a translated and verified quote',
                            'Other mission related to the works'
                        ]
                    ],
                    [
                        'name' => 'Student Accommodation',
                        'sub_sub_categories' => [
                            'Search for university accommodation',
                            'Find a student shared apartment',
                            'Book temporary student accommodation',
                            'Get student housing assistance',
                            'Check a student lease and its clauses',
                            'Find a guarantor or suitable insurance',
                            'Help with installation or moving',
                            'Other mission related to student housing'
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Work & Project',
                'sub_categories' => [
                    [
                        'name' => 'Find a Job',
                        'sub_sub_categories' => [
                            'Write a CV adapted to local standards',
                            'Translate a CV and cover letter',
                            'Adapt my profile to the expectations of the local market',
                            'Search for offers matching my profile',
                            'Apply for targeted offers on my behalf',
                            'Preparing for a job interview',
                            'Check an employment contract before signing',
                            'Other mission related to job search'
                        ]
                    ],
                    [
                        'name' => 'Working Freelance / Remotely',
                        'sub_sub_categories' => [
                            'Create or optimize a profile on a freelance platform',
                            'Write and translate my service offers',
                            'Register as a self-employed or independent contractor',
                            'Find local or foreign clients',
                            'Establish an invoice that complies with the country',
                            'Manage accounting or reporting obligations',
                            'Other mission related to freelance activity'
                        ]
                    ],
                    [
                        'name' => 'Create a Business or Project',
                        'sub_sub_categories' => [
                            'Write a business plan adapted to the country',
                            'Create a local business (SARL, micro, etc.)',
                            'Manage creation formalities (statutes, Kbis, etc.)',
                            'Translate statutes or legal documents',
                            'Find a local accountant or tax advisor',
                            'Look for local partners or supporters',
                            'Other mission related to business creation'
                        ]
                    ],
                    [
                        'name' => 'Work Legally',
                        'sub_sub_categories' => [
                            'Obtain a work permit or authorization',
                            'Prepare a work permit application file',
                            'Renew an expired work permit',
                            'Have my diplomas recognized for work',
                            'Find a labor lawyer',
                            'Other mission related to the right to work'
                        ]
                    ],
                    [
                        'name' => 'Defending Your Professional Rights',
                        'sub_sub_categories' => [
                            'Contest a dismissal or unfair termination',
                            'Obtain unpaid wages or compensation',
                            'Managing a conflict with an employer',
                            'Request mediation or legal assistance',
                            'Be accompanied during a procedure or hearing',
                            'Other mission related to professional defense'
                        ]
                    ],
                    [
                        'name' => 'Driving License',
                        'sub_sub_categories' => [
                            'Prepare a file to pass the local permit',
                            'Convert a foreign driving license',
                            'Renew a local license',
                            'Obtain an international license',
                            'Translate a driver\'s license for the authorities',
                            'Be accompanied to the appointment or the driving test',
                            'Other mission related to the driving license'
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Mobility & Transport',
                'sub_categories' => [
                    [
                        'name' => 'Vehicle: Purchase, Sale, Registration',
                        'sub_sub_categories' => [
                            'Find a reliable used vehicle',
                            'Check a vehicle before purchase (photos, test, etc.)',
                            'Be supported to buy or sell a vehicle',
                            'Register a vehicle in my name',
                            'Modify or cancel a registration certificate',
                            'Declare a sale or export of a vehicle',
                            'Other mission related to the purchase or sale of a vehicle'
                        ]
                    ],
                    [
                        'name' => 'Insurance & Formalities',
                        'sub_sub_categories' => [
                            'Find suitable car or motorcycle insurance',
                            'Take out vehicle insurance',
                            'Report an accident or car claim',
                            'Pay a vignette, tax or local toll',
                            'Contest an insurance refusal or dispute',
                            'Other mission related to car insurance'
                        ]
                    ],
                    [
                        'name' => 'Maintenance & Troubleshooting',
                        'sub_sub_categories' => [
                            'Find a reliable garage nearby',
                            'Arrange for the repair of a broken-down vehicle',
                            'Have routine vehicle maintenance carried out',
                            'Changing a tire, a battery, headlights...',
                            'Organize emergency assistance (towing, breakdown assistance)',
                            'Other mission related to car maintenance'
                        ]
                    ],
                    [
                        'name' => 'Driver & Accompaniment',
                        'sub_sub_categories' => [
                            'Book a one-off or long-term driver',
                            'Organize the transport of a loved one (child, elder)',
                            'Find a bilingual companion for a trip',
                            'Book a driver for medical or professional appointments',
                            'Organize a transfer (airport, train station, border)',
                            'Other mission related to accompanied transport'
                        ]
                    ],
                    [
                        'name' => 'Public Transport',
                        'sub_sub_categories' => [
                            'Explain how local transport works',
                            'Help me get a transport card or pass',
                            'Being accompanied during my first trips',
                            'Get help with complex journeys (children, luggage, etc.)',
                            'Contest a fine or transport dispute',
                            'Other mission related to public transport'
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Children & Education',
                'sub_categories' => [
                    [
                        'name' => 'Higher Education',
                        'sub_sub_categories' => [
                            'Search for a university or college',
                            'Prepare a complete admissions file (CV, letter, diplomas)',
                            'Translate the necessary diplomas and transcripts',
                            'Obtaining a student visa (compiling the file)',
                            'Estimate the costs and available assistance',
                            'Support for an admission interview',
                            'Other mission related to higher education'
                        ]
                    ],
                    [
                        'name' => 'Local Schooling',
                        'sub_sub_categories' => [
                            'Identify a suitable local school (public or private)',
                            'Prepare and submit a school registration file',
                            'Translate school documents for registration',
                            'Be accompanied during an appointment at school',
                            'Help with the child\'s school integration',
                            'Other mission related to schooling'
                        ]
                    ],
                    [
                        'name' => 'International Schools',
                        'sub_sub_categories' => [
                            'Compare available international schools',
                            'Prepare an admission file for an international school',
                            'Organize a visit or an appointment at a school',
                            'Supporting the child during the first few days',
                            'Other mission related to international schools'
                        ]
                    ],
                    [
                        'name' => 'Nurseries & Childcare',
                        'sub_sub_categories' => [
                            'Find a suitable nursery or daycare center',
                            'Find a nanny or childminder',
                            'Managing the formalities for hiring a nanny',
                            'Check a nanny\'s references',
                            'Organize a childcare schedule',
                            'Other childcare-related mission'
                        ]
                    ],
                    [
                        'name' => 'Academic Support',
                        'sub_sub_categories' => [
                            'Find a suitable private tutor',
                            'Organize classes at home or online',
                            'Helping the child learn the local language',
                            'Track academic progress remotely',
                            'Other academic support mission'
                        ]
                    ],
                    [
                        'name' => 'Extracurricular Activities',
                        'sub_sub_categories' => [
                            'Identify nearby sporting or cultural activities',
                            'Enroll the child in an extracurricular activity',
                            'Organize trips for activities',
                            'Find a bilingual supervisor for an activity',
                            'Manage registration papers and forms',
                            'Other mission related to extracurricular activities'
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Health & Well-being',
                'sub_categories' => [
                    [
                        'name' => 'Insurance & Health Procedures',
                        'sub_sub_categories' => [
                            'Compare and choose suitable health insurance',
                            'Register with local social security',
                            'Renew or terminate a health insurance contract',
                            'Obtain a health certificate or card',
                            'Request a reimbursement for care',
                            'Obtain an advance or care coverage',
                            'Translate medical documents',
                            'Managing health documents for a loved one (minor, elderly)',
                            'Other mission related to insurance or health procedures'
                        ]
                    ],
                    [
                        'name' => 'Access to Care',
                        'sub_sub_categories' => [
                            'Find a trusted doctor or specialist',
                            'Get a medical appointment quickly',
                            'Be accompanied to a medical consultation',
                            'Fill out medical forms',
                            'Organize medical or paramedical monitoring',
                            'Schedule a complete health checkup',
                            'Organizing care abroad',
                            'Other mission related to access to care'
                        ]
                    ],
                    [
                        'name' => 'Medical Emergencies',
                        'sub_sub_categories' => [
                            'Be accompanied to the emergency room or a hospital',
                            'Getting psychological support after an emergency',
                            'Arrange emergency (non-life-threatening) medical transport',
                            'Prepare a reimbursement file after an incident',
                            'Contact a medical center or emergency doctor for me',
                            'Other mission related to urgent medical situations'
                        ]
                    ],
                    [
                        'name' => 'Mental Health & Psychological Support',
                        'sub_sub_categories' => [
                            'Make an appointment with a psychologist or therapist',
                            'Organize regular consultations',
                            'Find a psychologist for children or adolescents',
                            'Join a suitable support group',
                            'Organize long-term therapeutic monitoring',
                            'Getting support for grief or separation',
                            'Other mission related to mental health'
                        ]
                    ],
                    [
                        'name' => 'Maternity & Birth',
                        'sub_sub_categories' => [
                            'Register at a local maternity hospital',
                            'Planning pregnancy exams',
                            'Translate a pregnancy file',
                            'Find a local midwife',
                            'Organize postpartum care',
                            'Managing the procedures after a birth',
                            'Help with breastfeeding or baby nutrition',
                            'Other mission related to maternity'
                        ]
                    ],
                    [
                        'name' => 'Well-being & Alternative Care',
                        'sub_sub_categories' => [
                            'Book a massage or wellness treatment',
                            'Find a personal or sports coach',
                            'Follow a suitable wellness program',
                            'Find a healthy activity: yoga, meditation, etc.',
                            'Book a practitioner in osteopathy, acupuncture, naturopathy',
                            'Find a suitable gym',
                            'Make an appointment with a local nutritionist',
                            'Follow a diet adapted to my condition',
                            'Book a cook for healthy meals',
                            'Be supported in a dietary program',
                            'Translate a meal plan or prescription',
                            'Get help with diabetes, deficiencies...',
                            'Other mission related to nutrition',
                            'Another wellness mission'
                        ]
                    ],
                    [
                        'name' => 'Children & Elderly',
                        'sub_sub_categories' => [
                            'Make an appointment with a local pediatrician',
                            'Organizing home care for an elderly person',
                            'Follow mandatory vaccinations',
                            'Being accompanied to the hospital',
                            'Translate and explain a prescription',
                            'Find a specialist: autism, disability, etc.',
                            'Other mission related to child/elder care'
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Integration & Social Life',
                'sub_categories' => [
                    [
                        'name' => 'Language & Communication',
                        'sub_sub_categories' => [
                            'Book a local language course (online or in person)',
                            'Find a teacher for an intensive course',
                            'Organize language tandem sessions',
                            'Translate a personal or professional document',
                            'Get help understanding messages (letters, text messages, official documents)',
                            'Prepare for a language exam (DELE, IELTS, etc.)',
                            'Organize conversation practice sessions',
                            'Other language-related mission'
                        ]
                    ],
                    [
                        'name' => 'Student Life & Integration',
                        'sub_sub_categories' => [
                            'Be connected with a local student community',
                            'Organize a sponsorship (buddy system)',
                            'Register for student activities (clubs, events, etc.)',
                            'Be accompanied to my first classes or student meetings',
                            'Find a roommate or partner who speaks my language',
                            'Being supported in case of isolation or discomfort',
                            'Understanding local traditions or social code',
                            'Other student integration mission'
                        ]
                    ],
                    [
                        'name' => 'Activities & Local Culture',
                        'sub_sub_categories' => [
                            'Book a cultural or discovery tour with a local guide',
                            'Be accompanied to cultural or sporting events',
                            'Join a local association (sports, cooking, art, etc.)',
                            'Participate in group activities with locals',
                            'Tour an iconic neighborhood with a local',
                            'Discover local festivals and traditions',
                            'Other cultural or social mission'
                        ]
                    ],
                    [
                        'name' => 'Create Social Bonds',
                        'sub_sub_categories' => [
                            'Be connected with other expats in my city',
                            'Participate in friendly gatherings (aperitifs, coffees, etc.)',
                            'Get tips to break the loneliness',
                            'Being accompanied to go out or meet people',
                            'Find a friendly and social shared accommodation',
                            'Other mission related to social integration'
                        ]
                    ],
                    [
                        'name' => 'Meetings & Love Life',
                        'sub_sub_categories' => [
                            'Get help creating or translating a dating profile',
                            'Get advice on the country\'s love codes',
                            'Be coached to gain confidence or seduce',
                            'Organize a targeted meeting (event, matchmaking)',
                            'Be accompanied to a first meeting (security, language)',
                            'Having support in an intercultural relationship',
                            'Other mission related to emotional life'
                        ]
                    ],
                    [
                        'name' => 'Commitment & Volunteering',
                        'sub_sub_categories' => [
                            'Find an association to get involved in',
                            'Offer my skills to a local cause',
                            'Join a solidarity project with other expatriates',
                            'Organize a personal volunteer action',
                            'Other mission related to voluntary commitment'
                        ]
                    ],
                    [
                        'name' => 'Spirituality & Moral Support',
                        'sub_sub_categories' => [
                            'Finding a place of worship suited to my practice',
                            'Join an open spiritual community',
                            'To be accompanied to a ceremony or ritual',
                            'Find a prayer or meditation group',
                            'Receiving moral support in difficult times',
                            'Participate in interfaith meetings',
                            'Another mission related to spirituality'
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Money & Financial Emergencies',
                'sub_categories' => [
                    [
                        'name' => 'Bank Account & Payment Methods',
                        'sub_sub_categories' => [
                            'Find a bank suited to my profile (expatriate, non-resident, etc.)',
                            'Get help opening a bank account',
                            'Help opening an online account (neobanks, local apps)',
                            'Understand the types of accounts available (current, savings, etc.)',
                            'Translate bank receipts',
                            'Resolve an account block or refusal to open',
                            'Other mission related to opening or managing an account'
                        ]
                    ],
                    [
                        'name' => 'International Transfers & Wire Transfers',
                        'sub_sub_categories' => [
                            'Compare the best money transfer solutions (Wise, Revolut, banks, etc.)',
                            'Get help making a transfer or wire transfer',
                            'Dispute an error or blocked transfer',
                            'Get advice on hidden transfer fees',
                            'Organize a transfer for a loved one without an account',
                            'Other mission related to international transfers'
                        ]
                    ],
                    [
                        'name' => 'Taxes & Taxation',
                        'sub_sub_categories' => [
                            'Understanding local tax obligations',
                            'Get help completing a tax return',
                            'Translate a tax notice or form',
                            'Contact the local tax office for me',
                            'Obtain a tax certificate or attestation',
                            'Resolve a tax dispute or fine',
                            'Other tax-related mission'
                        ]
                    ],
                    [
                        'name' => 'Social Assistance and Benefits',
                        'sub_sub_categories' => [
                            'Identify available assistance or rights (housing, health, parenting, etc.)',
                            'Help with preparing an aid application file',
                            'Monitoring of a current or refused file',
                            'Be accompanied to an appointment with a social administration',
                            'Translate a file or an administrative response',
                            'Contact a social service on my behalf',
                            'Other mission related to aid or allowances'
                        ]
                    ],
                    [
                        'name' => 'Jobs & Extra Income',
                        'sub_sub_categories' => [
                            'Get help finding a local job (delivery, babysitting, etc.)',
                            'Optimize my profile for a freelance platform',
                            'Get a translation or improvement of my CV',
                            'Find missions compatible with my visa',
                            'Be accompanied to a local interview',
                            'Other mission related to the search for local income'
                        ]
                    ],
                    [
                        'name' => 'Budget & Financial Emergencies',
                        'sub_sub_categories' => [
                            'Get help organizing my budget in the country',
                            'Understanding local prices and cost of living',
                            'Be put in touch with an emergency aid association',
                            'Translate or complete an exceptional aid application file',
                            'Contact a local solidarity structure (shelter, food aid, etc.)',
                            'Other mission related to the financial emergency'
                        ]
                    ],
                    [
                        'name' => 'Financial Management in the Home Country',
                        'sub_sub_categories' => [
                            'Get help understanding my tax obligations in my home country',
                            'Obtain assistance to regularize a debt or unpaid amount remaining in France',
                            'Be put in touch with a lawyer or tax advisor in my country',
                            'Follow up an administrative or banking file remotely',
                            'Other financial mission related to my country of origin'
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Procedures & Official Documents',
                'sub_categories' => [
                    [
                        'name' => 'Identity Documents',
                        'sub_sub_categories' => [
                            'Get help applying for a passport or identity card',
                            'Translate or certify a birth certificate, marriage certificate, etc.',
                            'Be accompanied to an administration to collect a document',
                            'Contact a consulate or embassy for me',
                            'Apply for renewal or duplicate',
                            'Prepare a power of attorney or document legalization',
                            'Other mission related to identity documents'
                        ]
                    ],
                    [
                        'name' => 'Marriage & Union',
                        'sub_sub_categories' => [
                            'Get help organizing a local civil or religious wedding',
                            'Translate or have a foreign marriage certificate recognized',
                            'Prepare a binational marriage file',
                            'Be accompanied for the banns publication appointments',
                            'Understanding the legal differences between PACS / marriage / common-law union',
                            'Other mission related to marriage or union'
                        ]
                    ],
                    [
                        'name' => 'Birth & Parentage',
                        'sub_sub_categories' => [
                            'Declare a birth to the local civil registry office',
                            'Translate a birth certificate or family record book',
                            'Obtain a certificate of filiation or recognition',
                            'Organize double declaration in two countries',
                            'Other mission related to birth and parentage'
                        ]
                    ],
                    [
                        'name' => 'Residence & Home',
                        'sub_sub_categories' => [
                            'Request a certificate of residence or proof of domicile',
                            'Obtain proof of accommodation for official records',
                            'Managing a change of address with the administrations',
                            'Get help making a declaration of residence for a minor child',
                            'Translate proof of address',
                            'Other mission related to administrative residence'
                        ]
                    ],
                    [
                        'name' => 'Legalization & Apostille',
                        'sub_sub_categories' => [
                            'Have a document legalized so that it is recognized abroad',
                            'Prepare an apostille request or equivalent',
                            'Be helped to identify the competent authority',
                            'Follow up on a legalization or refusal file',
                            'Translate the relevant documents before legalization',
                            'Other mission related to the legalization of documents'
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Humanitarian Emergencies & Immediate Support',
                'sub_categories' => [
                    [
                        'name' => 'Death & Succession',
                        'sub_sub_categories' => [
                            'Reporting a death in a foreign country',
                            'Translate a death certificate or will',
                            'Get help repatriating a body or organizing a ceremony',
                            'Understanding succession in a binational context',
                            'Organize post-death procedures (bank, insurance, etc.)',
                            'Other mission related to a death or succession'
                        ]
                    ],
                    [
                        'name' => 'Justice & Notaries',
                        'sub_sub_categories' => [
                            'Find a local notary who speaks my language',
                            'Be accompanied during a notarial procedure',
                            'Translate or legalize a notarial deed',
                            'Have administrative support for a legal procedure',
                            'Contact a local lawyer for a specific situation',
                            'Other legal or notarial mission'
                        ]
                    ],
                    [
                        'name' => 'Local Transport',
                        'sub_sub_categories' => [
                            'Have a document or package collected in my home country',
                            'Get help settling a debt or legal proceedings in my country',
                            'Get help filing taxes or paying a tax in my country',
                            'Mandate a relative or service provider to carry out a procedure on my behalf',
                            'Translate or send an official document to my country',
                            'Another mission related to my country of origin',
                            'Book a trusted private driver or VTC',
                            'Find a service provider to drive a purchased or leased vehicle',
                            'Being accompanied for my first trips (scouting, translation, etc.)',
                            'Find the best local transport subscriptions (bus, metro, etc.)',
                            'Help getting a local transport card',
                            'Other mission related to daily transport'
                        ]
                    ],
                    [
                        'name' => 'Driving License & Documents',
                        'sub_sub_categories' => [
                            'Get help to exchange or have my driving license recognized',
                            'Be accompanied to the permit administration',
                            'Get an appointment to pass a local driving test',
                            'Translate my license or a driving school document',
                            'Help to have an international license recognized',
                            'Other mission related to driving documents'
                        ]
                    ],
                    [
                        'name' => 'Psychological and Social Support in Crisis',
                        'sub_sub_categories' => [
                            'Be accompanied to leave a dangerous area',
                            'Be temporarily housed in case of emergency',
                            'Translate an official alert or urgent instruction',
                            'Be put in touch with the embassy or consulate',
                            'Managing a Family Emergency Remotely',
                            'Other immediate humanitarian mission',
                            'Be connected with a mental health professional',
                            'Being listened to in distress (supportive listening)',
                            'Translate an urgent medical or legal procedure',
                            'Obtain post-traumatic support',
                            'Join a local or international crisis unit',
                            'Other crisis support mission'
                        ]
                    ],
                    [
                        'name' => 'Mobility Logistics',
                        'sub_sub_categories' => [
                            'Get help renting a vehicle (car, scooter, bike, etc.)',
                            'Get support when purchasing a used vehicle',
                            'Find a trusted long-term car rental',
                            'Check a rental or sales contract before signing',
                            'Get assistance with insurance and registration',
                            'Other mission related to individual mobility'
                        ]
                    ]
                ]
            ]
        ];
    }
}