<script setup>
import { reactive } from "vue";
import { Link, Head, useForm, usePage } from "@inertiajs/inertia-vue3";

const form = useForm({
  email: "sayedulsayem@gmail.com",
  password: "sayedul",
  remember: true,
});

const login = () => {
  form.post("/login");
};
</script>
<template>
  <Head title="Login" />
  <div class="flex items-center min-h-screen bg-[#f3f3f6]">
    <div class="flex-1 h-full max-w-3xl mx-auto">
      <div class="flex justify-center my-10">
        <img
          width="180"
          src="logo.svg"
          alt="Logo"
        />
      </div>
      <div
        class="flex bg-white rounded-xl drop-shadow-[0_0_100px_rgba(0,0,0,0.05)] mb-10"
      >
        <div class="flex items-center justify-center px-20 py-12 md:w-full">
          <div class="w-full">
            <h1 class="text-3xl font-bold text-center text-[#1E1E3C] mb-6">
              Login
            </h1>
            <div
              class="flex items-center space-x-2 justify-center mb-12 text-sm"
            >
              <span class="text-[#828282]"> Don’t have an account yet? </span>
              <Link href="/register" class="font-medium hover:underline"
                >Create New Account</Link
              >
            </div>
            <form @submit.prevent="login">
              <div class="mb-5">
                <input
                  v-model="form.email"
                  type="email"
                  class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
                  placeholder="Email"
                />
                <div  v-if="form.errors.email" class="text-sm text-[#E8374D] mt-2">{{ form.errors.email }}</div>
              </div>
              <div class="mb-5">
                <input
                  v-model="form.password"
                  class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
                  placeholder="Password"
                  type="password"
                />
                <div  v-if="form.errors.password" class="text-sm text-[#E8374D] mt-2">{{ form.errors.password }}</div>
              </div>

              <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                  <div class="flex items-center h-5">
                    <input
                      v-model="form.remember"
                      id="remember-me"
                      type="checkbox"
                      class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                    />
                  </div>
                  <label
                    for="remember-me"
                    class="ml-2 text-sm font-medium text-[#1E1E3C]"
                    >Remember Me</label
                  >
                </div>
              </div>

              <div v-if="$page.props.flash.message" class="text-sm text-[#E8374D] mb-10">{{ $page.props.flash.message }}</div>
              
              <button
                type="submit"
                class="mb-10 block w-full px-4 py-3 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-[#E79073] rounded-md active:bg-[#1E1E3C] hover:bg-[#1E1E3C] focus:outline-none"
                :disabled="form.processing"
              >
                Sign In
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
</style>