<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import UnifiedLayout from "../../Layouts/UnifiedLayout.vue";
import AdminSideBar from "../../Layouts/AdminSideBar.vue";
const cars=usePage().props.cars
console.log(cars);

</script>

<template>
    <UnifiedLayout>
        <div class="flex h-screen gap-8">
            <AdminSideBar />
            <!-- Table Start-->
            <div class="flex-1 flex-col overflow-y-auto px-10">
                <div class="flex justify-end mb-5">
                    <a href="/admin/add-car-page">
                        <button type="button"
                            class="flex flex-end px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                            + Add A Car
                        </button>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-neutral-200">
                                <thead>
                                    <tr class="text-neutral-500">
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                            SL
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                            Name
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                            Brand
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                            Model
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                            Year
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                            Car Type
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                            Daily Reat Price
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                            Availability
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">
                                            Image
                                        </th>
                                        <th class="px-5 py-3 text-xs font-medium text-right uppercase">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200">
                                    <tr class="text-neutral-800" v-for="(car, index) in cars.data" :key="car.id">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                            {{ index+1 }}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{ car.name }}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{ car.brand }}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{ car.model }}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{ car.year }}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{ car.car_type }}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{ car.daily_rent_price }}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            {{ car.availability===1 ? "Available" : "Not Available" }}
                                        </td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">
                                            <img :src="`/${car.image}`" alt="" class="h-12 w-32 object-cover">
                                        </td>
                                        <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <a class="text-blue-600 hover:text-blue-700" :href="`/admin/edit-car-page/${car.id}`">Edit</a>
                                            |
                                            <a class="text-blue-600 hover:text-blue-700" :href="`/admin/show-car-page/${car.id}`">Show</a>
                                            |
                                            <a class="text-blue-600 hover:text-blue-700" :href="`/admin/delete-car/${car.id}`">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!--Pagination start-->
                <div class="flex items-center justify-between w-full h-16 px-3 border-t border-neutral-200">
                    <p class="pl-2 text-sm text-gray-700">
                        Showing
                        <span class="font-medium">{{ cars.from }}</span>
                        to
                        <span class="font-medium">{{ cars.to }}</span>
                        of
                        <span class="font-medium">{{ cars.total }}</span> results
                    </p>

                    <nav v-if="cars.links.length > 3">
                        <ul
                            class="flex items-center text-sm leading-tight bg-white border divide-x rounded h-9 text-neutral-500 divide-neutral-200 border-neutral-200">
                            <li v-for="(link, index) in cars.links" :key="index" class="h-full">
                                <component :is="link.url ? Link : 'span'" :href="link.url" v-html="link.label"
                                    class="relative inline-flex items-center h-full px-3 group" :class="{
                                        'text-neutral-900 bg-gray-50 font-medium': link.active,
                                        'hover:text-neutral-900': link.url && !link.active,
                                        'cursor-default text-gray-400': !link.url
                                    }" />
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--Pagination End-->
            </div>
            <!--Table End -->
        </div>
    </UnifiedLayout>
</template>
