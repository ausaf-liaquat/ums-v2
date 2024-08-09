@extends('backend.layout.app')

@section('title')
    View Course Content
@endsection

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Files</a>
                </li>
                <li class="breadcrumb-item">
                    {{-- <a href="{{ route('backend.course-schedules', ['course' => $course->id]) }}">View Course Content</a> --}}
                </li>
                <li class="breadcrumb-item active">View</li>
            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-4">
            <h5 class="card-header"> View Course Content</h5>
            <!-- Account -->

            <div class="card-body">

                {!! $user_course->course->course_content->content ?? null !!}
                @foreach ($user_course->course?->course_content?->links ?? [] as $item)
                    <h3 class="mt-4 fw-bolder">{{ $item->heading }}</h3>
                    <!--<iframe src="{{ $item->link }}" frameborder="0" width="900" height="375"	></iframe>-->
                    <div id="iframeContainer_{{ $loop->index }}">
                        <!-- Placeholder content -->
                        <p class="loading">Loading Content Please Wait ............!!</p>
                    </div>
                @endforeach

            </div>
            <!-- /Account -->
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
@endsection
@section('script')
    <script>
        // Function to load PDF gradually
        function loadPDFGradually(index, link) {
            var iframeContainer = document.getElementById('iframeContainer_' + index);
            var iframe = document.createElement('iframe');
            iframe.setAttribute('src', 'about:blank'); // Initial source, will change later
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('width', '900');
            iframe.setAttribute('height', '375');

            // Append iframe to container
            iframeContainer.appendChild(iframe);

            // Function to load PDF pages gradually
            function loadPages(startPage, endPage) {
                var nextPage = startPage + 1;
                // Delayed loading of next page after a short interval
                setTimeout(function() {
                    $('.loading').empty()
                    iframe.setAttribute('src', link + '#page=' + nextPage + '&toolbar=0');
                    if (nextPage < endPage) {
                        loadPages(nextPage, endPage);
                    }
                }, 2000); // Adjust this interval as needed
            }

            // Load first few pages initially
            loadPages(1, 3); // Change page numbers as needed
        }

        // Call the function for each PDF when the page loads
        document.addEventListener("DOMContentLoaded", function(event) {
            @foreach ($user_course->course?->course_content?->links as $index => $item)
                loadPDFGradually({{ $loop->index }}, "{{ $item->link }}");
            @endforeach
        });
    </script>
@endsection
