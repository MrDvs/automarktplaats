<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Zoeken</div>
                    <div class="card-body">
                        <form @submit="formSubmit">
                        <div  v-if="feedback">
                            <span  style="color:red" v-text="feedback" ></span>
                        </div>
                        <strong>Merk:</strong>
                        <select @change="makeChange" class="form-control" v-model="selectedMake">
                            <option value="alle">Alle</option>
                            <option v-for="item in makes" v-bind:value="item.make">
                                {{item.make}}
                            </option>
                        </select>
                        <strong>Model:</strong>
                        <select class="form-control" :disabled="this.models == []" v-model="selectedModel">
                            <option value="alle" v-if="this.models != []">Alle</option>
                            <option v-for="item in models" v-bind:value="item.model">
                                {{item.model}}
                            </option>
                        </select>
                        <strong>Bouwjaar (minimum):</strong>
                        <input type="text" maxlength="4" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  class="form-control" v-model="selectedYear">
                        <strong>Prijs (maximum):</strong>
                        <input type="text" maxlength="11" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  class="form-control" v-model="selectedPrice">
                        <button class="btn btn-success">Zoeken</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
              makes: '',
              selectedMake: 'alle',
              models: '',
              selectedModel: 'alle',
              feedback: '',
              selectedYear: '',
              selectedPrice: ''
            };
        },

        created() {
            axios
                .post('getMakes')
                .then(response => (this.makes = response.data))
                .catch(error => console.log(error))
        },

        mounted() {
            console.log('Component mounted.')
        },


        methods: {
            makeChange() {
                this.models = '';
                axios
                    .post('getModels', {make: this.selectedMake})
                    .then(response => (this.models = response.data))
                    .catch(error => console.log(error))
            },

            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
                axios.post('listing/zoeken', {
                    make: this.selectedMake,
                    model: this.selectedModel,
                    year: this.selectedYear,
                    price: this.selectedPrice
                })
                .then(function (response) {
                    console.log(response.data.redirect);
                    window.location = response.data.redirect;
                })
                .catch(function (error) {
                    // currentObj.output = error;
                    currentObj.feedback = error.response.data.message;
                });
            }
        }
    }
</script>
