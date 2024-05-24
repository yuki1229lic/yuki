<template>
    <a href="/chatting" >
        <i class="fa fa-comments-o" style="font-size:20px!important;"></i>
        <span class="unread-message" v-if="unread_count > 0">{{ unread_count }}</span>
    </a>
</template>
<script>
export default {
    props: ['user'],
    mounted() {
        this.get_unread_message();
        this.interval = setInterval(function() {
            this.get_unread_message()
        }.bind(this), 6000);
    },
    data(){
        return {
            unread_count: 0,
        }
    },
    methods: {
        get_unread_message(){
            axios.post('/get_unread_message')
                .then((response)=>{
                    this.unread_count = response.data;
                })
        },

    },
}
</script>
