<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    },
    placeholder: {
        type: String,
        default: '検索...'
    },
    showClearButton: {
        type: Boolean,
        default: true
    },
    buttonText: {
        type: String,
        default: '検索'
    },
    size: {
        type: String,
        default: 'md', // sm, md, lg
        validator: (value) => ['sm', 'md', 'lg'].includes(value)
    }
});

const emit = defineEmits(['update:modelValue', 'search', 'clear']);

// ローカルの検索値
const searchValue = ref(props.modelValue);

// 親コンポーネントの値が変更された時の同期
watch(() => props.modelValue, (newValue) => {
    searchValue.value = newValue;
});

// 検索値の変更を親に通知
watch(searchValue, (newValue) => {
    emit('update:modelValue', newValue);
});

// 検索実行
const handleSearch = () => {
    emit('search', searchValue.value);
};

// 検索クリア
const handleClear = () => {
    searchValue.value = '';
    emit('clear');
};

// エンターキー押下時の検索
const handleKeyup = (event) => {
    if (event.key === 'Enter') {
        handleSearch();
    }
};

// サイズに応じたクラス
const getSizeClasses = () => {
    const sizeClasses = {
        sm: {
            input: 'px-3 py-1.5 text-sm',
            button: 'px-3 py-1.5 text-sm',
            clear: 'px-2 py-1.5 text-xs'
        },
        md: {
            input: 'px-4 py-2 text-base',
            button: 'px-4 py-2 text-base',
            clear: 'px-3 py-2 text-sm'
        },
        lg: {
            input: 'px-5 py-3 text-lg',
            button: 'px-5 py-3 text-lg',
            clear: 'px-4 py-3 text-base'
        }
    };
    return sizeClasses[props.size];
};

</script>

<template>
    <div class="flex items-center space-x-2">
        <!-- 検索入力フィールド -->
        <input
            v-model="searchValue"
            @keyup="handleKeyup"
            type="text"
            :placeholder="placeholder"
            :class="[
                'border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200',
                getSizeClasses().input
            ]"
        />
        
        <!-- 検索ボタン -->
        <button
            @click="handleSearch"
            :class="[
                'bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-200 font-medium',
                getSizeClasses().button
            ]"
        >
            {{ buttonText }}
        </button>
        
        <!-- クリアボタン -->
        <button
            v-if="showClearButton && searchValue"
            @click="handleClear"
            :class="[
                'text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200',
                getSizeClasses().clear
            ]"
        >
            クリア
        </button>
    </div>
</template>