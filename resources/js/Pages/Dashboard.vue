<script setup>
import { ref } from 'vue';
import { Link } from "@inertiajs/inertia-vue3";
import icons from "../utilities/icons";
import fn from "../utilities/functions";
import Layout from "../components/Layout.vue";
const props = defineProps({
  statistics: Object,
});

const visitors = fn.countVisitors(props.statistics);

const copyText = ref('Copy');
const copyToClipboard = (event, text) => {
  navigator.clipboard.writeText(text);
  copyText.value = 'Copied!';
  setTimeout(() => {
    copyText.value = 'Copy';
  }, 2000);
}
</script>
<template>
  <Layout>
    <div class="grid grid-cols-3 gap-4 mb-6">
      <div class="bg-white border border-[#E79073] rounded-md">
        <div class="flex items-center justify-between h-full">
          <div class="flex items-center space-x-5 h-full">
            <div
              class="bg-[#E79073] text-white p-2 rounded-md rounded-r-none w-20 h-full flex items-center justify-center">
              <span class="h-6 w-6" v-html="icons.eye"></span>
            </div>
            <div class="py-5">
              <h2 class="font-bold text-xl text-[#E79073]">{{ visitors.unique }}</h2>
              <span class="flex text-[15px] items-center space-x-1 text-[#636363]">Unique {{ fn.getCounterText(visitors.unique, 'Visitor', false) }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-white border border-[#E8374D] rounded-md">
        <div class="flex items-center justify-between h-full">
          <div class="flex items-center space-x-5 h-full">
            <div
              class="bg-[#E8374D] text-white p-2 rounded-md rounded-r-none w-20 h-full flex items-center justify-center">
              <span class="h-6 w-6" v-html="icons.users"></span>
            </div>
            <div class="py-5">
              <h2 class="font-bold text-xl text-[#E8374D]">{{ visitors.total }}</h2>
              <span class="flex text-[15px] items-center space-x-1 text-[#636363]">{{ fn.getCounterText(visitors.total, 'Visitor', false) }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-white border border-[#1DB3C9] rounded-md">
        <div class="flex items-center justify-between h-full">
          <div class="flex items-center space-x-5 h-full">
            <div
              class="bg-[#1DB3C9] text-white p-2 rounded-md rounded-r-none w-20 h-full flex items-center justify-center">
              <span class="h-5 w-5" v-html="icons.urls"></span>
            </div>
            <div class="py-5">
              <h2 class="font-bold text-xl text-[#1DB3C9]">{{ statistics.length }}</h2>
              <span class="flex text-[15px] items-center space-x-1 text-[#636363]">{{ fn.getCounterText(statistics.length, 'URL', false) }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-white rounded-md p-5">
      <div class="container-full py-10 mx-auto">
        <h2 class="text-lg font-bold mb-4 flex justify-between">
          <div>
            <div class="flex justify-between items-center">
              <h2>Your Statistics</h2>
            </div>
          </div>
          <p><span>{{ fn.getCounterText(statistics.length, 'URL') }}</span></p>
        </h2>
        <table class="table-auto w-full">
          <thead>
            <tr class="border-b-gray-300 border-b text-sm text-gray-700 text-left">
              <th scope="col" class="px-4 py-3 text-gray-500" style="width: 40%">
                Original URL
              </th>
              <th scope="col" class="px-4 py-3 text-gray-500">
                Short URL
              </th>
              <th scope="col" class="px-4 py-3 text-gray-500">
                Visitors
              </th>
              <th scope="col" class="px-4 py-3 text-gray-500">
                Action
              </th>
            </tr>
          </thead>
          <tbody class="text-sm font-normal text-gray-700">
            <tr v-for="statistic in statistics" :key="statistic.id" class="border-b border-gray-200 py-10">
              <td class="px-4 py-3" width="40%">
                <span class="text-gray-600">{{ statistic.url }}</span>
              </td>
              <td class="px-4 py-3">
                <div class="text-gray-600 flex justify-start items-center">
                  <span>{{ fn.getShortUrl($page.props.appUrl, statistic.code, $page.props.auth.user) }}</span>
                  <span
                    @click="copyToClipboard($event, fn.getShortUrl($page.props.appUrl, statistic.code, $page.props.auth.user))"
                    class="ml-4 text-gray-400 relative flex flex-col items-center cursor-pointer group focus:ring-0">
                    <span class="h-4 w-4" v-html="icons.copy"></span>
                    <div class="absolute bottom-0 flex-col items-center hidden mb-6 group-hover:flex">
                      <span class="relative z-10 p-2 text-xs text-white bg-black whitespace-nowrap rounded-md">
                        {{ copyText }}
                      </span>
                      <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                    </div>
                  </span>
                </div>
              </td>
              <td class="px-4 py-3">
                <div class="text-gray-600">
                  <p>{{ statistic.statistics.length }}</p>
                </div>
              </td>
              <td class="px-4 py-3 flex justify-start items-center">
                <Link :href="`/visitors/${statistic.id}`"
                  class="text-white bg-red-500 border-0 px-4 focus:outline-none hover:bg-red-700 rounded py-1">
                View</Link>
              </td>
            </tr>
            <tr v-if="statistics.length <= 0">
              <td class="px-4 py-3 text-center" colspan="4">No data found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </Layout>
</template>