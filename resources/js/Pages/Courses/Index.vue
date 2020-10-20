<template>
    <app-layout>
        <template #header>
            Liste des formations
        </template>
        <section class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div v-if="$page.flash.success" class="bg-green-200 text-green-600 p-4">
                {{ $page.flash.success }}
            </div>
                <div class="py-3" v-for="course in courses.data" v-bind:key="course.id">
                    <div class="bg-white rounded shadow p-4">
                        <div class="text-sm text-gray-500 flex justify-between items-center">
                        <div>
                            Mise en ligne par <strong>{{ course.user.name }}</strong> (<span class="text-gray-500 text-sm">{{ course.participants }} participant<span v-if="parseInt(course.participants) > 1 ">s</span>)
                            </span>
                        </div>
                        <span class="block text-sm text-gray-400">{{ course.episodes_count }} épisode<span v-if="course.episodes_count > 1">s</span></span>
                        </div>
                        <h1 class="text-3xl">{{ course.title }}</h1>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                            {{ convert(course.total_duration) }}</span>
                        <div class="text-sm text-gray-500 mt-2">{{ course.description }}</div>
                        <div class="flex justify-between items-center">
                            <a :href="'course/' + course.id" class="bg-indigo-700 text-white px-3 py-2 text-sm mt-3 inline-block rounded hover:bg-indigo-500">Voir la formation</a>
                            <a :href="'courses/edit/' + course.id" v-if="course.update" class="bg-gray-700 text-white px-3 py-2 text-sm mt-3 inline-block rounded hover:bg-gray-500">Editer</a>
                        </div>
                    </div>
                </div>
                <inertia-link :href="link.url" class="text-indigo-700 border-gray-500 p-5" v-for="link in courses.links" v-bind:key="link.label">
                    <span v-bind:class="{'text-red-700' : link.active}">{{ link.label }}</span>
                </inertia-link>
            </div>
        </section>
    </app-layout>
</template>

<script>

import AppLayout from './../../Layouts/AppLayout';

export default {
    components: {
        AppLayout
    },

    props: ['courses'],

    methods: {
        convert(timestamps) {
            let hours = Math.floor(timestamps / 3600);
            let minutes = Math.floor(timestamps / 60) - (hours * 60);
            let seconds = timestamps % 60;

            return hours.toString().padStart(2, 0) + ':' + minutes.toString().padStart(2, 0) + ':' + seconds.toString().padStart(2, 0);
        }
    }
}
</script>
