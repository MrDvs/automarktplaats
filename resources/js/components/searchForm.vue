<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Zoeken</div>
                    <div class="card-body">
                        <form @submit="formSubmit">
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

                        <button class="btn btn-success">Zoeken</button>
                        </form>
                        <strong>Output:</strong>
                        <pre>
                        {{output}}
                        </pre>
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
              output: ''
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
                    model: this.selectedModel
                })
                .then(function (response) {
                    currentObj.output = response.data.redirect;
                    window.location = response.data.redirect;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            }
        }
    }
</script>
