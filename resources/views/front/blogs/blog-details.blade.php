@extends('front.layouts.app')
@section('content') 
<div class="container">
        <div class="page-inner">
          <div class="row">
            <div class="col-md-8">
                <div class="blogDetailSection">
                    <div class="prBlog-date grey py-3">
                        {{ $blog->created_at ? $blog->created_at->format('d, F, Y') : 'Date not available' }} 
                    </div>
                    <h3 class="prBlogTitle blue m-0">{{ $blog->title ?? 'Untitled Blog' }}</h3>
                    <div class="prblogImgBig py-4">
                        <a href="blog-detail.php">
                            <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('front-assets/images/blog/default.png') }}" alt="{{ $blog->title }}"  class="w-100">
                        </a>
                    </div>
                    <div class="blog-desc">
                        <p>{{ $blog->description ?? 'No description available.' }}</p>
                    </div>
                </div>
              
                <!-- <div class="post-block mt-4 pt-2 post-author">
                    <h6 class="mb-3 blue poppins-semibold">Author</h6>
                    <div class="d-flex gap-2">
                        <div class="img-thumbnail-no-borders d-block pb-3">
                            <a href="blog-post.html">
                                <img src="images/blog/team-img.png" alt="">
                            </a>
                        </div>
                        <div class="authText">
                            <p class="mb-0"><strong class="name"><a href="#" class="blue pb-2  d-block mb-0">John Doe</a></strong></p>
                            <p class="mb-0 fs-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.  </p>
                        </div>
                    
                    </div>
                </div>
                <div>
                  <h5 class="blue poppins-bold my-4">Related Blogs</h5>
                </div>
                <div class="relatedBlogs-slider py-10">
                    <div class="item">
                        <div class="prblogImg">
                            <a href="blog-details.html">
                                <img src="images/blog/wwd3.png" alt=""  class="w-100">
                            </a>
                        </div>
                        <div class="prBlog-date grey py-3">
                            14, june, 2022 
                        </div>
                        <h4 class="blue relBlog-Title">Why to Outsource Compliance Services to a Professional? </h4>
                    </div>

                    <div class="item">
                        <div class="prblogImg">
                            <a href="blog-details.html">
                                <img src="images/blog/wwd3.png" alt=""  class="w-100">
                            </a>
                        </div>
                        <div class="prBlog-date grey py-3">
                            14, june, 2022 
                        </div>
                        <h4 class="blue relBlog-Title">Why to Outsource Compliance Services to a Professional? </h4>
                    </div>

                    <div class="item">
                        <div class="prblogImg">
                            <a href="blog-details.html">
                                <img src="images/blog/wwd3.png" alt=""  class="w-100">
                            </a>
                        </div>
                        <div class="prBlog-date grey py-3">
                            14, june, 2022 
                        </div>
                        <h4 class="blue relBlog-Title">Why to Outsource Compliance Services to a Professional? </h4>
                    </div>

                    <div class="item">
                        <div class="prblogImg">
                            <a href="blog-details.html">
                                <img src="images/blog/wwd3.png" alt=""  class="w-100">
                            </a>
                        </div>
                        <div class="prBlog-date grey py-3">
                            14, june, 2022 
                        </div>
                        <h4 class="blue relBlog-Title">Why to Outsource Compliance Services to a Professional? </h4>
                    </div>
                </div> -->
            </div>
            <div class="col-md-4">
                <div class="sideBar">
                    <!-- <div class="Categories borderLines border-0">
                        <h6 class="blue sideBarCommon-head">Categories</h6>
                        <ul class="ps-0 mb-0">
                            @foreach($categories as $category)
                            <li><a href="#">Buildings</a></li>
                            <li><a href="#">Construction</a></li>
                            <li><a href="#">Educational</a></li>
                            <li><a href="#" class="active blue">Innovations</a></li>
                            <li><a href="#">Materials</a></li>
                            <li><a href="#">Standards</a></li>
                            <li><a href="#">Super Structures</a></li>
                            <li><a href="#">Technology</a></li>
                            @endforeach
                        </ul>
                    </div> -->
                    <div class="latstBlogs borderLines">
                        <h6 class="blue sideBarCommon-head">Latest Blogs</h6>

                        @foreach($latestBlogs as $blog)
                        <div class="d-flex latBlogflex my-3">
                            <div class="ltb-Img">
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-100">
                            </div>
                            <div class="right">
                                <h5 class="blue ltsBlogTitle">
                                    <a href="{{ url('blog/' . $blog->slug) }}" class="blue">{{ $blog->title }}</a>
                                </h5>
                                <div class="prBlog-date grey py-1">
                                    {{ $blog->created_at->format('d, F, Y') }}
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <!-- <div class="tags borderLines">
                        <h6 class="blue sideBarCommon-head">Tags</h6>

                        <div class="tagFlex d-flex flex-wrap">
                            <a href="#">#Business</a> 
                            <a href="#">#Real-Estate</a>
                            <a href="#">#Technology</a>
                            <a href="#">#Make-up</a>
                            <a href="#">#Photo</a>
                            <a href="#">#Science</a>
                            <a href="#">#Tech</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
@endsection

@section('customJs')
@endsection