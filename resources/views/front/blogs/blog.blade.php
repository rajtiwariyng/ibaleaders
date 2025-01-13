@extends('front.layouts.app')
@section('content') 
<div class="container">
        <div class="page-inner">
          <div class="row prBlogs">
          @forelse($blogs as $blog)
                <div class="col-md-4">
                    <div class="prBlogBox">
                        <div class="prblogImg">
                            <a href="{{ route('blog.details', $blog->id) }}">
                                <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('front-assets/images/blog/default.png') }}" 
                                    alt="{{ $blog->title }}" class="w-100">
                            </a>
                        </div>
                        <div class="p-3">
                            <div class="prBlog-date grey pb-2">
                                {{ $blog->published_at ? $blog->published_at->format('d, F, Y') : 'Date not available' }}
                            </div>
                            <a href="{{ route('blog.details', $blog->id) }}">
                                <h3 class="prBlogTitle blue m-0">{{ $blog->title ?? 'Untitled Blog' }}</h3>
                            </a>
                            <p>{{ $blog->short_description ?? 'No description available.' }}</p>
                            <div class="text-right d-flex justify-content-end">
                                <a href="{{ route('blog.details', $blog->id) }}" class="blue readMore">
                                    Read More <img src="{{ asset('front-assets/images/blog/arrow.png') }}" alt="Read More">
                                </a>            
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No blogs found.</p>
            @endforelse

        </div>
        </div>
        
@endsection

@section('customJs')
@endsection