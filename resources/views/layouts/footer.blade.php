      <!-- footer @s -->
      <div class="nk-footer">
        <div class="container-fluid">
            <div class="nk-footer-wrap">
                <div class="nk-footer-copyright"> &copy; 2020 DashLite. Template by <a
                        href="https://softnio.com" target="_blank">Softnio</a>
                </div>
                <div class="nk-footer-links">
                    <ul class="nav nav-sm">
                        <span style="display: none">{{ $pages= App\Models\Page::all() }}</span>
                        @foreach($pages as $page)
                        <li class="nav-item"><a class="nav-link" href="{{route('page',$page->id)}}">{{$page->page_title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- footer @e --> 