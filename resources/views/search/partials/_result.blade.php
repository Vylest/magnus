<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
    <div class="gallery-item">
        <div class="vcenter">
            @include('partials._opusThumbnail', ['opus'=>$opus, 'action'=>'OpusController@show', 'params'=>[$opus->slug]])
            <div class="item-details">
                <h5><strong><a href="{{ action('OpusController@show', [$opus->slug]) }}">{{ $opus->title }}</a></strong>
                    @if(!isset($showName) or $showName)
                        <br><a href="{{ action('ProfileController@show', $opus->userslug) }}">{!! Magnus::username($opus->user_id) !!}</a>
                    @endif
                </h5>
            </div>
        </div>
    </div>
</div>