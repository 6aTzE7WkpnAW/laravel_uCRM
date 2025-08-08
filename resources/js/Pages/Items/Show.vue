<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    item: Object,
});

// 改行をbrタグに変換する関数
const formatMemo = computed(() => {
    if (!props.item?.memo) return '';
    return props.item.memo.replace(/\r\n|\r|\n/g, '<br>');
});

// 削除機能
const deleteItem = (id) => {
    if (confirm('本当に削除しますか？')) {
        router.delete(route('items.destroy', { item: id }));
    }
};

</script>

<template>
    <Head title="商品詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                商品詳細
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <div class="container px-5 py-8 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <div class="flex flex-wrap -m-2">
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label class="block text-sm text-gray-600 mb-2">商品名</label>
                                                <div class="text-base text-gray-900 py-2 px-1">
                                                    {{ item.name }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label class="block text-sm text-gray-600 mb-2">メモ</label>
                                                <div class="bg-gray-50 rounded p-3 min-h-32 text-gray-800 leading-relaxed"
                                                    v-html="formatMemo">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label class="block text-sm text-gray-600 mb-2">商品価格</label>
                                                <div class="text-base text-gray-900 py-2 px-1">
                                                    ¥{{ item.price?.toLocaleString() }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label class="block text-sm text-gray-600 mb-2">ステータス</label>
                                                <div class="py-2 px-1">
                                                    <span v-if="item.is_selling == 0"
                                                        class="inline-flex items-center px-2 py-1 rounded text-sm bg-red-100 text-red-800">
                                                        販売停止中
                                                    </span>
                                                    <span v-if="item.is_selling == 1"
                                                        class="inline-flex items-center px-2 py-1 rounded text-sm bg-green-100 text-green-800">
                                                        販売中
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                       <div class="p-2 w-full mt-6">
                                            <div class="flex gap-4 justify-center">
                                                <Link 
                                                    :href="route('items.edit', { item: item.id })"
                                                    class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                                    編集
                                                </Link>
                                                <Link 
                                                    :href="route('items.index')"
                                                    class="text-gray-700 bg-gray-200 border-0 py-2 px-6 focus:outline-none hover:bg-gray-300 rounded text-lg">
                                                    一覧に戻る
                                                </Link>
                                                <button 
                                                    @click="deleteItem(item.id)"
                                                    class="text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded text-lg">
                                                    削除
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>