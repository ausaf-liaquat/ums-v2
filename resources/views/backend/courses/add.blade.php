@extends('backend.layout.app')

@section('title')
    {{ $isEdit ? 'Edit' : 'Add' }} Course
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
            <h5 class="card-header">{{ $isEdit ? 'Edit' : 'Add' }} Courses</h5>
            <!-- Account -->

            <div class="card-body">
                <form id="formSize"
                    action="{{ $isEdit ? route('backend.courses.update', ['course' => $course->id]) : route('backend.courses.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>

                    </div>
                    <div class="row">

                        <div class="mb-3 col-md-6">
                            <label for="course_name" class="form-label">Course Name (It should be unique)</label>
                            <input class="form-control" type="text" name="course_name" id="course_name"
                                value="{{ $course->name ?? '' }}" placeholder="Enter course name" name="name"
                                autofocus="" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="course_slug" class="form-label">Course Slug</label>
                            <input class="form-control" type="text" id="course_slug" value="{{ $course->slug ?? '' }}"
                                placeholder="Enter course slug" name="slug" autofocus="" readonly required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="description" class="form-label">Course Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="3" required>{{ $course->description ?? '' }}</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Course Address</label>
                            <textarea name="address" class="form-control" id="address" cols="30" rows="3">{{ $course->address ?? '' }}</textarea>
                        </div>
                        {{-- <div class="mb-3 col-md-3">
                            <label for="country" class="form-label">Country </label>
                            <select name="country_id" id="country_id" class="form-control country"
                                data-parsley-errors-container="#country-error" >
                                @if ($isEdit && !$course->country_id)
                                    <option value="{{ $course->country_id }}" selected>{{ $course?->country?->name }}
                                    </option>
                                @endif
                            </select>
                            <div id="country-error"></div>
                        </div> --}}

                        <div class="mb-3 col-md-3">
                            <label for="state" class="form-label">State </label>
                            <select name="state_id" id="state_id" class="form-control state"
                                data-parsley-errors-container="#state-error">
                                @if ($isEdit && $course->state_id)
                                    <option value="{{ $course->state_id }}" selected>{{ $course?->state?->name }}</option>
                                @endif
                            </select>
                            <div id="state-error"></div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="city" class="form-label">City </label>
                            <select name="city_id" id="city_id" class="form-control city"
                                data-parsley-errors-container="#city-error">
                                @if ($isEdit && $course->city_id)
                                    <option value="{{ $course->city_id }}" selected>{{ $course?->city?->name }}</option>
                                @endif
                            </select>
                            <div id="city-error"></div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="zipcode" class="form-label">Zip Code </label>
                            <input type="text" name="zip_code" value="{{ $course->zip_code ?? '' }}" id="zipcode"
                                placeholder="Enter zip code" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="course_type" class="form-label"> Course Type </label>
                            <select name="course_type" id="course_type" class="form-control course_type" required>
                                <option value="">Select Course Type</option>
                                <option value="0" {{ $isEdit && $course->type == 0 ? 'selected' : '' }}>Offline
                                </option>
                                <option value="1" {{ $isEdit && $course->type == 1 ? 'selected' : '' }}>Online
                                </option>
                                <option value="2" {{ $isEdit && $course->type == 2 ? 'selected' : '' }}>Online /
                                    Offline
                                </option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="mf_type" class="form-label">Is Upload Unxpired Card? </label>
                            <div class="form-switch mb-2">
                                <input class="form-check-input js-status-switch" name="is_upload_card" value="1" {{ $isEdit && $course->is_upload_card?'checked':'' }} type="checkbox">
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="course_price" class="form-label">Course price </label>
                            <input type="number" name="course_price" id="course_price" placeholder="Enter course price"
                                value="{{ $course->price ?? '' }}" step="0.01" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label for="mf_type" class="form-label">Course Image <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="filepond form-control" name="image"
                                data-parsley-errors-container="#image-error" required>
                            <div id="image-error"></div>
                        </div>

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
                            country_id: 233
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
                            country_id: 233,
                            state_id: $('.state').val()
                        }

                        return query;
                    }
                }
            })
        }
    </script>
@endsection
