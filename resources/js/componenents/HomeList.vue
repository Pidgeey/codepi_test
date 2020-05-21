<template>
    <div>
        <button class="btn btn-primary" @click="$emit('template', 'ProductCreate')">Créer un nouveau produit</button>
        <button class="btn btn-primary" @click="$emit('template', 'CategoryList')">Liste des catégories</button>
        <div class="row">
            <div class="col-4 mt-4">
                <h5>Catégories</h5>
                <ul>
                    <li v-for="category in categories" :key="category.name">
                        <input type="checkbox" :id="category.name" v-model="categoriesChecked" :value="category.id">
                        <label :for="category.name">{{category.name}}</label>
                    </li>
                </ul>
                <h5>Caractéristiques</h5>
                <ul>
                    <li v-for="characteristic in characteristics" :key="characteristic.name">
                        <input type="checkbox" :id="characteristic.name" v-model="characteristicsChecked" :value="characteristic.id">
                        <label :for="characteristic.name">{{characteristic.name}}</label>
                    </li>
                </ul>
                <input type="checkbox" v-model="softDelete" id="softDelete">
                <label for="softDelete">Inclure les produits retirés ?</label>
                <button class="btn-success btn" @click="getProducts">Filtrer la recheche</button>
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="card col-12 m-4" v-for="product in products" :key="product.name">
                        <div class="card-body">
                            <h5 class="card-title">{{product.name}}</h5>
                            <div class="row">
                                <div class="col-6">
                                    <div class="font-weight-bold">Catégories</div>
                                    <ul>
                                        <li v-for="category in product.categories">
                                            {{category.name}}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <div class="font-weight-bold">Caractéristiques</div>
                                    <ul>
                                        <li v-for="characteristic in product.characteristics">
                                            {{characteristic.name}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <button class="btn btn-primary" @click="getProduct(product)">Voir le détail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        data:() => ({
            products: [],
            categories: [],
            characteristics: [],
            categoriesChecked: [],
            characteristicsChecked: [],
            softDelete: false
        }),
        created(){
            this.getProducts()
        },
        methods: {
            getProducts(){
                let vm = this
                axios.get('api/products/get-list', {
                    params: {
                        with_soft_deletes: vm.softDelete ? 1 : 0,
                        categories: vm.categoriesChecked,
                        characteristics: vm.characteristicsChecked
                    }
                })
                .then((response) => {
                    vm.products = response.data.data
                    vm.getCategories()
                })
            },
            getProduct(product){
                this.$emit('product', product)
                this.$emit('template', 'ProductShow')
            },
            getProductsWithTrashed(){
                let vm = this
                axios.get('api/products/get-list', {
                    params: {
                        with_soft_deletes: 1
                    }
                })
                .then((response) => {vm.products = response.data.data})
            },
            getCategories(){
                let vm = this
                axios.get('api/categories/get-list')
                .then((response) => {
                    let c = []
                    let categories = []
                    let characteristics = []
                    for (let value of response.data.data) {
                        categories.push({id: value.id, name: value.name})
                        for (let characteristic of value.characteristics) {
                            // Check for double characteristics
                            if (!c.includes(characteristic.name)) {
                                c.push(characteristic.name)
                                characteristics.push(characteristic)
                            }
                        }
                    }
                    vm.categories = categories
                    vm.characteristics = characteristics
                })
            },
        }
    }
</script>
