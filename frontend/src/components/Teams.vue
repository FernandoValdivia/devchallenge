<template>
    <div class="container">
        <h1>LISTA DE EQUIPOS</h1>
        <div class="container_table">
            <table>
                <thead>
                    <tr>
                        <th>EMBLEMA</th>
                        <th>NOMBRE</th>
                        <th>ABREVIATURA</th>
                        <th>COLORES</th>
                        <th>ESTADIO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                    v-for="(team, index) in teams"
                    :key="team.id"
                    >
                    <td>
                        <img
                        :src="team.crest"
                        alt="Crest"
                        v-if="team.crest"
                        />
                        <span v-else>Sin Emblema</span>
                    </td>
                    <td>
                        <router-link :to="`/teams/${team.id}`">
                            {{ team.name }}
                        </router-link>
                    </td>
                    <td>{{ team.tla }}</td>
                    <td>{{ team.clubColors }}</td>
                    <td>{{ team.venue }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p v-if="teams.length === 0">
            Cargando información...
        </p>
    </div>
</template>

<script>
    import { ref, onMounted } from "vue";

    export default {
    name: "Teams",
    setup() {
        const teams = ref([]);

        const fetchTeams = async () => {
        try {
            const response = await fetch("http://127.0.0.1:8000/api/team/");
            if (!response.ok) {
            throw new Error("Error al obtener los equipos del API");
            }

            const result = await response.json();
            teams.value = result.teams.map((item) => ({
            id: item.id,
            name: item.name,
            tla: item.tla,
            crest: item.crest,
            clubColors: item.clubColors,
            venue: item.venue,
            }));
        } catch (error) {
            console.error("Error al consumir el API:", error);
        }
        };

        onMounted(() => {
        fetchTeams();
        });

        return {
        teams,
        };
    },
    };
</script>