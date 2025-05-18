<script setup>
import { useForm, usePage, router } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import UnifiedLayout from "../../Layouts/UnifiedLayout.vue";
import AdminSideBar from "../../Layouts/AdminSideBar.vue";
const css = "w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-neutral-400"
const cars = usePage().props.cars
const customers = usePage().props.customers
const toaster = createToaster({ useDefaultCss: false });
// const toaster = createToaster();
const rental=usePage().props.rental
const form = useForm({
    user_id: rental.user.id,
    car_id: rental.car.id,
    start_date: rental.start_date,
    end_date: rental.end_date,
    total_cost: rental.total_cost,
    status:rental.status
})

function calculateCost() {
    if (!form.car_id || !form.start_date || !form.end_date) return;
    const car = cars.find((car) => car.id === form.car_id)
    const start = new Date(form.start_date)
    const end = new Date(form.end_date)
    const timeDiff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1
    if (timeDiff > 0 && car) {
        form.total_cost = timeDiff * car.daily_rent_price
    } else {
        form.total_cost = 0
    }
}

function submit() {
    if (form.user_id.length===0) {
        toaster.success("Add a Customer Name")
    } else if (form.car_id.length===0) {
        toaster.success("Add a Car Name")
    } else if (form.start_date.length===0) {
        toaster.success("Add Start Date")
    } else if (form.end_date.length===0) {
        toaster.success("Add End Date")
    } else if (new Date(form.start_date)>new Date(form.end_date)) {
        toaster.success("Date Range Is Wrong")
    }else if (form.total_cost.length===0) {
        toaster.success("Add Total Cost")
    } else if (form.status.length===0) {
        toaster.success("Add The Status")
    } else {
            form.post(`/admin/edit-rental/${rental.id}`, {
                onSuccess:()=>{
                    toaster.success(usePage().props.flash.message)
            }
        })
    }

}


const goBack = () => {
    window.history.length > 1 ? window.history.back() : router.visit('/')
}

// console.log(message);

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
                <h2 class="text-xl font-semibold py-4">Add A Rental Manually</h2>
                <!--Form Start-->
                <form @submit.prevent="submit" class="w-full max-w-sm mx-auto space-y-4">

                    <!-- Customer Select -->
                    <select v-model="form.user_id" name="customer_name" :class="`${css}`">
                        <option value="" disabled selected>Select Customer</option>
                        <option :value="customer.id" v-for="(customer, index) in customers" :key="customer.id">{{
                            customer.name }}</option>
                    </select>
                    <!-- Car Select -->
                    <select v-model="form.car_id" @change="calculateCost" name="car_name" :class="`${css}`">
                        <option value="" disabled>Select Car</option>
                        <option :value="car.id" v-for="(car, index) in cars" :key="car.id">{{ car.name }}</option>
                    </select>

                    <!-- Start Date -->
                    <label for="start_date" class="block text-sm font-medium text-gray-700">
                        Start Date
                    </label>
                    <input type="date" v-model="form.start_date" @change="calculateCost"
                        onfocus="this.min=new Date().toISOString().split('T')[0]" :class="`${css}`" id="start_date" />

                    <!-- End Date -->
                    <label for="end_date" class="block text-sm font-medium text-gray-700">
                        End Date
                    </label>
                    <input type="date" v-model="form.end_date" @change="calculateCost"
                        onfocus="this.min=new Date().toISOString().split('T')[0]" :class="`${css}`" id="end_date" />

                    <!-- Total Cost -->
                    <input v-model="form.total_cost" type="number" name="total_cost" placeholder="Total Cost"
                        :class="`${css}`" />

                    <!-- Status -->
                    <select v-model="form.status" name="status" :class="`${css}`">
                        <option value="" disabled selected>Select Status</option>
                        <option value="pending">Pending</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                        <option value="canceled">Canceled</option>
                    </select>


                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-neutral-800 hover:bg-neutral-900 text-white py-2 px-4 rounded-md text-sm font-medium">
                        Register
                    </button>
                </form>
            </div>
            <!--Add Car Form End -->
        </div>
    </UnifiedLayout>
</template>

<style>
/* .c-toast-container {
  z-index: 50;
  padding: 1rem;
} */


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
