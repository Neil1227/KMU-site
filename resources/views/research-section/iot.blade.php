@extends('layouts.app')

@section('title', 'Internet of Things Research')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
@endpush

@section('content')

@include('layouts.components.generic-background')

{{-- Navbar --}}
@include('layouts.components.header')
@include('layouts.components.research-navbar', ['active' => 'iot'])

{{-- Page Content --}}
<div class="container-page py-5">
  <div class="row g-4 mb-4">
    <div class="col-12">
      <div class="bento-card h-100">

        {{-- Main Card --}}
        <div class="research-card">
          <div class="research-image">
            <img 
              src="{{ asset('assets/img/research_thumbnails/reseach-icon-iot.png') }}" 
              alt="Internet of Things" 
              loading="lazy"
              width="100%" height="auto"
              style="display: block; object-fit: cover; border-radius: 10px;"
            >
          </div>
          <div class="research-text">
            <h3>Water Management and Irrigation <hr></h3>
            <p>
              An automated irrigation system using a soil moisture sensor and Raspberry Pi was developed for real-time water monitoring. Faults are detected via an Arduino-based serial monitor to reduce downtime. A thematic map catalogs PSAU’s existing and potential water resources for better planning.
            </p>
            <p>
              Other systems enhance communication, safety, and resource management. A centralized app allows faculty to post announcements to students. A fire safety system displays sensor data and sends SMS alerts in emergencies. A Raspberry Pi-based system controls electrical switches manually or by schedule. An IoT door lock with intrusion detection was also created. Lastly, topographic and infrastructure maps of campus zones were generated.
            </p>
          </div>
        </div>

        {{-- Initiatives --}}
        <h3>Initiatives <hr></h3>
        <p>
          To address water management, an automated water irrigation system application was designed, utilizing a soil moisture sensor and Raspberry Pi to monitor irrigation levels in real-time. Fault detection in the irrigation system is managed through an Arduino-based serial monitor, ensuring quick identification of issues and minimizing system downtime.
        </p>
        <p>
          Additionally, a water resources thematic map was developed to catalog both existing and potential water resources within the PSAU property, facilitating the identification of various water sources and receivers across the campus. Together, these systems aim to enhance operational efficiency, ensure safety, and promote sustainability within the institution.
        </p>
        <p>
          It presents a series of interconnected systems aimed at improving communication, safety, and resource management within an academic institution. One system allows faculty members to post announcements, facilitating communication with students through a centralized application. Another system is designed to enhance safety by recording and displaying data from smoke, temperature, and fire sensors on an LCD monitor, while also sending SMS alerts to authorized fire department personnel in case of emergencies.
        </p>
        <p>
          Additionally, a web-based system embedded in a Raspberry Pi was developed to monitor and control electrical switches manually or via a scheduling system, enabling faculty to set operational schedules. For enhanced security, an IoT-based electronic door lock with an intrusion detection system was also created. Another key system generates topographic maps for various areas within the university, including academic, commercial, and science and technology zones, while also mapping infrastructure facilities across the PSAU campus.
        </p>

        {{-- R4D Thrusts and Priorities --}}
        <h3>R4D Thrusts and Priorities <hr></h3>
        <ul>
          <li>A Design and Development of an Internet of Things (IoT) Based Secured Office Automation, Monitoring, and Control with GSM Notification.</li>
          <li>Internet of Things Based Controlled Environment.</li>
          <li>Internet of Things Based Automated Irrigation System.</li>
        </ul>

        {{-- Recommendations --}}
        <h3>Recommendations <hr></h3>
        <ul>
          <li>IoT-based technologies are fundamentally transforming various industries, and as the world increasingly moves toward technology-driven sectors, it’s essential to integrate these technologies into areas like education, agriculture, and aquaculture.</li>
          <li>The Internet of Things should have a continuous monitoring and evaluation system when it comes to its data and on what they have been developed. Additionally, the security of the device should be focused to update and have strong encryption, securing data storage practices, and access controls.</li>
        </ul>

      </div>
    </div>
  </div>
</div>

{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
