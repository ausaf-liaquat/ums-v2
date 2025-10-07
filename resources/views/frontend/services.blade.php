@extends('frontend.layouts.app')

@section('title')
    Services |
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
            position: relative;
            height: 60vh;
            min-height: 500px;
            background: linear-gradient(rgba(109, 40, 217, 0.8), rgba(139, 92, 246, 0.8)),
                        url('{{ asset('img/hero-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--white);
            overflow: hidden;
        }

        .hero-content {
            max-width: 800px;
            z-index: 2;
            position: relative;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .modern-breadcrumb {
            position: absolute;
            bottom: 2rem;
            right: 2rem;
            background: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .modern-breadcrumb a {
            text-decoration: none;
            color: var(--text-light);
            font-size: 0.875rem;
            transition: color 0.3s;
        }

        .modern-breadcrumb a:hover {
            color: var(--primary);
        }

        .modern-breadcrumb .separator {
            color: var(--text-light);
            font-size: 0.75rem;
        }

        .modern-breadcrumb .current {
            color: var(--primary);
            font-weight: 600;
        }

        .home-icon {
            background: var(--gradient);
            color: var(--white);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modern-services {
            padding: 5rem 0;
            background: var(--white);
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .section-divider {
            height: 4px;
            width: 80px;
            background: var(--gradient);
            margin: 0 auto;
            border-radius: 2px;
        }

        .services-grid-modern {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }

        .service-card-modern {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            position: relative;
            height: 400px;
        }

        .service-card-modern:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .service-image-modern {
            height: 60%;
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
            padding: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .service-title-modern {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .service-description-modern {
            color: var(--text-light);
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .service-status {
            display: inline-block;
            background: var(--accent);
            color: var(--white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .service-link-modern {
            display: inline-flex;
            align-items: center;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            margin-top: 0.5rem;
        }

        .service-link-modern i {
            margin-left: 0.5rem;
            transition: transform 0.3s;
        }

        .service-link-modern:hover {
            color: var(--primary-dark);
        }

        .service-link-modern:hover i {
            transform: translateX(5px);
        }

        .coming-soon-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            z-index: 3;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            .hero-title {
                font-size: 2.5rem;
            }

            .services-grid-modern {
                grid-template-columns: 1fr;
            }

            .modern-breadcrumb {
                position: relative;
                bottom: auto;
                right: auto;
                margin-top: 2rem;
                justify-content: center;
            }
        }
    </style>

    <!-- Modern Hero Section -->
    <section class="modern-hero">
        <div class="hero-content">
            <h1 class="hero-title">Our Services</h1>
            <p class="hero-subtitle">Comprehensive healthcare solutions tailored to your needs</p>
        </div>

        <div class="modern-breadcrumb">
            <div class="home-icon">
                <i class="fas fa-home"></i>
            </div>
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <span class="current">Services</span>
        </div>
    </section>

    <!-- Modern Services Section -->
    <section class="modern-services">
        <div class="container mx-auto max-w-[85rem] px-4">
            <div class="section-header">
                <h2 class="section-title">What We Offer</h2>
                <div class="section-divider"></div>
            </div>

            <div class="services-grid-modern">
                <!-- Staffing Service -->
                <div class="service-card-modern animate-fadeInUp">
                    <div class="service-image-modern" style="background-image: url({{ asset('img/img-7.jpg') }})">
                        <div class="service-overlay-modern"></div>
                        <div class="coming-soon-badge">COMING SOON</div>
                    </div>
                    <div class="service-content-modern">
                        <h3 class="service-title-modern">Staffing Solutions</h3>
                        <p class="service-description-modern">Find qualified healthcare professionals to meet your staffing needs with our comprehensive recruitment services.</p>
                        <a href="{{ route('join-our-team') }}" class="service-link-modern">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Courses Service -->
                <div class="service-card-modern animate-fadeInUp">
                    <div class="service-image-modern" style="background-image: url({{ asset('img/img-9.jpg') }})">
                        <div class="service-overlay-modern"></div>
                    </div>
                    <div class="service-content-modern">
                        <h3 class="service-title-modern">Professional Courses</h3>
                        <p class="service-description-modern">Enhance your skills with our specialized healthcare training programs and certification courses.</p>
                        <a href="{{ route('courses') }}" class="service-link-modern">
                            Explore Courses <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Medical Supplies Service -->
                <div class="service-card-modern animate-fadeInUp">
                    <div class="service-image-modern" style="background-image: url({{ asset('img/img-10.jpg') }})">
                        <div class="service-overlay-modern"></div>
                        <div class="coming-soon-badge">COMING SOON</div>
                    </div>
                    <div class="service-content-modern">
                        <h3 class="service-title-modern">Medical Supplies</h3>
                        <p class="service-description-modern">High-quality medical equipment and supplies for healthcare facilities and professionals.</p>
                        <a href="{{ route('medical-supplies') }}" class="service-link-modern">
                            View Products <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Medical Uniforms Service -->
                <div class="service-card-modern animate-fadeInUp">
                    <div class="service-image-modern" style="background-image: url({{ asset('img/img-11.jpg') }})">
                        <div class="service-overlay-modern"></div>
                        <div class="coming-soon-badge">COMING SOON</div>
                    </div>
                    <div class="service-content-modern">
                        <h3 class="service-title-modern">Medical Uniforms</h3>
                        <p class="service-description-modern">Professional and comfortable medical uniforms designed for healthcare environments.</p>
                        <a href="{{ route('medical-uniforms') }}" class="service-link-modern">
                            Browse Collection <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Medical Coding and Billing Service -->
                <div class="service-card-modern animate-fadeInUp">
                    <div class="service-image-modern" style="background-image: url({{ asset('img/img-12.jpg') }})">
                        <div class="service-overlay-modern"></div>
                        <div class="coming-soon-badge">COMING SOON</div>
                    </div>
                    <div class="service-content-modern">
                        <h3 class="service-title-modern">Medical Coding & Billing</h3>
                        <p class="service-description-modern">Comprehensive medical coding and billing services to streamline your healthcare practice.</p>
                        <a href="#" class="service-link-modern">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
