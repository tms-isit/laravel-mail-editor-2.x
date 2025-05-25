@php
    $pageTitle = __('maileclipse::template.email_templates');
@endphp

@extends('maileclipse::layout.app')



@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">
                    {{ __('maileclipse::template.Templates') }}
                </h3>
            </div>
            <div class="card-toolbar">
                @if (!$templates->isEmpty())
                    <a href="{{ route('selectNewTemplate') }}" class="btn btn-primary">{{ __('maileclipse::template.Add Template') }}</a>
                @endif
            </div>
        </div>
        
        <div class="card-body">
            @if ($templates->isEmpty())
                @component('maileclipse::layout.emptydata')
                    <span class="d-block mb-4">{{ __("maileclipse::template.We didn't find anything - just empty space.") }}</span>
                    <a class="btn btn-primary" href="{{ route('selectNewTemplate') }}">{{ __('maileclipse::template.Add New Template') }}</a>
                @endcomponent
            @else
                <div class="table-responsive">
                    <table class="table" id="datatables">
                        <thead>
                            <tr>
                                <th>{{ __('maileclipse::template.Name') }}</th>
                                <th>{{ __('maileclipse::template.Description') }}</th>
                                <th>{{ __('maileclipse::template.Template') }}</th>
                                <th></th>
                                <th class="text-center">{{ __('maileclipse::template.Type') }}</th>
                                <th>{{ __('maileclipse::template.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($templates->all() as $template)
                                <tr id="template_item_{{ $template->template_slug }}">
                                    <td>{{ ucwords($template->template_name) }}</td>
                                    <td class="text-muted" title="/tee">{{ $template->template_description }}</td>
                                    <td>{{ ucfirst($template->template_view_name) }}</td>
                                    <td class="text-muted">{{ ucfirst($template->template_skeleton) }}</td>
                                    <td class="text-center">{{ ucfirst($template->template_type) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="flaticon2-gear text-primary"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('viewTemplate', ['templatename' => $template->template_slug]) }}" 
                                                   data-toggle="tooltip" data-placement="top">
                                                    <i class="fa fa-eye mx-2 text-primary"></i>
                                                    {{ __('maileclipse::template.adminstration.view') }}
                                                </a>
                                                <a href="#" class="dropdown-item mr-3 remove-item" data-toggle="tooltip" 
                                                   data-placement="top"
                                                   data-template-slug="{{ $template->template_slug }}"
                                                   data-template-name="{{ $template->template_name }}">
                                                    <i class="fa fa-trash mx-2 text-danger"></i>
                                                    {{ __('maileclipse::template.adminstration.delete') }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('.remove-item').click(function() {
            var templateSlug = $(this).data('template-slug');
            var templateName = $(this).data('template-name');

            Swal.fire({
                title: '{{ __("maileclipse::template.delete_confirmation_title") }}',
                html: `{!! __("maileclipse::template.delete_confirmation_html") !!}`.replace(':templateName', templateName),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{ __("maileclipse::template.yes_delete") }}',
                cancelButtonText: '{{ __("maileclipse::template.cancel") }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('{{ route('deleteTemplate') }}', {
                            templateslug: templateSlug,
                        })
                        .then(function(response) {
                            if (response.data.status === 'ok') {
                                Swal.fire({
                                    icon: 'success',
                                    title: '{{ __("maileclipse::template.deleted_title") }}',
                                    text: '{{ __("maileclipse::template.deleted_message") }}',
                                    timer: 2000,
                                    showConfirmButton: false
                                });

                                jQuery('tr#template_item_' + templateSlug).fadeOut('slow');

                                let tbody = $("#templates_list tbody");

                                if (tbody.children().length <= 1) {
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2000);
                                }

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: '{{ __("maileclipse::template.not_deleted_title") }}',
                                    text: '{{ __("maileclipse::template.not_deleted_message") }}',
                                });
                            }
                        })
                        .catch(function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: '{{ __("maileclipse::template.error_title") }}',
                                text: '{{ __("maileclipse::template.error_message") }}',
                            });
                        });
                }
            });
        });
    </script>
@endpush

@include('General.Datatable.datatables')
