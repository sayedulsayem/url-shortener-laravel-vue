<script setup>
import { ref } from 'vue';
import { Link, Head, usePage } from "@inertiajs/inertia-vue3";
import icons from "../utilities/icons";
import Layout from "../components/Layout.vue";
const props = defineProps({
    visitors: Object,
});
const getCounterText = () => {
    const visitors = props.visitors.length;
    return (visitors > 1) ? `${visitors} Visitors` : `${visitors} Visitor`;
}
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
                    <p><span>{{ getCounterText() }}</span></p>
                </h2>
                <table class="table-auto w-full plugins">
                    <thead>
                        <tr class="border-b-gray-300 border-b text-sm text-gray-700 text-left">
                            <th scope="col" id="description"
                                class="px-4 py-3 text-gray-500 manage-column column-description">
                                Short URL
                            </th>
                            <th scope="col" id="name"
                                class="px-4 py-3 text-gray-500 manage-column column-name column-primary"
                                style="width: 40%">
                                Original URL
                            </th>
                            <th scope="col" id="description"
                                class="px-4 py-3 text-gray-500 manage-column column-description">
                                IP Address
                            </th>
                        </tr>
                    </thead>
                    <tbody id="the-tokens" class="text-sm font-normal text-gray-700">
                        <tr v-for="visitor in visitors" :key="visitor.id" class="border-b border-gray-200 py-10">
                            <td class="px-4 py-3 column-description desc">
                                <div class="plugin-description text-gray-600 flex justify-start items-center">
                                    <span>{{ $page.props.appUrl + '/' + visitor.link.code }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 plugin-title column-primary" width="40%">
                                <span class="text-gray-600">{{ visitor.link.url }}</span>
                            </td>
                            <td class="px-4 py-3 column-description desc">
                                <div class="plugin-description text-gray-600">
                                    <p>{{ visitor.ip_address }}</p>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="visitors.length <= 0"><td class="px-4 py-3 text-center" colspan="4">No data found.</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </Layout>
</template>
<style scoped></style>