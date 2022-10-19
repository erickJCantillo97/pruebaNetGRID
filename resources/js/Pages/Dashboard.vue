<template>
    <app-layout>
        <v-app>
            <v-main>
                <v-container>
                    <v-pagination
                    v-model="page"
                    :length="42"
                    :total-visible="10"
                    @input="traer(page)"
                    prev-icon="mdi-menu-left"
                    next-icon="mdi-menu-right"
                  ></v-pagination>
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <v-card  v-for="personaje in personajes" outlined>
                        <v-list-item three-line>
                            <v-list-item-content>
                                <div class="text-overline mb-4">
                                   {{personaje.status}} - {{ personaje.species}}
                                </div>
                                <v-list-item-title class="text-h5 mb-1">
                                {{personaje.name}}
                                </v-list-item-title>
                                
                            </v-list-item-content>
                            <v-list-item-avatar>
                                <v-img :src="personaje.image" width="500px"></v-img>
                            </v-list-item-avatar>
                        </v-list-item>

                        <v-card-actions class="justify-between">
                            <v-btn
                            class="mx-2"
                            fab
                            dark
                            small
                            @click="Agregarfavorito(personaje.id)"
                            color="red">
                                <v-icon v-text="favoritos.indexOf(personaje.id) == -1 ? 'mdi-heart':'mdi-heart-off'" dark>
                                </v-icon>
                            </v-btn>
                            <inertia-link
                            class="mx-2"
                            fab
                            as="v-btn"
                            :href="route('personaje', {id: personaje.id})"
                            dark
                            small
                            color="primary">
                                <v-icon dark>
                                    mdi-information-variant
                                  </v-icon>
                            </inertia-link>
                        </v-card-actions>
                    </v-card>
                  </div>
                </v-container>
            </v-main>
            <v-footer padless>
                <v-col class="text-center" cols="12">
                    {{ new Date().getFullYear() }} — <strong>Erick Cantillo</strong>
                </v-col>
            </v-footer>
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
        this.traer(1),
        this.traerFavoritos()

    },
    data() {
        return {
            personajes: [],
            favoritos: [],
            page: 1,
        }
    },
    methods: {
        traer(offset) {
            axios.get('https://rickandmortyapi.com/api/character/?page=' + offset)
                .then(res => {
                    this.personajes = res.data.results;
                })
        },
        traerFavoritos(id){
            axios.get('/favoritos').then(res => {
                this.favoritos = res.data;
               
            })
        },
        Agregarfavorito(id){
            axios.post('/agregarFavorito', {'user_id': this.$page.props.user.id, 'ref_api':id})
            this.traerFavoritos()
        }
    },


}
</script>
