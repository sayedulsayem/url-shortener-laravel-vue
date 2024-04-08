<script setup>
import { Link, Head, usePage } from "@inertiajs/inertia-vue3";
import Header from "../common/Header.vue";
const props = defineProps({
  user: Object,
});
// console.log(usePage().props);
</script>
<template>
  <Head title="Users Dashboard" />
  <Header />
  <h1>This is User Dashboard</h1>
  <!-- <p>{{ user }}</p> -->
  <p>{{ $page.props.auth.user }}</p>
</template>
<style scoped>
h1 {
  color: red;
}
</style>