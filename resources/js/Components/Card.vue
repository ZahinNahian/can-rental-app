<script setup>
defineProps({
    title: String,
    number:[String, Number],
    image: String
})
</script>

<template>
    <section class="rounded-xl border-2 border-gray-100 bg-white h-28 mx-3">
        <div class="flex items-start gap-4 p-4 sm:p-6 lg:p-8">
            <a href="#" class="block shrink-0">
                <img alt=""
                    :src="`/icons/${title}.png`"
                    class="size-14 rounded-lg object-cover" />
            </a>

            <div>
                <h3 class="font-medium sm:text-lg">
                    {{ title }}
                </h3>

                <p class="line-clamp-2 text-sm text-gray-700">
                    {{ number }}
                </p>
            </div>
        </div>
    </section>
</template>