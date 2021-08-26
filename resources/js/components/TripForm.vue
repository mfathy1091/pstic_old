<template>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" :class="{'active': current_step == 1}" href="#" @click.prevent="gotToStep(1)">
                    From
                </a>
            </li>

        </ul>

        <div class="tab-content border-0">
            <div class="tab-form" v-show="current_step == 1">
                <div class="form-group">
                    <labble for="from_country" class="form-label required">
                        From Country
                    </labble>
                    <select v-model="from_country" @change="getFromCity" name="" id="">
                        <option :value="country" v-for="country in countries">

                        </option>
                    </select>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" @click="advanceStep">
            <span>Submit</span>

        </button>
    </div>
</template>


<script>

</script>
