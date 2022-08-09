<script setup>
import {defineComponent} from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link} from '@inertiajs/inertia-vue3';
// import 'highlight.js/styles/default.css';
// import {Highlight} from 'vue-markdown-highlight'
import {marked} from 'marked';

const props = defineProps({
    photo: Object
});

const content = marked.parse(props.photo.description)

</script>

<template>
    <app-layout title="Edit Photo">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Photo</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link
                    class="text-indigo-600 hover:text-indigo-900 pl-3 pr-3"
                    :href="route('admin.photos')"
                >
                    Back
                </Link>
                <div class="grid grid-cols-2">
                    <div class="preview p-4">
                        <img :src="'/storage/' + props.photo.path" alt/>
                    </div>
                    <div
                        v-html="content"
                        class="preview p-4">
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
