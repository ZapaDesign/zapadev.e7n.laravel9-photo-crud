<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
defineProps({
    photos: Array
});
</script>

<template>
    <AppLayout title="Photos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Photos
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <section class="photos">
                        <div v-for="photo in photos" :key="photo.id" class="card" >
                            <img :src="photo.path" alt="">
                        </div>
                    </section>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<style>

.photos {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: space-between;
}

.card {
    flex: 1 0 200px;
}
</style>
