<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Zoeken</div>
                    <div class="card-body">
                        <form @submit="formSubmit">
                        <strong>Merk:</strong>
                        <select class="form-control" v-model="choosen">

                            <option v-for="item in makes">
                                {{item.make}}
                            </option>

                        </select>

                        <strong>Description:</strong>
                        <textarea class="form-control" v-model="description"></textarea>

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
              makes: [],
              choosen: '',
              description: '',
              output: ''
            };
        },

        created() {
            axios
                .post('axiostest')
                .then(response => (this.makes = response.data))
                .catch(error => console.log(error))
        },

        mounted() {
            console.log('Component mounted.')

        },


        methods: {
            // makeChange(e) {

            // }

            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
                axios.post('axiostest', {
                    // name: this.name,
                    // description: this.description
                })
                .then(function (response) {
                    currentObj.output = response.data;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            }
        }
    }
</script>
