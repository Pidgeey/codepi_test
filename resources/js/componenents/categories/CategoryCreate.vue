<template>
    <div>
        <h2 class="font-weight-bold">Créer une nouvelle catégorie</h2>
        <div v-if="errors !== null">
            <ul>
                <li v-for="(array, attribute) in errors" class="bg-danger">
                    <ul>
                        <li v-for="error in array">{{error}}</li>
                    </ul>
                </li>
            </ul>
        </div>
        <form>
            <div class="form-group">
                <label for="category">Nom de la catégorie</label>
                <input class="form-control" type="text" id="category" v-model="category.name">
                <small class="form-text text-muted">Minimum 6 caractères, maximum 80 caractères</small>
            </div>
            <div class="form-check">
                <div class="font-weight-bold mb-1">Choisir les caractéristiques</div>
                <ul>
                    <li v-for="characteristic in characteristics" :key="characteristic.name" class="mt-1">
                        <input type="checkbox" :id="characteristic.name" v-model="category.characteristics" :value="characteristic.id">
                        <label :for="characteristic.name">{{characteristic.name}}</label>
                    </li>
                </ul>
            </div>
            <button type="submit" class="btn btn-primary" @click.prevent="createCategory">Créer une catégorie</button>
            <button class="btn btn-danger" @click="$emit('template', 'CategoryList')">Retour</button>
        </form>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        data:() => ({
            characteristics: [],
            category: {
                name: "",
                characteristics: []
            },
            errors: null
        }),
        created(){
            let vm = this
            axios.get('api/characteristics/get')
                .then((response) => {vm.characteristics = response.data.data})
        },
        methods: {
            createCategory(){
                let vm = this
                axios.post('api/categories/create', vm.category)
                .then(() => {
                    alert('Categorie crée')
                    vm.$emit('template', 'CategoryList')
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        vm.errors = error.response.data.errors;
                    } else {
                        vm.errors.push({error: ["An error has occurred"]})
                    }
                })
            }
        }
    }
</script>
