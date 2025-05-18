<script setup>
import { usePage } from "@inertiajs/vue3";
import UnifiedLayout from "../Layouts/UnifiedLayout.vue"
const cars = usePage().props.cars
// defineOptions({layout: auth.user? AuthenticatedLayout: GuestLayout})
</script>

<template>
    <UnifiedLayout>
        <!--Slot Start-->
        <section class="bg-white">
            <div class="w-full px-5 py-6 mx-auto space-y-5 sm:py-8 md:py-12 sm:space-y-8 md:space-y-16 max-w-7xl">
                <section class="h-auto bg-white">
                    <div class="px-10 mx-auto max-w-7xl">
                        <div class="w-full mx-auto text-left md:text-center">
                            <h1
                                class="mb-6 text-5xl font-extrabold leading-none max-w-5xl mx-auto tracking-normal text-gray-900 sm:text-6xl md:text-6xl lg:text-7xl md:tracking-tight">
                                Rent
                                <span
                                    class="w-full text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-blue-500 to-purple-500 lg:inline">The
                                    Best Car</span><br class="lg:block hidden" />with Affordable Prices.
                            </h1>
                            <p class="px-0 mb-6 text-lg text-gray-600 md:text-xl lg:px-24">
                                Explore a wide range of cars for your trips. From
                                luxury to economy, we have the perfect vehical for
                                every occasion.
                            </p>
                        </div>
                    </div>
                </section>

                <div class="flex grid grid-cols-12 pb-10 sm:px-5 gap-x-8 gap-y-16">
                    <div class="flex flex-col items-start col-span-12 space-y-3 sm:col-span-6 xl:col-span-4"
                        v-for="car in cars">
                        
                            <img class="h-48 w-96 object-cover mb-2 overflow-hidden rounded-lg shadow-sm max-h-56"
                                :src="`/${car.image}`" />
                        
                        <h2 class="text-lg font-bold sm:text-xl md:text-2xl">
                            {{ car.name }}
                        </h2>
                        <p class="text-sm text-gray-950">Brand: {{ car.brand }}</p>
                        <p class="text-sm text-gray-950">Daily Rent: {{ car.daily_rent_price }} BDT</p>
                        <a :href="`customer/car/${car.id}`">
                            <button type="button"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                                Rent Now
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </UnifiedLayout>
</template>
