<template>
    <div v-if="hasErrors" class="text-red-600">
        <div class="font-medium">Whoops! Something went wrong.</div>

        <ul class="mt-3 text-sm list-disc list-inside">
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>

<script>
    import { computed } from 'vue';
    import { usePage } from '@inertiajs/inertia-vue3';

    export default {
        name: 'ValidationErrors',
        setup(props) {
            const errors = computed(() => usePage().props.value.errors);

            const hasErrors = computed(() => Object.keys(errors.value).length > 0);

            return {
                errors,
                hasErrors,
            };
        },
    };
</script>
