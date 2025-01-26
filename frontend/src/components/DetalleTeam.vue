<template>
    <div class="container">
        <h1>Detalle del Equipo</h1>
        <div v-if="team">
            <div class="container_emblem">
                <img
                :src="team.crest"
                alt="Emblem"
                class="w-24 h-24 object-contain mx-auto"
                v-if="team.crest"
                />
                <p v-else>Sin Emblema</p>
            </div>
            <div class="container_info_competencia">
                <h2>Información</h2>
                <p><strong>Nombre:</strong> {{ team.name }}</p>
                <p><strong>Abreviatura:</strong> {{ team.tla }}</p>
                <p><strong>Dirección:</strong> {{ team.address }}</p>
                <p><strong>Sitio web:</strong> <a :href="team.website" target="_blank" class="text-blue-500 hover:underline">{{ team.website }}</a></p>
                <p><strong>Fundación:</strong> {{ team.founded }}</p>
                <p><strong>Colores del Club:</strong> {{ team.clubColors }}</p>
                <p><strong>Estadio:</strong> {{ team.venue }}</p>
            </div>
        </div>
        <p v-else>Cargando información del equipo...</p>
    </div>
</template>

<script>
    import { ref, onMounted } from "vue";
    import { useRoute } from "vue-router";

    export default {
    name: "DetalleTeam",
    setup() {
        const team = ref(null);
        const route = useRoute();

        const fetchTeamDetail = async () => {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/team/${route.params.id}`);
            if (!response.ok) {
            throw new Error("Error al obtener el detalle del equipo");
            }

            team.value = await response.json();
        } catch (error) {
            console.error("Error al consumir el API:", error);
        }
        };

        onMounted(() => {
        fetchTeamDetail();
        });

        return {
        team,
        };
    },
    };
</script>
