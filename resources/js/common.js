export default {
    data() {
        return {

        }
    },
    methods: {
        async callApi(method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url: url,
                    data:dataObj,
                });
            } catch (e) {
                return e.response
            }

        },

        /* info (desc, title="Hey") {
            this.$Notice.info({
                title: title,
                desc: desc,
            });
        },
        success (desc, title="Great!") {
            this.$Notice.success({
                title: title,
                desc: desc,
            });
        },
        warning (desc, title="Oops!") {
            this.$Notice.warning({
                title: title,
                desc: desc,
            });
        },
        error (desc, title="Hey") {
            this.$Notice.error({
                title: title,
                desc: desc,
            });
        },
        generic (desc='something went wrong! Please try again.', title="Oops!") {
            this.$Notice.error({
                title: title,
                desc: desc,
            });
        } */
    }
}