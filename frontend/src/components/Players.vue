<template>
    <div class="container">
        <h1>Listado de Jugadores</h1>
        <table>
        <thead>
            <tr>
            <th>EMBLEMA</th>
            <th>NOMBRE</th>
            <th>POSICIÓN</th>
            <th>NACIONALIDAD</th>
            <th>NÚMERO</th>
            <th>ACCION</th>
            </tr>
        </thead>
        <tbody>
            <tr
            v-for="(player, index) in players"
            :key="player.id"
            >
            <td>
                <img
                :src="player.currentTeam?.crest"
                alt="Crest"
                v-if="player.currentTeam?.crest"
                />
                <span v-else class="text-gray-500">Sin Emblema</span>
            </td>
            <td>{{ player.name }}</td>
            <td>{{ player.position }}</td>
            <td>{{ player.nationality }}</td>
            <td>{{ player.shirtNumber || 'N/A' }}</td>
            <td>
                <router-link :to="`/players/${player.id}`">
                Ver detalle
                </router-link>
            </td>
            </tr>
        </tbody>
        </table>
        <p v-if="players.length === 0">
            Aún no hay jugadores disponibles
        </p>
    </div>
</template>

<script>
    import { ref, onMounted } from "vue";

    export default {
    name: "Players",
    setup() {
        const players = ref([]);

        const fetchPlayers = async () => {
        try {
            const response = await fetch("http://127.0.0.1:8000/api/players"); // Cambia al endpoint correcto
            if (!response.ok) {
            throw new Error("Error al obtener los jugadores del API");
            }

            const result = await response.json();
            players.value = result.players.map((item) => ({
            id: item.id,
            name: item.name,
            position: item.position,
            nationality: item.nationality,
            shirtNumber: item.shirtNumber,
            currentTeam: item.currentTeam, // Información del equipo actual
            }));
        } catch (error) {
            console.error("Error al consumir el API:", error);
        }
        };

        onMounted(() => {
        fetchPlayers();
        });

        return {
        players,
        };
    },
    };
</script>