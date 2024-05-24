<template>
    <div class="sidebar" id="sidebar">
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
                            <div class="list-group" v-for="receiver in receivers">
                                <a class="filterDiscussions all unread single active">
                                    <img class="avatar-md" src="" data-toggle="tooltip" data-placement="top" title="Janette" alt="avatar">
                                    <div class="status">
                                        <i class="material-icons online">fiber_manual_record</i>
                                    </div>
                                    <div class="new bg-red">
                                        <span>+7</span>
                                    </div>
                                    <div class="data">
                                        <h5>Janette Dalton</h5>
                                        <span>Mon</span>
                                        <p>A new feature has been updated to your account. Check it out...</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
