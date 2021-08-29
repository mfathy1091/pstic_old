<template>
    <div>
        <div class="card col-12">
            <div class="card-body">
                <h5 class="card-title">Individual Search</h5>
                <p class="text-muted">Hint: You can search using part of the number</p>
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <input  v-model="keyword" v-validate="'required|email'" name="email" pattern="\d\d\d-\d\dC\d\d\d\d\d" class="form-control">
                        <span>{{ errors.first('email') }}</span>
                    </div>
                </div>

                <button id="search_btn" @click="getResults" class="btn btn-primary my-2 my-sm-2">Search</button>

                <table class="table">
                        <!-- TABLE TITLE -->
                    <tr>
                        <th>ID</th>
                        <th>Tag Name</th>
                        <th>Created At</th>
                    </tr>
                        <!-- TABLE TITLE -->


                        <!-- ITEMS -->
                    <tr v-for="(individual, i) in individuals" :key="i" v-if="individuals.length">
                        <td>{{individual.id}}</td>
                        <td>{{individual.name}}</td>
                        <td>{{individual.file.number}}</td>
                    </tr>

                    
                </table>

                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optradio">Option 1
                    </label>
                </div>

                <br><br>


                <h4>Not found?</h4>
                <button class="btn btn-primary">Add Individuals</button>

            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            keyword: null,
            individuals: [],
        }
    },

    methods: {
        async addTag(){
            if(this.data.tagName.trim()=='') return this.error('Tag name is required')
            const res = await this.callApi('post', 'app/create_tag', this.data)
            if(res.status==201){
                this.tags.unshift(res.data)
                this.success('Tag has been added successfuly!')
                this.addModal = false
                this.data.tagName = ""
            }else{
                this.generic()
            }
        }
    },
    async created() {

    },
    methods : {
        async getIndividuals(){
            const res = await this.callApi('get', 'vue/get-individuals')
            if(res.status==200)
            {
                this.individuals = res.data
            }else{
                this.generic()
            }
        },


        getResults() {
            
            axios.get('/vue/get-individuals', { params: { keyword: this.keyword } })
                .then(res => this.individuals = res.data)
                .catch(error => {});
        }
    }
}

</script>