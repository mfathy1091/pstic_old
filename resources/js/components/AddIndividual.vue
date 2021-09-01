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
            <p v-if="files.length > 0" class="text-primary">This File already exists</p>
            <button class="btn btn-primary mt-3" @click="isFileExists">Check</button>

            
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
            files: []
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