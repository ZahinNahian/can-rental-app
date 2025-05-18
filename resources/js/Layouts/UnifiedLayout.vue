<script setup>
import { usePage } from "@inertiajs/vue3";
import GuestLayout from "../Layouts/GuestLayout.vue"
import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.vue"
import FooterLayout from "../Layouts/FooterLayout.vue"

const auth=usePage().props.auth
// defineOptions({layout: auth.user? AuthenticatedLayout: GuestLayout})
</script>

<template>
    <component :is="auth.user ? AuthenticatedLayout : GuestLayout" />
    <slot />
    <FooterLayout />
</template>