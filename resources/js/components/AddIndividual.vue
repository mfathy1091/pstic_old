<template>
    <div>

		<div v-if="successMessage" class="alert alert-success position-relative" role="alert">
			{{ successMessage }}
		</div>

	  <div v-if="errorMessage" class="alert alert-danger position-relative" role="alret">
		  {{ errorMessage }}
	  </div>

        <div class="form-group">
            <label>Register Using:</label>
            <select class='form-control col-md-6' v-model='register_type' @change="toggleFileField">
                <option value='0' disabled>Choose...</option>
                <option value='1' >UNHCR File</option>
                <option value='2' >Passport</option>
            </select>
        </div>
        
        
        <div v-if="showFileNumberField" class="form-group">
            <hr>
            <label>Enter the File Number</label>
            <input v-validate="{ required: true, regex: /\d\d\d-\d\dC\d\d\d\d\d/ }" name="myinput" v-model="file_number" type="text" class="form-control col-md-4">
            <span class="text-danger">{{ errors.first('myinput') }}</span>
            
            <!-- Card For File Content -->
            <div v-if="files.length > 0" class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{files[0].number}}</h5>
                    <hr>
                    <div class="d-flex">
                        <h5>Individuals</h5>
                        <button class="btn btn-primary btn-sm mb-1 ml-3" @click="showAddIndividualModal = true">Add Individual</button>
                    </div>

                    <table id="datatable1" class="table table-hover table-sm table-bordered p-0"
                    data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>   
                            <!-- <th class="align-middle">Individual ID</th> -->
                            <th class="align-middle">Relationship</th>
                            <th class="align-middle">Passport #</th>                     
                            <th class="align-middle">Name</th>
                            <th class="align-middle">Age</th>
                            <!-- <th class="align-middle">Gender</th>
                            <th class="align-middle">Nationality</th> -->
                            <th class="align-middle">Current Phone #</th>
                            <th class="align-middle">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr v-for="(individual, i) in individuals" :key="i" v-if="individuals.length">
                                <!-- <td v-text="individual.name">{{ individual->gender->name }}</td>
                                <td v-text="individual.name">{{ individual->nationality->name }}</td> -->
                                <td>{{individual.individual_id}}</td>
                                <td>{{individual.passport_number}}</td>
                                <td>{{individual.name}}</td>
                                <td>{{individual.age}}</td>
                                <td>{{individual.current_phone_number}}</td>
                                <td>
                                    <!-- <a href="{{route('individuals.show', $individual->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true">Show</a>

                                    <a href="{{route('individuals.edit', $individual->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a> -->
                                    <button class="btn btn-primary btn-danger btn-sm mb-1 ml-3" @click="showAddIndividualModal = true">Delete</button>
                                </td>
                            </tr>
                    </tbody>
                </table>
                    
                </div>
            </div>
            <p v-if="files.length > 0" class="text-primary">This File already exists</p>

            
            

            
        </div>
        <button class="btn btn-primary mt-3" @click="isFileExists">Add File</button>

        <!-- Add Individual Modal -->
        <div v-if="showAddIndividualModal">
            <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                <div class="modal-dialog modal-dialog-scrollable " role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Individual</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="showAddIndividualModal = false">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Relationship to PA:</label>
                            <select class='form-control' v-model='data.relationship_id'>
                                <option value='0' disabled>Choose...</option>
                                <option v-for='relationship in relationships' :value='relationship.id' :key="relationship.id">{{ relationship.name }}</option>
                            </select>
                        </div>

                        <div class="form-group input-field">
                            <input v-model="data.individual_id" type="text" name="individual_id" class="form-control" required>
                            <label for="individual_id" class="mr-sm-2">Individual ID</label>
                            <div v-if="addIndividualErrors.individual_id" class="alert alert-danger" role="alret">{{ addIndividualErrors.individual_id }}</div>

                        </div>

                        <hr class="col-8 mt-5 mb-5">


                        <div class="form-group">
                            <label for="passport_number" class="mr-sm-2">Passport Number</label>
                            <input v-model="data.passport_number" type="text" name="passport_number" class="form-control">
                            
                        </div>

                        <div class="form-group">
                            <label for="name" class="mr-sm-2">Name</label>
                            <input v-model="data.name" type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="age" class="mr-sm-2">Age</label>
                            <input v-model="data.age" type="number" name="age" class="form-control">
                        </div>
                

                        <div class="form-group">
                            <label>Select Gender:</label>
                            <select class='form-control' v-model='data.gender_id'>
                                <option value='0' disabled>Choose...</option>
                                <option v-for='gender in genders' :value='gender.id' :key="gender.id">{{ gender.name }}</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Select Nationality:</label>
                            <select class='form-control' v-model='data.nationality_id'>
                                <option value='0' disabled>Choose...</option>
                                <option v-for='nationality in nationalities' :value='nationality.id' :key="nationality.id">{{ nationality.name }}</option>
                            </select>
                        </div>




                        <div class="form-group">
                            <label for="current_phone_number" class="mr-sm-2">Current Phone Number</label>
                            <input v-model="data.current_phone_number" type="text" name="current_phone_number" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showAddIndividualModal = false">Close</button>
                        <button type="button" class="btn btn-primary" @click="addIndividual">Add</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </transition>
        </div>

        <!-- Delete Individual Modal -->
        <div v-if="showDeleteIndividualModal">
            <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                <div class="modal-dialog modal-dialog-scrollable " role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Individual</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="showAddIndividualModal = false">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure?</p>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showAddIndividualModal = false">Close</button>
                        <button type="button" class="btn btn-danger" @click="addIndividual">Yes, Delete</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </transition>
        </div>

    </div>
</template>
<script>
export default {
    data () {
        return{
            value: '',
            register_type: '1',
            showFileNumberField: true,
            file_number:'',
            is_file_number_exists: false,
            files: [],
            showAddIndividualModal: false,
            showDeleteIndividualModal: false,
            individuals: [],
            data : {
                file_number: '',
                passport_number: '',
                name: '',
                age: '',
                is_registered: '1',
                file_id: '1',
                individual_id: '',
                gender_id: '0',
                nationality_id: '0',
                relationship_id: '0',
                current_phone_number: '',
            },
            addIndividualErrors: {
                passport_number: '',
                name: '',
                age: '',
                is_registered: '',
                file_id: '',
                individual_id: '',
                gender_id: '',
                nationality_id: '',
                pa_relationship_id: '',
                current_phone_number: '',
            },
            successMessage: '',
            errorMessage: '',
        }
        
    },
    watch: {
        files(newValue, oldValue){
            if(newValue.length > 0)
            {
                this.getIndividuals();
            }
            // files.length > 0
        }
    },
    methods:{
        toggleFileField() {
            if(this.register_type == 1){
                this.showFileNumberField = true
            }else{
                this.showFileNumberField = false
            }
        },
        async isFileExists(){
            try{
                let res = await axios.get('/get-file', { params: { file_number: this.file_number } })
                this.files = res.data
                // console.log(res.data)
            }catch(err){
                console.log(err)
            }
        },
        async addIndividual(){
            let res = '';
            try {
                res = await axios.post('api/individuals/add-individual', this.data);
                this.success = 'Added Scuccessfully'
                if(res.status == 200){
                    // this.individuals.unshift(res.data)
                    this.getIndividuals();
                    this.showAddIndividualModal = false
                    this.successMessage = "Added Successfully"
                }
            } catch(e){
                res = e.response
            }
            
            if(res.status==422){
                console.log('outside error')
                if(res.data.errors.individual_id){
                    this.addIndividualErrors.individual_id = res.data.errors.individual_id[0]
                    console.log('inner error')
                }
            }
        },
        async getIndividuals(){
            const res = await axios.get('/api/individuals/get-individuals', { params: { file_number: this.file_number } })
            if(res.status==200)
            {
                this.individuals = res.data
            }



        }
    },
    
    async created() {
        // get genders
        const res = await this.callApi('get', 'api/individuals/genders')
        if(res.status==200)
        {
            this.genders = res.data
        }else{
            this.generic()
        }

        // get nationalities
        const res2 = await this.callApi('get', 'api/individuals/nationalities')
        if(res2.status==200)
        {
            this.nationalities = res2.data
        }else{
            this.generic()
        }

        
        // get relationships
        const res3 = await this.callApi('get', 'api/individuals/relationships')
        if(res3.status==200)
        {
            this.relationships = res3.data
        }else{
            this.generic()
        }
    }

}
</script>
<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: top;
}



    .input-field{
        margin: 25px 0;
        position: relative;
        height: 50 px;
        width: 100%;
    }
    .input-field input{
        height: 100%;
        width: 100%;
        border: 1px solid silver;
        padding-left: 15px;
        padding-top: 10px;
        padding-bottom: 10px;
        outline: none;
        font-size: 19px;
        transition: .04s;
    }
    input:focus{
        border: 1px solid #1DA1F2;
    }
    .input-field label{
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        pointer-events: none;
        color: grey;
        font-size: 18px;
        transition: 0.4s;
    }
    input:focus ~ label,
    input:valid ~ label{
        transform: translateY(-38px);
        background: white;
        font-size: 16px;
        color: #1DA1F2;
    }
</style>