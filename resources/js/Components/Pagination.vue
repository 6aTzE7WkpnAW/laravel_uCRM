<script setup>
const props = defineProps({
    pagination: Object, // Laravelのpaginationオブジェクト
    preserveSearch: {
        type: Boolean,
        default: true
    }
});

const emit = defineEmits(['page-change'])

// ページネーション範囲を取得
const getPaginationRange = (pagination) => {
    const current = pagination.current_page;
    const last = pagination.last_page;
    const range = [];
    
    // 現在ページの前後2ページを表示
    const start = Math.max(1, current - 2);
    const end = Math.min(last, current + 2);
    
    for (let i = start; i <= end; i++) {
        range.push(i);
    }
    
    return range;
};

// ページURLを取得
const getPageUrl = (pagination, page) => {
    if (!props.preserveSearch) {
        return pagination.path + '?page=' + page;
    }
    
    // 現在のURLパラメータを保持
    const url = new URL(window.location);
    url.searchParams.set('page', page);
    return url.pathname + url.search;
};

// ページクリック処理
const handlePageClick = (url) => {
    emit('page-change', url)
}

const handlePageNumber = (page) => {
    const url = getPageUrl(props.pagination, page)
    emit('page-change', url)
}
</script>

<template>
    <!-- ページネーション -->
    <div v-if="pagination.last_page > 1" class="mt-8 flex items-center justify-center">
        <nav class="flex items-center space-x-1 bg-white rounded-lg shadow-sm border border-gray-200 p-1">
            <!-- 前のページ -->
            <button v-if="pagination.prev_page_url" 
                    @click="handlePageClick(pagination.prev_page_url)"
                    type="button"
                    class="flex items-center justify-center w-10 h-10 text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors duration-200 group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-0.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <span v-else 
                  class="flex items-center justify-center w-10 h-10 text-gray-300 cursor-not-allowed rounded-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </span>

            <!-- 最初のページ -->
            <template v-if="pagination.current_page > 3">
                <button @click="handlePageNumber(1)"
                        type="button"
                        class="flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-all duration-200">
                    1
                </button>
                <span v-if="pagination.current_page > 4" class="flex items-center justify-center w-8 h-10 text-gray-400">
                    ...
                </span>
            </template>

            <!-- 現在ページ周辺のページ番号 -->
            <template v-for="page in getPaginationRange(pagination)" :key="page">
                <button v-if="page !== pagination.current_page"
                        @click="handlePageNumber(page)"
                        type="button"
                        class="flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-all duration-200">
                    {{ page }}
                </button>
                <span v-else
                      class="flex items-center justify-center w-10 h-10 text-sm font-semibold text-white bg-indigo-600 rounded-md">
                    {{ page }}
                </span>
            </template>

            <!-- 最後のページ -->
            <template v-if="pagination.current_page < pagination.last_page - 2">
                <span v-if="pagination.current_page < pagination.last_page - 3" class="flex items-center justify-center w-8 h-10 text-gray-400">
                    ...
                </span>
                <button @click="handlePageNumber(pagination.last_page)"
                        type="button"
                        class="flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-all duration-200">
                    {{ pagination.last_page }}
                </button>
            </template>

            <!-- 次のページ -->
            <button v-if="pagination.next_page_url" 
                    @click="handlePageClick(pagination.next_page_url)"
                    type="button"
                    class="flex items-center justify-center w-10 h-10 text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors duration-200 group">
                <svg class="w-5 h-5 transform group-hover:translate-x-0.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <span v-else 
                  class="flex items-center justify-center w-10 h-10 text-gray-300 cursor-not-allowed rounded-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        </nav>
    </div>
</template>