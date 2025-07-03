@extends('users.layout.user')

@section('user')
    <section class="flex flex-col w-full items-center bg-gray-200 pb-16">
        <div class="app-name flex items-center justify-start w-[500px] px-4 py-5 bg-white fixed">
            <h1 class="text-2xl font-bold">InstaApp</h1>
        </div>
        <div class="p-3 flex w-full flex-col gap-2 pt-20">
            @foreach ( $posts as $post )
            <div class="card-contents w-full bg-white flex flex-col rounded-xl pb-4" data-post-id="{{ $post->post_id }}">
                <div class="card-profile px-4 py-3 flex items-center justify-between gap-4">
                    <div class="left-profile flex items-center gap-4">
                        <img src="{{ asset('img/profile.png') }}" alt="" class="w-10 rounded-full">
                        <p>{{$post->user->name}}</p>
                    </div>
                    <div class="right-profile">
                        <i class="ri-more-fill"></i>
                    </div>
                </div>
                <div class="card-content">
                    <img src="{{ route('image.show', $post->image) }}" alt="" class="w-full">
                    <div class="flex justify-start px-4 gap-2">
                        <p class="mt-1 font-semibold">{{$post->user->name}}</p>
                        <p class="mt-1">{{$post->text}}</p>
                    </div>
                </div>  
                <div class="card-action px-4 py-1 flex items-center gap-3">
                    <div class="likes-count flex items-center gap-1 cursor-pointer" onclick="toggleLike({{ $post->post_id }})">
                        @if($post->isLikedBy(Auth::id()))
                            <i class="ri-heart-fill text-red-500"></i>
                        @else
                            <i class="ri-heart-line"></i>
                        @endif
                        <p>{{$post->likes->count()}}</p>
                    </div>
                    <div class="comments-count flex items-center gap-1">
                        <i class="ri-message-3-line"></i>
                        <p>{{$post->comments->count()}}</p>
                    </div>
                </div>

                @if($post->comments->count() > 0)
                <div class="comments-list border-t pb-2 border-gray-300">
                    <div class="comments-container px-4 pt-2">
                        @foreach ($post->comments->take(2) as $comment)
                            <div class="flex gap-2 mb-1">
                                <p class="font-semibold">{{ $comment->user->name }}</p>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        @endforeach
                        
                        @if($post->comments->count() > 2)
                            <div class="view-more-comments mb-1">
                                <button class="text-gray-500 text-sm hover:text-gray-700" onclick="showAllComments({{ $post->post_id }})">
                                    View more comments ({{ $post->comments->count() - 2 }} more)
                                </button>
                            </div>
                            <div class="hidden-comments" style="display: none;">
                                @foreach ($post->comments->skip(2) as $comment)
                                    <div class="flex gap-2 mb-1">
                                        <p class="font-semibold">{{ $comment->user->name }}</p>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                @endif

                <div class="border-t border-gray-300">
                    <div class="comment-input flex w-full items-center justify-between px-4 pt-4 gap-2">
                        <div class="w-5/6">
                            <input type="text" name="text" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Add your comment...">
                        </div>
                        <div class="w-1/6">
                            <button type="button" class="comment-btn flex-1 w-full px-4 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Post
                            </button>
                        </div>
                    </div>
                </div>


            </div>
            @endforeach
        </div>

    </section>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function showAllComments(postId) {
        $(`[data-post-id="${postId}"] .hidden-comments`).show();
        $(`[data-post-id="${postId}"] .view-more-comments`).hide();
    }

    function toggleLike(postId) {
        $.ajax({
            url: `/posts/${postId}/like`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    const likeButton = $(`[data-post-id="${postId}"] .likes-count`);
                    const heartIcon = likeButton.find('i');
                    const likeCount = likeButton.find('p');
                    
                    if (response.is_liked) {
                        heartIcon.removeClass('ri-heart-line').addClass('ri-heart-fill text-red-500');
                    } else {
                        heartIcon.removeClass('ri-heart-fill text-red-500').addClass('ri-heart-line');
                    }
                    
                    likeCount.text(response.like_count);
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Failed to like/unlike post. Please try again.');
            }
        });
    }

    $(document).ready(function() {
        $('.comment-btn').on('click', function() {
            const postId = $(this).closest('.card-contents').data('post-id');
            const commentText = $(this).closest('.comment-input').find('input[name="text"]').val();
            const button = $(this);
            
            if (commentText.trim() === '') {
                alert('Please enter a comment');
                return;
            }

            $.ajax({
                url: '{{ route('comments.add') }}',
                method: 'POST',
                data: {
                    post_id: postId,
                    text: commentText,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Check if comments-list exists, if not create it
                        let commentsContainer = $(`[data-post-id="${postId}"] .comments-container`);
                        
                        if (commentsContainer.length === 0) {
                            // Create comments-list div if it doesn't exist
                            const commentsListHtml = `
                                <div class="comments-list border-t pb-2 border-gray-300">
                                    <div class="comments-container px-4 pt-2">
                                    </div>
                                </div>
                            `;
                            $(`[data-post-id="${postId}"] .card-action`).after(commentsListHtml);
                            commentsContainer = $(`[data-post-id="${postId}"] .comments-container`);
                        }
                        
                        // Add new comment to the comments container
                        const newComment = `
                            <div class="flex gap-2 mb-1">
                                <p class="font-semibold">${response.comment.user.name}</p>
                                <p>${response.comment.comment}</p>
                            </div>
                        `;
                        
                        // Check if we need to add to hidden comments or visible comments
                        const visibleComments = $(`[data-post-id="${postId}"] .comments-container > .flex`);
                        const hiddenComments = $(`[data-post-id="${postId}"] .hidden-comments`);
                        const viewMoreButton = $(`[data-post-id="${postId}"] .view-more-comments`);
                        
                        if (visibleComments.length >= 2 && hiddenComments.length === 0) {
                            // Create hidden comments section and view more button
                            const hiddenCommentsHtml = `
                                <div class="view-more-comments mb-1">
                                    <button class="text-gray-500 text-sm hover:text-gray-700" onclick="showAllComments(${postId})">
                                        View more comments (1 more)
                                    </button>
                                </div>
                                <div class="hidden-comments" style="display: none;">
                                    ${newComment}
                                </div>
                            `;
                            commentsContainer.append(hiddenCommentsHtml);
                        } else if (hiddenComments.length > 0) {
                            // Add to existing hidden comments
                            hiddenComments.append(newComment);
                            // Update view more button count
                            const currentMoreCount = parseInt(viewMoreButton.find('button').text().match(/\d+/)[0]);
                            viewMoreButton.find('button').text(`View more comments (${currentMoreCount + 1} more)`);
                        } else {
                            // Add to visible comments (less than 2 visible comments)
                            commentsContainer.append(newComment);
                        }
                        
                        // Clear the textarea
                        button.closest('.comment-input').find('input[name="text"]').val('');
                        
                        // Update comment count
                        const commentCountElement = $(`[data-post-id="${postId}"] .card-action .flex:nth-child(2) p`);
                        const currentCount = parseInt(commentCountElement.text()) || 0;
                        commentCountElement.text(currentCount + 1);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Failed to add comment. Please try again.');
                }
            });
        });
    });
</script>