<template>
    <div>
        <div class="d-flex row align-items-center mb-4">
            <h2 class="col-4">Liste des catégories</h2>
            <button class="btn btn-success col-2" @click="$emit('template', 'CategoryCreate')">Créer une catégorie</button>
        </div>
        <div class="row">
            <ul class="col-12">
                <li v-for="category in categories" :key="category.id" class="d-flex align-items-center row">
                    <div v-if="edit !== category" class="col-4">{{category.name}}</div>
                    <label class="col-4" :for="category.name" v-if="edit === category">{{category.name}}</label>
                    <input type="text" :id="category.name" v-if="edit === category" v-model="name">
                    <button class="btn btn-primary m-2 col-2" v-if="edit !== category" @click="edit = category">Modifier</button>
                    <button class="btn btn-success ml-1 mr-1" v-if="edit === category" @click="editCategory">Ok</button>
                    <button class="btn btn-danger" v-if="edit === category" @click="edit = null">Annuler</button>
                </li>
            </ul>
        </div>
        <button class="btn btn-danger" @click="$emit('template', 'HomeList')">Retour</button>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        data:() => ({
            categories: [],
            name: "",
            edit: null
        }),
        created(){
            this.getCategories()
        },
        methods: {
            editCategory(){
                let vm = this
                axios.post('api/categories/update/' + vm.edit.id, {name: vm.name})
                .then(() => {
                    alert('Catégorie modifié')
                    vm.getCategories()
                })
            },
            getCategories(){
                let vm = this
                axios.get('api/categories/get-list')
                    .then((response) => {vm.categories = response.data.data})
            }
        }
    }
</script>
