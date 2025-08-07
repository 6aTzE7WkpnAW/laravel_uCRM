<script setup>
import FlashMessage from '@/Components/FlashMessage.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


defineProps({
    items: Array,
});

</script>

<template>

    <Head title="商品一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                商品一覧
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 body-font">
                        <FlashMessage />
                        <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                            <Link as="button" :href="route('items.create')"
                                class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
                            商品登録</Link>
                        </div>
                        <section class="text-gray-600">
                            <div class="container px-5 py-8 mx-auto">

                                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                    ID</th>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    商品名</th>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    価格</th>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    ステータス</th>

                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                    詳細</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="item in items" :key="item.id">
                                                <td class="border-b-2 border-gray-200 px-4 py-3">{{ item.id }}</td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">{{ item.name }}</td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">{{ item.price }}</td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3 ">
                                                    <span v-if="item.is_selling === 0">販売停止中</span>
                                                    <span v-if="item.is_selling === 1">販売中</span>
                                                </td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                                    <Link :href="route('items.show', item.id)"
                                                        class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-550 focus:outline-none bg-gray-50 rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                    詳細
                                                    </Link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
