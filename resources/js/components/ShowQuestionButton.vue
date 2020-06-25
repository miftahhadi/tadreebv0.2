<template>
    <div>
        <a href="javascript:void" class="btn btn-light mr-2" @click="showSoal">Lihat</a>
    </div>
</template>

<script>
    export default {
        props: ['soalId', 'examId'],

        mounted() {

        },

        data() {
            return {
                soal: ''
            }
        },

        methods: {
            showSoal() {
                axios.get('/admin/exam/' + this.examId + '/soal/lihat' + this.soalId)
                    .then(response => {
                        this.soal = response.data
                    });
            }
        },
    }
</script>