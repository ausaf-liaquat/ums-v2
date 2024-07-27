@extends('backend.layout.app')

@section('title')
    {{ $isEdit ? 'Edit' : 'Add' }} Course Schedule
@endsection

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Files</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('backend.course-schedules',['course'=>$course->id]) }}">Course Schedule</a>
                </li>
                <li class="breadcrumb-item active">{{ $isEdit ? 'Edit' : 'Add' }}</li>
            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-4">
            <h5 class="card-header">{{ $isEdit ? 'Edit' : 'Add' }} Course Schedule</h5>
            <!-- Account -->

            <div class="card-body">
                <form id="formSize"
                    action="{{ $isEdit ? route('backend.course-schedules.update', ['course_schedule' => $course_schedule->id]) : route('backend.course-schedules.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>

                    </div>
                    <div class="row">
                      <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <div class="mb-3 col-md-12">
                            <label for="course_slug" class="form-label">Datetime</label>
                            <input class="form-control" type="datetime-local" name="datetime" value="{{ $course_schedule->datetime??'' }}" id="html5-datetime-local-input">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="description" class="form-label">Schedule Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="3" required>{{ $course_schedule->description ?? '' }}</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label"> Address</label>
                            <textarea name="address" class="form-control" id="address" cols="30" rows="3" required>{{ $course_schedule->address ?? '' }}</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="country" class="form-label">Country </label>
                            <select name="country_id" id="country_id" class="form-control country"
                                data-parsley-errors-container="#country-error" required>
                                @if ($isEdit)
                                    <option value="{{ $course_schedule->country_id }}" selected>{{ $course_schedule->country->name }}
                                    </option>
                                @endif
                            </select>
                            <div id="country-error"></div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="state" class="form-label">State </label>
                            <select name="state_id" id="state_id" class="form-control state"
                                data-parsley-errors-container="#state-error" required>
                                @if ($isEdit)
                                    <option value="{{ $course_schedule->state_id }}" selected>{{ $course_schedule->state->name }}</option>
                                @endif
                            </select>
                            <div id="state-error"></div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="city" class="form-label">City </label>
                            <select name="city_id" id="city_id" class="form-control city"
                                data-parsley-errors-container="#city-error" required>
                                @if ($isEdit)
                                    <option value="{{ $course_schedule->city_id }}" selected>{{ $course_schedule->city->name }}</option>
                                @endif
                            </select>
                            <div id="city-error"></div>
                        </div>
                        {{-- <div class="mb-3 col-md-3">
                            <label for="zipcode" class="form-label">Zip Code </label>
                            <input type="text" name="zip_code" value="{{ $course->zip_code ?? '' }}" id="zipcode"
                                placeholder="Enter zip code" class="form-control" required>
                        </div> --}}

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
