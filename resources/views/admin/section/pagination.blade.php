@if ($paginator->lastPage() > 1)


<ul class="pagination ms-auto">
    <li class="page-item ">
        @if($paginator->currentPage() > 1)
      <a class="page-link" href="{{$paginator->url($paginator->currentPage()-1)}}" tabindex="-1" aria-disabled="true">
        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="9 6 15 12 9 18"></polyline></svg>

        قبلی
      </a>
      @endif
    </li>

    @php
 $link_limit = 12;
    @endphp
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
    <?php
    $half_total_links = floor($link_limit / 2);
    $from = $paginator->currentPage() - $half_total_links;
    $to = $paginator->currentPage() + $half_total_links;
    if ($paginator->currentPage() < $half_total_links) {
       $to += $half_total_links - $paginator->currentPage();
    }
    if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
        $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
    }
    ?>
    @if ($from < $i && $i < $to)
        <li class="page-item  {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
        </li>
    @endif
@endfor
    {{-- @for ($i = 1; $i <= $paginator->lastPage(); $i++)
    <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
        <a class="page-link"  href="{{ $paginator->url($i) }}">{{ $i }}</a>
    </li>
@endfor --}}

    @if($paginator->currentPage() <$paginator->lastPage())

      <a class="page-link" href="{{$paginator->url($paginator->currentPage()+1)}}">
        بعدی <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="15 6 9 12 15 18"></polyline></svg>

      </a>
    @endif

    </li>
  </ul>
  <hr>

    <span style="margin-right: 20px">صفحه
        {{$paginator->currentPage()}}
                        از
                       {{$paginator->lastPage()}}
         </span>
    {{-- <div class="pagination1">
        <div class="number">


            <ul>
{{--                <li><a href="#">1</a></li>--}}
{{--                <li class="active"><a href="#">2</a></li>--}}
{{--                <li><span>...</span></li>--}}
{{--                <li><a href="#">14</a></li>--}}
{{--                <li><a href="#">15</a></li>--}}


            {{-- </ul>
        </div>
        <div class="result">

        </div> --}}

        {{-- <div class="next-prev">

            <span class="next-page {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">

                <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >    <i class="icon-arrow-right-line"></i></a>

            </span>
            <span class="prev-page{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }} ">
                     <a href="{{ $paginator->url($paginator->currentPage()-1) }}">  <i class="icon-arrow-right-line"></i></a>

            </span>
        </div> --}}
    {{-- </div> --}}

@endif
