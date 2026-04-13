<footer class="bg-[#111111] text-gray-400">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Brand --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <img src="{{ asset('images/logo_small_white.png') }}" alt="City Life International" class="h-12 w-50 object-contain flex-shrink-0">
                </div>
                <p class="text-sm leading-relaxed text-gray-500">
                    A vibrant Christian community in the heart of Sheffield, making disciples of Jesus Christ for the transformation of the city.
                </p>
            </div>

            {{-- Get In Touch --}}
            <div>
                <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Get In Touch</h4>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-[#e85d26] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>1 South Parade Shalesmoor,<br>Sheffield, S3 8SS</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#e85d26] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span>0114 272 8243</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#e85d26] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>admin1@citylifecc.com</span>
                    </li>
                </ul>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ url('/about-citylife') }}" class="hover:text-white transition-colors">About Us</a></li>
                    <li><a href="{{ route('ministries') }}" class="hover:text-white transition-colors">Ministries</a></li>
                    <li><a href="{{ url('/events') }}" class="hover:text-white transition-colors">Events</a></li>
                    {{-- <li><a href="{{ url('/news') }}" class="hover:text-white transition-colors">News</a></li> --}}
                    <li><a href="{{ url('/contact') }}" class="hover:text-white transition-colors">Contact Us</a></li>
                </ul>
            </div>

            {{-- Resources --}}
            <div>
                <h4 class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Resources</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ url('/books') }}" class="hover:text-white transition-colors">Books</a></li>
                    <li><a href="{{ route('media') }}" class="hover:text-white transition-colors">Media</a></li>
                    <li><a href="{{ url('/courses') }}" class="hover:text-white transition-colors">Courses</a></li>
                    <li><a href="{{ url('/member/login') }}" class="hover:text-white transition-colors">Member Login</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Download Our App</a></li>
                </ul>
            </div>

        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-600">
            <span>&copy; {{ now()->year }} City Life Church. All rights reserved.</span>
            <div class="flex items-center gap-4">
                <a href="{{ route('privacy-policy') }}" class="hover:text-gray-400 transition-colors">Privacy Policy</a>
                <a href="{{ route('cookie-policy') }}" class="hover:text-gray-400 transition-colors">Cookie Policy</a>
                <a href="{{ route('safeguarding') }}" class="hover:text-gray-400 transition-colors">Safeguarding</a>
            </div>
        </div>
    </div>
</footer>
