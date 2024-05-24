<template>
    <div class="dropdown">
        <a href="" class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
            <i class="fa fa-bell-o" style="font-size:20px!important;"></i>
            <span class="unread-message" v-if="unread_count > 0">{{ unread_count }}</span>
        </a>

        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
            <li role="presentation" class="drop-item" v-for="(unread, index) in unreads" :key="index">
                <a role="menuitem" tabindex="-1" @click.prevent="readNotification(unread.id)" v-if="unread.type === 1">{{ unread.sender_name }}様が{{unread.post_title}}案件について提案をしました。</a>
                <a role="menuitem" tabindex="-1" @click.prevent="readNotification(unread.id)" v-if="unread.type === 2">{{ unread.sender_name }}様が{{unread.post_title}}案件について採用しました。</a>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: ['app_url',],
    mounted() {
        this.get_unread_notification();
        this.interval = setInterval(function() {
            this.get_unread_notification()
        }.bind(this), 6000);
    },
    data(){
        return {
            unread_count: 0,
            unreads:[],
        }
    },
    methods: {
        get_unread_notification(){
            axios.post('/get_unread_notification')
                .then((response)=>{
                    this.unread_count = response.data.length;
                    this.unreads = response.data;
                })
        },
        readNotification(id) {
            axios.get( this.app_url + '/read_notification/' + id).then((response) => {
                console.log(response)
            }).catch((errors) => {
                console.log(errors)
            });
        },

    },
}
</script>
