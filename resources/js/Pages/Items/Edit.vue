<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    item: Object,
});

// フォームデータの初期化
const form = useForm({
    name: props.item?.name || '',
    memo: props.item?.memo || '',
    price: props.item?.price || '',
    is_selling: props.item?.is_selling || 0,
});

// フォーム送信処理
const updateItem = () => {
    form.put(route('items.update', { item: props.item.id }));
};

</script>

<template>
    <Head title="商品編集" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                商品編集
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <form @submit.prevent="updateItem">
                                <div class="container px-5 py-8 mx-auto">
                                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                        <div class="flex flex-wrap -m-2">
                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="name" class="leading-7 text-sm text-gray-600">商品名</label>
                                                    <input
                                                        id="name"
                                                        v-model="form.name"
                                                        type="text"
                                                        name="name"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                        :class="{ 'border-red-500': form.errors.name }"
                                                    />
                                                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                                                        {{ form.errors.name }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="memo" class="leading-7 text-sm text-gray-600">メモ</label>
                                                    <textarea
                                                        id="memo"
                                                        v-model="form.memo"
                                                        name="memo"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"
                                                        :class="{ 'border-red-500': form.errors.memo }"
                                                    ></textarea>
                                                    <div v-if="form.errors.memo" class="text-red-500 text-sm mt-1">
                                                        {{ form.errors.memo }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="price" class="leading-7 text-sm text-gray-600">商品価格</label>
                                                    <input
                                                        id="price"
                                                        v-model="form.price"
                                                        type="number"
                                                        name="price"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                        :class="{ 'border-red-500': form.errors.price }"
                                                    />
                                                    <div v-if="form.errors.price" class="text-red-500 text-sm mt-1">
                                                        {{ form.errors.price }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="is_selling" class="leading-7 text-sm text-gray-600">ステータス</label>
                                                    <select
                                                        id="is_selling"
                                                        v-model="form.is_selling"
                                                        name="is_selling"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                        :class="{ 'border-red-500': form.errors.is_selling }"
                                                    >
                                                        <option value="1">販売中</option>
                                                        <option value="0">販売停止中</option>
                                                    </select>
                                                    <div v-if="form.errors.is_selling" class="text-red-500 text-sm mt-1">
                                                        {{ form.errors.is_selling }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-2 w-full mt-4">
                                                <div class="flex gap-4 justify-center">
                                                    <button
                                                        type="submit"
                                                        :disabled="form.processing"
                                                        class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg disabled:opacity-50"
                                                    >
                                                        {{ form.processing ? '更新中...' : '更新' }}
                                                    </button>
                                                    <Link
                                                        :href="route('items.show', { item: item.id })"
                                                        class="text-gray-700 bg-gray-200 border-0 py-2 px-6 focus:outline-none hover:bg-gray-300 rounded text-lg"
                                                    >
                                                        キャンセル
                                                    </Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>