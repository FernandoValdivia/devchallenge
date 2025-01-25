<template>
    <div class="container">
        <h1>LISTA DE COMPETENCIAS</h1>
        <div class="container_table">
            <table>
                <thead>
                    <tr>
                        <th>EMBLEMA</th>
                        <th>NOMBRE</th>
                        <th>CODIGO</th>
                        <th>TIPO</th>
                        <th colspan="2">TEMPORADA ACTUAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(competition, index) in competitions"
                        :key="competition.id"
                    >
                        <td>
                            <img
                                :src="competition.emblem"
                                alt="Emblem"
                                v-if="competition.emblem"
                            />
                            <span v-else>Sin Emblema</span>
                        </td>
                        <td>
                            <router-link :to="`/competitions/${competition.id}`">  
                                {{ competition.name }}
                            </router-link>
                        </td>
                        <td>{{ competition.code }}</td>
                        <td>{{ competition.type }}</td>
                        <td>
                            {{ competition.currentSeason?.startDate }}
                        </td>
                        <td>
                            {{ competition.currentSeason?.endDate }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p v-if="competitions.length === 0">
            Cargando información...
        </p>
    </div>
</template>

<script>
    import { ref, onMounted } from "vue";

    export default {
    name: "CompetitionsTable",
    setup() {
        const competitions = ref([]);

        const fetchCompetitions = async () => {
        try {
            const response = await fetch("http://127.0.0.1:8000/api/competitions");
            if (!response.ok) {
            throw new Error("Error al obtener las competencias del API");
            }

            const result = await response.json();
            competitions.value = result.competitions.map((item) => ({
            id: item.id,
            name: item.name,
            code: item.code,
            type: item.type,
            currentSeason: item.currentSeason,
            emblem: item.emblem, // Agregamos el campo emblem
            }));
        } catch (error) {
            console.error("Error al consumir el API:", error);
        }
        };

        onMounted(() => {
        fetchCompetitions();
        });

        return {
        competitions,
        };
    },
    };
</script>