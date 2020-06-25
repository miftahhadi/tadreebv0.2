<template>
    <div>
        <button class="btn btn-light mr-2" @click="showSoal">Lihat</button>
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
                        this.soal = response;
                        console.log(this.soal);
                    });
            }
        },
    }
</script>