@include('layouts.layout_1.layout_header')
@php $SelectedRole = \Session::get('role'); @endphp

 

<body id="kt_body"
    class="header-mobile-fixed subheader-enabled aside-enabled aside-fixed subheader-fixed header-fixed aside-secondary-enabled kt-primary--minimize h-100">
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    @include('layouts.layout_1.elements.header_mobile')
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            @include('layouts.layout_1.elements.sideMenue')
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper h-100" id="kt_wrapper">
                <!--begin::header-->
                @include('layouts.layout_1.elements.header')
                <!--end::header-->

                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid kt_content_layout" id="kt_content">
                    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                        <div
                            class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center flex-wrap mr-2">
                                <!--begin::Page Title-->
                                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                                    {{ isset($pageTitle) ? $pageTitle : '' }}
                                </h5>
                                @include('common.shared.breadcrumbs')
                                <!--end::Page Title-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Toolbar-->
                            <div class="d-flex align-items-center">
                                @yield('subheader-info')
                                @if (url()->previous() != url()->current())
                                    <a class="btn btn-light-warning ml-3"
                                        href="{{ url()->previous() }}">{{ __('adminstration.back') }}</a>
                                @endif
                            </div>
                            <!--end::Toolbar-->
                        </div>
                    </div>
                    <!--begin::Container-->
                    @yield('pre-content')
                    <div class="container container_layout h-100 mt-3" id="container_layout">
                        <!--begin::Page Content-->
                        @yield('content')
                        <!--end::Page Content-->
                    </div>
                </div>

                @include('layouts.layout_1.elements.footer')
            </div>

        </div>
        @include('layouts.layout_1.elements.userpanel')
        @if (in_array($SelectedRole, App\Models\Nomination\Request::EXTERNAL_ROLES))
            @include('layouts.layout_1.elements.internal-cart',[
                'menu_id'=>'kt_second_quick_cart',
                'close_btn_id'=>'kt_second_quick_cart_close',
                'nominationCartItems'=>Auth::user()->nominationCartCourseItems,
                'title'=> __('nomination.layout.header.short_courses'),
                'type' => 'short_courses',
                'items_container_id'=>'internal-cart-body',
                'cart_items_count_id' => 'internal-cart-items-count',
                'cart_seats_count_id' => 'internal-cart-seats-count',
                'show_groups_count' => true,
                'show_courses_count' => false,
                'cart_groups_count_id' => 'internal-cart-groups-count',
                'submit_btn_id' => 'internal-cart-submit-btn'
            ])
            @include('layouts.layout_1.elements.internal-cart',[
                'menu_id'=>'kt_quick_cart',
                'close_btn_id'=>'kt_quick_cart_close',
                'nominationCartItems'=>Auth::user()->nominationCartEnrolmentPolicyItems,
                'title'=> __('nomination.listing.scheduled_training_programs'),
                'type' => 'scheduled_training_programs',
                'items_container_id'=>'internal-enrolment-cart-body',
                'cart_items_count_id' => 'internal-enrolment-cart-items-count',
                'cart_seats_count_id' => 'internal-enrolment-cart-seats-count',
                'show_groups_count' => false,
                'show_courses_count' => true,
                'cart_groups_count_id' => 'internal-enrolment-cart-groups-count',
                'submit_btn_id' => 'internal-enrolment-cart-submit-btn'
            ])
        @endif
        @include('layouts.layout_1.elements.quick_tabs_settings_notification_panel')


    </div>

    <script  src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.0/tinymce.min.js"></script>
    <!-- Axios Library -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @if ( request()->route()->getName() === 'newTemplate' ||
          request()->route()->getName() === 'editMailable' || 
          request()->route()->getName() === 'viewTemplate')
    <!--  Editor Markdown/Html/Text -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.js"></script>
    @endif

    @yield('script')
    @yield('studio-script')
    @stack('scripts')
    @yield('js')
</body>
</html>