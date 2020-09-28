<template>
    <div class="card-body">
        <span v-html="question"></span>

        <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">

            <!-- @foreach ($answers as $answer) -->
            <label class="form-selectgroup-item flex-fill">
                <input type="radio" 
                    name="jawaban[]" 
                    value="" 
                    class="form-selectgroup-input"
                    
                >
                <div class="form-selectgroup-label d-flex align-items-center p-3">
                    <div class="mr-3">
                        <span class="form-selectgroup-check"></span>
                    </div>
                    <div>
                        Meong meong
                    </div>
                </div>
            </label>

        </div>

    </div>
</template>

<script>
export default {
    name: 'exam-question-container',

    props: {
        question: String
    }
}
</script>