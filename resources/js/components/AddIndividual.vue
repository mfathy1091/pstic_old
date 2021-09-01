<template>
    <div>
        <div class="form-group">
            <label>Register Using:</label>
            <select class='form-control col-md-6' v-model='register_type' @change="toggleFileField">
                <option value='0' disabled>Choose...</option>
                <option value='1' >UNHCR File</option>
                <option value='2' >Passport</option>
            </select>
        </div>
        <hr>
        
        <div v-if="showFileNumberField" class="form-group">
            <label>Enter the File Number</label>
            <input v-model="file_number" type="text" class="form-control col-md-4">
            
            <!-- File Card -->
            <div v-if="files.length > 0" class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">{{files[0].number}}</h5>
                    <hr>
                    
                    <ul>
                        <li v-for="individual in files[0].individuals" :key="individual.id" v-text="individual.name"></li>
                    </ul>
                    
                </div>
            </div>
            <p v-if="files.length > 0" class="text-primary">This File already exists</p>

            <button class="btn btn-primary mt-3" @click="isFileExists">Add File</button>
            <button class="btn btn-primary mt-3" @click="showModal = true">Show Add File Modal</button>

            
        </div>


        <div v-if="showModal">
            <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="showModal = false">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
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
            register_type: '1',
            showFileNumberField: true,
            file_number:'',
            is_file_number_exists: false,
            files: [],
            showModal: false,
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
            // this.is_file_number_exists = !this.is_file_number_exists
            // console.log(this.is_file_number_exists)

            try{
                let response = await axios.get('/get-file', { params: { file_number: this.file_number } })
                this.files = response.data
                // console.log(response.data)
            }catch(err){
                console.log(err)
            }
            console.log(this.files)
            console.log(this.files.length)
            console.log(this.files.length === 1)

            // if(this.files.length > 0){
            //     this.is_file_number_exists = true
            // }else{
            //     this.is_file_number_exists = false
            // }
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
</style>