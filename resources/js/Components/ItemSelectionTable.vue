<!-- components/ItemSelectionTable.vue -->
<script setup>
import { computed } from 'vue'

const props = defineProps({
    items: {
        type: Array,
        required: true
    },
    quantities: {
        type: Array,
        default: () => ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]
    },
    showTotal: {
        type: Boolean,
        default: true
    }
})

const emit = defineEmits(['update:items'])

const totalPrice = computed(() => {
    let total = 0
    props.items.forEach(item => {
        total += item.price * item.quantity
    })
    return total
})

const updateQuantity = (index, quantity) => {
    const updatedItems = [...props.items]
    updatedItems[index].quantity = quantity
    emit('update:items', updatedItems)
}
</script>

<template>
    <div class="relative">
        <label class="leading-7 text-sm text-gray-600 mb-2 block">商品・サービス</label>
        <div class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 p-4">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-300">
                        <th class="text-left py-2 px-2 text-sm text-gray-600">ID</th>
                        <th class="text-left py-2 px-2 text-sm text-gray-600">商品名</th>
                        <th class="text-right py-2 px-2 text-sm text-gray-600">価格</th>
                        <th class="text-center py-2 px-2 text-sm text-gray-600 w-20">数量</th>
                        <th class="text-right py-2 px-2 text-sm text-gray-600 w-24">小計</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in items" :key="item.id" class="border-b border-gray-200">
                        <td class="py-2 px-2 text-sm text-gray-700">{{ item.id }}</td>
                        <td class="py-2 px-2 text-sm text-gray-700">{{ item.name }}</td>
                        <td class="py-2 px-2 text-sm text-gray-700 text-right">{{ item.price.toLocaleString() }}円</td>
                        <td class="py-2 px-2 text-center">
                            <select :value="item.quantity" @change="updateQuantity(index, $event.target.value)"
                                class="block py-2 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-500">
                                <option v-for="q in quantities" :value="q" :key="q">{{ q }}</option>
                            </select>
                        </td>
                        <td class="py-2 px-2 text-sm text-gray-700 text-right w-24">
                            {{ (item.price * item.quantity).toLocaleString() }}円
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div v-if="showTotal" class="text-right mt-4">
                <span class="text-lg font-semibold text-gray-700">
                    合計: {{ totalPrice.toLocaleString() }}円
                </span>
            </div>
        </div>
    </div>
</template>