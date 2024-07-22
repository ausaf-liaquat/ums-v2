@extends('backend.layout.app')

@section('title')
    {{ $isEdit ? 'Edit' : 'Add' }} Frontend Content
@endsection

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Files</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('backend.frontend-contents') }}">Frontend Content</a>
                </li>
                <li class="breadcrumb-item active">{{ $isEdit ? 'Edit' : 'Add' }}</li>
            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-4">
            <h5 class="card-header">{{ $isEdit ? 'Edit' : 'Add' }} Frontend Content</h5>
            <!-- Account -->

            <div class="card-body">
                <form id="formShiftType"
                    action="{{ $isEdit ? route('backend.frontend-contents.update', ['frontend_page' => $frontend_page->id]) : route('backend.frontend-contents.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <table class="table table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>Content Type</th>
                                    <th>Content Title</th>
                                    <th>Content File</th>
                                    <th>Content Text</th>

                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody id="dynamicTable">
                                @forelse ($frontend_page->contents ?? [] as $key => $content)
                                    <tr>
                                      <input type="hidden" name="existing_content_file[]" value="{{ $content->content_file }}">
                                        <input type="hidden" name="content_id[]" value="{{ $content->id }}">
                                        <td>
                                            <select name="content_type_id[]" class="form-control form-select" required>
                                                <option value="">Select Content Type</option>
                                                @foreach ($content_types as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $content->mf_content_type_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="content_title[]"
                                                value="{{ $content->content_title }}" placeholder="Enter Content Title"
                                                class="form-control" />
                                        </td>
                                        <td>
                                            @if ($content->content_file && Storage::disk('cms')->exists($content->content_file))
                                                <a href="{{ Storage::disk('cms')->url($content->content_file) }}"
                                                    target="_blank">UPLOADED FILE <i
                                                        class="tf-icons bx bx-download"></i></a>
                                            @endif
                                            <input type="file" name="content_file[]" class="form-control mt-1"  />
                                        </td>
                                        <td>
                                            <textarea name="content_text[]" class="form-control">{{ $content->content_text }}</textarea>
                                        </td>
                                        <td class="text-center">
                                            @if ($loop->last)
                                                <i class="tf-icons bx bxs-message-square-add text-success cursor-pointer fs-3"
                                                    id="add"></i>
                                            @else
                                                <i
                                                    class="tf-icons bx bxs-message-square-x text-danger cursor-pointer remove-tr fs-3"></i>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                      <input type="hidden" name="existing_content_file[]" value="">
                                        <input type="hidden" name="content_id[]" value="">
                                        <td>
                                            <select name="content_type_id[]" class="form-control form-select" id=""
                                                required>
                                                <option value="">Select Content Type</option>

                                                @foreach ($content_types as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                                @endforeach

                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="content_title[]" placeholder="Enter Content Title"
                                                class="form-control" />

                                        </td>
                                        <td>
                                            <input type="file" name="content_file[]" class="form-control" />

                                        </td>
                                        <td>
                                            <textarea type="file" name="content_text[]" class="form-control"></textarea>

                                        </td>
                                        <td class="text-center">
                                            <i class="tf-icons bx bxs-message-square-add text-success cursor-pointer fs-3"
                                                id="add"></i>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                    <div class="mt-5">
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

            let form = $('#formShiftType').parsley()

            var i = 0;

            $("#add").click(function() {

                ++i;

                $("#dynamicTable").append(
                    `
                      <tr>
                               <input type="hidden" name="existing_content_file[]" value="">
                                      <input type="hidden" name="content_id[]" value="">

                        <td>
                            <select name="content_type_id[]" class="form-control form-select" id=""
                                required>
                                <option value="">Select Content Type</option>
                                @foreach ($content_types as $item)
                                    <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="content_title[]" placeholder="Enter Content Title"
                                class="form-control" />
                        </td>
                        <td>
                            <input type="file" name="content_file[]" class="form-control" />
                        </td>
                        <td>
                            <textarea type="file" name="content_text[]" class="form-control" ></textarea>
                        </td>
                        <td class="text-center">
                          <i class="tf-icons bx bxs-message-square-x text-danger cursor-pointer remove-tr fs-3" id="add"></i>
                        </td>
                      </tr>
                    `
                );
            });

            $(document).on('click', '.remove-tr', function() {
                $(this).parents('tr').remove();
            });
        });
    </script>
@endsection
