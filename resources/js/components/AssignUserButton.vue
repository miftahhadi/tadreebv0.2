<template>
    <div>
        <button class="btn text-right" :class="buttonColor" @click="assignUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'kelasId', 'assigned'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function () {
            return {
                status: this.assigned,
            }
        },

        methods: {
            assignUser() {
                axios.post('/admin/kelas/' + this.kelasId + '/assign-user/' + this.userId)
                    .then(response => {

                        this.status = ! this.status;

                    });
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'Keluarkan dari kelas' : 'Masukkan ke kelas';
            },

            buttonColor() {
                return (this.status) ? 'btn-danger' : 'btn-primary';
            }
        }
    }
</script>
