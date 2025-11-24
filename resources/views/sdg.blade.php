@extends('layouts.app')

@section('title', 'KMU | Home')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/sdg.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
@endpush

{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.navbar')
@section('content')

    <div class="container mt-5">
        <h2 class="text-center mb-4 section-title" data-aos="fade-up">
            Sustainable Development Goals
            <hr class="hr">
        </h2>

        {{-- SDG 1 --}}
        <section class="content-section mb-3" id="sdg1">
            <div class="image-column">
                <img src="{{ asset('assets/img/sdgs/1.png') }}" alt="SDG" />
                <div class="gallery-btn">
                    <a href="{{ url('sdg-gallery/1') }}" class="view-gallery-link">View Gallery</a>
                </div>
            </div>

            <div class="text-column">
                <p>Pampanga State Agricultural University (PSAU) stands at the forefront of driving sustainable development,
                    deeply committed to addressing SDG 1: No Poverty through research-driven programs, community
                    empowerment, and agricultural innovations.</p>
                <p>One such study, conducted among local farmers, seeks to assess how well these programs fulfill their
                    intended purpose. By gathering firsthand insights, PSAU identifies gaps, strengths, and areas for
                    improvement, ensuring that interventions truly uplift farming communities.</p>
                <p>Through its continuous commitment to innovation and community engagement, PSAU reinforces its mission of
                    empowering farmers—helping them break free from the cycle of poverty while fostering a more food-secure
                    and sustainable future for all.</p>

            </div>

        </section>

        {{-- SDG 2 --}}
        <section class="content-section mb-3" id="sdg2">
            <div class="text-column">
                <p>Pampanga State Agricultural University (PSAU) actively contributes to Sustainable Development Goal 2 (SDG
                    2): Zero Hunger, particularly by working toward the target of doubling agricultural productivity and
                    increasing the incomes of small-scale food producers—including women, indigenous peoples, and family
                    farmers.</p>
                <p>Utilizing the rich agricultural resources of the region, PSAU transforms various local commodities into
                    value-added products that create sustainable livelihood opportunities for growers. This initiative
                    empowers farmers to achieve financial independence by equipping them with innovative technologies that
                    enhance farm productivity and profitability.</p>
                <p>In addition to livelihood support, PSAU conducts cutting-edge research to address pressing agricultural
                    and aquaculture challenges. One such study explores the use of Balakat (Ziziphus talanai), an indigenous
                    plant, as a natural molluscicide, providing farmers with a locally available, eco-friendly solution to
                    pest infestations.</p>
                <p>To further its commitment to food security and nutrition, PSAU has also developed innovative food
                    technologies using tamarind—a fruit abundant on campus. These include tamarind-based vinegar, wine, and
                    even ice cream, showcasing the university’s dedication to sustainable agricultural transformation and
                    entrepreneurship.</p>

            </div>
            <div class="image-column">
                <img src="{{ asset('assets/img/sdgs/2.png') }}" alt="SDG" />
                <div class="gallery-btn">
                    <a href="{{ url('sdg-gallery/1') }}" class="view-gallery-link">View Gallery</a>
                </div>
            </div>
        </section>

        <section class="content-section mb-3" id="sdg3">
            <div class="image-column">
                <img src="{{ asset('assets/img/sdgs/3.png') }}" alt="SDG 3" />
                <div class="gallery-btn">
                    <a href="{{ url('sdg-gallery/1') }}" class="view-gallery-link">View Gallery</a>
                </div>
            </div>
            <div class="text-column">
                <p>
                    Pampanga State Agricultural University supports Goal 3, which is Good Health and Well-being, by
                    promoting nutritious food through sustainable agriculture, offering health and wellness programs on
                    campus, conducting research on food safety and public health, and participating in community outreach
                    that enhances the general health of nearby communities.
                </p>
                <p>
                    Furthermore, PSAU promotes innovation by developing research-based solutions to health issues in rural
                    communities and agriculture. The institution helps to improve nutrition and prevent disease by
                    developing organic farming, climate-resilient crops, herbal medicine, and food technology. These
                    developments empower communities with sustainable practices that enhance their overall well-being, in
                    addition to promoting healthier lifestyles.
                </p>
            </div>
        </section>

        <section class="content-section mb-3" id="sdg4">
            <div class="text-column">
                <p>
                    Through its inclusive, high-quality, and readily available education, Pampanga State Agricultural
                    University (PSAU) contributes to Sustainable Development Goal 4: Quality Education by giving students
                    the values, knowledge, and abilities necessary to sustainable development. As an educational
                    institution, PSAU offers a range of academic programs in science, education, agriculture, and related
                    fields that meet the standards of both local and global development. It ensures that education,
                    particularly in rural and agricultural regions, is both highly educated and attentive to current events.
                </p>
                PSAU also promoted lifelong learning and community education through its training programs, extension
                activities, and research dissemination. By providing farmers, local authorities, and underrepresented groups
                with access to state-of-the-art knowledge, technology, and sustainable practices, these initiatives empower
                people. PSAU makes significant contributions to the advancement of high-quality education and the formation
                of future-ready individuals dedicated to both national and international development by incorporating
                innovation, diversity, and social responsibility into its outreach, research, and teaching.
                </p>
                </p>
            </div>
            <div class="image-column">
                <img src="{{ asset('assets/img/sdgs/4.png') }}" alt="SDG 4" />
                <div class="gallery-btn">
                    <a href="{{ url('sdg-gallery/1') }}" class="view-gallery-link">View Gallery</a>
                </div>
            </div>
        </section>
        <section class="content-section mb-3" id="sdg5">
            <div class="image-column">
                <img src="{{ asset('assets/img/sdgs/5.png') }}" alt="SDG 5" />
                <div class="gallery-btn">
                    <a href="{{ url('sdg-gallery/1') }}" class="view-gallery-link">View Gallery</a>
                </div>
            </div>
            <div class="text-column">
                <p>
                    By advocating for real equal opportunities for all women in leadership, education, and community
                    development, Pampanga State Agricultural University (PSAU) supports the achievement of Sustainable
                    Development Goal 5: Gender Equality. The university maintains inclusive policies that provide equal
                    access to leadership positions, professional growth, academic programs, and scholarships for men and
                    women. PSAU incorporates gender sensitivity inti its research, curriculum, and extension services,
                    offering training and seminars, and increasing awareness of gender issues through its Gender and
                    Development (GAD) initiatives.
                </p>
                <p>
                    Additionally, by providing them access to technology and supplies, livelihood opportunities, and skill
                    training, PSAU strengthens women in rural communities and agriculture. These programs support women’s
                    involvement in decision-making at the university and in the broader community by challenging
                    conventional gender norms. PSAU actively promotes gender equality and helps to create a more just and
                    equitable society by cultivating a culture of respect, inclusivity, and empowerment.
                </p>
            </div>

        </section>



        <section class="content-section mb-3" id="sdg6">
            <div class="text-column">
                <p>
                    Through its academic, research, and extension initiatives, Pampanga State Agricultural University (PSAU)
                    promotes the preservation of the environment, sustainable water management, and hygiene education in
                    support of Sustainable Development Goal 6: Clean Water and Sanitation. To minimize water pollution and
                    ensure the effective use of water resources, PSAU, an organization with a background in agricultural and
                    environmental science, researches water conservation, rainwater collection, wastewater treatment, and
                    environmentally friendly farming methods.
                </p>
                <p>
                    Furthermore, PSAU promotes innovation by creating affordable, locally based technologies for
                    waste-to-resource systems, irrigation efficiency, and water purification that help rural communities
                    have access to clean water. The university presents science-based solutions that tackle practical issues
                    in water quality and sanitation through collaborations with regional administrations and research
                    organizations. PSAU is a key player in expanding access to clean water, encouraging sustainable
                    sanitation, and creating communities that are resilient to climate change by fusing academic excellence
                    with innovation and community involvement.
                </p>
            </div>
            <div class="image-column">
                <img src="{{ asset('assets/img/sdgs/6.png') }}" alt="SDG" />
                <div class="gallery-btn">
                    <a href="{{ url('sdg-gallery/1') }}" class="view-gallery-link">View Gallery</a>
                </div>
            </div>
        </section>

        <section class="content-section mb-3" id="sdg7">
            <div class="image-column">
                <img src="{{ asset('assets/img/sdgs/7.png') }}" alt="SDG 7" />
                <div class="gallery-btn">
                    <a href="{{ url('sdg-gallery/1') }}" class="view-gallery-link">View Gallery</a>
                </div>
            </div>
            <div class="text-column">
                <p>
                    Through innovation, research, and education, Pampanga State Agricultural University (PSAU) promotes the
                    use of sustainable energy sources, helping to achieve Sustainable Development Goal 7: Affordable and
                    Clean Energy. Along with its commitment to the preservation of the environment, PSAU incorporates
                    concepts of renewable energy into its curriculum and carries out research on alternative energy sources,
                    particularly those that are pertinent to rural and agricultural communities, like biomass, solar, and
                    biofuels.
                </p>
                <p>
                    PSAU provides information and technologies about energy efficiency and clean energy production to local
                    communities through its extension programs. By fusing technological innovation, community engagement,
                    and scholarly expertise, PSAU actively promotes accessible, clean energy for a more sustainable future.
                </p>
            </div>
        </section>

        <section class="content-section mb-3" id="sdg8">
            <div class="text-column">
                <p>
                    Through the provision of opportunities, knowledge, and skills necessary for productive employment and
                    sustainable livelihoods, Pampanga State Agricultural University (PSAU) supports Sustainable Development
                    Goal 8: Decent Work and Economic Growth. Graduates of PSAU’s academic programs in technology,
                    entrepreneurship, agribusiness, and agriculture are equipped to be innovative, competitive professionals
                    and job creators in both domestic and international markets.
                </p>
                Additionally, the university promotes innovation and entrepreneurship by funding livelihood training,
                research- based startups, and the incubation of agribusiness ideas, particularly among young people and
                rural communities. Through the development of technical skills, financial literacy, and enterprise support,
                its extension programs help farmers, women, and marginalized groups raise their incomes and enhance their
                quality of life.
                </p>
                <p>
                    Internally, PSAU supports equitable opportunities for all workers, a safe workplace, and fair labor
                    practices. In the region and beyond, PSAU actively supports the creation of decent work opportunities
                    and sustainable economic growth by fusing education, innovation, and inclusive economic empowerment.
                </p>

            </div>
            <div class="image-column">
                <img src="{{ asset('assets/img/sdgs/8.png') }}" alt="SDG 8" />
                <div class="gallery-btn">
                    <a href="{{ url('sdg-gallery/1') }}" class="view-gallery-link">View Gallery</a>
                </div>
            </div>
        </section>
        <section class="content-section mb-3" id="sdg9">
            <div class="image-column">
                <img src="{{ asset('assets/img/sdgs/9.png') }}" alt="SDG 9" />
                <div class="gallery-btn">
                    <a href="{{ url('sdg-gallery/1') }}" class="view-gallery-link">View Gallery</a>
                </div>
            </div>
            <div class="text-column">
                <p>
                    Pampanga State Agricultural University (PSAU) supports a culture of research, technological advancement,
                    and rural development through education and community engagement, all of which contributed to
                    Sustainable Development Goal 9: Industry, Innovation, and Infrastructure. As an institution founded on
                    science and agriculture, PSAU promotes innovation in fields like environmental engineering, food
                    processing, agri-industrial development, and sustainable farming technologies, thereby assisting the
                    expansion of resilient, modern industries in rural regions.
                </p>
                <p>
                    To foster innovation and the creation of new technologies, the university makes investments in labs,
                    experimental farms, and research facilities. These resources help close the knowledge gap between
                    academia and industry by fostering faculty research, student learning, and joint projects with the
                    public and private sectors.
                </p>
                <p>
                    Through its extension programs, PSAU also improves rural infrastructure by providing local farmers and
                    microenterprises with technical support and capacity-building in areas like post-harvest processing,
                    irrigation, and farm mechanization. PSAU is essential to creating equitable and sustainable industrial
                    growth, especially in communities reliant on agriculture, by fusing innovation, infrastructure
                    development, and industry partnerships.
                </p>
            </div>

        </section>
        <section class="content-section mb-3" id="sdg10">
            <div class="text-column">
                <p>
                    Pampanga State Agricultural University (PSAU) advocates for inclusive education, equal opportunities,
                    and community empowerment, particularly for underprivileged and marginalized groups, to support
                    Sustainable Development Goal 10: Reduced Inequalities. The university makes sure that students from a
                    range of socioeconomic backgrounds, including those from rural and indigenous communities, have access
                    to high-quality education, scholarships, and training programs.
                </p>
                Through its outreach and extension initiatives, PSAU actively seeks to lessen disparities in rural
                communities by giving women, small-scale farmers, and underprivileged groups access to agricultural
                innovations, livelihood training, and technical assistance. These programs support social inclusion, raise
                income opportunities, and enhance quality of life.
                </p>
                <p>
                    To further guarantee that no one is left behind, PSAU incorporates cultural sensitivity, disability
                    awareness, and gender equality into its policies and initiatives. Both on campus and in the larger
                    community, PSAU helps to close social and economic divides by promoting an atmosphere of fairness,
                    empowerment, and community involvement.
                </p>

            </div>
            <div class="image-column">
                <img src="{{ asset('assets/img/sdgs/10.png') }}" alt="SDG 10" />
                <div class="gallery-btn">
                    <a href="{{ url('sdg-gallery/1') }}" class="view-gallery-link">View Gallery</a>
                </div>
            </div>
        </section>

        {{-- SDGs 11 to 17 --}}
        @for ($i = 11; $i <= 17; $i++)
            @php
                $sdgColors = [
                    1 => '#E5243B',
                    2 => '#DDA63A',
                    3 => '#4C9F38',
                    4 => '#C5192D',
                    5 => '#FF3A21',
                    6 => '#26BDE2',
                    7 => '#FCC30B',
                    8 => '#A21942',
                    9 => '#FD6925',
                    10 => '#DD1367',
                    11 => '#FD9D24',
                    12 => '#BF8B2E',
                    13 => '#3F7E44',
                    14 => '#0A97D9',
                    15 => '#56C02B',
                    16 => '#00689D',
                    17 => '#19486A',
                ];
            @endphp

            <section class="content-section mb-3" id="sdg{{ $i }}">
                @if ($i % 2 !== 0)
                    <div class="image-column">
                        <img src="{{ asset("assets/img/sdgs/$i.png") }}" alt="SDG" />
                        <div class="gallery-btn">
                            <a href="{{ url('sdg-gallery/' . $i) }}" class="view-gallery-link"
                                style="background: {{ $sdgColors[$i] }};">
                                View Gallery
                            </a>
                        </div>
                    </div>
                    <div class="text-column">
                        <p>No content available</p>
                    </div>
                @else
                    <div class="text-column">
                        <p>No content available</p>
                    </div>
                    <div class="image-column">
                        <img src="{{ asset("assets/img/sdgs/$i.png") }}" alt="SDG" />
                        <div class="gallery-btn">
                            <a href="{{ url('sdg-gallery/' . $i) }}" class="view-gallery-link"
                                style="background: {{ $sdgColors[$i] }};">
                                View Gallery
                            </a>
                        </div>
                    </div>
                @endif
            </section>
        @endfor
    </div>



    @include('layouts.components.footer')
    @push('scripts')
        <script>
            const sections = document.querySelectorAll(".content-section");

            const options = {
                root: null,
                threshold: 0.5, // Trigger when 50% visible
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    const el = entry.target;
                    if (entry.isIntersecting) {
                        el.classList.add("fade-up-in");
                        el.classList.remove("fade-up-out");
                    } else {
                        el.classList.remove("fade-up-in");
                        el.classList.add("fade-up-out");
                    }
                });
            }, options);

            sections.forEach((section) => {
                observer.observe(section);
            });
        </script>

        <script src="{{ asset('js/navbar.js') }}"></script>
    @endpush

@endsection
