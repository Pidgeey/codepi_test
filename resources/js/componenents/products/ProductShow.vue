<template>
    <div>
        <div class="row d-flex align-items-center mb-4">
            <h2 class="col-4 font-weight-bold">{{product.name}}</h2>
            <button class="btn btn-primary col-2 mr-2" @click="$emit('template', 'ProductEdit')">Modifier le produit</button>
            <button class="btn btn-danger col-2" v-if="product.deleted_at === null" @click="deleteProduct">Supprimer ce produit</button>
            <button class="btn btn-success col-2" v-if="product.deleted_at !== null" @click="restoreProduct">Restaurer ce produit</button>
        </div>
        <div class="row">
            <div class="col-6">
                <h5 class="font-weight-bold mb-2">Categories</h5>
                <ul>
                    <li v-for="category in product.categories" :key="category.id">
                        {{category.name}}
                    </li>
                </ul>
            </div>
            <div class="col-6">
                <h5 class="font-weight-bold mb-2">Caractéristiques</h5>
                <ul>
                    <li v-for="characteristic in product.characteristics" :key="characteristic.id">
                        {{characteristic.name}}
                    </li>
                </ul>
            </div>
        </div>
        <button class="btn btn-danger" @click="$emit('template', 'HomeList')">Retour</button>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        props: ['product'],
        methods: {
            deleteProduct(){
                let vm = this
                axios.delete('api/products/delete/' + vm.$props.product.id)
                .then(() => {
                    alert('Produit retiré de la liste')
                    vm.$emit('template', 'HomeList')
                })
            },
            restoreProduct(){
                let vm = this
                axios.post('api/products/restore/' + vm.$props.product.id)
                .then((response) => {
                    alert('Produit remis en ligne')
                    vm.$emit('product', response.data.data)
                })
            }
        }
    }
</script>
