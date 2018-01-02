<template lang="html">
    <tr>
        <td>
            <input type="text"  class="form-control" v-model="editForm.model_name" v-if="edit">
            <span v-else>{{ car.model_name }}</span>
        </td>
        <td>
            <input type="text"  class="form-control" v-model="editForm.color" v-if="edit">
            <span v-else>{{ car.color }}</span>
        </td>
        <td>
            <input type="text"  class="form-control" v-model="editForm.year_production" v-if="edit">
            <span v-else>{{ car.year_production }}</span>
        </td>

        <td>
            <button type="button" class="btn btn-info" v-on:click="editCar" v-if="!edit">Edit</button>

            <button type="button" class="btn btn-default" v-on:click="cancelEdit" v-if="edit">Cancel</button>

            <button type="button" class="btn btn-primary" v-on:click="updateCar(car, editForm)" v-if="edit">update</button>

            <button type="button" class="btn btn-danger" v-on:click="$emit('delete-car', car)" v-if="!edit">Delete</button>
        </td>
    </tr>
</template>


<script>
    export default {
      props:['car'],
      data(){
        return {
        edit: false,
            editForm :{
                model_name: '',
                color: '',
                year_production: ''
            }
        }
      },
     
     methods: {
        editCar(){
            this.edit = true;
            this.editForm.model_name = this.car.model_name;
            this.editForm.color = this.car.color;
            this.editForm.year_production = this.car.year_production;
        },
        cancelEdit(){
            this.edit = false;
            this.editForm.model_name = '';
            this.editForm.color = '';
            this.editForm.year_production = '';
        },
        updateCar(oldCar, newCar){
            this.$http.patch('/cars/' + oldCar.id, newCar).then(response => {
                this.$emit('update-car');
                this.cancelEdit();
                console.log(response.data);
            }, (response) => {
                console.log(response.data);
            });
        }
    }
}
</script>
