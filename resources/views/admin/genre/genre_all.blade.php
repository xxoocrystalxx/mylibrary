@extends('home.dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Genre List</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Genre All Data</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Genre Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($genres as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                <div style="display:none"
                                                    class="spinner-border spinner-border-sm text-success myspinner"
                                                    role="status">
                                                </div><a href="#" id="inline-firstname" class="name"
                                                    data-type="text" data-pk="1" data-placement="right"
                                                    data-url="{{ route('update.genre', $item->id) }}"
                                                    data-placeholder="Required"
                                                    data-title="Enter genre name">{{ $item->name }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('delete.genre', $item->id) }}" class="btn btn-danger sm"
                                                    title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                </tbody>
                                @endforeach
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

    <script>
        var jQuery = jQuery.noConflict();
        jQuery(document).ready(function() {
            (jQuery.fn.editableform.buttons =
                '<button type="submit" class="btn btn-success editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button><button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect waves-light"><i class="mdi mdi-close"></i></button>'
            ),
            jQuery(".name", this).editable({
                    validate: function(e) {
                        if ("" == jQuery.trim(e)) return "This field is required"
                    },
                    mode: "inline",
                    inputclass: "form-control-sm",
                }),
                jQuery("#inline-comments", this).editable({
                    showbuttons: "bottom",
                    mode: "inline",
                    inputclass: "form-control-sm",
                });
        });
    </script>
@endsection
