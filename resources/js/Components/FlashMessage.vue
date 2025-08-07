<script setup>
</script>

<template>
    <div v-if="$page.props.flash.status === 'success'" class="bg-green-100 text-green-800 p-4 rounded mb-4">
        {{ $page.props.flash.message }}
    </div>
    <div v-else-if="$page.props.flash.status === 'error'" class="bg-red-100 text-red-800 p-4 rounded mb-4">
        {{ $page.props.flash.message }}
    </div>
</template>