@extends('layouts.app')

@section('title', 'Home')

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
    </div>
    <div class="text-column">
      <p>Pampanga State Agricultural University (PSAU) stands at the forefront of driving sustainable development, deeply committed to addressing SDG 1: No Poverty through research-driven programs, community empowerment, and agricultural innovations.</p>
      <p>One such study, conducted among local farmers, seeks to assess how well these programs fulfill their intended purpose. By gathering firsthand insights, PSAU identifies gaps, strengths, and areas for improvement, ensuring that interventions truly uplift farming communities.</p>
      <p>Through its continuous commitment to innovation and community engagement, PSAU reinforces its mission of empowering farmers—helping them break free from the cycle of poverty while fostering a more food-secure and sustainable future for all.</p>
    </div>
  </section>

  {{-- SDG 2 --}}
  <section class="content-section mb-3" id="sdg2">
    <div class="text-column">
      <p>Pampanga State Agricultural University (PSAU) actively contributes to Sustainable Development Goal 2 (SDG 2): Zero Hunger, particularly by working toward the target of doubling agricultural productivity and increasing the incomes of small-scale food producers—including women, indigenous peoples, and family farmers.</p>
      <p>Utilizing the rich agricultural resources of the region, PSAU transforms various local commodities into value-added products that create sustainable livelihood opportunities for growers. This initiative empowers farmers to achieve financial independence by equipping them with innovative technologies that enhance farm productivity and profitability.</p>
      <p>In addition to livelihood support, PSAU conducts cutting-edge research to address pressing agricultural and aquaculture challenges. One such study explores the use of Balakat (Ziziphus talanai), an indigenous plant, as a natural molluscicide, providing farmers with a locally available, eco-friendly solution to pest infestations.</p>
      <p>To further its commitment to food security and nutrition, PSAU has also developed innovative food technologies using tamarind—a fruit abundant on campus. These include tamarind-based vinegar, wine, and even ice cream, showcasing the university’s dedication to sustainable agricultural transformation and entrepreneurship.</p>
    </div>
    <div class="image-column">
      <img src="{{ asset('assets/img/sdgs/2.png') }}" alt="SDG" />
    </div>
  </section>

  <section class="content-section mb-3" id="sdg3">
    <div class="image-column">
      <img src="{{ asset('assets/img/sdgs/3.png') }}" alt="SDG 3" />
    </div>
    <div class="text-column">
      <p>
        Pampanga State Agricultural University (PSAU) stands at the forefront of driving sustainable development, deeply committed to addressing SDG 1: No Poverty through research-driven programs, community empowerment, and agricultural innovations. Guided by its mandate, PSAU continuously explores the effectiveness of its initiatives in tackling poverty, food insecurity, and environmental stability—paving the way for inclusive growth and lasting change.
      </p>
      <p>
        One such study, conducted among local farmers, seeks to assess how well these programs fulfill their intended purpose. By gathering firsthand insights, PSAU identifies gaps, strengths, and areas for improvement, ensuring that interventions truly uplift farming communities. The research highlights practical solutions that enhance agricultural productivity, promote sustainable livelihoods, and build resilience against economic and environmental challenges.
      </p>
      <p>
        Through its continuous commitment to innovation and community engagement, PSAU reinforces its mission of empowering farmers—helping them break free from the cycle of poverty while fostering a more food-secure and sustainable future for all.
      </p>
    </div>
  </section>

  <section class="content-section mb-3" id="sdg4">
    <div class="text-column">
      <p>
        Pampanga State Agricultural University (PSAU) stands at the forefront of driving sustainable development, deeply committed to addressing SDG 1: No Poverty through research-driven programs, community empowerment, and agricultural innovations. Guided by its mandate, PSAU continuously explores the effectiveness of its initiatives in tackling poverty, food insecurity, and environmental stability—paving the way for inclusive growth and lasting change.
      </p>
      <p>
        One such study, conducted among local farmers, seeks to assess how well these programs fulfill their intended purpose. By gathering firsthand insights, PSAU identifies gaps, strengths, and areas for improvement, ensuring that interventions truly uplift farming communities. The research highlights practical solutions that enhance agricultural productivity, promote sustainable livelihoods, and build resilience against economic and environmental challenges.
      </p>
      <p>
        Through its continuous commitment to innovation and community engagement, PSAU reinforces its mission of empowering farmers—helping them break free from the cycle of poverty while fostering a more food-secure and sustainable future for all.
      </p>
    </div>
    <div class="image-column">
      <img src="{{ asset('assets/img/sdgs/4.png') }}" alt="SDG 4" />
    </div>
  </section>

  {{-- SDGs 5 to 17 --}}
  @for ($i = 5; $i <= 17; $i++)
    <section class="content-section mb-3" id="sdg{{ $i }}">
      @if ($i % 2 !== 0)
        <div class="image-column">
          <img src="{{ asset("assets/img/sdgs/$i.png") }}" alt="SDG" />
        </div>
        <div class="text-column">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at diam ut lorem dignissim tincidunt. Nulla facilisi. Curabitur suscipit, augue sed dignissim aliquam, nisi odio blandit metus, et tincidunt mi ante non nisl.</p>
          <p>Praesent id quam sed nulla varius tincidunt. Proin dapibus, nunc in dictum tincidunt, nulla sem egestas risus, eget porttitor odio velit ut libero.</p>
          <p>Vivamus iaculis turpis sit amet mattis fermentum. Sed sit amet faucibus neque, ut suscipit ipsum. Pellentesque non metus nec eros scelerisque commodo.</p>
        </div>
      @else
        <div class="text-column">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at diam ut lorem dignissim tincidunt. Nulla facilisi. Curabitur suscipit, augue sed dignissim aliquam, nisi odio blandit metus, et tincidunt mi ante non nisl.</p>
          <p>Praesent id quam sed nulla varius tincidunt. Proin dapibus, nunc in dictum tincidunt, nulla sem egestas risus, eget porttitor odio velit ut libero.</p>
          <p>Vivamus iaculis turpis sit amet mattis fermentum. Sed sit amet faucibus neque, ut suscipit ipsum. Pellentesque non metus nec eros scelerisque commodo.</p>
        </div>
        <div class="image-column">
          <img src="{{ asset("assets/img/sdgs/$i.png") }}" alt="SDG" />
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



