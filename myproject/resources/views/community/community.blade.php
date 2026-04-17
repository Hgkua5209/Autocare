@extends('layouts.app')

@section('content')

<div class="community-container">

<div class="community-header">
    <h2 class="title">Community Feed</h2>

<button id="savedBtn" class="saved-btn" onclick="toggleSaved()">
      <span class="material-symbols-outlined">bookmark</span>
</button>
</div>

    <!-- TABS -->
<div class="tabs">
    <div id="tab-public" class="tab active" onclick="switchTab('public')">
        Public Feed
    </div>
    <div id="tab-my" class="tab" onclick="switchTab('my')">
        My Feed
    </div>
</div>
    <!-- POST BOX -->
<div class="post-box">
<form method="POST" action="{{ route('community.store') }}">
    @csrf

    <textarea 
        name="content" 
        class="post-input" 
        placeholder="What’s happening?" 
        required></textarea>

    <!-- WAJIB ADA WRAPPER NI -->
    <div class="post-action">
        <button type="submit" class="post-btn">Post</button>
    </div>
</form>
</div>

    <!-- PUBLIC FEED -->
    <div id="publicFeed">
        @foreach($publicPosts as $post)
        <div class="post-card">

            <!-- HEADER -->
            <div class="post-header">
                <strong>{{ $post->user->name }}</strong>
                <span>{{ $post->created_at->diffForHumans() }}</span>
            </div>

            <!-- CONTENT -->
            <div class="post-content">
                {{ $post->content }}
            </div>

            <!-- ACTION ROW -->
            <div class="post-actions">

                <!-- LEFT -->
                <div class="actions-left">

                    <!-- LIKE -->
                    <button onclick="likePost(this, {{ $post->post_id }})" class="action-btn">
                        
                        <span class="material-symbols-outlined {{ $post->likes->count() ? 'liked' : '' }}">
                            favorite
                        </span>

                        <span class="like-count">
                            {{ $post->likes_count }}
                        </span>

                    </button>

                    <!-- COMMENT -->
                    <button type="button" class="action-btn" onclick="toggleComment({{ $post->post_id }})">
                        <span class="material-symbols-outlined">chat_bubble</span>
                        {{ $post->comments->count() }}
                    </button>

                    <!-- SAVE -->
                    <button onclick="savePost(this, {{ $post->post_id }})" class="action-btn">
                        
                        <span class="material-symbols-outlined {{ $post->saves->count() ? 'saved' : '' }}">
                            bookmark
                        </span>

                        <span class="save-count">
                            {{ $post->saves_count }}
                        </span>

                    </button>

                </div>

                <!-- RIGHT (DELETE) -->
                @if($post->user_id == auth()->id() || auth()->user()->role == 'admin')
                <form method="POST" action="{{ route('post.delete', $post->post_id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </form>
                @endif

            </div>

            <!-- COMMENT BOX -->
            <div id="commentBox-{{ $post->post_id }}" class="comment-box" style="display:none;">

                {{-- LIST COMMENT --}}
                @foreach($post->comments as $c)
                    <div class="comment-item">
                        <strong>{{ $c->user->name }}</strong> {{ $c->comment }}
                    </div>
                @endforeach

                {{-- INPUT COMMENT --}}
                <form method="POST" action="{{ route('comment', $post->post_id) }}">
                    @csrf
                    <div class="comment-input-wrapper">
                        <input class="comment-input" type="text" name="comment" placeholder="Write a comment..." required>
                        <button type="submit" class="comment-send">Send</button>
                    </div>
                </form>

            </div>

        </div>
        @endforeach
    </div>

    <!-- MY save FEED -->
    <div id="myFeed" style="display:none;">
        @foreach($myPosts as $post)
        <div class="post-card">

            <!-- HEADER -->
            <div class="post-header">
                <strong>{{ $post->user->name }}</strong>
                <span>{{ $post->created_at->diffForHumans() }}</span>
            </div>

            <!-- CONTENT -->
            <div class="post-content">
                {{ $post->content }}
            </div>

            <!-- ACTION ROW -->
            <div class="post-actions">

                <!-- LEFT -->
                <div class="actions-left">

                    <!-- LIKE -->
                    <button onclick="likePost(this, {{ $post->post_id }})" class="action-btn">
                        
                        <span class="material-symbols-outlined {{ $post->likes->count() ? 'liked' : '' }}">
                            favorite
                        </span>

                        <span class="like-count">
                            {{ $post->likes_count }}
                        </span>

                    </button>

                    <!-- COMMENT -->
                    <button type="button" class="action-btn" onclick="toggleComment({{ $post->post_id }})">
                        <span class="material-symbols-outlined">chat_bubble</span>
                        {{ $post->comments->count() }}
                    </button>

                    <!-- SAVE -->
                    <button onclick="savePost(this, {{ $post->post_id }})" class="action-btn">
                        
                        <span class="material-symbols-outlined {{ $post->saves->count() ? 'saved' : '' }}">
                            bookmark
                        </span>

                        <span class="save-count">
                            {{ $post->saves_count }}
                        </span>

                    </button>

                </div>

                <!-- RIGHT (DELETE) -->
                @if($post->user_id == auth()->id() || auth()->user()->role == 'admin')
                <form method="POST" action="{{ route('post.delete', $post->post_id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </form>
                @endif

            </div>

            <!-- COMMENT BOX -->
            <div id="commentBox-{{ $post->post_id }}" class="comment-box" style="display:none;">

                {{-- LIST COMMENT --}}
                @foreach($post->comments as $c)
                    <div class="comment-item">
                        <strong>{{ $c->user->name }}</strong> {{ $c->comment }}
                    </div>
                @endforeach

                {{-- INPUT COMMENT --}}
                <form method="POST" action="{{ route('comment', $post->post_id) }}">
                    @csrf
                    <div class="comment-input-wrapper">
                        <input class="comment-input" type="text" name="comment" placeholder="Write a comment..." required>
                        <button type="submit" class="comment-send">Send</button>
                    </div>
                </form>

            </div>

        </div>
        @endforeach
    </div>
<div id="savedFeed" style="display:none;">

    @foreach($savedPosts as $post)
        <div class="post-card">

            <div class="post-header">
                <strong>{{ $post->user->name }}</strong>
                <span>{{ $post->created_at->diffForHumans() }}</span>
            </div>

            <div class="post-content">
                {{ $post->content }}
            </div>

            <div class="post-actions">
                ❤️ {{ $post->likes_count }}
                💬 {{ $post->comments->count() }}
            </div>

        </div>
    @endforeach

</div>
</div>

<script>
    let showingSaved = false;

function toggleSaved() {
    let btn = document.getElementById('savedBtn');

    let publicFeed = document.getElementById('publicFeed');
    let myFeed = document.getElementById('myFeed');
    let savedFeed = document.getElementById('savedFeed');

    if (btn.classList.contains('active')) {
        // balik ke public
        btn.classList.remove('active');
        savedFeed.style.display = 'none';
        publicFeed.style.display = 'block';
    } else {
        // buka saved
        btn.classList.add('active');
        publicFeed.style.display = 'none';
        myFeed.style.display = 'none';
        savedFeed.style.display = 'block';
    }
}
    function switchTab(type) {

    let publicFeed = document.getElementById('publicFeed');
    let myFeed = document.getElementById('myFeed');

    let tabPublic = document.getElementById('tab-public');
    let tabMy = document.getElementById('tab-my');

    if (type === 'public') {
        publicFeed.style.display = 'block';
        myFeed.style.display = 'none';

        tabPublic.classList.add('active');
        tabMy.classList.remove('active');
    } else {
        publicFeed.style.display = 'none';
        myFeed.style.display = 'block';

        tabPublic.classList.remove('active');
        tabMy.classList.add('active');
    }
}

function savePost(btn, postId) {
    fetch(`/save/${postId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {

        let icon = btn.querySelector('.material-symbols-outlined');
        let count = btn.querySelector('.save-count');

        if (data.saved) {
            icon.classList.add('saved');
        } else {
            icon.classList.remove('saved');
        }

        count.innerText = data.count;
    });
}

function likePost(btn, postId) {
    fetch(`/like/${postId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {

        let icon = btn.querySelector('.material-symbols-outlined');
        let count = btn.querySelector('.like-count');

        if (data.liked) {
            icon.classList.add('liked');
        } else {
            icon.classList.remove('liked');
        }

        count.innerText = data.count;
    });
}

function showTab(tab) {
    document.getElementById('publicFeed').style.display = tab === 'public' ? 'block' : 'none';
    document.getElementById('myFeed').style.display = tab === 'my' ? 'block' : 'none';

    document.getElementById('tab-public').classList.toggle('active', tab === 'public');
    document.getElementById('tab-my').classList.toggle('active', tab === 'my');
}

function toggleComment(id) {
    let el = document.getElementById('commentBox-' + id);
    el.style.display = el.style.display === 'none' ? 'block' : 'none';
}

function toggleComment(postId) {
    let box = document.getElementById('commentBox-' + postId);

    if (box.style.display === 'none') {
        box.style.display = 'block';
    } else {
        box.style.display = 'none';
    }
}
</script>

<style>

    body {
    margin: 0;
    padding: 0;
    min-height: 100vh;

    background: linear-gradient(135deg, #667eea, #764ba2);
    background-attachment: fixed; /* smooth scroll */
}

    .main-content {
    padding: 0 !important;
}

.title {
    text-align: center;
    color: white;
    font-weight: 700;
    font-size: 26px;   /* 🔥 BESAR */
    letter-spacing: 0.5px;
    margin-bottom: 25px;  
}
.community-container {
    padding: 30px 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    font-family: 'Segoe UI';
    margin: 0;
    width: 100%;
}

.post-input {
    width: 100%;
    border-radius: 16px; /* ni buat bulat smooth */
    border: 1px solid #e2e8f0;
    padding: 14px 18px;
    font-size: 14px;
    outline: none;
    background: #f8fafc;
}
.community-header {
    position: relative;
}

.saved-btn {
    position: absolute;
    top: 5px;
    right: 25px;
    background: white;
    color: #6c63ff;
    border: none;
    padding: 8px 16px;
    border-radius: 20px;
    cursor: pointer;
    font-weight: 500;
    transition: 0.2s;
}
.saved-btn.active {
    background: #6c63ff;
    color: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}
.saved-btn:hover {
    background: #f1f5f9;
}
/* focus effect */
.post-input:focus {
    border-color: #6366f1;
    background: white;
}
.post-btn {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    padding: 10px 22px;
    border-radius: 999px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.2s;
}


/* hover */
.post-btn:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}
/* TABS */
.tabs {
    display: flex;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 25px;
}

.tabs button {
    flex: 1;
    padding: 10px;
    border: none;
    background: #e2e8f0;
    cursor: pointer;
}
.tab {
    flex: 1;
    text-align: center;
    padding: 12px;
    background: rgba(255,255,255,0.3);
    color: white;
    cursor: pointer;
    user-select: none;
}

.tab.active {
    background: rgba(255,255,255,0.6);
    color: #1e293b;
    font-weight: 600;
}

/* POST BOX */
.post-box {
    background: white;
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 20px;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
}

.post-box textarea {
    width: 100%;
    border: none;
    outline: none;
    margin-bottom: 10px;
}

/* CARD */
.post-card {
    background: white;
    padding: 20px;
    border-radius: 18px;
    margin-bottom: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.post-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.post-action{
    display: flex;
    gap: 20px;
    justify-content: flex-end;
    margin-top: 10px;
}

/* ICON BUTTON */
.icon-btn {
    background: none;
    border: none;
    cursor: pointer;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 5px;
}

.icon-btn:hover {
    color: #667eea;
}

/* ACTIVE STATES */
.active-like {
    color: #e11d48;
}

.active-save {
    color: #667eea;
}

/* COMMENTS */
.comment-box {
    display: none;
    margin-top: 10px;
    background: #f1f5f9;
    padding: 10px;
    border-radius: 10px;
}

.comment-item {
    font-size: 13px;
    margin-bottom: 5px;
}

/* DELETE */
.delete-btn {
    background: red;
    color: white;
    border: none;
    padding: 5px 10px;
    margin-top: 10px;
}

.comment-input {
    width: 100%;
    border-radius: 25px;
    border: 1px solid #e2e8f0;
    padding: 10px 15px;
    outline: none;
    transition: 0.2s;
}

.comment-input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2);
}

.comment-box {
    display: flex;
    align-items: center;
    gap: 10px;
}

.comment-btn {
    background: #667eea;
    border: none;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
}
.delete-btn {
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #ef4444;
    transition: 0.2s;
}

.delete-btn:hover {
    color: #dc2626;
    transform: scale(1.2);
}

    .post-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 12px;
}

/* LEFT GROUP */
.actions-left {
    display: flex;
    align-items: center;
    gap: 15px;
}

/* RIGHT GROUP */
.actions-right {
    display: flex;
    align-items: center;
}

/* COMMON BUTTON */
.action-btn {
    display: flex;
    align-items: center;
    gap: 5px;
    background: transparent;
    border: none;
    cursor: pointer;
    color: #64748b;
    font-size: 14px;
}

/* ICON */
.action-btn .material-symbols-outlined {
    font-size: 20px;
    transition: 0.2s;
}

/* HOVER EFFECT */
.action-btn:hover .material-symbols-outlined {
    transform: scale(1.2);
}

/* DELETE BUTTON */
.delete-btn {
    background: transparent;
    border: none;
    cursor: pointer;
}

.delete-btn .material-symbols-outlined {
    font-size: 22px;
    color: #ef4444;
    transition: 0.2s;
}

.delete-btn:hover .material-symbols-outlined {
    color: #dc2626;
    transform: scale(1.2);
}

/* default icon */
.material-symbols-outlined {
    font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 24;
    transition: 0.2s;
}

/* LIKE ACTIVE */
.liked {
    font-variation-settings: 'FILL' 1;
    color: #ef4444;
}

/* SAVE ACTIVE */
.saved {
    font-variation-settings: 'FILL' 1;
    color: #f59e0b;
}

/* COMMENT ACTIVE */
.commented {
    font-variation-settings: 'FILL' 1;
    color: #6366f1;
}
</style>

@endsection