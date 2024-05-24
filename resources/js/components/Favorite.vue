<template>
    <span>
        <a href="#" v-if="isFavorited" @click.prevent="unFavorite(job)" class="action-button animate blue-btn col-md-2 col-md-push-5">
            <i class="fa fa-heart" style="color:yellow;"></i>気になる
        </a>
        <a href="#" v-else @click.prevent="favorite(job)" class="action-button animate blue-btn col-md-2 col-md-push-5">
            <i  class="fa fa-heart-o" style="color:white;"></i>気になる
        </a>
    </span>
</template>

<script>
export default {
    props: ['job', 'favorited'],
    data: function() {
        return {
            isFavorited: '',
        }
    },
    mounted() {
        this.isFavorited = this.isFavorite ? true : false;
    },
    computed: {
        isFavorite() {
            return this.favorited;
        },
    },
    methods: {
        favorite(job) {
            axios.post('/user/favorite/'+job)
                .then(response => this.isFavorited = true)
                .catch(response => console.log(response.data));
        },
        unFavorite(job) {
            axios.post('/user/unfavorite/'+job)
                .then(response => this.isFavorited = false)
                .catch(response => console.log(response.data));
        }
    }
}
</script>
