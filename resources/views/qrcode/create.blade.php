<x-splade-modal class="bg-slate-100 rounded-lg w-full h-full">
    <div class="mx-auto>">
    <h2 class="text-2xl font-semibold mb-4">Add a new Trackable Asset</h2>
        <x-splade-form :for="$form" />
    </div>
</x-splade-modal>


<script setup>
    import {
        ref
    } from 'vue';

    const form = ref({
        name: '',
        email: ''
    });
</script>
