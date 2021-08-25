<template>
    <div>
        <input type="text" v-model="keyword">
        <ul v-if="individuals.length > 0">
            <li v-for="individual in individuals" :key="individual.id" v-text="individual.name"></li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            keyword: null,
            individuals: []
        };
    },
    watch: {
        keyword(after, before) {
            this.getResults();
        }
    },
    methods: {
        getResults() {
            axios.get('/vuelivesearch', { params: { keyword: this.keyword } })
                .then(res => this.individuals = res.data)
                .catch(error => {});
        }
    }
}
</script>