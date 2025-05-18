<script setup>
import UnifiedLayout from "../Layouts/UnifiedLayout.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
 const toaster=createToaster()
const car = usePage().props.car;

const form = useForm({
  car_id: car.id,
  start_date: '',
  end_date: '',
});

const submit = () => {
  form.post(`/customer/car-rent/${car.id}`, {
    onSuccess: () => {
      toaster.success(usePage().props.flash.message);
    },
  });
};
</script>

<template>
    <UnifiedLayout>
        <section class="px-2 py-14 bg-white md:px-0">
            <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
                <div class="flex items-center gap-5 sm:-mx-3">

                    <!--Left Side Start-->
                    <div class="w-full md:w-1/2">
                        <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl"
                            data-rounded="rounded-xl" data-rounded-max="rounded-full">
                            <img :src="`/${car.image}`" />
                        </div>
                    </div>
                    <!--Left Side End-->

                    <!--Right Side Start-->
                    <div class="w-full md:w-1/2 md:px-3">
                        <div
                            class="w-full pb-6 space-y-6 sm:max-w-md lg:max-w-lg md:space-y-4 lg:space-y-8 xl:space-y-9 sm:pr-5 lg:pr-0 md:pb-0">
                            <h1
                                class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl">
                                <span class="block xl:inline">{{car.name}}</span>
                            </h1>
                            <p class="mx-auto text-base text-gray-500">
                                Model: <strong>{{car.model}}</strong><br>
                                Brand: <strong>{{car.brand}}</strong><br>
                                Year: <strong>{{car.year}}</strong><br>
                                Type: <strong>{{car.car_type}}</strong><br>
                                Daily Rent: <strong>$ {{car.daily_rent_price}}</strong><br>
                            </p>
                            <form @submit.prevent="submit" class="flex flex-col">
                                <div class="flex flex-row items-center gap-1">
                                    <label for="startdate">Start Date:  </label>
                                    <!-- <input type="date" v-model="startDate" class="border" id="start_date" min="2025-05-05" onfocus="this.min" /><br> -->
                                    <input type="date" v-model="form.start_date" class="border" id="startdate" onfocus="this.min=new Date().toISOString().split('T')[0]" /><br>
                                    <label for="enddate">End Date: </label>
                                    <input type="date" v-model="form.end_date" class="border" id="enddate" onfocus="this.min=new Date().toISOString().split('T')[0]" /><br>
                                </div>

                                <button type="submit"
                                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none w-40 mx-auto my-3">
                                    Book Now
                                </button>
                            </form>

                        </div>
                    </div>
                    <!--Right Side End-->

                </div>
            </div>
        </section>
    </UnifiedLayout>
</template>
