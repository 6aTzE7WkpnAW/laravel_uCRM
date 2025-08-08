<template>
    <div class="p-2 w-full">
        <div class="relative">
            <label v-if="label" class="block leading-7 text-sm text-gray-600 mb-3">
                {{ label }}
                <span v-if="required" class="text-red-500 ml-1">*</span>
            </label>
            
            <!-- ラジオボタンスタイル -->
            <div v-if="variant === 'radio'" :class="containerClass">
                <div v-for="option in options" :key="option.value" class="flex items-center">
                    <input 
                        type="radio" 
                        :id="uniqueName + '_' + option.value"
                        :name="uniqueName"
                        :value="option.value"
                        :checked="modelValue === option.value"
                        :disabled="disabled || option.disabled"
                        @change="updateValue(option.value)"
                        class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:ring-2 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                    <label 
                        :for="uniqueName + '_' + option.value"
                        class="ml-2 text-sm font-medium text-gray-900 cursor-pointer"
                        :class="{ 'opacity-50 cursor-not-allowed': disabled || option.disabled }"
                    >
                        {{ option.label }}
                    </label>
                </div>
            </div>

            <!-- ボタンスタイル -->
            <div v-else-if="variant === 'button'" :class="containerClass">
                <label 
                    v-for="option in options" 
                    :key="option.value"
                    class="flex items-center cursor-pointer bg-white border border-gray-300 rounded-lg px-4 py-2 hover:bg-gray-50 transition-colors"
                    :class="{
                        'bg-indigo-50 border-indigo-500': modelValue === option.value,
                        'opacity-50 cursor-not-allowed hover:bg-white': disabled || option.disabled
                    }"
                >
                    <input 
                        type="radio" 
                        :name="uniqueName"
                        :value="option.value"
                        :checked="modelValue === option.value"
                        :disabled="disabled || option.disabled"
                        @change="updateValue(option.value)"
                        class="sr-only"
                    >
                    <span class="text-sm font-medium text-gray-900">{{ option.label }}</span>
                </label>
            </div>

            <!-- カードスタイル -->
            <div v-else-if="variant === 'card'" :class="containerClass">
                <label 
                    v-for="option in options" 
                    :key="option.value"
                    class="block cursor-pointer bg-white border border-gray-300 rounded-lg p-4 hover:bg-gray-50 transition-all"
                    :class="{
                        'ring-2 ring-indigo-500 border-indigo-500 bg-indigo-50': modelValue === option.value,
                        'opacity-50 cursor-not-allowed hover:bg-white': disabled || option.disabled
                    }"
                >
                    <input 
                        type="radio" 
                        :name="uniqueName"
                        :value="option.value"
                        :checked="modelValue === option.value"
                        :disabled="disabled || option.disabled"
                        @change="updateValue(option.value)"
                        class="sr-only"
                    >
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-4 h-4 border-2 border-gray-300 rounded-full flex items-center justify-center"
                                 :class="{ 'border-indigo-500 bg-indigo-500': modelValue === option.value }">
                                <div v-if="modelValue === option.value" class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">{{ option.label }}</div>
                            <div v-if="option.description" class="text-sm text-gray-500 mt-1">{{ option.description }}</div>
                        </div>
                    </div>
                </label>
            </div>

            <!-- エラーメッセージ -->
            <div v-if="error" class="mt-1 text-sm text-red-600">
                {{ error }}
            </div>
            
            <!-- ヘルプテキスト -->
            <div v-if="help" class="mt-1 text-sm text-gray-500">
                {{ help }}
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    modelValue: {
        type: [String, Number, Boolean],
        default: ''
    },
    label: {
        type: String,
        default: ''
    },
    name: {
        type: String,
        default: 'radio-group'
    },
    options: {
        type: Array,
        required: true,
        validator: (options) => {
            return options.every(option => 
                typeof option === 'object' && 
                option.hasOwnProperty('value') && 
                option.hasOwnProperty('label')
            )
        }
    },
    layout: {
        type: String,
        default: 'horizontal', // horizontal | vertical
        validator: value => ['horizontal', 'vertical'].includes(value)
    },
    variant: {
        type: String,
        default: 'radio', // radio | button | card
        validator: value => ['radio', 'button', 'card'].includes(value)
    },
    required: {
        type: Boolean,
        default: false
    },
    disabled: {
        type: Boolean,
        default: false
    },
    error: {
        type: String,
        default: ''
    },
    help: {
        type: String,
        default: ''
    }
})

const emit = defineEmits(['update:modelValue', 'change'])

const containerClass = computed(() => {
    const baseClasses = {
        horizontal: 'flex flex-wrap gap-6',
        vertical: 'space-y-3'
    }
    
    if (props.variant === 'button') {
        return props.layout === 'vertical' ? 'space-y-3' : 'flex flex-wrap gap-3'
    }
    
    if (props.variant === 'card') {
        return props.layout === 'vertical' ? 'space-y-4' : 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4'
    }
    
    return baseClasses[props.layout] || baseClasses.horizontal
})

const uniqueName = computed(() => {
    return `${props.name}_${Math.random().toString(36).substr(2, 9)}`
})

const updateValue = (value) => {
    if (props.disabled) return
    
    emit('update:modelValue', value)
    emit('change', value)
}
</script>