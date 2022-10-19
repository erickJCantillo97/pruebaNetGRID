<template>
    <app-layout>
        <v-app>
            <v-card class="mx-auto my-2">
                <template slot="progress">
                    <v-progress-linear color="deep-purple" height="10" indeterminate></v-progress-linear>
                </template>
                <v-img height="250" contain :src="personaje.image"></v-img>
                <v-card-title>{{personaje.name}}</v-card-title>
                <v-card-text>
                    <v-list-item>
                        <v-list-item-content>
                          <v-list-item-title>Genero: {{personaje.gender}}</v-list-item-title>
                        </v-list-item-content>
                      </v-list-item>
                    <v-list-item>
                        <v-list-item-content>
                          <v-list-item-title>Especie: {{personaje.species}}</v-list-item-title>
                        </v-list-item-content>
                      </v-list-item>
                    <v-list-item>
                        <v-list-item-content>
                          <v-list-item-title>Estado: {{personaje.status}}</v-list-item-title>
                        </v-list-item-content>
                      </v-list-item>    
                </v-card-text>
            </v-card>
        </v-app>
    </app-layout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import axios from 'axios'

export default {
    components: {
        AppLayout,
        Welcome,
    },
    created() {
        this.traer(1)
    },
    props: ['id'],
    data() {
        return {
            personaje: {},
            page: 1,
        }
    },
    methods: {
        traer(offset) {
            axios.get('https://rickandmortyapi.com/api/character/' + this.id)
                .then(res => {
                   this.personaje = res.data
                })
        },
      
    },


}
</script>
