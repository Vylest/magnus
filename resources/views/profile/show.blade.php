@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h3><img src="{{ $user->getAvatar() }}"> {{ $user->name }}</h3>
        @if(Auth::check() and (Auth::user()->hasRole('Administrator') or Auth::user()->isOwner($profile)))
            <div class="pull-right"> @include('gallery._createModal') </div>
        @endif
        @if(isset($profile->biography))
            <p>{{ $profile->biography }}</p>
        @endif
        <hr>
        <div class="col-md-1">
            <h4>Galleries</h4>
        </div>
        <div class="col-md-11">
            <div class="gallery-container">
                @foreach($galleries->chunk(4) as $i => $gallery)
                    <div class="row">
                        @foreach($gallery as $j => $item)
                            <div class="col-md-3 vcenter gallery-item">

                                @if(isset($item->opera))
                                    <a href="{{ action('GalleryController@show', $item->id) }}">
                                        <img src="/{{ $item->opera->last()->thumbnail_path }}" alt="">
                                    </a>
                                @endif

                                <h4><a href="{{ action('GalleryController@show', $item->id) }}">{{ $item->name }}</a></h4>
                                <p>{{ $item->description }}</p>

                                @if(Auth::check() and (Auth::user()->hasRole('admin') or Auth::user()->isOwner($item)))
                                    <div class="clearfix">
                                        @include('gallery._editModal', ['id'=>$i.'-'.$j, 'gallery'=>$item])
                                        {!! Form::model($item, ['method'=>'delete', 'class'=>'delete-confirm operations', 'action'=>['GalleryController@destroy', $item->id]]) !!}
                                        @if($item->main_gallery != true)
                                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
                                        @endif
                                        {!! Form::close() !!}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <div class="pull-left">
            <div class="container">
                <div class="pull-right">{!! $galleries->render() !!}</div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-md-1">
            <h4>Recent Submissions</h4>
        </div>
        <div class="col-md-11">
            @foreach($opera->chunk(4) as $i => $operaChunk)
                <div class="row">
                    @foreach($operaChunk as $opus)
                        <div class="col-md-3 vcenter gallery-item">
                            <a href="{{ action('OpusController@show', [$opus->id]) }}"><img class="piece-show" src="/{{ $opus->getThumbnail() }}" alt=""></a>
                            <h4><a href="{{ action('OpusController@show', [$opus->id]) }}">{{ $opus->title }}</a></h4>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <div class="pull-right">{!! $opera->render() !!}</div>
        </div>
    </div>

@endsection