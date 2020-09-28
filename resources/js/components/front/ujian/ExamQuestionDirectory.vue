<template>
    <div class="card">
        <div class="card-header">
            Direktori Soal
        </div>
        <div class="card-body">
            <div class="btn-list justify-content-center">

                <a href="#" 
                    class="btn btn-light btn-sm active"
                    v-for="n in 50" :key="n"
                    >
                    {{ n++ }}
                </a>
    
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: 'exam-question-directory'
}
</script>