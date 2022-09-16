<template>
    <header
        class="flex justify-between px-5 items-center w-full sticky top-0 h-16 border-b shadow z-10 bg-white"
    >
        <p class="uppercase font-extrabold">show case</p>
        <div class="inline-flex min-w-[20%]">
            <span class="bg-gray-100 rounded-l-md px-2 py-3"
                ><img class="h-5" src="../../../public/icons/search.svg" alt=""
            /></span>
            <input
                type="text"
                class="border-0 bg-gray-100 rounded-r-md text-gray-800 focus:ring-0"
                placeholder="search project / users"
            />
        </div>
        <div class="flex gap-3">
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        </div>
    </header>
    <slot ></slot>
</template>

