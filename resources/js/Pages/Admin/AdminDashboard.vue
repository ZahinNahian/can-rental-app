<script setup>
import { usePage } from "@inertiajs/vue3";
import AdminSideBar from "../../Layouts/AdminSideBar.vue"
import UnifiedLayout from "../../Layouts/UnifiedLayout.vue"
const totalcars=usePage().props.totalcars
const availablecars=usePage().props.availablecars
const rentals=usePage().props.rentals
const reveneu=usePage().props.reveneu


import Card from "../../Components/Card.vue"
</script>

<template>
  <UnifiedLayout>

    
  <div class="flex h-screen gap-8">
    <AdminSideBar />

    <div class="flex-1 grid grid-cols-4 gap-5">
      <Card title="Total Cars" :number="totalcars" />
      <Card title="Available Cars" :number="availablecars" />
      <Card title="Total Rentals" :number="rentals" />
      <Card title="Total Earnings" :number="reveneu" />
    </div>


  </div>
  </UnifiedLayout>
</template>