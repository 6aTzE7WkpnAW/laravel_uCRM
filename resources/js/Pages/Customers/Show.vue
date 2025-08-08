<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
import RadioButtonGroup from '@/Components/RadioButtonGroup.vue';

const props = defineProps({
    customer: Object,
});

// 改行をbrタグに変換する関数
const formatMemo = computed(() => {
    if (!props.customer?.memo) return '';
    return props.customer.memo.replace(/\r\n|\r|\n/g, '<br>');
});

const genderOptions = [
    { value: 0, label: '男性' },
    { value: 1, label: '女性' },
    { value: 2, label: 'その他' }
];

// 生年月日のフォーマット
const formatBirthday = computed(() => {
    if (!props.customer?.birthday) return '';
    const date = new Date(props.customer.birthday);
    return date.toLocaleDateString('ja-JP', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
});

// 削除機能
const deleteCustomer = (id) => {
    if (confirm('本当に削除しますか？')) {
        router.delete(route('customers.destroy', { customer: id }));
    }
};

</script>

<template>

    <Head title="顧客詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                顧客詳細
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
                                                <label class="block text-sm text-gray-600 mb-2">顧客名</label>
                                                <div class="text-base text-gray-900 py-2 px-1">
                                                    {{ customer.name }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label class="block text-sm text-gray-600 mb-2">カナ</label>
                                                <div class="text-base text-gray-900 py-2 px-1">
                                                    {{ customer.kana }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label class="block text-sm text-gray-600 mb-2">電話番号</label>
                                                <div class="text-base text-gray-900 py-2 px-1">
                                                    {{ customer.tel }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label class="block text-sm text-gray-600 mb-2">メールアドレス</label>
                                                <div class="text-base text-gray-900 py-2 px-1">
                                                    <a :href="'mailto:' + customer.email"
                                                        class="text-blue-600 hover:text-blue-800 underline">
                                                        {{ customer.email }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label class="block text-sm text-gray-600 mb-2">郵便番号</label>
                                                <div class="text-base text-gray-900 py-2 px-1">
                                                    〒{{ customer.postcode }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label class="block text-sm text-gray-600 mb-2">住所</label>
                                                <div class="text-base text-gray-900 py-2 px-1">
                                                    {{ customer.address }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label class="block text-sm text-gray-600 mb-2">誕生日</label>
                                                <div class="text-base text-gray-900 py-2 px-1">
                                                    {{ formatBirthday }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 性別表示 -->
                                        <RadioButtonGroup v-model="customer.gender" label="性別" name="gender"
                                            :options="genderOptions" layout="horizontal" variant="radio"
                                            :readonly="true" />

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label class="block text-sm text-gray-600 mb-2">メモ</label>
                                                <div class="bg-gray-50 rounded p-3 min-h-32 text-gray-800 leading-relaxed"
                                                    v-html="formatMemo">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full mt-6">
                                            <div class="flex gap-4 justify-center">
                                                <Link :href="route('customers.edit', { customer: customer.id })"
                                                    class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                                編集
                                                </Link>
                                                <Link :href="route('customers.index')"
                                                    class="text-gray-700 bg-gray-200 border-0 py-2 px-6 focus:outline-none hover:bg-gray-300 rounded text-lg">
                                                一覧に戻る
                                                </Link>
                                                <button @click="deleteCustomer(customer.id)"
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