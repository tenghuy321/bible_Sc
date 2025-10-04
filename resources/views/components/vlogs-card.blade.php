{{-- resources/views/components/vlogs-card.blade.php --}}
@props(['vlogs' => [], 'locale' => app()->getLocale()])

@php
    $locale = app()->getLocale(); // 'en' or 'km'
    $titleField = 'title_' . $locale;
    $paragraphField = 'paragraph_' . $locale;
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
    <div class="w-full h-full grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3 py-4">
        @foreach ($vlogs as $vlog)
            @php
                $videoId = $vlog->video_Url ? getYoutubeVideoId($vlog->video_Url) : null;
                $thumbnailUrl = $videoId
                    ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg"
                    : asset('images/default-thumbnail.jpg');
            @endphp

            <a href="{{ $vlog->video_Url ?? '#' }}" target="_blank"
                class="w-full h-full bg-white rounded-[22px] border-[2px] border-gray-300 xl:drop-shadow-xl p-2 hover:scale-[1.02] transition-all duration-300">
                <div class="relative">
                    <img src="{{ $thumbnailUrl }}" alt="vlog-thumbnail"
                        class="w-full h-fit object-contain object-center rounded-[5%]">
                </div>
                <div class="p-1 font-kantumruy">
                    <h1 class="text-[14px] font-bold">{{ $vlog->$titleField }}</h1>
                    <div class="text-[12px] whitespace-pre-line prose max-w-full">
                        {!! $vlog->$paragraphField !!}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
