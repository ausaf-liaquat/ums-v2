@extends('frontend.layouts.app')

@section('title')
@endsection

@section('content')
    <style>
        :root {
            --primary: #6d28d9;
            --primary-light: #8b5cf6;
            --primary-dark: #5b21b6;
            --secondary: #f1f5f9;
            --accent: #f59e0b;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;
            --gradient: linear-gradient(135deg, #6d28d9 0%, #8b5cf6 100%);
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .modern-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 85vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-content-modern {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-text-modern {
            color: white;
        }

        .hero-tagline {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .hero-title-modern {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .hero-description {
            font-size: 1.25rem;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            opacity: 0.9;
        }

        .hero-btn {
            display: inline-block;
            background: white;
            color: var(--primary-dark);
            font-weight: 700;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
        }

        .hero-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
        }

        .hero-image-container {
            position: relative;
        }

        .hero-image {
            width: 100%;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            transform: perspective(1000px) rotateY(-5deg) rotateX(5deg);
            transition: transform 0.5s ease;
        }

        .hero-image:hover {
            transform: perspective(1000px) rotateY(0) rotateX(0);
        }

        .wave-divider {
            position: relative;
            background: white;
            margin-top: -1px;
        }

        .services-section-modern {
            padding: 6rem 0;
            background: white;
        }

        .section-header-modern {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title-modern {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .section-divider-modern {
            height: 4px;
            width: 80px;
            background: var(--gradient);
            margin: 0 auto;
            border-radius: 2px;
        }

        .services-grid-modern {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .service-card-modern {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            position: relative;
            height: 350px;
        }

        .service-card-modern:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .service-image-modern {
            height: 70%;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .service-overlay-modern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 100%);
        }

        .service-content-modern {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            transform: translateY(0);
            transition: transform 0.3s ease;
        }

        .service-card-modern:hover .service-content-modern {
            transform: translateY(-5px);
        }

        .service-title-modern {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            text-align: center;
            margin: 0;
        }

        .courses-section-modern {
            padding: 6rem 0;
            background: var(--secondary);
        }

        .courses-grid-modern {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .course-card-modern {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .course-card-modern:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .course-image-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .course-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .course-card-modern:hover .course-image {
            transform: scale(1.05);
        }

        .course-badge {
            position: absolute;
            top: 1rem;
            left: -2rem;
            padding: 0.5rem 2rem;
            color: white;
            font-weight: 700;
            font-size: 0.75rem;
            transform: rotate(-45deg);
        }

        .badge-offline {
            background: #6b7280;
        }

        .badge-online {
            background: #10b981;
        }

        .badge-hybrid {
            background: #ef4444;
        }

        .course-content {
            padding: 1.5rem;
        }

        .course-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @media (max-width: 768px) {
            .hero-content-modern {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-title-modern {
                font-size: 2.5rem;
            }

            .services-grid-modern, .courses-grid-modern {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- Modern Hero Section -->
    <section class="modern-hero">
        <div class="hero-content-modern">
            <div class="hero-text-modern animate-fadeInUp">
                <p class="hero-tagline">Looking for?</p>
                <h1 class="hero-title-modern">MEDICAL SERVICES</h1>
                <p class="hero-description">
                    Our company is a one stop shop for all medical facilities nationwide. We provide services to keep your
                    facility running smoothly so you can focus on what is most important, patient care.
                </p>
                <a href="{{ route('service') }}" class="hero-btn">
                    Explore Services
                </a>
            </div>
            <div class="hero-image-container animate-fadeInUp">
                <img class="hero-image" src="{{ asset('img/img-5.jpg') }}" alt="Medical Services">
            </div>
        </div>
    </section>

    <!-- Wave Divider -->
    <div class="wave-divider">
        <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
                    <path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.100000001"></path>
                    <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
                </g>
                <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <path d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"></path>
                </g>
            </g>
        </svg>
    </div>

    <!-- Modern Services Section -->
    <section class="services-section-modern">
        <div class="container mx-auto max-w-[85rem] px-4">
            <div class="section-header-modern">
                <h2 class="section-title-modern">Our Services</h2>
                <div class="section-divider-modern"></div>
            </div>

            <div class="services-grid-modern">
                <!-- Staffing Service -->
                <a href="{{ route('join-our-team') }}" class="service-card-modern animate-fadeInUp">
                    <div class="service-image-modern" style="background-image: url({{ asset('img/img-7.jpg') }})">
                        <div class="service-overlay-modern"></div>
                    </div>
                    <div class="service-content-modern">
                        <h3 class="service-title-modern">STAFFING</h3>
                    </div>
                </a>

                <!-- Courses Service -->
                <a href="{{ route('courses') }}" class="service-card-modern animate-fadeInUp">
                    <div class="service-image-modern" style="background-image: url({{ asset('img/img-9.jpg') }})">
                        <div class="service-overlay-modern"></div>
                    </div>
                    <div class="service-content-modern">
                        <h3 class="service-title-modern">COURSES</h3>
                    </div>
                </a>

                <!-- Medical Supplies Service -->
                <a href="{{ route('medical-supplies') }}" class="service-card-modern animate-fadeInUp">
                    <div class="service-image-modern" style="background-image: url({{ asset('img/img-10.jpg') }})">
                        <div class="service-overlay-modern"></div>
                    </div>
                    <div class="service-content-modern">
                        <h3 class="service-title-modern">MEDICAL SUPPLIES</h3>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Modern Courses Section -->
    <section class="courses-section-modern">
        <div class="container mx-auto max-w-[85rem] px-4">
            <div class="section-header-modern">
                <h2 class="section-title-modern">Featured Courses</h2>
                <div class="section-divider-modern"></div>
            </div>

            @php
                $courses = App\Models\Courses\Course::whereStatus(1)->take(4)->get();
            @endphp

            <div class="courses-grid-modern">
                @foreach ($courses as $course)
                    <div class="course-card-modern animate-fadeInUp">
                        <div class="course-image-container">
                            <img class="course-image" src="{{ Storage::disk('cms')->url($course->image) }}" alt="{{ $course->name }}">

                            @if ($course->type == 0)
                                <div class="course-badge badge-offline">OFFLINE</div>
                            @elseif($course->type == 1)
                                <div class="course-badge badge-online">ONLINE</div>
                            @else
                                <div class="course-badge badge-hybrid">HYBRID</div>
                            @endif
                        </div>

                        <div class="course-content">
                            <h3 class="course-title">{{ Str::limit($course->name, 24) }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
