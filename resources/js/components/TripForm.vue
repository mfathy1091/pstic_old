<template>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" :class="{'active': current_step == 1}" href="#" @click.prevent="gotToStep(1)">
                    From
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="{'disabled': max_step < 2, 'active': current_step == 2}" href="#" @click.prevent="gotToStep(2)">
                    To
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" :class="{'disabled': max_step < 3, 'active': current_step == 3}" href="#" @click.prevent="gotToStep(3)">
                    passengers
                </a>
            </li>

        </ul>



        <div class="tab-content border-0">
            <div class="tab-form" v-show="current_step == 1">
                <div class="form-group">
                    <label for="from_country" class="form-label required">
                        From Country
                    </label>
                    <select v-model="from_country" @change="getFromCity" id="from_country">
                        <option :value="country" v-for="country in countries" :key="country.id">

                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="from_city" class="form-label required">
                        From City
                    </label>
                    <select v-model="from_city" id="from_city" class="form-controller">
                        <option :value="city" v-for="city in from_cities" :key="city.id">

                        </option>
                    </select>
                </div>
            </div>
        </div>

                <div class="tab-content border-0">
            <div class="tab-form" v-show="current_step == 2">
                <div class="form-group">
                    <label for="to_country" class="form-label required">
                        To Country
                    </label>
                    <select v-model="to_country" @change="getFromCity" id="to_country">
                        
                    </select>
                </div>

                <div class="form-group">
                    <label for="to_city" class="form-label required">
                        To City
                    </label>
                    <select v-model="to_city" id="to_city" class="form-controller">
                        
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-3">Price: 
            <!-- <strong>${{ price }}</strong>  -->
        </div>

        <button class="btn btn-primary" @click="advanceStep">
            <span v-if="max_step === 3">Submit</span>
            <span v-else>Next</span>
        </button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                adults: 0,
                children: 0,
                from_country: {},
                from_city: {},
                from_cities: [],
                from_date: '',
                to_country: {},
                to_city: {},
                to_cities: [],
                to_date: '',
                countries: [],
                current_step: 1,
                max_step: 1,
            }
        },
        mounted() {
            axios.get('countries')
            .then(respose => this.countries = response.data.data)
        },
        /* computed: {
            price: function () {
                // let month = this.getFromMonth()
                let coefficient = 1

                if (!isNaN(month)) {
                    month++;

                    if(month === 6) {
                        coefficient = 1.5
                    }

                    if (month === 7) {
                        coefficient = 1.3
                    }

                    if (month === 8) {
                        coefficient = 1.1
                    }
                }

                let price = (this.adults * 100 + this.children * 50) * coefficient
                return (Math.round(price * 100) / 100).toFixed(2)
            }
        }, */

        methods: {
            getFromCity() {
                this.from_cities = []
                axios.get('cities', {
                    params: {
                        country:this.from_country.id
                    }
                })
                    .then(response => {
                        this.from_cities = response.data.data
                    })
            },

            validate() {
                if(this.current_step === 1) {
                    if (_.isEmpty(this.from_country) || _.isEmpty(this.from_city) || _.isEmpty(this.from_date)) {
                        return false
                    }
                    
                }

                if(this.current_step === 2) {
                    if (_.isEmpty(this.to_country) || _.isEmpty(this.to_city) || _.isEmpty(this.to_date)){
                        return false
                    }
                }

                if(this.current_step === 3) {
                    if (this.adults === 0 && this.children === 0){
                        return false
                    }
                }
                return true;
            },

/*             getFromMonth() {
                return moment(this.from_date).month()
            }, */

            advanceStep() {
                if(!this.validate()){
                    return
                }

                if(this.max_step == 3) {
                    return this.submitForm()
                }

                this.current_step++

                if (this.max_step < this.current_step) {
                    this.max_step = this.current_step
                }
            },

            gotToStep(value) {
                if(!this.validate()) {
                    return
                }
                this.current_step = value
            },

            submitForm() {
                axios.post('trips', {
                    'city_from_id': this.from_city.id,
                    'date_from': this.from_date,
                    'city_to_id': this.to_city.id,
                    'date_to': this.to_date,
                    'adults': this.adults,
                    'children': this.children
                })
                .then(() => location.replace('/admin/trips'))
            }

        }
    }
</script>
