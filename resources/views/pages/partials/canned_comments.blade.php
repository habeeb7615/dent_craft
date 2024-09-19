@forelse ($cannedComments as $comment)
    <div class="canned-comments-wrap">
        <div class="canned-comment-heading">
            <h4>{{ $comment->title }}</h4>
            <a href="#" onclick="javascript:delete_comment('{{ $comment->id }}');" class="delete-comment">
                <img src="{{ asset('new-theme/images/delete-icon.svg') }}" alt="">
                <span>Delete</span>
            </a>
        </div>
        <div class="comments-content">
            <p>{{ $comment->comment }}</p>
            <div class="comments-time">{{ $comment->created_at }}</div>
        </div>
    </div>
@empty
    <div class="empty d-flex justify-content-center">
        No Canned Comments Added
    </div>
@endforelse
