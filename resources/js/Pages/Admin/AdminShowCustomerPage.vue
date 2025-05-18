<script setup>
import { usePage, Link, router } from "@inertiajs/vue3";
import UnifiedLayout from '../../Layouts/UnifiedLayout.vue';
import AdminSideBar from "../../Layouts/AdminSideBar.vue"
import { createToaster } from "@meforma/vue-toaster";
const customers = usePage().props.customers
// const links=usePage().props.customers.links
// console.log(links);
const user = usePage().props.user
const rentals = usePage().props.rentals
function goBack() {
  window.history.length > 1 ? window.history.back() : router.visit('/')
}
const toaster=createToaster({useDefaultCss:false})
function deleteRental(id) {
    router.visit(`/admin/delete-rental/${id}`,{
        onSuccess:()=>{
            toaster.success(usePage().props.flash.message)
        }
    })
}
</script>

<template>
    <UnifiedLayout>
        <div class="flex h-screen gap-8">
            <AdminSideBar />
            <!-- Table Start-->
            <div class="flex-1 flex-col overflow-y-auto px-10">
                <div class="flex justify-end my-5">
                        <button type="button"
                            class="flex flex-end px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none" @click="goBack">
                            Back
                        </button>
                </div>
                <div class="overflow-x-auto">
                    <h1><strong>Customer Name- {{ user.name }}</strong></h1>
                    <h1><strong>Customer Email- {{ user.email }}</strong></h1>
                    <h1>Rental History------------------------------------</h1>
                    <div class="inline-block min-w-full">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-neutral-200">
                                <thead>
                                    <tr class="text-neutral-500">
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">SL</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Car Name</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Start Date</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">End Date</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Total Cost</th>
                                        <th class="px-5 py-3 text-xs font-medium text-left uppercase">Status</th>
                                        <th class="px-5 py-3 text-xs font-medium text-right uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200">
                                    <tr class="text-neutral-800" v-for="(rental, index) in rentals" :key="rental.id">
                                        <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">{{ index + 1 }}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{ rental.car.name }}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{ rental.start_date }}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{ rental.end_date }}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{ rental.total_cost }}</td>
                                        <td class="px-5 py-4 text-sm whitespace-nowrap">{{ rental.status }}</td>
                                        <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <a class="text-blue-600 hover:text-blue-700"
                                                :href="`/admin/edit-rental-page/${rental.id}`">Edit</a> |
                                            <button class="text-blue-600 hover:text-blue-700" @click="deleteRental(rental.id)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!--Pagination Start-->
                <!-- <div class="flex items-center justify-between w-full h-16 px-3 border-t border-neutral-200">
                    <p class="pl-2 text-sm text-gray-700">
                        Showing
                        <span class="font-medium">{{ customers.from }}</span>
                        to
                        <span class="font-medium">{{ customers.to }}</span>
                        of
                        <span class="font-medium">{{ customers.total }}</span> results
                    </p>

                    <nav v-if="customers.links.length > 3">
                        <ul
                            class="flex items-center text-sm leading-tight bg-white border divide-x rounded h-9 text-neutral-500 divide-neutral-200 border-neutral-200">
                            <li v-for="(link, index) in customers.links" :key="index" class="h-full">
                                <component :is="link.url ? Link : 'span'" :href="link.url" v-html="link.label"
                                    class="relative inline-flex items-center h-full px-3 group" :class="{
                                        'text-neutral-900 bg-gray-50 font-medium': link.active,
                                        'hover:text-neutral-900': link.url && !link.active,
                                        'cursor-default text-gray-400': !link.url
                                    }" />
                            </li>
                        </ul>
                    </nav>
                </div> -->
                <!--Pagination End-->
            </div>
            <!--Table End -->
        </div>
    </UnifiedLayout>
</template>
<style>
.c-toast {
  border-radius: 0.375rem;
  border: 1px solid #c54a4a;
  background-color: #ffffff;
  padding: 1rem;
  box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
  font-weight: 500;
  color: #c54a4a;
  margin-top: 20px;
  }
</style>