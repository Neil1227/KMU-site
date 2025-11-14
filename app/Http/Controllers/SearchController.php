<?php

namespace App\Http\Controllers;

use App\Models\Ictv;
use App\Models\IECMaterial;
use App\Models\Module;
use App\Models\Newsletter;
use App\Models\Podcast;
use App\Models\PromotionalActivity;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
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
        Pampanga State Agricultural University supports Goal 3, which is Good Health and Well-being, by promoting nutritious food through sustainable agriculture, offering health and wellness programs on campus, conducting research on food safety and public health, and participating in community outreach that enhances the general health of nearby communities.
        Furthermore, PSAU promotes innovation by developing research-based solutions to health issues in rural communities and agriculture. The institution helps to improve nutrition and prevent disease by developing organic farming, climate-resilient crops, herbal medicine, and food technology. These developments empower communities with sustainable practices that enhance their overall well-being, in addition to promoting healthier lifestyles. 
        ',
                'url' => url('/sdgs/#sdg3'),
            ],
            [
                'title' => 'SDG 4 – Quality Education',
                'content' => '
        Through its inclusive, high-quality, and readily available education, Pampanga State Agricultural University (PSAU) contributes to Sustainable Development Goal 4: Quality Education by giving students the values, knowledge, and abilities necessary to sustainable development. As an educational institution, PSAU offers a range of academic programs in science, education, agriculture, and related fields that meet the standards of both local and global development. It ensures that education, particularly in rural and agricultural regions, is both highly educated and attentive to current events.
        PSAU also promoted lifelong learning and community education through its training programs, extension activities, and research dissemination. By providing farmers, local authorities, and underrepresented groups with access to state-of-the-art knowledge, technology, and sustainable practices, these initiatives empower people. PSAU makes significant contributions to the advancement of high-quality education and the formation of future-ready individuals dedicated to both national and international development by incorporating innovation, diversity, and social responsibility into its outreach, research, and teaching. 
        ',
                'url' => url('/sdgs/#sdg4'),
            ],
            [
                'title' => 'SDG 5 – Quality Education',
                'content' => '
        By advocating for real equal opportunities for all women in leadership, education, and community development, Pampanga State Agricultural University (PSAU) supports the achievement of Sustainable Development Goal 5: Gender Equality. The university maintains inclusive policies that provide equal access to leadership positions, professional growth, academic programs, and scholarships for men and women. PSAU incorporates gender sensitivity inti its research, curriculum, and extension services, offering training and seminars, and increasing awareness of gender issues through its Gender and Development (GAD) initiatives.
 Additionally, by providing them access to technology and supplies, livelihood opportunities, and skill training, PSAU strengthens women in rural communities and agriculture. These programs support women’s involvement in decision-making at the university and in the broader community by challenging conventional gender norms. PSAU actively promotes gender equality and helps to create a more just and equitable society by cultivating a culture of respect, inclusivity, and empowerment. 

        ',
                'url' => url('/sdgs/#sdg5'),
            ],
            [
                'title' => 'SDG 6 – Quality Education',
                'content' => '
        Through its academic, research, and extension initiatives, Pampanga State Agricultural University (PSAU) promotes the preservation of the environment, sustainable water management, and hygiene education in support of Sustainable Development Goal 6: Clean Water and Sanitation. To minimize water pollution and ensure the effective use of water resources, PSAU, an organization with a background in agricultural and environmental science, researches water conservation, rainwater collection, wastewater treatment, and environmentally friendly farming methods.
 Furthermore, PSAU promotes innovation by creating affordable, locally based technologies for waste-to-resource systems, irrigation efficiency, and water purification that help rural communities have access to clean water. The university presents science-based solutions that tackle practical issues in water quality and sanitation through collaborations with regional administrations and research organizations. PSAU is a key player in expanding access to clean water, encouraging sustainable sanitation, and creating communities that are resilient to climate change by fusing academic excellence with innovation and community involvement.

        ',
                'url' => url('/sdgs/#sdg6'),
            ],
            [
                'title' => 'SDG 7 – Quality Education',
                'content' => '
        Through innovation, research, and education, Pampanga State Agricultural University (PSAU) promotes the use of sustainable energy sources, helping to achieve Sustainable Development Goal 7: Affordable and Clean Energy. Along with its commitment to the preservation of the environment, PSAU incorporates concepts of renewable energy into its curriculum and carries out research on alternative energy sources, particularly those that are pertinent to rural and agricultural communities, like biomass, solar, and biofuels.
 PSAU provides information and technologies about energy efficiency and clean energy production to local communities through its extension programs. By fusing technological innovation, community engagement, and scholarly expertise, PSAU actively promotes accessible, clean energy for a more sustainable future. 

        ',
                'url' => url('/sdgs/#sdg7'),
            ],
            [
                'title' => 'SDG 8 – Quality Education',
                'content' => '
        Through the provision of opportunities, knowledge, and skills necessary for productive employment and sustainable livelihoods, Pampanga State Agricultural University (PSAU) supports Sustainable Development Goal 8: Decent Work and Economic Growth. Graduates of PSAU’s academic programs in technology, entrepreneurship, agribusiness, and agriculture are equipped to be innovative, competitive professionals and job creators in both domestic and international markets.
 Additionally, the university promotes innovation and entrepreneurship by funding livelihood training, research- based startups, and the incubation of agribusiness ideas, particularly among young people and rural communities. Through the development of technical skills, financial literacy, and enterprise support, its extension programs help farmers, women, and marginalized groups raise their incomes and enhance their quality of life.
 Internally, PSAU supports equitable opportunities for all workers, a safe workplace, and fair labor practices. In the region and beyond, PSAU actively supports the creation of decent work opportunities and sustainable economic growth by fusing education, innovation, and inclusive economic empowerment. 

        ',
                'url' => url('/sdgs/#sdg8'),
            ],
            [
                'title' => 'SDG 9 – Quality Education',
                'content' => '
        Pampanga State Agricultural University (PSAU) supports a culture of research, technological advancement, and rural development through education and community engagement, all of which contributed to Sustainable Development Goal 9: Industry, Innovation, and Infrastructure. As an institution founded on science and agriculture, PSAU promotes innovation in fields like environmental engineering, food processing, agri-industrial development, and sustainable farming technologies, thereby assisting the expansion of resilient, modern industries in rural regions.
 To foster innovation and the creation of new technologies, the university makes investments in labs, experimental farms, and research facilities. These resources help close the knowledge gap between academia and industry by fostering faculty research, student learning, and joint projects with the public and private sectors.
Through its extension programs, PSAU also improves rural infrastructure by providing local farmers and microenterprises with technical support and capacity-building in areas like post-harvest processing, irrigation, and farm mechanization. PSAU is essential to creating equitable and sustainable industrial growth, especially in communities reliant on agriculture, by fusing innovation, infrastructure development, and industry partnerships. 

        ',
                'url' => url('/sdgs/#sdg9'),
            ],
            [
                'title' => 'SDG 10 – Quality Education',
                'content' => '
        Pampanga State Agricultural University (PSAU) advocates for inclusive education, equal opportunities, and community empowerment, particularly for underprivileged and marginalized groups, to support Sustainable Development Goal 10: Reduced Inequalities. The university makes sure that students from a range of socioeconomic backgrounds, including those from rural and indigenous communities, have access to high-quality education, scholarships, and training programs.
 Through its outreach and extension initiatives, PSAU actively seeks to lessen disparities in rural communities by giving women, small-scale farmers, and underprivileged groups access to agricultural innovations, livelihood training, and technical assistance. These programs support social inclusion, raise income opportunities, and enhance quality of life.
 To further guarantee that no one is left behind, PSAU incorporates cultural sensitivity, disability awareness, and gender equality into its policies and initiatives. Both on campus and in the larger community, PSAU helps to close social and economic divides by promoting an atmosphere of fairness, empowerment, and community involvement. 

        ',
                'url' => url('/sdgs/#sdg10'),
            ],
            //         [
            //     'title' => 'SDG 11 – Quality Education',
            //     'content' => '

            //     ',
            //     'url' => url('/sdgs/#sdg11'),
            // ],
            //         [
            //     'title' => 'SDG 12 – Quality Education',
            //     'content' => '

            //     ',
            //     'url' => url('/sdgs/#sdg12'),
            // ],
            //         [
            //     'title' => 'SDG 13 – Quality Education',
            //     'content' => '

            //     ',
            //     'url' => url('/sdgs/#sdg13'),
            // ],
            //         [
            //     'title' => 'SDG 14 – Quality Education',
            //     'content' => '

            //     ',
            //     'url' => url('/sdgs/#sdg14'),
            // ],
            //         [
            //     'title' => 'SDG 15 – Quality Education',
            //     'content' => '

            //     ',
            //     'url' => url('/sdgs/#sdg15'),
            // ],
            //         [
            //     'title' => 'SDG 16 – Quality Education',
            //     'content' => '

            //     ',
            //     'url' => url('/sdgs/#sdg16'),
            // ],
            //         [
            //     'title' => 'SDG 17 – Quality Education',
            //     'content' => '

            //     ',
            //     'url' => url('/sdgs/#sdg17'),
            // ],

        ];

        $results = collect($staticPages)
            ->filter(function ($page) use ($query) {
                return str_contains(strtolower($page['title'].' '.$page['content']), strtolower($query));
            })
            ->map(function ($page) use ($query) {
                $content = $page['content'];
                $lowerContent = strtolower($content);
                $lowerQuery = strtolower($query);
                $matchPos = strpos($lowerContent, $lowerQuery);

                if ($matchPos !== false) {
                    $start = max(0, $matchPos - 50);
                    $snippet = Str::limit(substr($content, $start, 100), 100, '...');
                } else {
                    $snippet = Str::limit($content, 100);
                }

                return [
                    'title' => $page['title'],
                    'snippet' => $snippet,
                    'url' => $page['url'].'?query='.urlencode($query),
                ];
            });

        // --- Database Results ---
        $ictvResults = Ictv::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get()
            ->map(fn ($item) => [
                'title' => $item->title,
                'snippet' => Str::limit($item->description, 100),
                'url' => url('/ictv/'.$item->id), // assuming detail page
            ]);

        $iecResults = IECMaterial::where('title', 'like', "%$query%")
            ->get()
            ->map(fn ($item) => [
                'title' => $item->title,
                'snippet' => Str::limit($item->description, 100),
                'url' => url('/iec/'.$item->id),
            ]);

        $promotionalResults = PromotionalActivity::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get()
            ->map(fn ($item) => [
                'title' => $item->title,
                'snippet' => Str::limit($item->description, 100),
                'url' => url('/promotional/'.$item->id),
            ]);

        $podcastResults = Podcast::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get()
            ->map(fn ($item) => [
                'title' => $item->title,
                'snippet' => Str::limit($item->description, 100),
                'url' => url('/podcast/'.$item->id),
            ]);

        $newsletterResults = Newsletter::where('title', 'like', "%$query%")
            ->get()
            ->map(fn ($item) => [
                'title' => $item->title,
                'snippet' => Str::limit($item->description, 100),
                'url' => url('/newsletter/'.$item->id),
            ]);

        $moduleResults = Module::where('title', 'like', "%$query%")
            ->get()
            ->map(fn ($item) => [
                'title' => $item->title,
                'snippet' => Str::limit($item->description, 100),
                'url' => url('/modules/'.$item->id),
            ]);

        $columns = Schema::getColumnListing('technologies');

        $technologyResults = Technology::query()
            ->where(function ($q) use ($columns, $query) {
                foreach ($columns as $column) {
                    $q->orWhereRaw("LOWER(`$column`) LIKE ?", ['%'.strtolower($query).'%']);
                }
            })
            ->get()
            ->map(fn ($item) => [
                'title' => $item->product,
                'snippet' => Str::limit($item->desc, 100),
                'url' => url('/technologies/'.$item->id),
            ]);

        // --- Merge all results ---
        $allResults = $results
            ->merge($ictvResults)
            ->merge($iecResults)
            ->merge($promotionalResults)
            ->merge($podcastResults)
            ->merge($moduleResults)
            ->merge($newsletterResults)
            ->merge($technologyResults);

        $totalResults = $allResults->count();

        return view('search-results', [
            'results' => $allResults,
            'totalResults' => $totalResults,
            'query' => $query,
        ]);
    }
}
