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
        
        <div v-if="showFileNumberField" class="form-group">
            <label>Enter the File Number</label>
            <input type="text" class="form-control col-md-6">
            <button class="btn btn-primary">Check</button>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return{
            register_type: '1',
            showFileNumberField: true,
        }
        
    },
    methods:{
        toggleFileField() {
            if(this.register_type == 1){
                this.showFileNumberField = true
            }else{
                this.showFileNumberField = false
            }
        }
    }
}
</script>