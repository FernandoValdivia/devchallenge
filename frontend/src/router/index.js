import { createRouter, createWebHistory } from 'vue-router';
import Competitions from '../components/Competitions.vue';
import DetalleCompetitions from "../components/DetalleCompetitions.vue";
import DetalleTeam from "../components/DetalleTeam.vue";
import DetallePlayer from "../components/DetallePlayer.vue";
import Teams from '../components/Teams.vue';
import Players from '../components/Players.vue';

const routes = [
    { path: '/', redirect: '/competitions' }, 
    { path: '/competitions', component: Competitions },
    { path: "/competitions/:id", component: DetalleCompetitions },
    { path: '/teams', component: Teams },
    { path: "/teams/:id", component: DetalleTeam },
    { path: '/players', component: Players },
    { path: "/players/:id", component: DetallePlayer },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
