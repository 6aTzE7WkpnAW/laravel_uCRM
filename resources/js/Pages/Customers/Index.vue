<script setup>
import FlashMessage from '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    customers: Object, // Paginatorオブジェクト
    filters: Object,
});

// 検索機能
const search = ref(props.filters.search || '');

// 検索処理
const handleSearch = (searchValue) => {
    router.get(route('customers.index'),
        { search: searchValue },
        {
            preserveState: true,
            replace: true
        }
    );
};

// 検索クリア
const handleClear = () => {
    search.value = '';
    router.get(route('customers.index'));
};

</script>

<template>

    <Head title="顧客一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                顧客一覧
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 body-font">
                        <FlashMessage />

                        <!-- 検索フォームと新規登録ボタン -->
                        <div class="flex justify-between items-center pl-4 my-4 lg:w-2/3 w-full mx-auto">
                            <Link :href="route('customers.create')"
                                class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
                            顧客登録
                            </Link>

                            <SearchForm v-model="search" placeholder="氏名・カナ・電話番号で検索..." @search="handleSearch"
                                @clear="handleClear" />
                        </div>



                        <section class="text-gray-600">
                            <div class="container px-5 py-8 mx-auto">
                                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                    ID
                                                </th>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    氏名
                                                </th>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    仮名
                                                </th>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    電話番号
                                                </th>
                                                <th
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                    詳細
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="customer in customers.data" :key="customer.id"
                                                class="hover:bg-gray-50">
                                                <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.id }}</td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3 font-medium">{{
                                                    customer.name }}
                                                </td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.kana }}
                                                </td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.tel }}</td>
                                                <td class="border-b-2 border-gray-200 px-4 py-3">
                                                    <Link :href="route('customers.show', customer.id)"
                                                        class="py-2 px-4 text-sm font-medium text-gray-700 bg-gray-50 rounded-lg border border-gray-300 hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                                    詳細
                                                    </Link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!-- データがない場合 -->
                                    <div v-if="customers.data.length === 0" class="text-center py-8">
                                        <p class="text-gray-500">
                                            <span v-if="search">検索条件に一致する顧客が見つかりませんでした。</span>
                                            <span v-else>登録されている顧客がありません。</span>
                                        </p>
                                    </div>
                                </div>

                                <!-- ページネーションコンポーネント -->
                                <Pagination :pagination="customers" />

                                <!-- 検索結果の件数表示 -->
                                <div class="flex items-center justify-center mb-4 lg:w-2/3 w-full mx-auto">
                                    <p class="text-sm text-gray-600">
                                        {{ customers.from }} - {{ customers.to }} 件 / 全 {{ customers.total }} 件
                                        <span v-if="search">（「{{ search }}」での検索結果）</span>
                                    </p>
                                </div>
                            </div>
                        </section>
                    
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>