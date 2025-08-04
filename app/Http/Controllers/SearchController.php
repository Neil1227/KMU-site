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
        'url' => url('/#about'),
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
    })->map(function ($page) {
        return [
            'title' => $page['title'],
            'snippet' => Str::limit($page['content'], 100),
            'url' => $page['url'],
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
        ->orWhere('description', 'like', "%$query%")
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
