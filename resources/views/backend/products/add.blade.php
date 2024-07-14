@extends('backend.layout.app')

@section('title')
    {{ $isEdit ? 'Edit' : 'Add' }} Product
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Files</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('backend.products') }}">Products</a>
                </li>
                <li class="breadcrumb-item active">{{ $isEdit ? 'Edit' : 'Add' }}</li>
            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-4">
            <h5 class="card-header">{{ $isEdit ? 'Edit' : 'Add' }} Products</h5>
            <!-- Account -->

            <div class="card-body">
                <form id="formSize"
                    action="{{ $isEdit ? route('backend.products.update', ['product' => $product->id]) : route('backend.products.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="title" class="form-label">Product Title</label>
                            <input class="form-control" type="text" id="title" value="{{ $product->title ?? '' }}"
                                placeholder="Enter product title" name="title" autofocus="" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="slug" class="form-label">Product Slug</label>
                            <input class="form-control" type="text" name="slug" id="slug"
                                value="{{ $product->slug ?? '' }}" placeholder="Enter product slug" autofocus="" readonly
                                required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="description" class="form-label">Product Description</label>
                            <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{ $product->description ?? '' }}</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="price" class="form-label">Product Price</label>
                            <input class="form-control" type="number" id="price" name="price" step="0.01"
                                value="{{ $product->price ?? '' }}" placeholder="Enter product price" autofocus=""
                                required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="mf_type" class="form-label">Product Type </label>
                            <select class="form-control form-select" name="mf_type_id" id="mf_type_id" required>

                                <option value="">Please select type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ $isEdit && $product->mf_type_id == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="mf_type" class="form-label">Product Colors</label>

                            <select name="color[]" class="form-control color" multiple required>
                                @php
                                    if ($isEdit) {
                                        $selectedColors = $product->colors->pluck('id')->toArray();
                                    }
                                @endphp
                                <option value="">Please select</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}"
                                        {{ $isEdit && in_array($color->id, $selectedColors) ? 'selected' : '' }}>
                                        {{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="mf_type" class="form-label">Product Sizes</label>

                            <select name="size[]" class="form-control size" multiple required>
                                @php
                                    if ($isEdit) {
                                        $selectedSizes = $product->sizes->pluck('id')->toArray();
                                    }
                                @endphp
                                <option value="">Please select</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}"
                                        {{ $isEdit && in_array($size->id, $selectedSizes) ? 'selected' : '' }}>
                                        {{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="mf_type" class="form-label">Product Images</label>
                            <input type="file" class="filepond form-control" name="images[]" multiple
                                data-max-file-size="300MB">
                        </div>
                        {{-- @dd(json_decode($product->image)) --}}
                    </div {{-- <div class="customer_records_dynamic"></div> --}} <div class="mt-5">
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

            let form = $('#formSize').parsley()

            $('.color').select2({
                width: 'resolve', // need to override the changed default
                placeholder: 'Please select colors'
            });
            $('.size').select2({
                placeholder: 'Please select sizes'

            });

            $('.extra-fields-customer').click(function() {
                // Clone the initial row
                var newRow = `
                <div class="row">
                        <div class="mb-3 col-md-4">
                            <select name="color[]" class="form-control form-select color" required>
                                <option value="">Please select</option>
                                 @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <select name="size[]" class="form-control form-select size" required>
                                <option value="">Please select</option>
                                 @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <input type="number" class="form-control" name="quantity[]" placeholder="Enter quantity" required>
                        </div>
                        <div class="mb-3 col-md-1 text-center">
                            <i class="tx-icons bx bx-minus-circle text-danger remove-field my-2" style="cursor: pointer;"></i>
                        </div>
                        </div>
                    `;
                // Append the new row to the dynamic container
                $('.customer_records_dynamic').append(newRow);
            });

            // Function to handle the removal of a row
            $(document).on('click', '.remove-field', function() {
                $(this).closest('.row').remove();
            });

            $('#title').on('input', function() {
                var slug = generateSlug($(this).val());
                $('#slug').val(slug);
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
                allowMultiple: true, // Allow multiple
                storeAsFile: true,
                files: [
                    @if ($isEdit)
                        @foreach (json_decode($product->image) as $image)
                            {
                                source: '{{ Storage::disk('cms')->url($image) }}',
                            },
                        @endforeach
                    @endif
                ]
            }
        );
    </script>
@endsection
