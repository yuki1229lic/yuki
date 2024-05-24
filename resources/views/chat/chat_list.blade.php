<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="utf-8">
    <title>ハコボウズ – チャット</title>
    <link href="{{asset('chat')}}/dist/css/lib/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="{{asset('chat')}}/dist/css/swipe.min.css" type="text/css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('front/img/common/favicon.png') }}"/>
</head>
<body>
<main>
    <div class="layout">
        <div class="navigation">
            <div class="container">
                <div class="inside">
                    <div class="nav nav-tab menu">
                        <button class="btn"><img class="avatar-xl" src="{{asset('chat')}}/dist/img/avatars/avatar-male-1.jpg" alt="avatar"></button>
                        <a href="/"><i class="material-icons">home</i></a>
                        <button class="btn power" onclick=""><i class="material-icons">power_settings_new</i></button>
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
                                    <a href="#list-chat" class="filterDiscussions all unread single active" id="list-chat-list" data-toggle="list" role="tab">
                                        <img class="avatar-md" src="{{asset('chat')}}/dist/img/avatars/avatar-female-1.jpg" data-toggle="tooltip" data-placement="top" title="Janette" alt="avatar">
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
                                    <a href="#list-empty" class="filterDiscussions all unread single" id="list-empty-list" data-toggle="list" role="tab">
                                        <img class="avatar-md" src="{{asset('chat')}}/dist/img/avatars/avatar-male-1.jpg" data-toggle="tooltip" data-placement="top" title="Michael" alt="avatar">
                                        <div class="status">
                                            <i class="material-icons offline">fiber_manual_record</i>
                                        </div>
                                        <div class="new bg-red">
                                            <span>+10</span>
                                        </div>
                                        <div class="data">
                                            <h5>Michael Knudsen</h5>
                                            <span>Sun</span>
                                            <p>How can i improve my chances of getting a deposit?</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="tab-content" id="nav-tabContent">
                <div class="babble tab-pane fade active show" id="list-chat" role="tabpanel" aria-labelledby="list-chat-list">
                    <div class="chat" id="chat1">
                        <div class="top">
                            <div class="container">
                                <div class="col-md-12">
                                    <div class="inside">
                                        <a href="#"><img class="avatar-md" src="{{asset('chat')}}/dist/img/avatars/avatar-female-5.jpg" data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar"></a>
                                        <div class="status">
                                            <i class="material-icons online">fiber_manual_record</i>
                                        </div>
                                        <div class="data">
                                            <h5><a href="#">Keith Morris</a></h5>
                                            <span>Active now</span>
                                        </div>
                                        <button class="btn d-md-block d-none"><i class="material-icons md-30">close</i></button>
                                        <div class="dropdown">
                                            <button class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons md-30">more_vert</i></button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button class="dropdown-item"><i class="material-icons">clear</i>Clear History</button>
                                                <button class="dropdown-item"><i class="material-icons">block</i>Block Contact</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content" id="content">
                            <div class="container">
                                <div class="col-md-12">
                                    <div class="date">
                                        <hr>
                                        <span>Yesterday</span>
                                        <hr>
                                    </div>
                                    <div class="message">
                                        <img class="avatar-md" src="{{asset('chat')}}/dist/img/avatars/avatar-female-5.jpg" data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">
                                        <div class="text-main">
                                            <div class="text-group">
                                                <div class="text">
                                                    <p>We've got some killer ideas kicking about already.</p>
                                                </div>
                                            </div>
                                            <span>09:46 AM</span>
                                        </div>
                                    </div>
                                    <div class="message me">
                                        <div class="text-main">
                                            <div class="text-group me">
                                                <div class="text me">
                                                    <p>Can't wait! How are we coming along with the client?</p>
                                                </div>
                                            </div>
                                            <span>11:32 AM</span>
                                        </div>
                                    </div>
                                    <div class="message">
                                        <img class="avatar-md" src="{{asset('chat')}}/dist/img/avatars/avatar-female-5.jpg" data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">
                                        <div class="text-main">
                                            <div class="text-group">
                                                <div class="text">
                                                    <p>Coming along nicely, we've got a draft for the client quarries completed.</p>
                                                </div>
                                            </div>
                                            <span>02:56 PM</span>
                                        </div>
                                    </div>
                                    <div class="message me">
                                        <div class="text-main">
                                            <div class="text-group me">
                                                <div class="text me">
                                                    <p>Roger that boss!</p>
                                                </div>
                                            </div>
                                            <div class="text-group me">
                                                <div class="text me">
                                                    <p>I have already started gathering some stuff for the mood boards, excited to start!</p>
                                                </div>
                                            </div>
                                            <span>10:21 PM</span>
                                        </div>
                                    </div>
                                    <div class="message">
                                        <img class="avatar-md" src="{{asset('chat')}}/dist/img/avatars/avatar-female-5.jpg" data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">
                                        <div class="text-main">
                                            <div class="text-group">
                                                <div class="text">
                                                    <p>Great start guys, I've added some notes to the task. We may need to make some adjustments to the last couple of items - but no biggie!</p>
                                                </div>
                                            </div>
                                            <span>11:07 PM</span>
                                        </div>
                                    </div>
                                    <div class="date">
                                        <hr>
                                        <span>Today</span>
                                        <hr>
                                    </div>
                                    <div class="message me">
                                        <div class="text-main">
                                            <div class="text-group me">
                                                <div class="text me">
                                                    <p>Well done all. See you all at 2 for the kick-off meeting.</p>
                                                </div>
                                            </div>
                                            <span>10:21 PM</span>
                                        </div>
                                    </div>
                                    <div class="message">
                                        <img class="avatar-md" src="{{asset('chat')}}/dist/img/avatars/avatar-female-5.jpg" data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">
                                        <div class="text-main">
                                            <div class="text-group">
                                                <div class="text">
                                                    <div class="attachment">
                                                        <button class="btn attach"><i class="material-icons md-18">insert_drive_file</i></button>
                                                        <div class="file">
                                                            <h5><a href="#">Tenacy Agreement.pdf</a></h5>
                                                            <span>24kb Document</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span>11:07 PM</span>
                                        </div>
                                    </div>
                                    <div class="message me">
                                        <div class="text-main">
                                            <div class="text-group me">
                                                <div class="text me">
                                                    <p>Hope you're all ready to tackle this great project. Let's smash some Brand Concept & Design!</p>
                                                </div>
                                            </div>
                                            <span><i class="material-icons">check</i>10:21 PM</span>
                                        </div>
                                    </div>
                                    <div class="message">
                                        <img class="avatar-md" src="{{asset('chat')}}/dist/img/avatars/avatar-female-5.jpg" data-toggle="tooltip" data-placement="top" title="Keith" alt="avatar">
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
                                    <form class="position-relative w-100">
                                        <textarea class="form-control" placeholder="Start typing for reply..." rows="1"></textarea>
                                        <button class="btn emoticons"><i class="material-icons">insert_emoticon</i></button>
                                        <button type="submit" class="btn send"><i class="material-icons">send</i></button>
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
            </div>
        </div>
    </div>
</main>

<script src="{{asset('chat')}}/dist/js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="{{asset('chat')}}/dist/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="{{asset('chat')}}/dist/js/vendor/popper.min.js"></script>
<script src="{{asset('chat')}}/dist/js/bootstrap.min.js"></script>
{{--<script src="{{ mix('js/app.js') }}"></script>--}}
<script>
    function scrollToBottom(el) { el.scrollTop = el.scrollHeight; }
    scrollToBottom(document.getElementById('content'));
</script>
</body>

</html>
