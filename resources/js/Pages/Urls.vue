<script setup>
import { ref } from 'vue';
import md5 from "md5";
import { Link, Head, usePage, useForm } from "@inertiajs/inertia-vue3";
import icons from "../utilities/icons";
import fn from "../utilities/functions";
import Layout from "../components/Layout.vue";

const props = defineProps({
  urls: Object,
});

const form = useForm({
  url: "",
});

const store = () => {
  form.post("/urls");
  form.reset();
};

const getCounterText = () => {
  const urls = props.urls.length;
  return (urls > 1) ? `${urls} URLs` : `${urls} URL`;
}

const copyText = ref('Copy');
const copyToClipboard = (event, text) => {
  navigator.clipboard.writeText(text);
  copyText.value = 'Copied!';
  setTimeout(() => {
    copyText.value = 'Copy';
  }, 2000);
}

const deleteUrl = (id) => {
  if (confirm('Are you sure you want to delete this URL?')) {
    form.reset();
    form.delete(`/urls/${id}`);
    form.reset();
  }
}

</script>
<template>
  <Layout>
    <div class="bg-white rounded-md p-5">
      <form class="pt-[30px]" @submit.prevent="store">
        <div class="flex mb-3 w-8/12 mx-auto">
          <div class="relative w-full mr-3">
            <input v-model="form.url" type="text"
              class="form-control py-4 px-4 block w-full text-[15px] font-[400] text-gray-700 bg-white border border-solid border-[#E0E0E0] rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-gray-700 focus:outline-none"
              placeholder="Enter site url" />
            <div v-if="form.errors.url" class="text-sm text-[#E8374D] mt-2">{{ form.errors.url }}</div>
            <div v-if="$page.props.flash.message" class="text-sm mt-2"
              :class="$page.props.flash.status ? 'text-[#27AE60]' : 'text-[#E8374D]'">{{ $page.props.flash.message }}
            </div>
          </div>
          <div>
            <input type="submit"
              class="cursor-pointer text-white bg-[#D54752] hover:bg-[#4c5564] focus:ring-[#4c5564] font-bold rounded px-8 py-4 text-[16px] text-center focus:outline-none focus:ring-0"
              value="Add Url" />
          </div>
        </div>
      </form>
      <div class="container-full py-10 mx-auto">
        <h2 class="text-lg font-bold mb-4 flex justify-between">
          <div>
            <div class="flex justify-between items-center">
              <h2>Your Short URLs</h2>
            </div>
          </div>
          <p><span>{{ getCounterText() }}</span></p>
        </h2>
        <table class="table-auto w-full plugins">
          <thead>
            <tr class="border-b-gray-300 border-b text-sm text-gray-700 text-left">
              <th scope="col" id="name" class="px-4 py-3 text-gray-500 manage-column column-name column-primary"
                style="width: 40%">
                Original URL
              </th>
              <th scope="col" id="description" class="px-4 py-3 text-gray-500 manage-column column-description">
                Short URL
              </th>
              <th scope="col" id="description" class="px-4 py-3 text-gray-500 manage-column column-description">
                Views
              </th>
              <th scope="col" id="auto-updates" class="px-4 py-3 text-gray-500 manage-column column-auto-updates">
                Action
              </th>
            </tr>
          </thead>
          <tbody id="the-tokens" class="text-sm font-normal text-gray-700">
            <tr v-for="url in urls" :key="url.id" class="border-b border-gray-200 py-10">
              <td class="px-4 py-3 plugin-title column-primary" width="40%">
                <span class="text-gray-600">{{ url.url }}</span>
              </td>
              <td class="px-4 py-3 column-description desc">
                <div class="plugin-description text-gray-600 flex justify-start items-center">
                  <span>{{ fn.getShortUrl($page.props.appUrl, url.code, $page.props.auth.user) }}</span>
                  <span @click="copyToClipboard($event, fn.getShortUrl($page.props.appUrl, url.code, $page.props.auth.user))"
                    class="ml-4 text-gray-400 relative flex flex-col items-center cursor-pointer group focus:ring-0">
                    <span class="h-4 w-4" v-html="icons.copy"></span>
                    <div class="absolute bottom-0 flex-col items-center hidden mb-6 group-hover:flex">
                      <span class="relative z-10 p-2 text-xs text-white bg-black whitespace-nowrap rounded-md">{{
        copyText }}</span>
                      <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                    </div>
                  </span>
                </div>
              </td>
              <td class="px-4 py-3 column-description desc">
                <div class="plugin-description text-gray-600">
                  <p>{{ url.statistics.length }}</p>
                </div>
              </td>
              <td class="px-4 py-3 column-auto-updates flex justify-start items-center">
                <span @click="deleteUrl(url.id)"
                  class="ml-4 text-gray-400 hover:text-[#D54752] cursor-pointer relative flex flex-col items-center group">
                  <span class="h-4 w-4" v-html="icons.delete"></span>
                  <div class="absolute bottom-0 flex-col items-center hidden mb-6 group-hover:flex">
                    <span class="relative z-10 p-2 text-xs text-white bg-black whitespace-nowrap rounded-md">
                      Delete</span>
                    <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                  </div>
                </span>
              </td>
            </tr>
            <tr v-if="urls.length <= 0">
              <td class="px-4 py-3 text-center" colspan="4">No data found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </Layout>
</template>
<style scoped></style>