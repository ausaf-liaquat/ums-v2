@extends('backend.layout.app')

@section('title')
    {{ $isEdit ? 'Edit' : 'Add' }} Course Content
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css"
        integrity="sha512-ZbehZMIlGA8CTIOtdE+M81uj3mrcgyrh6ZFeG33A4FHECakGrOsTPlPQ8ijjLkxgImrdmSVUHn1j+ApjodYZow=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Files</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('backend.courses') }}">Course</a>
                </li>
                <li class="breadcrumb-item active">{{ $isEdit ? 'Edit' : 'Add' }}</li>
            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-4">
            <h5 class="card-header">{{ $isEdit ? 'Edit' : 'Add' }} Course Content</h5>
            <!-- Account -->

            <div class="card-body">
                <form id="formSize" action="{{ route('backend.courses.content.update', ['course' => $course->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>

                        <div class="form-group mt-4">
                            <label for="" class="form-label">Main Content</label>
                            <textarea id="summernote" class="form-control" name="content" required data-parsley-errors-container="#content-error">{{ $course->course_content->content ?? null }}</textarea>

                            <div id="content-error"></div>
                        </div>

                        <table class="table table-bordered mt-4" id="dynamicTable">
                            <tr>
                                <th>Name</th>
                                <th>Link</th>
                                <th class="text-center">Action</th>
                            </tr>

                            @forelse ($course->course_content->links ?? [] as $key => $course_link)
                                <tr>
                                    <td>
                                        <input type="text" name="heading[]" placeholder="Enter heading"
                                            class="form-control" value="{{ $course_link->heading }}" />
                                    </td>
                                    <td>

                                        <input type="text" name="link[]" value="{{ $course_link->link }}"
                                            placeholder="Enter link" class="form-control" />
                                    </td>
                                    <td class="text-center">
                                        @if ($loop->first)
                                            <i class="tf-icons bx bxs-message-square-add text-success cursor-pointer fs-3"
                                                id="add"></i>
                                            {{-- <button type="button" name="add" id="add" class="btn btn-success">Add
                                                More
                                            </button> --}}
                                        @else
                                            <i class="tf-icons bx bxs-message-square-x text-danger cursor-pointer remove-tr fs-3"
                                                id="add"></i>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <input type="text" name="heading[]" placeholder="Enter heading"
                                            class="form-control" />
                                    </td>
                                    <td>
                                        <input type="text" name="link[]" placeholder="Enter link"
                                            class="form-control" />

                                    </td>
                                    <td class="text-center">
                                        <i class="tf-icons bx bxs-message-square-add text-success cursor-pointer fs-3"
                                            id="add"></i>
                                        {{-- <button type="button" name="add" id="add" class="btn btn-success">Add
                                            More
                                        </button> --}}
                                    </td>
                                </tr>
                            @endforelse

                        </table>
                    </div>

                    {{-- <div class="customer_records_dynamic"></div> --}} <div class="mt-5">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /Account -->
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"
        integrity="sha512-lVkQNgKabKsM1DA/qbhJRFQU8TuwkLF2vSN3iU/c7+iayKs08Y8GXqfFxxTZr1IcpMovXnf2N/ZZoMgmZep1YQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                tabsize: 2,
                height: 450
            });
        });
    </script>
    <script type="text/javascript">
        var i = 0;

        $("#add").click(function() {

            ++i;

            $("#dynamicTable").append(
                '<tr><td><input type="text" name="heading[]" placeholder="Enter heading" class="form-control" /></td><td><input type="text" name="link[]" placeholder="Enter link" class="form-control" /></td> <td class="text-center"> <i class="tf-icons bx bxs-message-square-x text-danger cursor-pointer remove-tr fs-3" id="add"></i></td></tr>'
            );
        });

        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    </script>
    <script>
        $(document).ready(function() {
            countrySelect2()
            stateSelect2()
            citySelect2()
            let form = $('#formSize').parsley()

            $('.color').select2({
                width: 'resolve', // need to override the changed default
                placeholder: 'Please select colors'
            });
            $('.size').select2({
                placeholder: 'Please select sizes'

            });

            // Function to handle the removal of a row
            $(document).on('click', '.remove-field', function() {
                $(this).closest('.row').remove();
            });

            $('#course_name').on('input', function() {
                var slug = generateSlug($(this).val());
                $('#course_slug').val(slug);
            });
        });

        function generateSlug(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        }

        FilePond.registerPlugin(FilePondPluginImagePreview);

        FilePond.create(
            document.querySelector('.filepond'), {
                instantUpload: false, // Disable instant upload
                allowMultiple: false, // Allow multiple
                storeAsFile: true,
                files: [
                    @if ($isEdit)

                        {
                            source: '{{ Storage::disk('cms')->url($course->image) }}',
                        },
                    @endif
                ]
            }
        );

        function countrySelect2() {
            $('.country').select2({
                placeholder: 'Select Country',
                ajax: {
                    url: "{{ route('countries.select2') }}",
                    delay: 250,
                    data: function(params) {
                        var query = {
                            q: params.term,
                        }

                        return query;
                    }
                }
            })
        }

        function stateSelect2() {
            $('.state').select2({
                placeholder: 'Select state',
                ajax: {
                    url: "{{ route('states.select2') }}",
                    delay: 250,
                    data: function(params) {
                        var query = {
                            q: params.term,
                            country_id: $('.country').val()
                        }

                        return query;
                    }
                }
            })
        }

        function citySelect2() {
            $('.city').select2({
                placeholder: 'Select city',
                ajax: {
                    url: "{{ route('cities.select2') }}",
                    delay: 250,
                    data: function(params) {
                        var query = {
                            q: params.term,
                            country_id: $('.country').val(),
                            state_id: $('.state').val()
                        }

                        return query;
                    }
                }
            })
        }
    </script>
@endsection
