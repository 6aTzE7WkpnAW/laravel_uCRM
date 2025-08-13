<script setup>
import { ref, reactive } from 'vue'
import { onMounted, onUnmounted } from 'vue'
import axios from 'axios'
import Pagination from '@/Components/Pagination.vue'

const search = ref('')
const customers = reactive({})
const isShow = ref(false)
const isLoading = ref(false)

const emit = defineEmits(['update:customerId'])

const toggleStatus = () => {
    isShow.value = !isShow.value
}

const searchCustomers = async (page = 1) => {
    if (!search.value.trim()) {
        alert('検索キーワードを入力してください')
        return
    }

    isLoading.value = true

    try {
        const response = await axios.get(`/api/searchCustomers`, {
            params: {
                search: search.value.trim(),
                page: page
            }
        })

        customers.value = response.data
        console.log('検索結果:', response.data)

        if (page === 1) {
            toggleStatus()
        }

    } catch (error) {
        console.error('検索エラー:', error)
        if (error.response?.status === 401) {
            alert('認証が必要です。再ログインしてください。')
        } else {
            alert('検索中にエラーが発生しました。')
        }
    } finally {
        isLoading.value = false
    }
}

const onPageChange = (url) => {
    if (!url) return

    const urlObj = new URL(url, window.location.origin)
    const page = urlObj.searchParams.get('page') || 1

    searchCustomers(page)
}

const setCustomer = (customer) => {
    search.value = customer.kana
    emit('update:customerId', customer.id)
    toggleStatus()
}

const handleKeydown = (event) => {
    if (event.key === 'Escape' && isShow.value) {
        toggleStatus()
    }
}

onMounted(() => {
    document.addEventListener('keydown', handleKeydown)
})

onUnmounted(() => {
    document.removeEventListener('keydown', handleKeydown)
})
</script>

<template>
    <div>
        <!-- 検索入力とボタン -->
        <div class="mb-2">
            <div class="flex gap-2">
                <input v-model="search" type="text" placeholder="顧客名、カナ、電話番号で検索" @keydown.enter="searchCustomers(1)"
                    :disabled="isLoading"
                    class="flex-1 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out disabled:opacity-50">
                <button type="button" @click="searchCustomers(1)" :disabled="isLoading"
                    class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-200 transition-colors duration-200 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed min-w-[80px]">
                    <span v-if="isLoading">検索中...</span>
                    <span v-else>検索</span>
                </button>
            </div>
        </div>
    </div>

    <!-- モーダル -->
    <Teleport to="body">
        <div v-show="isShow" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
            @click="toggleStatus">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-5xl h-[85vh] overflow-hidden" @click.stop>
                <!-- モーダルヘッダー -->
                <div class="flex justify-between items-center p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">顧客検索結果</h3>
                    <button type="button" @click="toggleStatus"
                        class="text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition ease-in-out duration-150">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- モーダルコンテンツ -->
                <div class="h-[calc(85vh-80px)] overflow-y-auto">
                    <div v-if="customers.value && customers.value.data && customers.value.data.length > 0">
                        <!-- 検索結果情報 -->
                        <div class="p-4 border-b border-gray-100">
                            <div class="p-3 bg-gray-50 rounded">
                                <p class="text-sm text-gray-600">
                                    「{{ search }}」の検索結果: {{ customers.value.total }}件
                                    （{{ customers.value.from }}-{{ customers.value.to }}件目を表示）
                                </p>
                            </div>
                        </div>

                        <!-- テーブルコンテナ -->
                        <div class="border-b border-gray-100">
                            <!-- テーブルヘッダー -->
                            <div class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">
                                <div
                                    class="grid grid-cols-12 gap-4 px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="col-span-1">ID</div>
                                    <div class="col-span-3">名前</div>
                                    <div class="col-span-3">カナ</div>
                                    <div class="col-span-3">電話番号</div>
                                    <div class="col-span-2"></div>
                                </div>
                            </div>

                            <!-- テーブルボディ -->
                            <div class="bg-white">
                                <div v-for="customer in customers.value.data" :key="customer.id"
                                    class="grid grid-cols-12 gap-4 px-4 py-3 hover:bg-gray-50 transition-colors duration-150 border-b border-gray-100 last:border-b-0">
                                    <div class="col-span-1 text-sm text-gray-900">{{ customer.id }}</div>
                                    <div class="col-span-3 text-sm text-gray-900">{{ customer.name }}</div>
                                    <div class="col-span-3 text-sm text-gray-900">{{ customer.kana }}</div>
                                    <div class="col-span-3 text-sm text-gray-900">{{ customer.tel }}</div>
                                    <div class="col-span-2">
                                        <button type="button" @click="setCustomer(customer)"
                                            class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-1 px-3 rounded text-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-200">
                                            選択
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ページネーション -->
                        <div class="p-4 bg-white">
                            <Pagination :pagination="customers.value" :preserve-search="false"
                                @page-change="onPageChange" />
                        </div>
                    </div>

                    <!-- 検索結果がない場合 -->
                    <div v-else-if="customers.value && customers.value.data && customers.value.data.length === 0"
                        class="flex items-center justify-center h-full">
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">検索結果なし</h3>
                            <p class="text-sm text-gray-500">「{{ search }}」の検索結果が見つかりませんでした。</p>
                        </div>
                    </div>

                    <!-- 初期状態 -->
                    <div v-else class="flex items-center justify-center h-full">
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">顧客検索</h3>
                            <p class="text-sm text-gray-500">検索キーワードを入力して「検索」ボタンを押してください。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Teleport>
</template>