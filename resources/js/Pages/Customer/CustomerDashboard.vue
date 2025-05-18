<script setup>
import CustomerSideBar from "../../Layouts/CustomerSideBar.vue"
import UnifiedLayout from "../../Layouts/UnifiedLayout.vue"
import Card from "../../Components/Card.vue"
import { usePage } from "@inertiajs/vue3";
const rentals = usePage().props.rentals;
</script>

<template>
  <UnifiedLayout>

    
  <div class="flex h-screen gap-8">
    <CustomerSideBar />

    <div class="flex-1 grid grid-cols-4 gap-5">
      <Card title="Total Rentals" :number="rentals" />
      <Card title="Available Cars" :number="rentals" />
      <Card title="Total Rentals" :number="rentals" />
    </div>


  </div>
  </UnifiedLayout>
</template>