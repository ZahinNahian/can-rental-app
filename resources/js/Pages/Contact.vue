<script setup>
import UnifiedLayout from "../Layouts/UnifiedLayout.vue"
</script>
<template>
    <UnifiedLayout>
    <section class="h-auto bg-white">
        <div class="max-w-7xl mx-auto py-16 px-10 sm:py-24 sm:px-6 lg:px-8 sm:text-center">
            <h2 class="text-base font-semibold text-indigo-600 tracking-wide uppercase">Contact Form</h2>
            <p class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">Send Us A
                Message Here</p>
            <p class="max-w-3xl mt-5 mx-auto text-xl text-gray-500">If you have any conpliant, feel free to contact us here
            </p>
        </div>
    </section>
    <div class="flex flex-col justify-center items-center">
        <div class="w-full max-w-xs mx-auto my-2">
        <input type="text" placeholder="Name"
            class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
    </div>
    <div class="w-full max-w-xs mx-auto my-2">
        <textarea type="text" placeholder="Type your message here."
            class="flex w-full h-auto min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
    </div>
    <button type="button"
    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none my-2">Submit
    </button>
    </div>
    </UnifiedLayout>
</template>