<script setup>
import { usePage, router } from "@inertiajs/vue3";
import UnifiedLayout from "../../Layouts/UnifiedLayout.vue";
import AdminSideBar from "../../Layouts/AdminSideBar.vue";
const car = usePage().props.car
const goBack=()=>{
    window.history.length>1?window.history.back():router.visit('/')
}
</script>

<template>
    <UnifiedLayout>
        <div class="flex h-screen gap-8">
            <AdminSideBar />
            <!-- Show Car Start-->
            <div class="mx-auto">
                <div class="flex justify-end">
                    <button type="button" 
                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
                        @click="goBack">
                        Back
                    </button>
                </div>

                <div
                    class="rounded-lg overflow-hidden border border-neutral-200/60 bg-white text-neutral-700 shadow-sm w-[380px] h-fit">
                    <div class="relative">
                        <img :src="`/${car.image}`" class="w-full h-auto" />
                    </div>
                    <div class="p-7">
                        <button
                            class="inline-flex items-center justify-center w-full h-auto px-4 py-6 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">Car
                            Name -- {{ car.name }}<br>Car Brand -- {{ car.brand }}<br>Car Model -- {{ car.model }}<br>Year
                            of Manufacture -- {{ car.year }}<br>Car Type -- {{ car.car_type }}<br>Daily Rent -- {{ car.daily_rent_price }} BDT<br>Availability -- {{ car.availability === 1 ? "Available" : "Not Available"}}
                        </button>
                    </div>
                </div>
            </div>


            <!--Show Car End -->
        </div>
</UnifiedLayout></template>
