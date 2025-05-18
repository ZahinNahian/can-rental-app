<script setup>
import UnifiedLayout from '../../Layouts/UnifiedLayout.vue';
import CustomerSideBar from "../../Layouts/CustomerSideBar.vue"
import { usePage, router } from "@inertiajs/vue3";
const rentals = usePage().props.rentals
</script>

<template>
    <UnifiedLayout>
        <div class="flex h-screen gap-8">
            <CustomerSideBar />
            <!-- Table Start-->
           <div class="flex-1 flex-col overflow-y-auto px-10">
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-neutral-200">
                                <thead>
                                    <tr class="text-neutral-500">
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">SL</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Car Name</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Car Brand</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Start Date</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">End Date</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Total Cost</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Status</th>

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200">
                                    <tr class="text-neutral-800" v-for="(rental, index) in rentals" :key="rental.id">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">{{ index + 1 }}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{ rental.car.name }}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{ rental.car.brand }}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{ rental.start_date }}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{ rental.end_date }}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{ rental.total_cost }}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{ rental.status }}</td>
                                        <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--Table End -->
        </div>
    </UnifiedLayout>
</template>