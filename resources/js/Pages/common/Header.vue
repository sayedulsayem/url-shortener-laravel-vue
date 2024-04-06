<script setup>
import { Link, Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
    title: String || '',
    description: String || '',
});

</script>
<template>
    <Head>
        <title>{{ props.title }}</title>
        <meta name="description" :content="description">
    </Head>
    <header>
        <Link href="/">Home</Link>
        <Link href="/login">Login</Link>
        <Link href="/register">Register</Link>
        <Link href="/users/dashboard">Dashboard</Link>
    </header>
</template>
<style scoped>
a {
    margin: 20px;
}
</style>