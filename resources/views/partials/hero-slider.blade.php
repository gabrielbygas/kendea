{{-- Modified by Claude --}}
{{-- Hero Slider Section --}}
<section id="hero-slider" class="hero-slider-section">
    <div class="slider-container">
        <!-- Slides Container -->
        <div class="slides-wrapper">
            @foreach($topActivities as $index => $activity)
            <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                <img src="{{ asset($activity->first_image) }}" 
                     alt="{{ $activity->nom }}" 
                     loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                     class="slide-background"
                     onerror="this.src='{{ asset('images/default.jpg') }}'">
                
                <div class="slide-gradient-overlay"></div>
                
                <div class="slide-content-wrapper">
                    <div class="slide-content">
                        <div class="slide-emoji">
                            {{ $activity->category->emoji ?? '🎯' }}
                        </div>
                        
                        <span class="slide-badge">{{ __($activity->category->nom ?? 'Activité') }}</span>
                        
                        <h2 class="slide-title">{{ $activity->nom }}</h2>
                        
                        <p class="slide-description">{{ __(Str::limit($activity->description, 150)) }}</p>
                        
                        <div class="slide-info">
                            @if($activity->duree)
                            <span class="info-item">
                                <span>⏱️</span> {{ $activity->duree }}
                            </span>
                            @endif
                            <span class="info-item">
                                <span>📍</span> {{ $activity->location }}
                            </span>
                            @if($activity->notes)
                            <span class="info-item">
                                <span>⭐</span> {{ number_format($activity->notes, 1) }}
                            </span>
                            @endif
                        </div>
                        
                        <div class="slide-cta-wrapper">
                            <div class="price-badge">
                                <p class="price-label">{{ __('À partir de') }}</p>
                                <p class="price-value">{{ number_format($activity->prix, 0) }} AED</p>
                            </div>
                            <a href="{{ route('activity.show', $activity->slug) }}" class="cta-button">
                                {{ __('Réserver') }} →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Navigation Arrows -->
        <button id="slider-prev-btn" class="slider-nav-arrow prev-arrow" aria-label="{{ __('Slide précédent') }}">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        
        <button id="slider-next-btn" class="slider-nav-arrow next-arrow" aria-label="{{ __('Slide suivant') }}">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Bottom Navigation -->
        <div class="slider-navigation">
            <!-- Progress Bar -->
            <div class="progress-bar-container">
                <div id="slider-progress-bar" class="progress-bar-fill"></div>
            </div>
            
            <!-- Dots -->
            <div class="slider-dots">
                @foreach($topActivities as $index => $activity)
                <button class="slider-dot {{ $index === 0 ? 'active' : '' }}" 
                        data-dot="{{ $index }}" 
                        aria-label="{{ __('Aller au slide') }} {{ $index + 1 }}">
                </button>
                @endforeach
            </div>
            
            <!-- Slide Counter -->
            <div class="slide-counter">
                <span id="current-slide-num">1</span> / <span id="total-slides-num">{{ count($topActivities) }}</span>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    /* Hero Slider Styles */
    .hero-slider-section {
        position: relative;
        width: 100%;
        height: 600px;
        overflow: hidden;
        background: linear-gradient(135deg, #d97706 0%, #92400e 100%);
    }

    .slider-container {
        position: relative;
        width: 100%;
        height: 100%;
    }

    /* Slides */
    .slides-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .hero-slide {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 600px;
        opacity: 0;
        transition: opacity 0.8s ease-in-out;
        pointer-events: none;
    }

    .hero-slide.active {
        opacity: 1;
        pointer-events: auto;
    }

    .slide-background {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slide-gradient-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, transparent 100%);
    }

    .slide-content-wrapper {
        position: relative;
        z-index: 10;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem clamp(1.5rem, 5vw, 6rem);
    }

    .slide-content {
        max-width: 50rem;
        text-align: center;
    }

    .hero-slide.active .slide-content > * {
        animation: slideUpFade 0.8s ease-out both;
    }

    .hero-slide.active .slide-emoji { animation-delay: 0.1s; }
    .hero-slide.active .slide-badge { animation-delay: 0.2s; }
    .hero-slide.active .slide-title { animation-delay: 0.3s; }
    .hero-slide.active .slide-description { animation-delay: 0.4s; }
    .hero-slide.active .slide-info { animation-delay: 0.5s; }
    .hero-slide.active .slide-cta-wrapper { animation-delay: 0.6s; }

    @keyframes slideUpFade {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slide-emoji {
        font-size: 3.5rem;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
        margin-bottom: 1rem;
        line-height: 1;
    }

    .slide-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: rgba(255, 106, 0, 0.25);
        backdrop-filter: blur(8px);
        border-radius: 9999px;
        color: rgba(255, 255, 255, 0.95);
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.75rem;
        border: 1px solid rgba(255, 106, 0, 0.3);
    }

    .slide-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.75rem, 4vw, 2.75rem);
        font-weight: 700;
        color: white;
        line-height: 1.2;
        margin-bottom: 0.75rem;
    }

    .slide-description {
        font-size: clamp(0.95rem, 2vw, 1.125rem);
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
        margin-bottom: 1.25rem;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .slide-info {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 1.5rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }

    .slide-cta-wrapper {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
    }

    .price-badge {
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, rgba(255, 106, 0, 0.25) 0%, rgba(229, 95, 0, 0.2) 100%);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 106, 0, 0.4);
        border-radius: 0.5rem;
    }

    .price-label {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.85);
        margin: 0 0 0.25rem 0;
    }

    .price-value {
        font-family: 'Playfair Display', serif;
        font-size: 1.875rem;
        font-weight: 700;
        color: #FF8533;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .cta-button {
        display: inline-block;
        padding: 0.75rem 2rem;
        background: linear-gradient(135deg, #FF6A00 0%, #E55F00 100%);
        color: #FFFFFF;
        font-weight: 600;
        font-size: 1rem;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        box-shadow: 0 10px 25px rgba(255, 106, 0, 0.3);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-decoration: none;
    }

    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(255, 106, 0, 0.5);
        background: linear-gradient(135deg, #FF8533 0%, #FF6A00 100%);
        color: #FFFFFF;
    }

    .cta-button:active {
        transform: translateY(-1px);
    }

    /* Navigation Arrows */
    .slider-nav-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 20;
        width: 3.5rem;
        height: 3.5rem;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(12px);
        border: none;
        border-radius: 50%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .slider-nav-arrow:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-50%) scale(1.1);
    }

    .prev-arrow {
        left: 1rem;
    }

    .next-arrow {
        right: 1rem;
    }

    /* Bottom Navigation */
    .slider-navigation {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 20;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    .progress-bar-container {
        width: 12rem;
        height: 4px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 2px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        width: 0%;
        background: white;
        border-radius: 2px;
        transition: width 5s linear;
    }

    .slider-dots {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .slider-dot {
        width: 0.75rem;
        height: 0.75rem;
        background: rgba(255, 255, 255, 0.4);
        border: none;
        border-radius: 50%;
        padding: 0;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .slider-dot.active {
        background: white;
        transform: scale(1.3);
    }

    .slider-dot:hover:not(.active) {
        background: rgba(255, 255, 255, 0.6);
    }

    .slide-counter {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.875rem;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-slider-section {
            height: 600px;
        }

        .slide-content-wrapper {
            padding: 1.5rem;
        }

        .slide-emoji {
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
        }

        .slide-title {
            font-size: 1.5rem;
        }

        .slide-description {
            font-size: 0.95rem;
        }

        .slide-info {
            font-size: 0.875rem;
            gap: 0.75rem;
        }

        .slide-cta-wrapper {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }

        .cta-button {
            width: 100%;
            padding: 0.875rem 1.5rem;
        }

        .slider-nav-arrow {
            width: 3rem;
            height: 3rem;
        }

        .prev-arrow {
            left: 0.5rem;
        }

        .next-arrow {
            right: 0.5rem;
        }

        .slider-navigation {
            bottom: 1rem;
        }

        .progress-bar-container {
            width: 10rem;
        }
    }

    @media (max-width: 480px) {
        .slide-title {
            font-size: 1.35rem;
        }

        .price-value {
            font-size: 1.5rem;
        }
        
        .slide-description {
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const HeroSlider = {
        currentIndex: 0,
        totalSlides: {{ count($topActivities) }},
        autoPlayInterval: null,
        autoPlayDelay: 5000,
        
        elements: {
            slides: document.querySelectorAll('.hero-slide'),
            dots: document.querySelectorAll('.slider-dot'),
            progressBar: document.getElementById('slider-progress-bar'),
            currentSlideNum: document.getElementById('current-slide-num'),
            prevBtn: document.getElementById('slider-prev-btn'),
            nextBtn: document.getElementById('slider-next-btn')
        },

        init() {
            this.bindEvents();
            this.startAutoPlay();
        },

        bindEvents() {
            // Navigation buttons
            this.elements.prevBtn?.addEventListener('click', () => {
                this.prevSlide();
                this.startAutoPlay();
            });

            this.elements.nextBtn?.addEventListener('click', () => {
                this.nextSlide();
                this.startAutoPlay();
            });

            // Dots navigation
            this.elements.dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const index = parseInt(dot.dataset.dot);
                    this.goToSlide(index);
                    this.startAutoPlay();
                });
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight') {
                    this.nextSlide();
                    this.startAutoPlay();
                } else if (e.key === 'ArrowLeft') {
                    this.prevSlide();
                    this.startAutoPlay();
                }
            });

            // Touch/swipe support
            let touchStartX = 0;
            let touchEndX = 0;

            document.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            document.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                this.handleSwipe(touchStartX, touchEndX);
            }, { passive: true });
        },

        handleSwipe(startX, endX) {
            const swipeThreshold = 50;
            const diff = startX - endX;
            
            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    this.nextSlide();
                } else {
                    this.prevSlide();
                }
                this.startAutoPlay();
            }
        },

        goToSlide(index) {
            this.elements.slides[this.currentIndex]?.classList.remove('active');
            this.elements.dots[this.currentIndex]?.classList.remove('active');

            this.currentIndex = index;
            if (this.currentIndex >= this.totalSlides) this.currentIndex = 0;
            if (this.currentIndex < 0) this.currentIndex = this.totalSlides - 1;

            this.elements.slides[this.currentIndex]?.classList.add('active');
            this.elements.dots[this.currentIndex]?.classList.add('active');
            
            if (this.elements.currentSlideNum) {
                this.elements.currentSlideNum.textContent = this.currentIndex + 1;
            }

            this.resetProgress();
        },

        nextSlide() {
            this.goToSlide(this.currentIndex + 1);
        },

        prevSlide() {
            this.goToSlide(this.currentIndex - 1);
        },

        resetProgress() {
            if (!this.elements.progressBar) return;
            
            this.elements.progressBar.style.transition = 'none';
            this.elements.progressBar.style.width = '0%';
            
            setTimeout(() => {
                this.elements.progressBar.style.transition = `width ${this.autoPlayDelay}ms linear`;
                this.elements.progressBar.style.width = '100%';
            }, 50);
        },

        startAutoPlay() {
            this.stopAutoPlay();
            this.resetProgress();
            this.autoPlayInterval = setInterval(() => this.nextSlide(), this.autoPlayDelay);
        },

        stopAutoPlay() {
            if (this.autoPlayInterval) {
                clearInterval(this.autoPlayInterval);
            }
        }
    };

    // Initialize slider
    HeroSlider.init();

    // Pause autoplay when user leaves tab
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            HeroSlider.stopAutoPlay();
        } else {
            HeroSlider.startAutoPlay();
        }
    });
});

// Handle activity booking from slider
function handleActivityBooking(activityId) {
    // Scroll to activities section
    const activitiesSection = document.getElementById('activites');
    if (activitiesSection) {
        activitiesSection.scrollIntoView({ behavior: 'smooth' });
        
        // Highlight and open the activity after scroll
        setTimeout(() => {
            const activityCard = document.querySelector(`[data-activity-id="${activityId}"]`);
            if (activityCard) {
                activityCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                activityCard.classList.add('highlight-pulse');
                setTimeout(() => activityCard.classList.remove('highlight-pulse'), 2000);
                
                // Trigger details modal if available
                const detailsBtn = activityCard.querySelector('.view-details-btn');
                if (detailsBtn) {
                    setTimeout(() => detailsBtn.click(), 500);
                }
            }
        }, 1000);
    }
}
</script>
@endpush
