<template>
    <div class="layout">
        <div class="navigation">
            <div class="container">
                <div class="inside">
                    <div class="nav nav-tab menu">
                        <button class="btn"><img class="avatar-xl" :src="url + auth.image" alt=""></button>
                        <span aria-hidden="true" style="margin-bottom: 60px;">
                            <div v-if="auth.name<11">{{ auth.name }}</div>
                            <div v-else>  {{auth.name}} 様</div>
                        </span>
                        <a href="/" style="color:#2196f3;"><i class="material-icons">home</i></a>
                        <button class="btn power" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">power_settings_new</i></button>
                        <div>
                            <form id="logout-form" action="logout" method="POST" style="display: none;">
                                <input type="hidden" name="_token" :value="csrf">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar">
            <div class="container">
                <div class="col-md-12">
                    <div class="tab-content">
                        <div id="discussions" class="tab-pane fade active show">
                            <div class="search">
                                <form class="form-inline position-relative">
                                    <input type="search" class="form-control" id="conversations" placeholder="">
                                    <button type="button" class="btn btn-link loop"><i class="material-icons">search</i></button>
                                </form>
                            </div>
                            <div class="discussions">
                                <div class="list-group" id="chats" role="tablist">
                                    <a @click.prevent="openChat(friend)" class="filterDiscussions all unread single" v-for="friend in friends" :key="friend.id">
                                        <img class="avatar-md" :src="url + friend.image" alt="" />
                                        <div class="status" v-if="friend.online">
                                            <i class="material-icons online">fiber_manual_record</i>
                                        </div>
                                        <div class="status" v-else>
                                            <i class="material-icons offline">fiber_manual_record</i>
                                        </div>
                                        <div class="new bg-red" v-if="friend.session && friend.session.unreadCount > 0">
                                            <span>+{{friend.session.unreadCount}}</span>
                                        </div>
                                        <div class="data">
                                            <h5>{{friend.name}}様</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main" >
            <div class="tab-content" v-for="friend in friends" :key="friend.id" v-if="friend.session">
                <private-message-component v-if="friend.session.open" @close="close(friend)" :friend="friend" :url="url"></private-message-component>
            </div>
        </div>
    </div>
</template>

<script>
    import PrivateMessageComponent from "./PrivateMessageComponent";
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                friends: [],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                auth: window.auth,
                url:url
            };
        },
        methods: {
            close(friend) {
                friend.session.open = false;
            },
            getFriends() {
                axios.post("/getFriends").then(res => {
                    this.friends = res.data.data;
                    console.log(this.friends)
                    this.friends.forEach(
                        friend => (friend.session ? this.listenForEverySession(friend) : "")
                    );
                });
            },
            openChat(friend) {
                if (friend.session) {
                    this.friends.forEach(
                        friend => (friend.session ? (friend.session.open = false) : "")
                    );
                    friend.session.open = true;
                    friend.session.unreadCount = 0;
                }
                // else {
                //     this.createSession(friend);
                // }
            },
            createSession(friend) {
                axios.post("/session/create", { friend_id: friend.id }).then(res => {
                    (friend.session = res.data.data), (friend.session.open = true);
                });
            },
            listenForEverySession(friend) {
                Echo.private(`Chat.${friend.session.id}`).listen(
                    "PrivateChatEvent",
                    e => (friend.session.open ? "" : friend.session.unreadCount++)
                );
            }
        },
        created() {
            this.getFriends();

            Echo.channel("Chat").listen("SessionEvent", e => {
                let friend = this.friends.find(friend => friend.id == e.session_by);
                friend.session = e.session;
                this.listenForEverySession(friend);
            });

            Echo.join(`Chat`)
                .here(users => {
                    this.friends.forEach(friend => {
                        users.forEach(user => {
                            if (user.id == friend.id) {
                                friend.online = true;
                            }
                        });
                    });
                })
                .joining(user => {
                    this.friends.forEach(
                        friend => (user.id == friend.id ? (friend.online = true) : "")
                    );
                })
                .leaving(user => {
                    this.friends.forEach(
                        friend => (user.id == friend.id ? (friend.online = false) : "")
                    );
                });
        },
        components: { PrivateMessageComponent }
    };
</script>
