<template>
    <div>
         <form v-on:submit.prevent="createCar" method="post">
            <div v-bind:class="{'form-group': true, 'has-error': errors.model_name}">
                <label>Model Name:</label>
                <input type="text" v-model="car.model_name" class="form-control">
                <span class="help-block" v-for="error in errors.model_name" :key="error.id">{{ error }}</span>
            </div>

            <div v-bind:class="{'form-group': true, 'has-error': errors.color}">
                <label>Color:</label>
                <input type="text" v-model="car.color" class="form-control">
                <span class="help-block" v-for="error in errors.color" :key="error.id">{{ error }}</span>
            </div>

            <div v-bind:class="{'form-group': true, 'has-error': errors.year_production}">
                <label>Year Of Production:</label>
                <input type="text" v-model="car.year_production" class="form-control">
                <span class="help-block" v-for="error in errors.year_production" :key="error.id">{{ error }}</span>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create New Car</button>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Model Name</th>
                    <th>Color</th>
                    <th>Year Of Production</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <Car v-for="car in cars" :key="car.id" v-bind:car="car" 
                     v-on:delete-car="deleteCar" v-on:update-car="fetchCars">
                </Car>
            </tbody>
        </table>
    </div>
</template>

<script>
import Car from './Car.vue';
export default {
    data(){
        return {
            cars:[],
            errors:[],
            car:{
                color: '',
                model_name: '',
                year_production: '',
            }
        }
    },
    components: { Car },
    created(){
        this.fetchCars();
    },
    methods:{
        fetchCars(){
            this.$http.get('/cars').then(response => {
                this.cars = response.data.cars;
            });
        },
        createCar() {
            this.$http.post('/cars/', this.car).then(response => {
                this.cars.push(response.data.car);
                this.cars = {model_name:'',color:'',year_production:''};
                if (this.errors) {
                    this.errors = [];
                }
                console.log(response.data);
            }, response => {
                this.errors = response.data;
            });
        },

        deleteCar(car){
            this.$http.delete('/cars/' + car.id).then(response => {
                let index = this.cars.indexOf(car);
                this.cars.splice(index, 1);
                console.log(response.data);
            });
        }
    }
}
</script>
