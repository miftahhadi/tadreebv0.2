<template>
    <div>
        <div class="btn" :class="btnColor">
            {{ hours }} jam : {{ minutes }} menit : {{ seconds }} detik
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    
    export default {
        props: {
            starttime: Number,
            endtime: Number
        },

        data: function() {
                return {
                    seconds: 0,
                    minutes: 0,
                    hours:0,
                    days: 0,
                    interval: 0,
                    nearEnd: false,
                };
            },
        
        mounted() {
            // Update the count down every 1 second
            this.timerCount(this.starttime,this.endtime);
            this.interval = setInterval(() => {
                this.timerCount(this.starttime,this.endtime);
            }, 1000);
        },

        methods: {
            timerCount: function(start,end){
                // Get todays date and time
                const now = moment().valueOf();

                // Find the distance between now an the count down date
                let distance = start - now;
                let passTime =  end - now;

                if(distance < 0 && passTime < 0) {
                    clearInterval(this.interval);
                    window.location.reload(true);
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