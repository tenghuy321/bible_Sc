{{-- resources/views/components/vlogs-card.blade.php --}}
@props(['vlogs' => [], 'locale' => app()->getLocale()])

@php
    $locale = app()->getLocale(); // 'en' or 'km'
    // $titleField = 'title_' . $locale;
    // $paragraphField = 'paragraph_' . $locale;
    function getYoutubeVideoId($url)
    {
        try {
            $parsed = parse_url($url);
            if (!$parsed || !isset($parsed['host'])) {
                return null;
            }

            // youtu.be links
            if ($parsed['host'] === 'youtu.be') {
                return ltrim($parsed['path'], '/');
            }

            // youtube.com/watch?v= links
            if (str_contains($parsed['host'], 'youtube.com')) {
                parse_str($parsed['query'] ?? '', $query);
                return $query['v'] ?? null;
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
@endphp

<div
    class="w-full h-full max-w-[386px] md:max-w-[720px] xl:max-w-[1200px] mx-auto translate-y-[-12%] md:translate-y-[-22%] lg:translate-y-[-18%] overflow-y-auto overflow-x-hidden px-3">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($vlogs as $vlog)
            @php
                $videoId = $vlog->video_Url ? getYoutubeVideoId($vlog->video_Url) : null;
                $thumbnailUrl = $videoId
                    ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg"
                    : asset('images/default-thumbnail.jpg');
            @endphp

            <div onclick="openVideoModal('{{ $videoId }}')"
                class="cursor-pointer w-full bg-white rounded-[22px] border-[2px] border-gray-300 xl:drop-shadow-xl p-2 transition-all duration-300">
                <div class="relative">
                    <img src="{{ $thumbnailUrl }}" alt="vlog-thumbnail"
                        class="w-full h-fit object-contain object-center rounded-[5%]">
                </div>
                <div class="p-1 font-kantumruy">
                    <h1 class="text-[15px] font-bold">{{ app()->getLocale() === 'km' ? $vlog->title_km : $vlog->title_en }}</h1>
                    <div class="text-[14px] whitespace-pre-line max-w-full">
                        {!! app()->getLocale() === 'km' ? $vlog->paragraph_km : $vlog->paragraph_en !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- YouTube Video Modal -->
    <div id="videoModal"
        class="fixed inset-0 z-50 hidden bg-black/70 flex items-center justify-center transition-opacity duration-300">
        <div
            class="relative bg-black rounded-lg overflow-hidden w-[90%] max-w-3xl aspect-video transform scale-90 opacity-0 transition-all duration-300">
            <iframe id="videoFrame" class="w-full h-full" src="" frameborder="0" allowfullscreen></iframe>
            <button onclick="closeVideoModal()"
                class="absolute top-2 right-2 text-white text-2xl font-bold hover:text-gray-300">&times;</button>
        </div>
    </div>
<script>
    const modal = document.getElementById('videoModal');
    const modalContent = modal.querySelector('div');
    const iframe = document.getElementById('videoFrame');

    function openVideoModal(videoId) {
        if (!videoId) return; // fallback if no video

        iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
        modal.classList.remove('hidden');

        // Small delay to trigger Tailwind transitions
        setTimeout(() => {
            modalContent.classList.remove('scale-90', 'opacity-0');
        }, 10);
    }

    function closeVideoModal() {
        modalContent.classList.add('scale-90', 'opacity-0');

        // Wait for transition, then hide modal and stop video
        setTimeout(() => {
            modal.classList.add('hidden');
            iframe.src = '';
        }, 200);
    }

    // Close on background click
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeVideoModal();
    });

    // Close on ESC key
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeVideoModal();
    });
</script>
