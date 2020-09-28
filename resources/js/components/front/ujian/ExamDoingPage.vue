<template>
    <div class="row">
        <div class="col-md-7">
            <form>
                <div class="card">
                    <div class="card-header">
                        Soal ke-{{ currentQuestionNumber }} dari {{ totalQuestion }}

                        <div class="card-action ml-auto">
                            <timer 
                                :starttime="starttime"
                                :endtime="endtime"
                            ></timer>
                        </div>
                    </div>
                    
                    <exam-question-container></exam-question-container>

                    <div class="card-footer">
                        <div class="btn-list">

                            <input type="submit" class="btn btn-success" value="Jawab">
                            
                            <a href="#" class="btn btn-info">
                                <span class="mr-1">Selanjutnya</span> 
                                <i class="fas fa-chevron-circle-right"></i>
                            </a>

                        </div>

                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-5">
            
            <exam-question-directory></exam-question-directory>

            <div class="col d-flex justify-content-center" v-if="lastQuestion">
                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#selesaiUjian">
                    <i class="fas fa-check-circle"></i>
                    <span class="ml-1">Selesai</span>
                </button>
            </div>

        </div>
    </div>

</template>

<script>
export default {
    name: 'exam-doing-page',

    props: {
        starttime: Number,
        endtime: Number,
    },

    data() {
        return {
            lastQuestion: true,
            currentQuestionNumber: 1,
            totalQuestion: 50
        }
    }
}
</script>