<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import Layout from "../components/Layout.vue";
const props = defineProps({
  user: Object,
});

const form = useForm({
  name: props.user.name,
  username: props.user.username,
  email: props.user.email,
  use_prefix: (1 == props.user.use_prefix) ? true : false,
  old_password: "",
  password: "",
  password_confirmation: "",
});

const updateUserInfo = () => {
  form.post("/profile");
};

</script>
<template>
  <Layout>
    <div class="bg-white rounded-md p-5">
      <form @submit.prevent="updateUserInfo" class="w-6/12 mx-auto my-0 pt-10">
        <div class="mb-5">
          <label class="mb-2 block">Name: </label>
          <input v-model="form.name" type="text"
            class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
            placeholder="Name" />
          <div v-if="form.errors.name" class="text-sm text-[#E8374D] mt-2">
            {{ form.errors.name }}
          </div>
        </div>
        <div class="mb-5">
          <label class="mb-2 block">Username: </label>
          <input v-model="form.username" type="text"
            class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
            placeholder="Username" />
          <div v-if="form.errors.username" class="text-sm text-[#E8374D] mt-2">
            {{ form.errors.username }}
          </div>
        </div>
        <div class="mb-5">
          <label class="mb-2 block">Email: </label>
          <input :value="form.email" type="email"
            class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
            disabled placeholder="Email" />
          <div v-if="form.errors.email" class="text-sm text-[#E8374D] mt-2">
            {{ form.errors.email }}
          </div>
        </div>
        <div class="mb-5">
          <label class="mb-2 block">Old Password: </label>
          <input v-model="form.old_password"
            class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
            placeholder="Old Password" type="password" />
          <div v-if="form.errors.old_password" class="text-sm text-[#E8374D] mt-2">
            {{ form.errors.old_password }}
          </div>
        </div>
        <div class="mb-5">
          <label class="mb-2 block">New Password: </label>
          <input v-model="form.password"
            class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
            placeholder="Password" type="password" />
          <div v-if="form.errors.password" class="text-sm text-[#E8374D] mt-2">
            {{ form.errors.password }}
          </div>
        </div>
        <div class="mb-5">
          <label class="mb-2 block">Confirm Password: </label>
          <input v-model="form.password_confirmation"
            class="w-full px-4 py-3 text-sm border border-[#E0E0E0] rounded-md focus:border-[#1E1E3C] focus:outline-none focus:ring-1 focus:ring-[#1E1E3C]"
            placeholder="Confirm Password" type="password" />
          <div v-if="form.errors.password_confirmation" class="text-sm text-[#E8374D] mt-2">
            {{ form.errors.password_confirmation }}
          </div>
        </div>

        <div class="mb-5">
          <div class="flex items-center">
            <div class="flex items-center h-5">
              <input v-model="form.use_prefix" id="use_prefix" type="checkbox"
                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
            </div>
            <label for="use_prefix" class="ml-2 text-sm font-medium text-[#1E1E3C]">Use Username as prefix on Short
              Urls</label>
          </div>
          <div v-if="form.use_prefix" class="text-sm text-gray mt-3">Your short url will be like
            <code>{{ $page.props.appUrl + "/" + form.username + "/<code>" }}</code>
          </div>
          <div v-if="form.errors.use_prefix" class="text-sm text-[#E8374D] mt-2">
            {{ form.errors.use_prefix }}
          </div>
        </div>

        <div v-if="$page.props.flash.message" class="text-sm mb-5"
          :class="$page.props.flash.status ? 'text-[#27AE60]' : 'text-[#E8374D]'">{{ $page.props.flash.message }}
        </div>

        <button type="submit"
          class="mb-10 block w-full px-4 py-3 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-[#E79073] rounded-md active:bg-[#1E1E3C] hover:bg-[#1E1E3C] focus:outline-none"
          :disabled="form.processing">
          Update
        </button>
      </form>
    </div>
  </Layout>
</template>
<style scoped></style>