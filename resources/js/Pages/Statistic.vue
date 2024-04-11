<script setup>
import fn from "../utilities/functions";
import Layout from "../components/Layout.vue";
const props = defineProps({
    visitors: Object,
});
</script>
<template>
    <Layout>
        <div class="bg-white rounded-md p-5">
            <div class="container-full py-10 mx-auto">
                <h2 class="text-lg font-bold mb-4 flex justify-between">
                    <div>
                        <div class="flex justify-between items-center">
                            <h2>Visitors</h2>
                        </div>
                    </div>
                    <p><span>{{ fn.getCounterText(visitors.length, 'Visitor') }}</span></p>
                </h2>
                <table class="table-auto w-full">
                    <thead>
                        <tr class="border-b-gray-300 border-b text-sm text-gray-700 text-left">
                            <th scope="col"
                                class="px-4 py-3 text-gray-500">
                                Short URL
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-gray-500"
                                style="width: 40%">
                                Original URL
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-gray-500">
                                IP Address
                            </th>
                        </tr>
                    </thead>
                    <tbody id="the-tokens" class="text-sm font-normal text-gray-700">
                        <tr v-for="visitor in visitors" :key="visitor.id" class="border-b border-gray-200 py-10">
                            <td class="px-4 py-3">
                                <div class="text-gray-600 flex justify-start items-center">
                                    <span>{{ fn.getShortUrl($page.props.appUrl, visitor.link.code,
                        $page.props.auth.user) }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3" width="40%">
                                <span class="text-gray-600">{{ visitor.link.url }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-gray-600">
                                    <p>{{ visitor.ip_address }}</p>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="visitors.length <= 0">
                            <td class="px-4 py-3 text-center" colspan="4">No data found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </Layout>
</template>