@foreach($comments as $comment)
    <div class="modal modal-custom modal-team-member fade text-md-left" id="comment-{{ $comment->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row row-30 justify-content-sm-center align-items-sm-center">
                        <div class="col-md-5">
                            <div class="bg-image" style="background-image: url('/storage/{{ $comment->genre_avatar }}'); height: 310px;background-size: cover; top: -30px;left: -20px;"></div>
                        </div>
                        <div class="col-md-7">
                            <div class="modal-body-column-content">
                                <div class="team-member">
                                    <div class="team-member-img-wrap d-md-none">
                                        <img class="rounded-circle img-responsive center-block" src="/storage/{{ $comment->genre_avatar }}" width="100" height="100" alt="">
                                    </div>
                                    <div class="team-member-title text-small text-ubold text-uppercase text-spacing-200 text-black">{{ $comment->user_name_for_comment }}</div>
                                    <div class="team-member-scroll-section">
                                        <p class="text-small font-italic text-silver-chalice text-left">
                                            {{ $comment->content }}
                                        </p>
                                    </div>
                                </div>
                                <ul class="list-inline list-primary list-inline-13">
                                    <li class="text-center"><a class="icon fa fa-facebook text-black" href="#"></a></li>
                                    <li class="text-center"><a class="icon fa fa-twitter text-black" href="#"></a></li>
                                    <li class="text-center"><a class="icon fa fa-youtube text-black" href="#"></a></li>
                                    <li class="text-center"><a class="icon fa fa-linkedin text-black" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
