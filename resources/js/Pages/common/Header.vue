<script setup>
import { computed } from 'vue'
import { Link, Head, useForm, usePage } from "@inertiajs/inertia-vue3";

// const props = defineProps({
//     title: String || '',
//     description: String || '',
// });

console.log(usePage().props.appName);

</script>
<template>
    <h1>{{ $page.props.appName }}</h1>
    <header>
        <Link href="/">Home</Link>
        <Link href="/login">Login</Link>
        <Link href="/register">Register</Link>
        <Link href="/users/dashboard">Dashboard</Link>
        <Link href="/logout">Logout</Link>
    </header>
</template>
<style scoped>
a {
    margin: 20px;
}
</style>