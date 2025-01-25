<template>
    <div class="container">
        <h1>Detalle de Competencia</h1>
        <div v-if="competition">
        <div>
            <img
            :src="competition.emblem"
            alt="Emblem"
            v-if="competition.emblem"
            />
            <p v-else>Sin Emblema</p>
        </div>
        <p><strong>Nombre:</strong> {{ competition.name }}</p>
        <p><strong>Código:</strong> {{ competition.code }}</p>
        <p><strong>Tipo:</strong> {{ competition.type }}</p>
        <p><strong>Temporada Actual:</strong></p>
        <ul>
            <li><strong>Inicio:</strong> {{ competition.currentSeason?.startDate }}</li>
            <li><strong>Fin:</strong> {{ competition.currentSeason?.endDate }}</li>
        </ul>
        <p v-if="competition.numberOfAvailableSeasons">
            <strong>Número de Temporadas:</strong> {{ competition.numberOfAvailableSeasons }}
        </p>
        <p v-else>
            <strong>Número de Temporadas:</strong> No disponible
        </p>
        <p>
            <strong>Última Actualización:</strong> {{ competition.lastUpdated }}
        </p>
        </div>
        <p v-else>Cargando información...</p>
    </div>
</template>

<script>
    import { ref, onMounted } from "vue";
    import { useRoute } from "vue-router";

    export default {
    name: "DetalleCompetitions",
    setup() {
        const competition = ref(null);
        const route = useRoute(); // Obtenemos el parámetro `id` desde la URL

        const fetchCompetitionDetail = async () => {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/competitions/${route.params.id}`);
            if (!response.ok) {
            throw new Error("Error al obtener el detalle de la competencia");
            }

            competition.value = await response.json();
        } catch (error) {
            console.error("Error al consumir el API:", error);
        }
        };

        onMounted(() => {
        fetchCompetitionDetail();
        });

        return {
        competition,
        };
    },
    };
</script>