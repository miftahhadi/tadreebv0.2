<template>
    <div>
        <div class="btn" :class="btnColor">
            {{ hours }} jam : {{ minutes }} menit : {{ seconds }} detik
        </div>
    </div>
</template>

<script>
    export default {
        props: ['starttime','endtime'],

        data: function() {
                return {
                    timer:"",
                    start: "",
                    end: "",
                    interval: "",
                    minutes:"",
                    hours:"",
                    seconds:"",
                    nearEnd: false,
                };
            },
        
        mounted() {
            this.start = new Date(this.starttime).getTime();
            this.end = new Date(this.endtime).getTime();
            // Update the count down every 1 second
            this.timerCount(this.start,this.end);
            this.interval = setInterval(() => {
                this.timerCount(this.start,this.end);
            }, 1000);
        },

        methods: {
            timerCount: function(start,end){
                // Get todays date and time
                const now = new Date().getTime();

                // Find the distance between now an the count down date
                let distance = start - now;
                let passTime =  end - now;

                if(distance < 0 && passTime < 0) {
                    window.location.reload(true);
                    clearInterval(this.interval);
                    return;
                } else if (distance < 0 && passTime <= 300000) {
                    this.nearEnd = true;
                    this.calcTime(passTime);
                } else if(distance < 0 && passTime > 0){
                    this.calcTime(passTime);

                } else if( distance > 0 && passTime > 0 ){
                    this.calcTime(distance); 
                }
            },
            
            calcTime: function(dist){
            // Time calculations for days, hours, minutes and seconds
                this.days = Math.floor(dist / (1000 * 60 * 60 * 24));
                this.hours = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                this.minutes = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
                this.seconds = Math.floor((dist % (1000 * 60)) / 1000);
            }
            
        },

        computed: {
            btnColor() {
                return (this.nearEnd) ? 'btn-danger' : 'btn-primary';
            }
        }
    }
</script>