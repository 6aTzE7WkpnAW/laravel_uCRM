<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { getToday } from '@/common'
import { onMounted, reactive, ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import ValidationErrors from '@/Components/ValidationErrors.vue';
import ItemSelectionTable from '@/Components/ItemSelectionTable.vue';
import MicroModal from '@/Components/MicroModal.vue';

const props = defineProps({
    'customers': Array,
    'items': Array,
    'errors': Object,
})

onMounted(() => {
    form.date = getToday()
    props.items.forEach(item => {
        itemlist.value.push({
            id: item.id,
            name: item.name,
            price: item.price,
            quantity: 0
        })
    })
})

const itemlist = ref([])

const form = reactive({
    date: null,
    customer_id: null,
    status: true,
    items: [],
})

const totalPrice = computed(() => {
    let total = 0
    itemlist.value.forEach(item => {
        total += item.price * item.quantity
    })
    return total
})

// ItemSelectionTableからのイベントを受け取る
const updateItems = (updatedItems) => {
    itemlist.value = updatedItems
}

const storePurchase = () => {
    // バリデーション
    if (!form.customer_id) {
        alert('会員を選択してください')
        return
    }

    if (!form.date) {
        alert('日付を入力してください')
        return
    }

    // 商品が選ばれているかチェック
    const hasItems = itemlist.value.some(item => item.quantity > 0)
    if (!hasItems) {
        alert('商品を選択してください')
        return
    }

    // form.itemsを一度クリア（重複防止）
    form.items = []

    itemlist.value.forEach(item => {
        if (item.quantity > 0) {
            form.items.push({
                id: item.id,
                quantity: parseInt(item.quantity),
            })
        }
    })

    router.post(route('purchases.store'), form)
}

const setCustomerId = (id) => {
    form.customer_id = id
}

// 選択された顧客の名前を取得（props.customersから検索）
const selectedCustomerName = computed(() => {
    if (!form.customer_id) return ''
    // props.customersが存在するかチェック
    if (!props.customers || !Array.isArray(props.customers)) return ''
    
    const customer = props.customers.find(c => c.id == form.customer_id)
    return customer ? customer.name : ''
})
</script>

<template>
    <Head title="購入履歴登録" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                購入履歴登録
            </h2>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <form @submit.prevent="storePurchase" class="space-y-6">
                            <ValidationErrors :errors="errors" />
                            
                            <!-- 基本情報セクション -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">基本情報</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- 日付 -->
                                    <div>
                                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                                            購入日 <span class="text-red-500">*</span>
                                        </label>
                                        <input 
                                            type="date" 
                                            id="date" 
                                            name="date" 
                                            v-model="form.date"
                                            required
                                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-2 px-3 transition-colors duration-200 ease-in-out"
                                        >
                                    </div>

                                    <!-- 顧客検索 -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            会員選択 <span class="text-red-500">*</span>
                                        </label>
                                        <MicroModal @update:customerId="setCustomerId" />
                                    </div>
                                </div>

                                <!-- 選択中の会員表示（一時的にコメントアウト） -->
                                <!-- <div v-if="selectedCustomerName" class="mt-4 p-3 bg-indigo-50 rounded border border-indigo-200">
                                    <p class="text-sm text-indigo-700">
                                        <span class="font-medium">選択中の会員:</span> {{ selectedCustomerName }}
                                    </p>
                                </div> -->
                            </div>

                            <!-- 商品選択セクション -->
                            <div class="bg-white rounded-lg border border-gray-200">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">商品・サービス選択</h3>
                                    <p class="text-sm text-gray-500 mt-1">購入する商品を選択し、数量を入力してください</p>
                                </div>
                                
                                <div class="p-6">
                                    <ItemSelectionTable 
                                        :items="itemlist" 
                                        @update:items="updateItems"
                                        :show-total="true" 
                                    />
                                </div>
                            </div>

                            <!-- 合計金額表示 -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-medium text-gray-900">合計金額</h3>
                                    <div class="text-2xl font-bold text-indigo-600">
                                        ¥{{ totalPrice.toLocaleString() }}
                                    </div>
                                </div>
                            </div>

                            <!-- 登録ボタン -->
                            <div class="flex justify-center pt-6">
                                <button 
                                    type="submit"
                                    class="inline-flex items-center px-8 py-3 bg-indigo-500 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-200 active:bg-indigo-700 transition duration-150 ease-in-out"
                                >
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    購入履歴を登録
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>