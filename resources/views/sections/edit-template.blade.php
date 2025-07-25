@php
    $pageTitle = __('maileclipse::template.edit templates');
@endphp

@extends('maileclipse::layout.app')

@section('title', 'Edit Template ' . ucfirst($template['name']))

@section('content')

    <div class="col-lg-12 col-md-12">
       
        <div class="container">
            <div class="row my-4">
                <div class="col-12 mb-2 d-block d-lg-none">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0 dropdown-toggle" style="cursor: pointer;" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{ __('maileclipse::template.details') }}
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.name') }}:</b>
                                        {{ ucfirst($template['name']) }}</p>
                                    <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.slug') }}:</b>
                                        {{ $template['slug'] }}</p>
                                    <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.description') }}:</b>
                                        {{ $template['description'] }}</p>

                                    {{-- <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.template view') }}:</b>
                                        {{ 'maileclipse::templates.' . $template['slug'] }}</p> --}}

                                    <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.type') }}:</b>
                                        {{ ucfirst($template['template_type']) }}</p>
                                    <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.template name') }}:</b>
                                        {{ ucfirst($template['template_view_name']) }}</p>
                                    <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.details') }}:</b>
                                        {{ ucfirst($template['template_skeleton']) }}</p>
                                    <p class="text-primary edit-template" style="cursor:pointer;"><i
                                            class="fas fa-edit"></i> {{ __('maileclipse::template.edit details') }}</p>
                                    <p class="text-danger delete-template" style="cursor:pointer;"><i
                                            class="fas fa-trash "></i> {{ __('maileclipse::template.delete template') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="card mb-2">
                        <div class="card-header p-3" style="border-bottom:1px solid #e7e7e7e6;">
                            <button type="button" class="btn btn-success float-right save-template">{{ __('maileclipse::template.update') }}</button>
                            <button type="button" class="btn btn-secondary float-right preview-toggle mr-2"><i
                                    class="far fa-eye"></i> {{ __('maileclipse::template.preview') }}</button>
                            <button type="button" class="btn btn-light float-right mr-2 save-draft disabled">{{ __('maileclipse::template.save') }}
                                {{ __('maileclipse::template.draft') }}</button>
                        </div>
                    </div>

                    <div class="card">

                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">{{ __('maileclipse::template.editor') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <textarea id="template_editor" cols="30" rows="10">{{ $template['template'] }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{__('maileclipse::template.details')}}</h5>
                        </div>
                        <div class="card-body">
                            <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.name') }}:</b>
                                        {{ ucfirst($template['name']) }}</p>
                                    <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.slug') }}:</b>
                                        {{ $template['slug'] }}</p>
                                    <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.description') }}:</b>
                                        {{ $template['description'] }}</p>

                                    {{-- <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.template view') }}:</b>
                                        {{ 'maileclipse::templates.' . $template['slug'] }}</p> --}}

                                    <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.template type') }}:</b>
                                        {{ ucfirst($template['template_type']) }}</p>
                                    <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.template name') }}:</b>
                                        {{ ucfirst($template['template_view_name']) }}</p>
                                    <p style="font-size: .9em;"><b class="font-weight-sixhundred">{{ __('maileclipse::template.details') }}:</b>
                                        {{ ucfirst($template['template_skeleton']) }}</p>
                                    <p class="text-primary edit-template" style="cursor:pointer;"><i
                                            class="fas fa-edit"></i> {{ __('maileclipse::template.edit details') }}</p>
                                    <p class="text-danger delete-template" style="cursor:pointer;"><i
                                            class="fas fa-trash "></i> {{ __('maileclipse::template.delete template') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
@section('page-js')
 <style type="text/css">
        .CodeMirror {
            height: 400px;
        }

        .editor-preview-active,
        .editor-preview-active-side {
            /*display:block;*/
        }

        .editor-preview-side>p,
        .editor-preview>p {
            margin: inherit;
        }

        .editor-preview pre,
        .editor-preview-side pre {
            background: inherit;
            margin: inherit;
        }

        .editor-preview table td,
        .editor-preview table th,
        .editor-preview-side table td,
        .editor-preview-side table th {
            border: inherit;
            padding: inherit;
        }

        .view_data_param {
            cursor: pointer;
        }
    </style>
    @endsection
    @push('scripts')
        
    <script type="text/javascript">
        $(document).ready(function() {

            var templateID = "{{ 'template_view_' . $template['slug'] }}";

            $('.edit-template').click(function() {
                Swal.fire({
                    title: 'New template name:',
                    input: 'text',
                    inputPlaceholder: 'e.g. Weekly Newsletter',
                    showCancelButton: true,
                    confirmButtonText: 'Next',
                    inputValidator: (value) => {
                        if (!value.trim()) {
                            return 'Please enter a template name';
                        }
                        const invalid = /[^a-zA-Z0-9 ]/g;
                        if (invalid.test(value)) {
                            return 'Only letters, numbers and spaces allowed';
                        }
                    }
                }).then((nameResult) => {
                    if (nameResult.isConfirmed) {
                        const templatename = nameResult.value;

                        Swal.fire({
                            title: 'New template description:',
                            input: 'text',
                            inputPlaceholder: 'Enter description...',
                            showCancelButton: true,
                            confirmButtonText: 'Update Template',
                            inputValidator: (value) => {
                                if (!value.trim()) {
                                    return 'Please enter a description';
                                }
                                const invalid = /[^a-zA-Z0-9 ]/g;
                                if (invalid.test(value)) {
                                    return 'Only letters, numbers and spaces allowed';
                                }
                            }
                        }).then((descResult) => {
                            if (descResult.isConfirmed) {
                                const templatedescription = descResult.value;

                                axios.post('{{ route('updateTemplate') }}', {
                                        templateslug: '{{ $template['slug'] }}',
                                        title: templatename,
                                        description: templatedescription,
                                    })
                                    .then(function(response) {
                                        if (response.data.status === 'ok') {
                                            window.location.replace(response.data
                                                .template_url);
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Update failed',
                                                text: response.data.message,
                                            });
                                        }
                                    })
                                    .catch(function(error) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Request failed',
                                            text: 'Something went wrong. Please try again.',
                                        });
                                    });
                            }
                        });
                    }
                });
            });


            $('.delete-template').click(function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will permanently delete the template.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('{{ route('deleteTemplate') }}', {
                                templateslug: '{{ $template['slug'] }}',
                            })
                            .then(function(response) {
                                if (response.data.status === 'ok') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Template Deleted',
                                        html: '<small>Redirecting...</small>',
                                        timer: 2500,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {
                                        window.location.replace(
                                            '{{ route('templateList') }}');
                                    }, 2500);
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Template not deleted',
                                        text: response.data.message ||
                                            'Something went wrong.'
                                    });
                                }
                            })
                            .catch(function(error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Something went wrong. Please try again.'
                                });
                            });
                    }
                });
            });


            @if ($template['template_type'] === 'markdown')

                var simplemde = new SimpleMDE({
                    element: $("#template_editor")[0],
                    toolbar: [{
                            name: "bold",
                            action: SimpleMDE.toggleBold,
                            className: "fa fa-bold",
                            title: "Bold",
                        },
                        {
                            name: "italic",
                            action: SimpleMDE.toggleItalic,
                            className: "fa fa-italic",
                            title: "Italic",
                        },
                        {
                            name: "strikethrough",
                            action: SimpleMDE.toggleStrikethrough,
                            className: "fa fa-strikethrough",
                            title: "Strikethrough",
                        },
                        {
                            name: "heading",
                            action: SimpleMDE.toggleHeadingSmaller,
                            className: "fa fa-header",
                            title: "Heading",
                        },
                        {
                            name: "code",
                            action: SimpleMDE.toggleCodeBlock,
                            className: "fa fa-code",
                            title: "Code",
                        },
                        /*{
                        		name: "quote",
                        		action: SimpleMDE.toggleBlockquote,
                        		className: "fa fa-quote-left",
                        		title: "Quote",
                        },*/
                        "|",
                        {
                            name: "unordered-list",
                            action: SimpleMDE.toggleBlockquote,
                            className: "fa fa-list-ul",
                            title: "Generic List",
                        },
                        {
                            name: "uordered-list",
                            action: SimpleMDE.toggleOrderedList,
                            className: "fa fa-list-ol",
                            title: "Numbered List",
                        },
                        {
                            name: "clean-block",
                            action: SimpleMDE.cleanBlock,
                            className: "fa fa-eraser fa-clean-block",
                            title: "Clean block",
                        },
                        "|",
                        {
                            name: "link",
                            action: SimpleMDE.drawLink,
                            className: "fa fa-link",
                            title: "Create Link",
                        },
                        {
                            name: "image",
                            action: SimpleMDE.drawImage,
                            className: "fa fa-picture-o",
                            title: "Insert Image",
                        },
                        {
                            name: "horizontal-rule",
                            action: SimpleMDE.drawHorizontalRule,
                            className: "fa fa-minus",
                            title: "Insert Horizontal Line",
                        },
                        "|",
                        {
                            name: "button-component",
                            action: setButtonComponent,
                            className: "fa fa-hand-pointer-o",
                            title: "Button Component",
                        },
                        {
                            name: "table-component",
                            action: setTableComponent,
                            className: "fa fa-table",
                            title: "Table Component",
                        },
                        {
                            name: "promotion-component",
                            action: setPromotionComponent,
                            className: "fa fa-bullhorn",
                            title: "Promotion Component",
                        },
                        {
                            name: "panel-component",
                            action: setPanelComponent,
                            className: "fa fa-thumb-tack",
                            title: "Panel Component",
                        },
                        "|",
                        {
                            name: "side-by-side",
                            action: SimpleMDE.toggleSideBySide,
                            className: "fa fa-columns no-disable no-mobile",
                            title: "Toggle Side by Side",
                        },
                        {
                            name: "fullscreen",
                            action: SimpleMDE.toggleFullScreen,
                            className: "fa fa-arrows-alt no-disable no-mobile",
                            title: "Toggle Fullscreen",
                        },
                        {
                            name: "preview",
                            action: SimpleMDE.togglePreview,
                            className: "fa fa-eye no-disable",
                            title: "Toggle Preview",
                        },
                    ],
                    renderingConfig: {
                        singleLineBreaks: true,
                        codeSyntaxHighlighting: true,
                    },
                    hideIcons: ["guide"],
                    spellChecker: false,
                    promptURLs: true,
                    placeholder: "Write your Beautiful Email",
                    previewRender: function(plainText, preview) {
                        // return preview.innerHTML = 'sacas';
                        $.ajax({
                            method: "POST",
                            url: "{{ route('previewTemplateMarkdownView') }}",
                            data: {
                                markdown: plainText,
                                name: '{{ $template['slug'] }}'
                            }

                        }).done(function(HtmledTemplate) {
                            preview.innerHTML = HtmledTemplate;
                        });

                        return '';
                    },
                });

                function setButtonComponent(editor) {

                    link = prompt('Button Link');

                    var cm = editor.codemirror;
                    var output = '';
                    var selectedText = cm.getSelection();
                    var text = selectedText || 'Button Text';

                    output = `
[component]: # ('mail::button',  ['url' => '` + link + `'])
` + text + `
[endcomponent]: # 
	    `;
                    cm.replaceSelection(output);

                }

                function setPromotionComponent(editor) {

                    var cm = editor.codemirror;
                    var output = '';
                    var selectedText = cm.getSelection();
                    var text = selectedText || 'Promotion Text';

                    output = `
[component]: # ('mail::promotion')
` + text + `
[endcomponent]: # 
	    `;
                    cm.replaceSelection(output);

                }

                function setPanelComponent(editor) {

                    var cm = editor.codemirror;
                    var output = '';
                    var selectedText = cm.getSelection();
                    var text = selectedText || 'Panel Text';

                    output = `
[component]: # ('mail::panel')
` + text + `
[endcomponent]: # 
	    `;
                    cm.replaceSelection(output);

                }

                function setTableComponent(editor) {

                    var cm = editor.codemirror;
                    var output = '';
                    var selectedText = cm.getSelection();

                    output = `
[component]: # ('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
[endcomponent]: # 
	    `;
                    cm.replaceSelection(output);

                }

                simplemde.codemirror.on("change", function() {
                    if ($('.save-draft').hasClass('disabled')) {
                        $('.save-draft').removeClass('disabled').text('Save Draft');
                    }
                    // alert('Hello');
                });

                $('.save-draft').click(function() {
                    if (!$('.save-draft').hasClass('disabled')) {
                        localStorage.setItem(templateID, simplemde.codemirror.getValue());
                        $(this).addClass('disabled').text('Draft Saved');
                    }
                });

                if (localStorage.getItem(templateID) !== null) {
                    simplemde.value(localStorage.getItem(templateID));
                }

                $('.save-template').click(function() {

                    notie.confirm({

                        text: 'Are you sure you want to do that?',

                        submitCallback: function() {

                            axios.post('{{ route('parseTemplate') }}', {
                                    markdown: simplemde.codemirror.getValue(),
                                    viewpath: "{{ $template['slug'] }}",
                                    template: true
                                })

                                .then(function(response) {

                                    if (response.data.status == 'ok') {

                                        notie.alert({
                                            type: 1,
                                            text: 'Template updated',
                                            time: 3
                                        })

                                        localStorage.removeItem(templateID);
                                    } else {

                                        notie.alert({
                                            type: 'error',
                                            text: 'Template not updated',
                                            time: 3
                                        })
                                    }

                                })

                                .catch(function(error) {
                                    notie.alert({
                                        type: 'error',
                                        text: error,
                                        time: 3
                                    })
                                });

                        }
                    });

                });

                $('.preview-toggle').click(function() {
                    simplemde.togglePreview();
                    $(this).toggleClass('active');
                });
            @else

                tinymce.init({
                    selector: "textarea#template_editor",
                    menubar: false,
                    visual: false,
                    height: 600,
                    inline_styles: true,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table directionality emoticons template paste fullpage code legacyoutput"
                    ],
                    content_css: "css/content.css",
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image fullpage table | forecolor backcolor emoticons | preview | code",
                    fullpage_default_encoding: "UTF-8",
                    fullpage_default_doctype: "<!DOCTYPE html>",
                    init_instance_callback: function(editor) {
                        editor.on('Change', function(e) {
                            if ($('.save-draft').hasClass('disabled')) {
                                $('.save-draft').removeClass('disabled').text('Save Draft');
                            }
                        });

                        if (localStorage.getItem(templateID) !== null) {
                            editor.setContent(localStorage.getItem(templateID));
                        }

                        setTimeout(function() {
                            editor.execCommand("mceRepaint");
                        }, 2000);

                    }
                });


                $('.save-template').click(function() {
                    Swal.fire({
                        title: '{{ __('maileclipse::template.update confirmation') }}',
                        html: '{{ __('maileclipse::template.update confirmation text') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: '{{ __('maileclipse::template.update') }}',
                        cancelButtonText: '{{ __('maileclipse::template.cancel') }}',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.post('{{ route('parseTemplate') }}', {
                                    markdown: tinymce.get('template_editor').getContent(),
                                    viewpath: "{{ $template['slug'] }}",
                                    template: true
                                })
                                .then(function(response) {
                                    if (response.data.status === 'ok') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Updated!',
                                            text: '{{ __('maileclipse::template.template updated') }}',
                                            timer: 3000,
                                            showConfirmButton: false
                                        });

                                        localStorage.removeItem(templateID);
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: '{{ __('maileclipse::template.template not updated') }}',
                                            timer: 3000,
                                            showConfirmButton: false
                                        });
                                    }
                                })
                                .catch(function(error) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: '{{ __('maileclipse::template.error occurred') }}',
                                        timer: 3000,
                                        showConfirmButton: false
                                    });
                                });
                        }
                    });
                });



                $('.save-draft').click(function() {
                    if (!$('.save-draft').hasClass('disabled')) {
                        localStorage.setItem(templateID, tinymce.get('template_editor').getContent());
                        $(this).addClass('disabled').text('Draft Saved');
                    }
                });

                $('.preview-toggle').click(function() {
                    tinyMCE.execCommand('mcePreview');
                    return false;
                });
            @endif

        });
    </script>

@endpush