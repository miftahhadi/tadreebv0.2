<template>
    <div>
        <a href="javascript:void" 
            role="button" 
            class="btn text-right" 
            :class="[buttonColor, buttonLoading]" 
            @click="assignUser" 
            v-text="buttonText"
        >
        </a>
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
                loading: false,
            }
        },

        methods: {
            assignUser() {
                this.loading = true,
                axios.post('/admin/kelas/' + this.kelasId + '/assign-user/' + this.userId)
                    .then(response => {

                        this.status = ! this.status,
                        this.loading = false;

                    });
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'Keluarkan dari kelas' : 'Masukkan ke kelas';
            },

            buttonColor() {
                return (this.status) ? 'btn-danger' : 'btn-primary';
            },

            buttonLoading() {
                return (this.loading) ? 'btn-loading' : '';
            }
        }
    }
</script>
