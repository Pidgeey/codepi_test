<template>
    <div>
        <h2 class="font-weight-bold">{{product.name}}</h2>
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
                <label for="currentName">Modifier le nom</label>
                <input type="text" :placeholder="currentProduct.name" class="form-control" id="currentName" v-model="currentProduct.name">
                <small class="form-text text-muted">Minimum 6 caractères, maximum 80 caractères</small>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="font-weight-bold mb-2">Categories</div>
                    <ul>
                        <li v-for="category in categories" :key="category.id">
                            {{category.name}}
                        </li>
                    </ul>
                </div>
                <div class="col-6 form-check">
                    <div class="font-weight-bold mb-2">Caractéristiques</div>
                    <ul>
                        <li v-for="characteristic in characteristics" :key="characteristic.id">
                            <label :for="characteristic.name">{{characteristic.name}}</label>
                            <input type="checkbox" :id="characteristic.name" v-model="currentProduct.characteristics" :value="characteristic">
                        </li>
                    </ul>
                    <small class="form-text text-muted">Une caractéristique minimum</small>
                </div>
            </div>
            <button type="submit" class="btn btn-success" @click.prevent="updateProduct">Valider</button>
            <button class="btn btn-danger" @click="$emit('template', 'ProductShow')">Retour</button>
        </form>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        data:() => ({
            categories: [],
            characteristics: [],
            currentProduct: {
                name: "",
                categories: [],
                characteristics: []
            },
            errors: null,
        }),
        props: ['product'],
        created(){
            let vm = this
            let categories = []
            for (let value of this.$props.product.categories) {
                categories.push(value.id)
            }
            axios.get('api/categories/get-list', {
                params: {
                    categories_id: categories
                }
            })
            .then((response) => {
                for (let value of response.data.data) {
                    vm.categories.push({id: value.id, name: value.name})
                    vm.characteristics = vm.characteristics.concat(value.characteristics)
                }
            })
            this.currentProduct.name = this.$props.product.name
            this.currentProduct.categories = this.$props.product.categories
            this.currentProduct.characteristics = this.$props.product.characteristics
        },
        methods: {
            updateProduct(){
                let vm = this
                let categories = []
                let characteristics = []
                // Get id from checked categories
                for (let category of this.currentProduct.categories) {
                    categories.push(category.id)
                }
                // Get id from checked characteristics
                for (let characteristic of this.currentProduct.characteristics) {
                    characteristics.push(characteristic.id)
                }
                axios.post('api/products/update/' + vm.$props.product.id, {
                    name: vm.currentProduct.name,
                    categories: categories,
                    characteristics: characteristics
                })
                .then((response) => {
                    alert('Produit modifié')
                    vm.$emit('product', response.data.data)
                    vm.$emit('template', "ProductShow")
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
