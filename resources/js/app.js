require('./bootstrap');

window.Vue = require('vue');
// Home components
import HomeList from "./componenents/HomeList.vue";
// Products components
import ProductShow from "./componenents/products/ProductShow";
import ProductEdit from "./componenents/products/ProductEdit";
import ProductCreate from "./componenents/products/ProductCreate";
// Categories components
import CategoryCreate from "./componenents/categories/CategoryCreate";
import CategoryList from "./componenents/categories/CategoryList";

const app = new Vue({
    el: '#app',
    data:() => ({
        currentTemplate: HomeList,
        currentProduct: null
    }),
    components: {
        HomeList,
        ProductShow,
        ProductEdit,
        ProductCreate,
        CategoryCreate,
        CategoryList
    },
    computed: {
        chooseComponent(){
            return this.currentTemplate;
        }
    },
    methods: {
        template: function (value) {
            this.currentTemplate = value;
        },
        product: function (value) {
            this.currentProduct = value
        },
    }
})
