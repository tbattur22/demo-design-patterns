@php
    $patternObj = $patternObj ?? null
@endphp
<div class='fixed hidden sm:flex rounded-2xl bg-blue-200'>
    <nav class='w-full px-5 lg:px-8 xl:px-[8%] pt-2 pb-0.1 flex justify-center items-center'>
        <ul class="hidden sm:flex justify-center items-center gap-6 lg:gap-8 rounded-full px-12 py-3 ">
            <x-nav-menu :patterns="$patterns" :patternObj="$patternObj"></x-nav-menu>
        </ul>
    </nav>
</div>
<div class='mobile-menu fixed sm:hidden'>
    <nav class='w-full px-5 lg:px-8 xl:px-[8%] pt-2 pb-0.1 flex justify-center items-center'>
        {{-- mobile menu --}}
        <ul class="flex sm:hidden flex-col gap-4 px-10 py-20 fixed -right-64
        top-0 bottom-0 w-64 z-50 h-screen bg-blue-200">
            <div class='closeSideMenu absolute right-6 top-6'>
                <Image src="{{ asset('images/close-black.png') }}" alt='' class='w-5 cursor-pointer' />
            </div>

            <x-nav-menu :patterns="$patterns" :patternObj="$patternObj"></x-nav-menu>
        </ul>
    </nav>
</div>

<div class='w-full fixed flex sm:hidden justify-end gap-4 mr-4 mt-2'>
    <button class='openSideMenu block sm:hidden ml-3'>
        <Image src="{{ asset('images/menu-black.png') }}" alt="" class='w-6' />
    </button>
</div>
<script>
    // open mobile menu handling
    $("button.openSideMenu").click(function() {
        console.log('open menu called');
        const mobile = document.querySelector('div.mobile-menu nav ul');
        this.classList.add("hidden");

        mobile.style.transform = "translateX(-16rem)";
    });
    $("div.closeSideMenu").click(function() {
        console.log('close side menu called');
        const mobile = document.querySelector('div.mobile-menu nav ul');
        const openSideMenu = document.querySelector('button.openSideMenu');
        openSideMenu.classList.remove("hidden");
        mobile.style.transform = "translateX(16rem)";
    });

</script>
