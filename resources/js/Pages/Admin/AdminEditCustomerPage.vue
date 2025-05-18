<script setup>
import { useForm, usePage, router } from "@inertiajs/vue3";
import UnifiedLayout from "../../Layouts/UnifiedLayout.vue";
import AdminSideBar from "../../Layouts/AdminSideBar.vue";
const css = "w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-500 focus:outline-none focus:ring-2 focus:ring-neutral-400"
const customer = usePage().props.customer
const form = useForm({
    name: customer.name,
    email: customer.email,
    password: "",
    password_confirmation: "",
    role: customer.role
})

function submit() {
    form.post('/admin/edit-customer/' + customer.id)
}

const goBack = () => {
    window.history.length > 1 ? window.history.back() : router.visit('/')
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
                <h2 class="text-xl font-semibold py-4">Edit Customer Details</h2>
                <form @submit.prevent="submit" class="w-full max-w-sm mx-auto space-y-4">
                    <!-- Name -->
                    <input v-model="form.name" type="text" name="name" placeholder="Name"
                        class="w-full h-10 px-3 py-2 text-sm border rounded-md border-neutral-300 placeholder:text-neutral-500 focus:ring-2 focus:ring-neutral-400" />

                    <!-- Email -->
                    <input v-model="form.email" type="email" name="email" placeholder="Email"
                        class="w-full h-10 px-3 py-2 text-sm border rounded-md border-neutral-300 placeholder:text-neutral-500 focus:ring-2 focus:ring-neutral-400" />

                    <!-- Password -->
                    <input v-model="form.password" type="password" name="password" placeholder="Password"
                        class="w-full h-10 px-3 py-2 text-sm border rounded-md border-neutral-300 placeholder:text-neutral-500 focus:ring-2 focus:ring-neutral-400" />

                    <!-- Confirm Password -->
                    <input v-model="form.password_confirmation" type="password" name="password_confirmation"
                        placeholder="Confirm Password"
                        class="w-full h-10 px-3 py-2 text-sm border rounded-md border-neutral-300 placeholder:text-neutral-500 focus:ring-2 focus:ring-neutral-400" />

                    <!-- Role -->
                    <select v-model="form.role" name="role"
                        class="w-full h-10 px-3 py-2 text-sm border rounded-md border-neutral-300 text-neutral-700 focus:ring-2 focus:ring-neutral-400">
                        <option value="" disabled selected>Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="customer">Customer</option>
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
