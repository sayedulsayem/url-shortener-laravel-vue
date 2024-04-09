<script setup>
import { Link, Head } from "@inertiajs/inertia-vue3";
import icons from "../utilities/icons";
import md5 from "md5";
const props = defineProps({
  user: Object,
});
</script>

<template>

  <Head :title="$page.component" />
  <div class="flex h-screen antialiased text-gray-700">
    <div
      class="fixed- inset-y-0 z-20 flex-shrink-0 w-52 pb-4 overflow-auto- text-white bg-[#1E1E3C] lg:static hidden lg:block">
      <Link href="/" class="pl-6 mb-3 mt-2 flex">
      <span class="w-10 h-10" v-html="icons.logo"></span>
      </Link>
      <ul class="flex flex-col flex-grow px-2 py-4 overflow-auto">
        <li>
          <Link href="/"
            class="p-2.5 mt-2 flex items-center justify-between rounded-md px-4 duration-300 hover:bg-white hover:text-[#1E1E3C]"
            :class="($page.url == '/' || $page.url.startsWith('/visitors')) ? 'bg-white text-[#1E1E3C]' : 'text-white'">
          <div class="flex items-center">
            <span class="w-4 h-4" v-html="icons.dashboard"></span><span class="text-[15px] ml-2">Dashboard</span>
          </div>
          </Link>
        </li>
        <li>
          <Link href="/urls"
            class="p-2.5 mt-2 flex items-center justify-between rounded-md px-4 duration-300 hover:bg-white hover:text-[#1E1E3C]"
            :class="$page.url == '/urls' ? 'bg-white text-[#1E1E3C]' : 'text-white'">
          <div class="flex items-center">
            <span class="w-4 h-4" v-html="icons.urls"></span><span class="text-[15px] ml-2">Urls</span>
          </div>
          </Link>
        </li>
        <li>
          <Link href="/profile"
            class="p-2.5 mt-2 flex items-center justify-between rounded-md px-4 duration-300 hover:bg-white hover:text-[#1E1E3C]"
            :class="$page.url == '/profile' ? 'bg-white text-[#1E1E3C]' : 'text-white'">
          <div class="flex items-center">
            <span class="w-4 h-4" v-html="icons.profile"></span><span class="text-[15px] ml-2">Profile</span>
          </div>
          </Link>
        </li>
        <li>
          <Link href="/logout"
            class="p-2.5 mt-2 flex items-center justify-between rounded-md px-4 duration-300 hover:bg-white hover:text-[#1E1E3C] text-white">
          <div class="flex items-center">
            <span class="w-4 h-4" v-html="icons.logout"></span><span class="text-[15px] ml-2">Logout</span>
          </div>
          </Link>
        </li>
      </ul>
    </div>
    <div class="flex flex-col flex-grow">
      <div class="flex items-center flex-shrink-0 h-16 px-6 bg-[#F3F3F6]">
        <div class="flex items-center justify-between">
          <h2 class="text-xl text-[#1E1E3C] font-bold">{{ $page.component }}</h2>
          <Link v-if="$page.url != '/urls'" href="/urls"
            class="ml-10 flex items-center bg-[#1E1E3C] hover:bg-[#E79073] hover:text-white px-6 py-3 text-xs leading-5 rounded-md font-bold text-white">
          Add New URL</Link>
        </div>
        <div class="flex items-center ml-auto">
          <div class="ml-auto text-right">
            <h2 class="text-[13px] font-bold text-[#1E1E3C]">
              {{ $page.props.auth.user.name }}
            </h2>
            <span class="flex text-[12px] items-center space-x-1 text-[#B9B9B9]">{{ $page.props.auth.user.email
              }}</span>
          </div>
          <img :src="`https://www.gravatar.com/avatar/${md5(
    $page.props.auth.user.email
  )}?s=30`" alt="User Avatar" class="w-7 h-7 rounded-full bg-gray-500 ml-3 mr-2" />
        </div>
      </div>
      <div class="flex-grow p-6 pt-4 overflow-auto bg-[#F3F3F6]">
        <slot />
      </div>
    </div>
  </div>
</template>