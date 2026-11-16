<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { home } from '@/routes';

const props = defineProps({
    status: Number,
});

const titles = {
    403: 'Accès refusé',
    404: 'Page introuvable',
    429: "Trop d'envois",
};

const messages = {
    403: "Vous n'avez pas accès à cette page.",
    404: "Cette page n'existe pas ou n'est plus en ligne.",
    429: 'Réessayez dans une minute.',
};

const title = computed(() => titles[props.status]);
const message = computed(() => messages[props.status]);
</script>
