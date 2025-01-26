<template>
    <div class="container">
        <h1>Detalle de Competencia</h1>
        <div v-if="competition">
        <div class="container_emblem">
            <img
                :src="competition.emblem"
                alt="Emblem"
                v-if="competition.emblem"
                class="emblem_competencia"
            />
            <p v-else>Sin Emblema</p>
        </div>
        <div class="container_info_competencia">
            <h2>Información</h2>
            <p><strong>Código:</strong> {{ competition.id }}</p>
            <p><strong>Nombre:</strong> {{ competition.name }}</p>
            <p><strong>Código:</strong> {{ competition.code }}</p>
            <p><strong>Tipo:</strong> {{ competition.type }}</p>
            <p><strong>Temporada Actual:</strong></p>
            <ul>
                <li><strong>Inicio:</strong> {{ competition.currentSeason?.startDate }}</li>
                <li><strong>Fin:</strong> {{ competition.currentSeason?.endDate }}</li>
            </ul>
            <p>
                <strong>Última Actualización:</strong> {{ competition.lastUpdated }}
            </p>
            </div>
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