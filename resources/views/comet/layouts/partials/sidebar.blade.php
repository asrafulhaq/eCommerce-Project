<div class="col-md-3 col-md-offset-1">
    <div class="sidebar hidden-sm hidden-xs">
        <div class="widget">
            <h6 class="upper">Search blog</h6>


            <form action="{{ route('post.search') }}" method="POST">
                @csrf
                <input name="search" type="text" placeholder="Search.." class="form-control">
            </form>




        </div>
        <!-- end of widget        -->
        <div class="widget">
            <h6 class="upper">Categories</h6>



            <ul class="nav">

                @php
                    $all_cat = App\Models\Category::all();
                @endphp
                @foreach($all_cat  as $cat)
                <li><a href="{{ route('post.cat.search', $cat -> slug )  }}">{{ $cat -> name }}</a>
                </li>
                @endforeach

            </ul>
        </div>
        <!-- end of widget        -->
        <div class="widget">
            <h6 class="upper">Popular Tags</h6>
            <div class="tags clearfix">
                @php
                    $all_tag = App\Models\Tag::all();
                @endphp
                @foreach( $all_tag  as $tag)
                <a href="{{ $tag -> id }}">{{ $tag -> name }}</a>
                @endforeach

            </div>
        </div>
        <!-- end of widget      -->
        <div class="widget">
            <h6 class="upper"> Popular Posts</h6>
            <ul class="nav">

                @php
                    $all_post = App\Models\Post::where('status', true) -> orderBy('views', 'DESC') -> take(5) ->  latest() -> get();
                @endphp
                @foreach( $all_post as $post)
                    <li><a href="{{ route('post.single', $post -> slug) }}">{{ $post -> title }}<i class="ti-arrow-right"></i><span>{{ date('d M, Y', strtotime($post -> created_at) ) }}</span></a>
                    </li>
                @endforeach


            </ul>
        </div>
        <!-- end of widget          -->
    </div>
    <!-- end of sidebar-->
</div>

