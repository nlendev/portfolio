<script setup>
import { Form, Head } from '@inertiajs/vue3';
import ContactController from '@/actions/App/Http/Controllers/ContactController';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { Textarea } from '@/components/ui/textarea';
</script>

<template>
    <Head title="Contact">
        <meta
            head-key="description"
            name="description"
            content="Écrire à Nathanaël Lenaerts, un projet, un stage."
        />
    </Head>

    <div class="max-w-xl space-y-6 py-8">
        <h1 class="font-display text-3xl font-bold md:text-4xl">Contact</h1>

        <Form
            v-bind="ContactController.store.form()"
            :reset-on-success="['name', 'email', 'message']"
            v-slot="{ errors, processing }"
            class="space-y-6"
        >
            <div class="grid gap-2">
                <Label for="name">Nom</Label>
                <Input id="name" name="name" autocomplete="name" />
                <InputError :message="errors.name" />
            </div>

            <div class="grid gap-2">
                <Label for="email">Adresse e-mail</Label>
                <Input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                />
                <InputError :message="errors.email" />
            </div>

            <div class="grid gap-2">
                <Label for="message">Message</Label>
                <Textarea id="message" name="message" rows="6" />
                <InputError :message="errors.message" />
            </div>

            <Button type="submit" :disabled="processing">
                <Spinner v-if="processing" />
                Envoyer
            </Button>
        </Form>
    </div>
</template>
