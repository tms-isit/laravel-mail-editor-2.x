
@php
    $pageTitle = __('maileclipse::template.Create Template');
@endphp

@extends(Auth::user()->layout)


@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="container">
            <div class="row my-4">

                <div class="col-md-12">

                    <div class="card mb-2">
                        <div class="card-header p-3" style="border-bottom:1px solid #e7e7e7e6;">
                            <button type="button" class="btn btn-primary float-right save-template">{{__('maileclipse::template.create')}}</button>
                            <button type="button" class="btn btn-secondary float-right preview-toggle mr-2"><i
                                    class="far fa-eye"></i> {{__('maileclipse::template.preview')}}</button>
                        </div>
                    </div>

                    <div class="card">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">{{__('maileclipse::template.editor')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">{{__('maileclipse::template.Plain Text')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <textarea id="template_editor" cols="30" rows="10">{{ $skeleton['template'] }}</textarea>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <textarea id="plain_text" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-css')
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.css">
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
    <script src="{{ asset('mailTemplate/tinymce/js/tinymce/tinymce.min.js') }}" defer></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/xml/xml.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/css/css.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/javascript/javascript.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/htmlmixed/htmlmixed.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/display/placeholder.js"></script>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            @if ($skeleton['type'] === 'markdown')


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
                                name: 'new'
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
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image fullpage | forecolor backcolor emoticons | preview | code",
                    fullpage_default_encoding: "UTF-8",
                    fullpage_default_doctype: "<!DOCTYPE html>",
                    init_instance_callback: function(editor) {
                        setTimeout(function() {
                            editor.execCommand("mceRepaint");
                        }, 5000);
                    }
                });




                $('.preview-toggle').click(function() {
                    tinyMCE.execCommand('mcePreview');
                    return false;
                });
            @endif


         $('.save-template').click(async function() {
    // Step 1: Get template name
    const {
        value: templateName
    } = await Swal.fire({
        title: '{{ __("maileclipse::template.enter_template_name_title") }}',
        input: 'text',
        inputPlaceholder: '{{ __("maileclipse::template.template_name_placeholder") }}',
        inputValidator: (value) => {
            if (!value) return '{{ __("maileclipse::template.template_name_required") }}';
            if (/[^a-zA-Z0-9 ]/.test(value))
            return '{{ __("maileclipse::template.template_name_validation") }}';
        },
        showCancelButton: true,
        confirmButtonText: '{{ __("maileclipse::template.confirm_button") }}',
        cancelButtonText: '{{ __("maileclipse::template.cancel_button") }}'
    });

    if (!templateName) return;

    // Step 2: Get template description
    const {
        value: templateDescription
    } = await Swal.fire({
        title: '{{ __("maileclipse::template.enter_template_description_title") }}',
        input: 'text',
        inputPlaceholder: '{{ __("maileclipse::template.template_description_placeholder") }}',
        inputValidator: (value) => {
            if (!value) return '{{ __("maileclipse::template.template_description_required") }}';
            if (/[^a-zA-Z0-9 ]/.test(value))
            return '{{ __("maileclipse::template.template_description_validation") }}';
        },
        showCancelButton: true,
        confirmButtonText: '{{ __("maileclipse::template.confirm_button") }}',
        cancelButtonText: '{{ __("maileclipse::template.cancel_button") }}'
    });

    if (!templateDescription) return;

    // Step 3: Select language
    const {
        value: lang
    } = await Swal.fire({
        title: '{{ __("maileclipse::template.select_language_title") }}',
        input: 'select',
        inputOptions: {
            en: '{{ __("maileclipse::template.english") }}',
            ar: '{{ __("maileclipse::template.arabic") }}'
        },
        inputPlaceholder: '{{ __("maileclipse::template.select_language_placeholder") }}',
        showCancelButton: true,
        confirmButtonText: '{{ __("maileclipse::template.confirm_button") }}',
        cancelButtonText: '{{ __("maileclipse::template.cancel_button") }}',
        inputValidator: (value) => {
            if (!value) return '{{ __("maileclipse::template.language_selection_required") }}';
        }
    });

    if (!lang) return;

    // Prepare post data
    let postData;

    @if ($skeleton['type'] === 'markdown')
        postData = {
            content: simplemde.codemirror.getValue(),
            plain_text: plaintextEditor.getValue(),
            template_name: templateName,
            template_description: templateDescription,
            lang: lang,
            template_view_name: '{{ $skeleton['name'] }}',
            template_type: '{{ $skeleton['type'] }}',
            template_skeleton: '{{ $skeleton['skeleton'] }}',
        };
    @else
        postData = {
            content: tinymce.get('template_editor').getContent(),
            plain_text: plaintextEditor.getValue(),
            template_name: templateName,
            template_description: templateDescription,
            lang: lang,
            template_view_name: '{{ $skeleton['name'] }}',
            template_type: '{{ $skeleton['type'] }}',
            template_skeleton: '{{ $skeleton['skeleton'] }}',
        };
    @endif

    // Send via axios
    axios.post('{{ route('createNewTemplate') }}', postData)
        .then(function(response) {
            if (response.data.status === 'ok') {
                Swal.fire({
                    icon: 'success',
                    title: '{{ __("maileclipse::template.template_created_title") }}',
                    html: response.data.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                setTimeout(function() {
                    window.location.replace(response.data.template_url);
                }, 1000);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: '{{ __("maileclipse::template.error_title") }}',
                    text: response.data.message
                });
            }
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: '{{ __("maileclipse::template.request_failed_title") }}',
                text: error.response?.data?.message ||
                    '{{ __("maileclipse::template.default_error_message") }}'
            });
        });
});

            var plaintextEditor = CodeMirror.fromTextArea(document.getElementById("plain_text"), {
                lineNumbers: false,
                mode: 'plain/text',
                placeholder: "Email Plain Text Version (Optional)",
            });

        });
    </script>
@endpush
