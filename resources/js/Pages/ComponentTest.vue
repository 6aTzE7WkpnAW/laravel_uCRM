<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'

import { ref } from 'vue'

const title = ref('初期値')
</script>

<template>
  <GuestLayout>
    <InputLabel value="件名">タイトル</InputLabel>
    <TextInput v-model="title" />
  </GuestLayout>
</template>