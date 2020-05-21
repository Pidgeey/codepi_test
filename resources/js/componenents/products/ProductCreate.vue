<template>
    <div>
        <h2 class="font-weight-bold">Créer un nouveau produit</h2>
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
                <label for="name">Nom du produit</label>
                <input class="form-control" id="name" type="text" v-model="product.name">
                <small class="form-text text-muted">Minimum 6 caractères, maximum 80 caractères</small>
            </div>
            <div class="row">
                <div class="form-check col-6">
                    <div class="font-weight-bold mb-1">Categories</div>
                    <ul>
                        <li v-for="category in categories" :key="category.name" class="mt-1">
                            <input type="checkbox" :id="category.name" v-model="product.categories" :value="category.id">
                            <label :for="category.name">{{category.name}}</label>
                        </li>
                    </ul>
                    <small class="form-text text-muted">Minimum 1 catégorie</small>
                </div>
                <div class="form-check col-6">
                    <div class="font-weight-bold mb-1">Caractéristiques</div>
                    <ul>
                        <li v-for="characteristic in characteristics" :key="characteristic.name" class="mt-1">
                            <input type="checkbox" :id="characteristic.name" v-model="product.characteristics" :value="characteristic.id">
                            <label :for="characteristic.name">{{characteristic.name}}</label>
                        </li>
                    </ul>
                    <small class="form-text text-muted">Minimum 3 caractéristiques</small>
                </div>
            </div>
        </form>
        <button class="btn btn-success" @click="createProduct">Valider</button>
        <button class="btn btn-danger" @click="$emit('template', 'HomeList')">Retour</button>
    </div>
</template>
<script>
    // TODO: Faire des validations plus profondes (pouvoir selectionner uniquement les caracteristiques adéquates aux
    // catégories sélectionnées )
    import axios from 'axios';
    export default {
        data:() => ({
            categories: [],
            characteristics: [],
            product: {
                name: "",
                categories: [],
                characteristics: []
            },
            errors: null
        }),
        created(){
            let vm = this
            axios.get('api/categories/get-list')
            .then((response) => {
                let c = []
                for (let value of response.data.data) {
                    vm.categories.push({id: value.id, name: value.name})
                    for (let characteristic of value.characteristics) {
                        if (!c.includes(characteristic.name)) {
                            c.push(characteristic.name)
                            vm.characteristics.push(characteristic)
                        }
                    }
                }
            })
        },
        methods: {
            createProduct(){
                let vm = this
                axios.post('api/products/create', vm.product)
                .then(() => {
                    alert('Produit crée')
                    vm.$emit('template', 'HomeList')
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
