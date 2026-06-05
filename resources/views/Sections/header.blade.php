<header class="relative z-20 px-4 pt-6">
    <div class="container py-8 md:py-16 lg:py-24 mx-auto">
        <div class="mb-12 md:mb-24">
            <h1
                class="font-sans antialiased font-bold text-3xl md:text-4xl lg:text-5xl text-current [text-wrap:_balance] max-w-3xl mx-auto mb-6 text-center !leading-tight">
                Our company mission is to lead the web development.</h1>
            <p class="font-sans antialiased text-base md:text-lg text-slate-600 mb-12 mx-auto text-center max-w-xl">The
                time is now for it to be okay to be great. People in this world shun people for being great. For being a
                bright color.</p>
            <div class="flex items-center justify-center gap-4 m-12">
                <a href="#about"
                    class="inline-flex items-center justify-center gap-2 rounded-full border border-black/10 bg-black px-4 py-2 text-sm font-semibold text-white shadow-sm transition-transform hover:-translate-y-0.5">
                    <span>Get Started</span>
                </a>
                <a href="#projects"
                    class="inline-flex items-center justify-center gap-2 rounded-full border border-black/10 bg-[var(--card-bg)] px-4 py-2 text-sm font-semibold text-black shadow-sm transition-transform hover:-translate-y-0.5">
                    <span>Learn More</span>
                </a>
            </div>
            @php
                // imÃ¡genes dentro de public/images: coloca 01.jpg, 02.jpg, 03.jpg
                $heroImages = [
                    'img/01.jpg',
                    'img/02.jpg',
                    'img/03.jpg',
                ];
            @endphp

            <div id="hero-carousel" class="w-full h-[40vh] sm:h-[50vh] md:h-[60vh] lg:h-[70vh] relative overflow-hidden rounded-xl">
                @foreach($heroImages as $i => $src)
                    <img
                        src="{{ asset($src) }}"
                        alt="hero {{ $i }}"
                        data-index="{{ $i }}"
                        loading="lazy"
                        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}"
                    />
                @endforeach
            </div>

            <script>
                (function(){
                    const carousel = document.getElementById('hero-carousel');
                    if (!carousel) return;
                    const slides = Array.from(carousel.querySelectorAll('img[data-index]'));
                    let current = 0;
                    const total = slides.length;
                    const intervalMs = 4000; // 4 segundos

                    function show(idx){
                        slides.forEach((s,i)=>{
                            const visible = (i === idx);
                            s.style.opacity = visible ? '1' : '0';
                            s.classList.toggle('opacity-100', visible);
                            s.classList.toggle('opacity-0', !visible);
                        });
                    }

                    if (total <= 1) return; // nothing to rotate

                    show(current); // ensure initial state

                    let timer = setInterval(()=>{
                        current = (current + 1) % total;
                        show(current);
                    }, intervalMs);

                    carousel.addEventListener('mouseenter', ()=> {
                        clearInterval(timer);
                        timer = null;
                    });
                    carousel.addEventListener('mouseleave', ()=> {
                        if (timer) return; // already running
                        timer = setInterval(()=>{
                            current = (current + 1) % total;
                            show(current);
                        }, intervalMs);
                    });
                })();
            </script>
        </div>
    </div>
</header>
