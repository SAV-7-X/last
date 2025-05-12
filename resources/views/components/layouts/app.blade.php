<!--
=========================================================
* Soft UI Dashboard 3 - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

{{-- The header appears shere --}}
@include('include.header')

<body class="g-sidenav-show  bg-gray-100">
{{-- The sidebar is here  --}}
@include('include.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
{{-- @include('include.panel_navbar',  ['pageTitle' => 'Users']) --}}

        {{ $slot }}
    </main>
   {{-- Dashboard Configurator appears here  --}}
   @include('include.config')
   {{-- The scripts appear here --}}
   @include('include.footer')
   @stack('scripts')
  </body>
  
  </html>