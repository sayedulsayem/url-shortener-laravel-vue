<script setup>
import { Link, Head, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
  name: "",
  username: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const register = () => {
  form.post("/register");
  form.reset();
};
</script>
<template>

  <Head title="Register" />
  <div class="flex items-center min-h-screen bg-[#f3f3f6]">
    <div class="flex-1 h-full max-w-3xl mx-auto">
      <div class="flex justify-center my-10">
        <img width="180" src="logo.svg" alt="Logo" />
      </div>
      <div class="flex bg-white rounded-xl drop-shadow-[0_0_100px_rgba(0,0,0,0.05)] mb-10">
        <div class="flex items-center justify-center px-20 py-12 md:w-full">
          <div class="w-full">
            <h1 class="text-3xl font-bold text-center text-[#1E1E3C] mb-6">
              Register
            </h1>
            <div class="flex items-center space-x-2 justify-center mb-12 text-sm">
              <span class="text-[#828282]"> Already have an account? </span>
              <Link href="/login" class="font-medium hover:underline">Sign in</Link>
            </div>
            <form @submit.prevent="register">
              <div class="mb-5">
                <input v-model="form.name" type="text"
                  class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
                  placeholder="Name" />
                <div v-if="form.errors.name" class="text-sm text-[#E8374D] mt-2">
                  {{ form.errors.name }}
                </div>
              </div>
              <div class="mb-5">
                <input v-model="form.username" type="text"
                  class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
                  placeholder="Username" />
                <div v-if="form.errors.username" class="text-sm text-[#E8374D] mt-2">
                  {{ form.errors.username }}
                </div>
              </div>
              <div class="mb-5">
                <input v-model="form.email" type="email"
                  class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
                  placeholder="Email" />
                <div v-if="form.errors.email" class="text-sm text-[#E8374D] mt-2">
                  {{ form.errors.email }}
                </div>
              </div>
              <div class="mb-5">
                <input v-model="form.password"
                  class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
                  placeholder="Password" type="password" />
                <div v-if="form.errors.password" class="text-sm text-[#E8374D] mt-2">
                  {{ form.errors.password }}
                </div>
              </div>
              <div class="mb-5">
                <input v-model="form.password_confirmation"
                  class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
                  placeholder="Confirm Password" type="password" />
                <div v-if="form.errors.password_confirmation" class="text-sm text-[#E8374D] mt-2">
                  {{ form.errors.password_confirmation }}
                </div>
              </div>

              <div v-if="$page.props.flash.message" class="text-sm mt-2"
                :class="$page.props.flash.status ? 'text-[#27AE60]' : 'text-[#E8374D]'">{{ $page.props.flash.message }}
              </div>

              <button type="submit"
                class="mb-10 block w-full px-4 py-3 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-[#E79073] rounded-md active:bg-[#1E1E3C] hover:bg-[#1E1E3C] focus:outline-none"
                :disabled="form.processing">
                Sign Up
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>