<script setup>
import { useForm, usePage, router } from "@inertiajs/vue3";
import UnifiedLayout from "../../Layouts/UnifiedLayout.vue";
import AdminSideBar from "../../Layouts/AdminSideBar.vue";
const css = "w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-neutral-400"
const car = usePage().props.car
const form = useForm({
    name: car.name,
    brand: car.brand,
    model: car.model,
    year: car.year,
    car_type: car.car_type,
    daily_rent_price: car.daily_rent_price,
    availability: car.availability,
    image: null
})

function submit() {
    form.post('/admin/edit-car/' + car.id)
}

const goBack=()=>{
    window.history.length>1?window.history.back():router.visit('/')
}
</script>

<template>
    <UnifiedLayout>
        <div class="flex h-fit gap-8">
            <AdminSideBar />
            <!-- Add Car Form Start-->
            <div class="max-w-md mx-auto bg-white rounded-md mb-5">
                <div class="flex justify-end">
                    <button type="button"
                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none"
                        @click="goBack">
                        Back
                    </button>
                </div>
                <h2 class="text-xl font-semibold py-4">Edit Car Details</h2>
                <form @submit.prevent="submit" class="space-y-4">
                    <!-- Name -->
                    <input type="text" name="name" placeholder="Name" :class="`${css}`" v-model="form.name" />

                    <!-- Brand -->
                    <input type="text" name="brand" placeholder="Brand" :class="`${css}`" v-model="form.brand" />

                    <!-- Model -->
                    <input type="text" name="model" placeholder="Model" :class="`${css}`" v-model="form.model" />

                    <!-- Year -->
                    <input type="number" name="year" placeholder="Year" :class="`${css}`" v-model="form.year" />

                    <!-- Car Type -->
                    <input type="text" name="car_type" placeholder="Car Type" :class="`${css}`" v-model="form.car_type" />

                    <!-- Daily Rent Price -->
                    <input type="number" name="daily_rent_price" step="0.01" placeholder="Daily Rent Price"
                        :class="`${css}`" v-model="form.daily_rent_price" />

                    <!-- Availability -->
                    <select name="availability" :class="`${css}`" v-model="form.availability">
                        <option value="" disabled selected>Select Availability</option>
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </select>

                    <!-- Image -->
                    <img :src="`/${car.image}`" alt="" class="h-14 w-32 object-scale-down">
                    <input type="file" name="image" placeholder="Image URL"
                        class="w-full h-10  py-2 text-sm placeholder:text-neutral-500"
                        @change="(e) => form.image = e.target.files[0]" />

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900">
                        Add Car
                    </button>
                </form>

            </div>

            <!--Add Car Form End -->
        </div>
    </UnifiedLayout>
</template>
