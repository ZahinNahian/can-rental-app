<script setup>
import { useForm, usePage } from "@inertiajs/vue3"
import UnifiedLayout from "../Layouts/UnifiedLayout.vue"
const cars = usePage().props.cars
const filters=usePage().props.filters
const allCarTypes=usePage().props.allCarTypes
const allBrands=usePage().props.allBrands
const form = useForm({
    car_type: filters.car_type?filters.car_type:"",
    brand: filters.brand?filters.brand:"",
    daily_rent_price: filters.daily_rent_price?filters.daily_rent_price:"",
})
console.log(cars);
function submit() {
    form.get('/rentals')
}

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
                                Available
                                <span
                                    class="w-full text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-blue-500 to-purple-500 lg:inline">
                                    Cars For</span><br class="lg:block hidden" />Rent
                            </h1>
                        </div>
                    </div>
                </section>
                <!--Search Section Start-->
                <section>
                    <form @submit.prevent="submit" class="grid grid-cols-4 gap-6">
                        <div class="w-full max-w-xs mx-auto">
                            <select
                                class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                                v-model="form.car_type">
                                <option value="">All Car Type</option>
                                <option :value="CarType" v-for="CarType in allCarTypes">{{ CarType }}</option>
                                
                            </select>
                        </div>

                        <div class="w-full max-w-xs mx-auto">
                            <select
                                class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                                v-model="form.brand">
                                <option value="">All Brands</option>
                                <option :value="Brand" v-for="Brand in allBrands">{{ Brand }}</option>
                            </select>
                        </div>
                        <div class="w-full max-w-xs mx-auto">
                            <input type="text" placeholder="Max Dily Rent Price"
                                class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"
                                v-model="form.daily_rent_price" />
                        </div>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                            Search
                        </button>
                    </form>
                </section>
                <!--Search Section End-->

                <div class="flex grid grid-cols-12 pb-10 sm:px-5 gap-x-8 gap-y-16">
                    <div class="flex flex-col items-start col-span-12 space-y-3 sm:col-span-6 xl:col-span-4"
                        v-for="(car, index) in cars.data" :key="car.id">
                        
                        <img class="object-cover w-full mb-2 overflow-hidden rounded-lg shadow-sm max-h-56"
                                :src="`/${car.image}`" />
                        
                        <h2 class="text-lg font-bold sm:text-xl md:text-2xl">
                            {{ car.name }}
                        </h2>
                        <p class="text-sm text-gray-950">Brand: {{ car.brand }}</p>
                        <p class="text-sm text-gray-950">Daily Rent: {{ car.daily_rent_price }}$</p>
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
</UnifiedLayout></template>