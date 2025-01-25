<template>
    <div class="container">
        <h1>DETALLE DEL JUGADOR: {{ player.id }}</h1>
        <div v-if="player">
            
        <!-- Información del Jugador -->
        <h2>Información Personal</h2>
        <h3>{{ player.name }}</h3>
        <p><strong>Fecha de Nacimiento:</strong> {{ player.dateOfBirth }}</p>
        <p><strong>Nacionalidad:</strong> {{ player.nationality }}</p>
        <p><strong>Sección:</strong> {{ player.section }}</p>
        <p><strong>Posición:</strong> {{ player.position }}</p>
        <p><strong>Número de Camiseta:</strong> {{ player.shirtNumber }}</p>

        <!-- Información del Equipo Actual -->
        <h2>Equipo Actual</h2>
        <div v-if="player.currentTeam">
            <div>
            <img
                :src="player.currentTeam.crest"
                alt="Team Crest"
                class="w-24 h-24 object-contain mx-auto"
            />
            </div>
            <p><strong>Nombre del Equipo:</strong> {{ player.currentTeam.name }}</p>
            <p><strong>Colores del Club:</strong> {{ player.currentTeam.clubColors }}</p>
            <p><strong>Sitio Web:</strong> 
            <a 
                :href="player.currentTeam.website" 
                target="_blank" 
            >
                {{ player.currentTeam.website }}
            </a>
            </p>
            <p><strong>Estadio:</strong> {{ player.currentTeam.venue }}</p>
            <p><strong>Fundación:</strong> {{ player.currentTeam.founded }}</p>
        </div>

        <!-- Competencias -->
        <h2>Competencias en Curso</h2>
        <ul>
            <li v-for="competition in player.currentTeam.runningCompetitions" :key="competition.id">
            {{ competition.name }} ({{ competition.code }}) - {{ competition.type }}
            </li>
        </ul>
        </div>
        <p v-else>Cargando información del jugador...</p>
    </div>
</template>

<script>
    import { ref, onMounted } from "vue";
    import { useRoute } from "vue-router";

    export default {
    name: "PlayerDetail",
    setup() {
        const player = ref(null);
        const route = useRoute();

        const fetchPlayerDetail = async () => {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/players/${route.params.id}`);
            if (!response.ok) {
            throw new Error("Error al obtener el detalle del jugador");
            }

            player.value = await response.json();
        } catch (error) {
            console.error("Error al consumir el API:", error);
        }
        };

        onMounted(() => {
        fetchPlayerDetail();
        });

        return {
        player,
        };
    },
    };
</script>