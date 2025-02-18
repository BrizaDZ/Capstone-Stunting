<!DOCTYPE html>
<!--
Template Name:  SmartAdmin Responsive WebApp - Template build with Twitter Bootstrap 4
Version: 4.0.0
Author: Sunnyat Ahmmed
Website: http://gootbootstrap.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="en">
@include('layouts.head')

<body class="mod-bg-1 ">
    <!-- DOC: script to save and load page settings -->

    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            @include('layouts.sidebar')
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                @include('layouts.header')
                <!-- END Page Header -->
                <!-- BEGIN Page Content -->
                <main id="js-page-content" role="main" class="page-content">

                    @yield('content')

                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>

                @include('layouts.footer')

                @include('layouts.shortcuts')

            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->
    <!-- BEGIN Quick Menu -->
    <!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->

    <!-- END Quick Menu -->
    <!-- BEGIN Messenger -->
    @include('layouts.messenger')
    <!-- END Messenger -->
    <!-- BEGIN Page Settings -->
    @include('layouts.modal')
    <!-- END Page Settings -->
    @include('layouts.scriptsrc')
</body>

</html>
