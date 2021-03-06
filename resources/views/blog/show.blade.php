@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post-item post-detail">
                    <div class="post-item-image">
                        @if ($post->image_url)
                            <a href="javascript:;">
                                {{-- Created an accessor in the post model called image_url to
                                get the image from the database --}}
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
                            </a>
                        @endif
                    </div>

                    <div class="post-item-body">
                        <div class="padding-10">
                            <h1>{{ $post->title }}</h1>

                            <div class="post-meta no-border">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i>
                                        {{-- Created a relationship in the post model called
                                        user to access the user name and display it --}}
                                        <a href="{{ route('author', $post->user->slug) }}">{{ $post->user->name }}</a>
                                    </li>
                                    <li><i class="fa fa-clock-o"></i><time> {{ $post->date }}</time></li>
                                    <li><i class="fa fa-tags"></i><a href="{{ route('category', $post->category->slug) }}">
                                            {{ $post->category->title }}</a>
                                    </li>
                                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                </ul>
                            </div>

                            {{-- Created a new accessor in the post model to display the post
                            body --}}
                            {!! $post->body_html !!}
                        </div>
                    </div>
                </article>

                <article class="post-author padding-10">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img alt="Author 1" src="{{ asset('img/author.jpg') }}" class="media-object">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a
                                    href="{{ route('author', $post->user->slug) }}">{{ $post->user->name }}</a></h4>
                            <div class="post-author-count">
                                <a href="{{ route('author', $post->user->slug) }}">
                                    <i class="fa fa-clone"></i>
                                    @php $postCount = $post->user->posts()->published()->count() @endphp
                                    {{ $postCount }} {{ Str::plural('post', $postCount) }}
                                </a>
                            </div>
                            {!! $post->user->bio_html !!}
                        </div>
                    </div>
                </article>

                {{-- comments here --}}
            </div>
            @include('layouts.sidebar')
        </div>
    </div>

@endsection
