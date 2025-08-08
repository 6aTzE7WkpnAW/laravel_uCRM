<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import RadioButtonGroup from '@/Components/RadioButtonGroup.vue';
import { Core } from 'yubinbango-core2';

const props = defineProps({
    customer: Object,
});

// フォームデータの初期化
const form = reactive({
    name: props.customer?.name || '',
    kana: props.customer?.kana || '',
    tel: props.customer?.tel || '',
    email: props.customer?.email || '',
    postcode: props.customer?.postcode || '',
    address: props.customer?.address || '',
    birthday: props.customer?.birthday || '',
    gender: props.customer?.gender !== undefined ? Number(props.customer.gender) : 0, // 数値に変換
    memo: props.customer?.memo || '',
});

// 性別の選択肢
const genderOptions = [
    { value: 0, label: '男性' },
    { value: 1, label: '女性' },
    { value: 2, label: 'その他' }
];

// 郵便番号から住所を自動取得
const fetchAddress = () => {
    if (!form.postcode || form.postcode.length !== 7) {
        return;
    }

    try {
        new Core(form.postcode, (addr) => {
            if (addr) {
                form.address = addr.region + addr.locality + addr.street;
            }
        });
    } catch (error) {
        console.error('住所取得エラー:', error);
    }
};

// フォーム送信処理
const updateCustomer = () => {
    router.put(route('customers.update', { customer: props.customer.id }), form, {
        onSuccess: () => {
            // 成功時の処理（必要に応じて）
        },
        onError: (errors) => {
            console.error('更新エラー:', errors);
        }
    });
};

</script>

<template>

    <Head title="顧客編集" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                顧客編集
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <form @submit.prevent="updateCustomer">
                                <div class="container px-5 py-8 mx-auto">
                                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                        <div class="flex flex-wrap -m-2">

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="name"
                                                        class="leading-7 text-sm text-gray-600">顧客名</label>
                                                    <input id="name" v-model="form.name" type="text" name="name"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                            </div>

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="kana" class="leading-7 text-sm text-gray-600">カナ</label>
                                                    <input id="kana" v-model="form.kana" type="text" name="kana"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                            </div>

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="tel"
                                                        class="leading-7 text-sm text-gray-600">電話番号</label>
                                                    <input id="tel" v-model="form.tel" type="tel" name="tel"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                            </div>

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="email"
                                                        class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                                    <input id="email" v-model="form.email" type="email" name="email"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                            </div>

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="postcode"
                                                        class="leading-7 text-sm text-gray-600">郵便番号</label>
                                                    <input id="postcode" v-model="form.postcode" @input="fetchAddress"
                                                        type="text" name="postcode" maxlength="7" placeholder="1234567"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                            </div>

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="address"
                                                        class="leading-7 text-sm text-gray-600">住所</label>
                                                    <input id="address" v-model="form.address" type="text"
                                                        name="address"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                            </div>

                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="birthday"
                                                        class="leading-7 text-sm text-gray-600">誕生日</label>
                                                    <input id="birthday" v-model="form.birthday" type="date"
                                                        name="birthday"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                </div>
                                            </div>

                                            <RadioButtonGroup v-model="form.gender" label="性別" name="gender"
                                                :options="genderOptions" layout="horizontal" variant="radio" />


                                            <div class="p-2 w-full">
                                                <div class="relative">
                                                    <label for="memo" class="leading-7 text-sm text-gray-600">メモ</label>
                                                    <textarea id="memo" v-model="form.memo" name="memo"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                                </div>
                                            </div>

                                            <div class="p-2 w-full mt-4">
                                                <div class="flex gap-4 justify-center">
                                                    <button type="submit"
                                                        class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                                        更新
                                                    </button>
                                                    <Link :href="route('customers.show', { customer: customer.id })"
                                                        class="text-gray-700 bg-gray-200 border-0 py-2 px-6 focus:outline-none hover:bg-gray-300 rounded text-lg">
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