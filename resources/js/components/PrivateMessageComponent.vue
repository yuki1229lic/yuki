<template>
    <div class="babble tab-pane fade active show" id="list-chat">
            <div class="chat" id="chat1">
                <div class="top">
                    <div class="container">
                        <div class="col-md-12">
                            <div class="inside">
                                <img class="avatar-md" :src="url + friend.image" alt=""/>
                                <div class="status" v-if="friend.online">
                                    <i class="material-icons online">fiber_manual_record</i>
                                </div>
                                <div class="status" v-else>
                                    <i class="material-icons offline">fiber_manual_record</i>
                                </div>
                                <div class="data">
                                    <h5 :class="{'text-danger':session.block}">{{friend.name}}様</h5>
                                    <span v-if="session.block" class="text-danger">(Blocked)</span>
                                    <span v-else>Active</span>
                                </div>
                                <button class="btn d-md-block d-none" @click.prevent="close"><i class="material-icons md-30">close</i></button>
                                <div class="dropdown">
                                    <button class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons md-30">more_vert</i></button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" @click.prevent="clear"><i class="material-icons">clear</i>メッセージ履歴削除</button>
                                        <button class="dropdown-item" @click.prevent="block" v-if="!session.block"><i class="material-icons">block</i>ブロックさせる</button>
                                        <button class="dropdown-item" v-if="session.block && can" @click.prevent="unblock"><i class="material-icons">unblock</i>ブロックを解除</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content" id="content" v-chat-scroll>
                    <div class="container">
                        <div class="col-md-12">
                            <div :class="{'message me':chat.type === 0,'message':chat.type === 1}" v-for="chat in chats" :key="chat.id">
                                <img class="avatar-md" :src="url + friend.image" alt="" v-if="chat.type === 1" />
                                <div class="text-main">
                                    <div class="text-group">
                                        <div :class="{'text me':chat.type === 0,'text':chat.type === 1}">
                                            <p class="messageText">{{chat.message}}</p>
                                        </div>
                                    </div>
                                    <span><i class="material-icons" v-if="chat.read_at != null">check</i>{{chat.send_at}}</span>
                                </div>
                            </div>

                            <div class="message" v-if="isTyping">
                                <img class="avatar-md" />
                                <div class="text-main">
                                    <div class="text-group">
                                        <div class="text typing">
                                            <div class="wave">
                                                <span class="dot"></span>
                                                <span class="dot"></span>
                                                <span class="dot"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="col-md-12">
                        <div class="bottom">
                            <form class="position-relative w-100" @submit.prevent="send">
                                <textarea class="form-control" placeholder="メッセージを入力してください..." rows="2" :disabled="session.block"
                                          v-model="message" ></textarea>
                                <button class="btn emoticons"><i class="material-icons">insert_emoticon</i></button>
                                <button type="submit" class="btn send" @click.prevent="send"><i class="material-icons">send</i></button>
                            </form>
                            <label>
                                <input type="file">
                                <span class="btn attach d-sm-block d-none"><i class="material-icons">attach_file</i></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
    export default {
        props: ['friend','url'],
        data() {
            return {
                chats: [],
                message: null,
                isTyping: false
            }
        },
        watch: {
            message(value) {
                if (value) {
                    Echo.private(`Chat.${this.friend.session.id}`).whisper("typing", {
                        name: auth.name
                    });
                }
            }
        },
        computed: {
            session() {
                return this.friend.session;
            },
            can() {
                return this.session.blocked_by == auth.id;
            }
        },
        created() {
            this.read();
            this.getAllMessages();
            Echo.private(`Chat.${this.friend.session.id}`).listen(
                "PrivateChatEvent",
                e => {
                    this.friend.session.open ? this.read() : "";
                    this.chats.push({ message: e.content, type: 1, send_at: "Just Now" });
                }
            );
            Echo.private(`Chat.${this.friend.session.id}`).listen("MsgReadEvent", e =>
                this.chats.forEach(
                    chat => (chat.id == e.chat.id ? (chat.read_at = e.chat.read_at) : "")
                )
            );
            Echo.private(`Chat.${this.friend.session.id}`).listen(
                "BlockEvent",
                e => (this.session.block = e.blocked)
            );
            Echo.private(`Chat.${this.friend.session.id}`).listenForWhisper(
                "typing",
                e => {
                    this.isTyping = true;
                    setTimeout(() => {
                        this.isTyping = false;
                    }, 2000);
                }
            );
        },
        methods: {
            getAllMessages() {
                axios
                    .post(`/session/${this.friend.session.id}/chats`)
                    .then(res => (this.chats = res.data.data));
            },
            send() {
                if (this.message) {
                    this.pushToChats(this.message);
                    axios
                        .post(`/send/${this.friend.session.id}`, {
                            message: this.message,
                            to_user: this.friend.id
                        })
                        .then(res => (this.chats[this.chats.length - 1].id = res.data));
                    this.message = null;
                }
            },
            pushToChats(message) {
                this.chats.push({
                    message: message,
                    type: 0,
                    read_at: null,
                    send_at: "Just now"
                });
            },
            close() {
                this.$emit('close');
            },
            clear() {
                axios.post(`session/${this.friend.session.id}/clear`).then(res => {
                    this.chats = [];
                })
            },
            block() {
                this.session.block = true;
                axios
                    .post(`/session/${this.friend.session.id}/block`)
                    .then(res => (this.session.blocked_by = auth.id));
            },
            unblock() {
                this.session.block = false;
                axios.post(`session/${this.friend.session.id}/unblock`).then(
                    res => {
                        this.session.blocked_by = null;
                    }
                );
            },
            read() {
                axios.post(`/session/${this.friend.session.id}/read`);
            }
        },
    };
</script>

<style>
    .text-danger{
     color: red !important;
    }
    .messageText {
    white-space: pre-wrap;
    }   
</style>
