<style>
    @keyframes loading-bar {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .animate-loading-bar {
        animation: loading-bar 1.5s linear infinite;
    }
</style>

<div id="loading-overlay" class="fixed inset-0 bg-[#f8efff] z-[999] hidden transition-opacity duration-[2000ms] opacity-0">
    <div class="flex flex-col items-center gap-4 justify-center min-h-screen bg-[#f8efff]">
        <img src="{{ asset('assets/images/logo.svg') }}" alt="" class="w-20 h-auto animate-bounce">
        <div class="w-1/2 sm:w-[10%] bg-gray-200 h-1 overflow-hidden">
            <div class="bg-[#4FC9EE] h-full animate-loading-bar" style="width: 100%"></div>
        </div>
        <h1 class='text-[20px] text-[#4FC9EE] font-bold'>The Bible Society in Cambodia.</h1>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loadingOverlay = document.getElementById("loading-overlay");

        window.addEventListener("beforeunload", function() {
            loadingOverlay.classList.remove("hidden");
            loadingOverlay.classList.add("opacity-100");
        });

        window.addEventListener("load", function() {
            setTimeout(() => {
                loadingOverlay.classList.add("hidden");
                loadingOverlay.classList.remove("opacity-100");
            }, 3000);
        });
    });
</script>
