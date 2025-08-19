<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictv;
use App\Models\IECMaterial;
use App\Models\Newsletter;
use App\Models\Module;
use App\Models\PromotionalActivity;
use App\Models\Podcast;

use Illuminate\Support\Str;

class SearchController extends Controller
{
public function search(Request $request)
{
    $query = $request->input('query');

// Static Pages
$staticPages = [
    [
        'title' => 'Research | Agriculture',
        'content' => 'Agriculture refers to the cultivation of crops and the raising of animals to provide essential products such as food, fiber, and fuel. It plays a fundamental role in sustaining human life and the global economy. However, modern agriculture faces numerous challenges including climate change, soil degradation, water scarcity, and pest infestations.
    Current agricultural challenges include under-utilization of natural resources, crop mismanagement, and wasteful practices. The misuse of chemical fertilizers and pesticides also contributes to long-term ecological damage and health risks. Farmers need support to transition toward more sustainable and scientifically guided practices.',
        'url' => route('agriculture'),
    ],
    [
        'title' => 'Research | Aquaculture',
        'content' => 'Aquaculture is the farming of aquatic organisms, such as fish and plants in controlled environments like ponds, tanks, or ocean enclosures. It involves the cultivation of both freshwater and marine species for commercial purposes, typically for food production.

    The stocking ratio in aquaculture has become an important consideration due to the increasing demand for fish as food and for other purposes. As more people seek fish for consumption and various industries utilize aquatic species, the demand for aquaculture production has surged. This heightened demand has led to a rise in the price of commercial fish diets, as the cost of quality feed increases. Consequently, managing the stocking ratio effectively is crucial to ensure sustainable fish farming practices, balancing the need for optimal growth rates while minimizing feed costs and maximizing production efficiency.',
        'url' => route('aquaculture'),
    ],
    [
        'title' => 'Research | Livestock',
        'content' => 'It is important to think both practically and sustainably when it comes to livelihood. To help communities cope with changing weather patterns and ecosystem degradation, it needs to examine climate-resilient livelihoods, such as drought-resistant livestock practices and efficient animal health strategies.
    Additionally, to address gender-sensitive livelihood, such as strategies and policies that support women and other disadvantaged groups. Lastly, the role of social protection programs in improving security, especially during crises.',
        'url' => route('livestock'),
    ],
    [
        'title' => 'Research | Livelihood',
        'content' => 'Livelihood refers to the means or methods by which individuals or communities sustain themselves financially and support their basic needs, such as food, shelter, and clothing. It encompasses the activities, resources, and strategies people use to earn a living, whether through work, agriculture, trade, services, or other economic activities.
    Climate change is a widespread issue that significantly impacts ecosystems and biodiversity, leading to the disruption of natural habitats and altering species survival. Alongside this, climate-related disasters, such as floods, droughts, and storms, can devastate communities, destroying peoples economic, cultural, and social lives. These events worsen existing vulnerabilities and lead to increased poverty and food insecurity. The effectiveness of initiatives like the National Greening Program (NGP) is critical in addressing these challenges. By focusing on poverty reduction, food security, and environmental stability, NGP aims to mitigate the effects of climate change and promote sustainable development. However, its success in achieving these goals depends on effective implementation and coordination across various sectors.',
        'url' => route('livelihood'),
    ],    
    [
        'title' => 'Research | Biotechnology',
        'content' => 'Sour and Aglibut sweet tamarind are difficult to distinguish, especially when they are seedlings. At this early stage, both varieties appear quite similar, making it challenging to tell them apart. The differences between them become more apparent as they mature, with the sour tamarind exhibiting a more tangy flavor and the Aglibut sweet tamarind developing a milder, sweeter taste. However, in their seedling form, their characteristics are not yet fully developed, contributing to the confusion in identifying them.',
        'url' => route('biotechnology'),
    ],      
    [
        'title' => 'Research | Root Crops',
        'content' => 'The effect of different extracts on major mungbean diseases has been a subject of study, with various plant-based solutions showing potential in controlling these diseases. Additionally, the impact of different rates of plant growth promoters (PGP) on disease reactions, 
        insect pest infestations, and the yield potential of mungbean varieties has been observed, revealing that optimal PGP application can improve both plant health and productivity.
        Moringa water extract, known for its medicinal properties, 
        has also been explored for its potential benefits in crop management. Furthermore, the medicinal properties of invasive plants are being increasingly recognized, with some showing promise
        in treating various ailments, even as they continue to pose threats to agricultural systems.',
        'url' => route('root-crops'),
    ], 
    [
        'title' => 'Research | IOT',
        'content' => 'An automated irrigation system using a soil moisture sensor and Raspberry Pi was developed for real-time water monitoring. Faults are detected via an Arduino-based serial monitor to reduce downtime. A thematic map catalogs PSAU’s existing and potential water resources for better planning.
    Other systems enhance communication, safety, and resource management. A centralized app allows faculty to post announcements to students. A fire safety system displays sensor data and sends SMS alerts in emergencies. A Raspberry Pi-based system controls electrical switches manually or by schedule. An IoT door lock with intrusion detection was also created. Lastly, topographic and infrastructure maps of campus zones were generated.',
        'url' => route('iot'),
    ],     
    [
        'title' => 'Research | Others',
        'content' => 'Commercially available stoves for briquettes are often not suitable for the biomass briquettes produced at PSAU. Additionally, the COVID-19 pandemic had a significant impact on the ecotourism sector in the SPCW, leading to a decline in visitor numbers, disruption of local livelihoods, and a negative effect on environmental sustainability.The stove designed for biomass briquettes highlights the need for public-private partnerships and emphasizes the importance of continuous monitoring and evaluation to ensure the long-term sustainability of the SPCWs ecotourism sector. This collaborative approach is essential for maintaining the balance between economic development, environmental protection, and local community benefits.',
        'url' => route('others'),
    ],    

    [
        'title' => 'Media Resources | ICTV',
        'content' => 'ICTV',
        'url' => route('ictv'),
    ],  
    [
        'title' => 'Media Resources | IEC Materials',
        'content' => 'IEC Materials',
        'url' => route('iec'),
    ],  
    [
        'title' => 'Media Resources | Newsletter',
        'content' => 'Newsletters',
        'url' => route('newsletter'),
    ],  
    [
        'title' => 'Media Resources | Modules',
        'content' => 'Modules',
        'url' => route('modules'),
    ],  
    [
        'title' => 'Media Resources | Tech Portfolio',
        'content' => 'Technology Portfolio',
        'url' => route('tech-portfolio'),
    ],      

    
    [
        'title' => 'Plagiarism Check Roadmap | Submit via Form, QR, or Email',
        'content' => 'Fill out the Google form to request a PlagScan, scan the QR code, or email your paper to kmc@psau.edu.ph',
        'url' => route('contact'),
    ],
    [
        'title' => 'Plagiarism Check Roadmap | Wait for KMC Feedback',
        'content' => 'Expect an email from the Knowledge Management Center regarding the similarity index, status of your paper, and your overall score.',
        'url' => route('contact'),
    ],
        [
        'title' => 'Plagiarism Check Roadmap | Final Check: Approval or Editing',
        'content' => 'If the paper passes the criteria, you’ll be asked to pick up your anti-plagiarism certificate. Otherwise, you’ll receive feedback via email for revisions',
        'url' => route('contact'),
    ],
            [
        'title' => 'Plagiarism Check Roadmap | Final Step: Claim Your Certificate',
        'content' => 'Collect your certificate from the ICTRD office beside the CBEE building. Present your student ID or confirmation email upon claiming.',
        'url' => route('contact'),
    ],
    [
        'title' => 'About Us',
        'content' => 'The Knowledge Management (KM) unit operates to foster an environment where knowledge resources
            are acquired, promoted, and shared in alignment with quality assurance standards, supporting the continuous
            improvement and accessibility of the information it handles. By establishing a centralized framework,
            it creates space and best practices for knowledge sharing activities, making knowledge-based assets
            accessible to all.
            Kamp Maalam is an initiative of KMs knowledge-sharing activities. It seeks to modernize practices by leveraging available resources and expanding its reach to a broader audience. The ultimate goal is to foster a community where knowledge is shared, nurtured, and grows.',
        'url' => url('homepage#about'),
    ],
    [
        'title' => 'SDG 1 – No Poverty',
        'content' => '  Pampanga State Agricultural University (PSAU) stands at the forefront of driving sustainable development, deeply committed to addressing SDG 1: No Poverty through research-driven programs, community empowerment, and agricultural innovations.
                        One such study, conducted among local farmers, seeks to assess how well these programs fulfill their intended purpose. By gathering firsthand insights, PSAU identifies gaps, strengths, and areas for improvement, ensuring that interventions truly uplift farming communities.
                        Through its continuous commitment to innovation and community engagement, PSAU reinforces its mission of empowering farmers—helping them break free from the cycle of poverty while fostering a more food-secure and sustainable future for all.',
        'url' => url('/sdgs/#sdg1'),
    ],
    [
        'title' => 'SDG 2 – Zero Hunger',
        'content' => 'Pampanga State Agricultural University (PSAU) actively contributes to Sustainable Development Goal 2 (SDG 2): Zero Hunger, particularly by working toward the target of doubling agricultural productivity and increasing the incomes of small-scale food producers—including women, indigenous peoples, and family farmers.
      Utilizing the rich agricultural resources of the region, PSAU transforms various local commodities into value-added products that create sustainable livelihood opportunities for growers. This initiative empowers farmers to achieve financial independence by equipping them with innovative technologies that enhance farm productivity and profitability.
      In addition to livelihood support, PSAU conducts cutting-edge research to address pressing agricultural and aquaculture challenges. One such study explores the use of Balakat (Ziziphus talanai), an indigenous plant, as a natural molluscicide, providing farmers with a locally available, eco-friendly solution to pest infestations.
      To further its commitment to food security and nutrition, PSAU has also developed innovative food technologies using tamarind—a fruit abundant on campus. These include tamarind-based vinegar, wine, and even ice cream, showcasing the university’s dedication to sustainable agricultural transformation and entrepreneurship.
',
        'url' => url('/sdgs/#sdg2'),
    ],
    [
        'title' => 'SDG 3 – Good Health and Well-being',
        'content' => '
        Pampanga State Agricultural University (PSAU) stands at the forefront of driving sustainable development, deeply committed to addressing SDG 1: No Poverty through research-driven programs, community empowerment, and agricultural innovations. Guided by its mandate, PSAU continuously explores the effectiveness of its initiatives in tackling poverty, food insecurity, and environmental stability—paving the way for inclusive growth and lasting change.
        One such study, conducted among local farmers, seeks to assess how well these programs fulfill their intended purpose. By gathering firsthand insights, PSAU identifies gaps, strengths, and areas for improvement, ensuring that interventions truly uplift farming communities. The research highlights practical solutions that enhance agricultural productivity, promote sustainable livelihoods, and build resilience against economic and environmental challenges.
        Through its continuous commitment to innovation and community engagement, PSAU reinforces its mission of empowering farmers—helping them break free from the cycle of poverty while fostering a more food-secure and sustainable future for all.',
        'url' => url('/sdgs/#sdg3'),
    ],
    [
        'title' => 'SDG 4 – Quality Education',
        'content' => '
        Pampanga State Agricultural University (PSAU) stands at the forefront of driving sustainable development, deeply committed to addressing SDG 1: No Poverty through research-driven programs, community empowerment, and agricultural innovations. Guided by its mandate, PSAU continuously explores the effectiveness of its initiatives in tackling poverty, food insecurity, and environmental stability—paving the way for inclusive growth and lasting change.
        One such study, conducted among local farmers, seeks to assess how well these programs fulfill their intended purpose. By gathering firsthand insights, PSAU identifies gaps, strengths, and areas for improvement, ensuring that interventions truly uplift farming communities. The research highlights practical solutions that enhance agricultural productivity, promote sustainable livelihoods, and build resilience against economic and environmental challenges.
        Through its continuous commitment to innovation and community engagement, PSAU reinforces its mission of empowering farmers—helping them break free from the cycle of poverty while fostering a more food-secure and sustainable future for all.',
        'url' => url('/sdgs/#sdg4'),
    ],
    // add more here when sdgs5-17 is posted
];



    $results = collect($staticPages)->filter(function ($page) use ($query) {
        return str_contains(strtolower($page['title'] . ' ' . $page['content']), strtolower($query));
    })->map(function ($page) use ($query) {
        $content = $page['content'];
        $lowerContent = strtolower($content);
        $lowerQuery = strtolower($query);
        
        $matchPos = strpos($lowerContent, $lowerQuery);

        if ($matchPos !== false) {
            // Center snippet around match
            $start = max(0, $matchPos - 50);
            $snippet = Str::limit(substr($content, $start, 100), 100, '...');
        } else {
            // Fallback: first 100 chars
            $snippet = Str::limit($content, 100);
        }

        return [
            'title' => $page['title'],
            'snippet' => $snippet,
            'url' => $page['url'] . '?query=' . urlencode($query), // pass query to target
        ];
    });

    // Search in ICTV
    $ictvResults = Ictv::where('title', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->get()
        ->map(function ($item) {
            return [
                'title' => $item->title,
                'snippet' => Str::limit($item->description, 100),
                'url' => url('/ictv/'), // Adjust if you have a detail page
            ];
        });

    // Search in IEC
    $iecResults = IECMaterial::where('title', 'like', "%$query%")
        ->get()
        ->map(function ($item) {
            return [
                'title' => $item->title,
                'snippet' => Str::limit($item->description, 100),
                'url' => url('/iec/'),
            ];
        });


    // Search for promotional Activity
    $promotionalResults = PromotionalActivity::where('title', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->get()
        ->map(function ($item) {
            return [
                'title' => $item->title,
                'snippet' => Str::limit($item->description, 100),
                'url' => url('/promotional/'),
            ];
        });

    // Search for Podcast 
    $podcastResults = Podcast::where('title', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->get()
        ->map(function ($item) {
            return [
                'title' => $item->title,
                'snippet' => Str::limit($item->description, 100),
                'url' => url('/podcast/'),
            ];
        });
    // Search in Newsletters
    $newsletterResults = Newsletter::where('title', 'like', "%$query%")
        ->get()
        ->map(function ($item) {
            return [
                'title' => $item->title,
                'snippet' => Str::limit($item->description, 100),
                'url' => url('/newsletter/'),
            ];
        });
    // Search for Modules 
    $moduleResults = Module::where('title', 'like', "%$query%")
    ->get()
    ->map(function ($item) {
        return [
            'title' => $item->title,
            'snippet' => Str::limit($item->description, 100),
            'url' => url('/modules/'),
        ];
    });
    // Combine all results
    $allResults = $results
        ->merge($ictvResults)
        ->merge($iecResults)
        ->merge($promotionalResults)
        ->merge($podcastResults)
        ->merge($moduleResults)
        ->merge($newsletterResults);

    return view('search-results', ['results' => $allResults]);
}


}
