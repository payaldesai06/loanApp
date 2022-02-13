@extends('layouts.app')

@section('title')
Home
@endsection

@section('css_before')
@endsection

@section('css_after')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('js_after')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('js/pages/user.js') }}"></script>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Total Users</div>
                        <div class="ms-auto lh-1">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted totalusertext" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item totaluser active" data-id="7" href="javascript:void(0);">Last 7 days</a>
                                <a class="dropdown-item totaluser" data-id="30" href="javascript:void(0);">Last 30 days</a>
                                <a class="dropdown-item totaluser" data-id="90" href="javascript:void(0);">Last 3 months</a>
                                <a class="dropdown-item totaluser" data-id="365" href="javascript:void(0);">In Year</a>
                                <input type="text" id="dates1">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <div class="h1 mb-3 me-2" id="totalusers">{{Commonhelper::totalUsers(7)}}</div>
                    </div>
                    <div id="chart-active-users" class="chart-sm"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="subheader">Total Quotes</div>
                            <div class="ms-auto lh-1">
                            <div class="dropdown">
                                <a class="dropdown-toggle text-muted totalquotetext" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item totalquote active" data-id="7" href="javascript:void(0);">Last 7 days</a>
                                    <a class="dropdown-item totalquote" data-id="30" href="javascript:void(0);">Last 30 days</a>
                                    <a class="dropdown-item totalquote" data-id="90" href="javascript:void(0);">Last 3 months</a>
                                    <a class="dropdown-item totalquote" data-id="365" href="javascript:void(0);">In Year</a>
                                    <input type="text" id="dates2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-baseline">
                        <div class="h1 mb-3 me-2" id="totalquotes">{{Commonhelper::totalQuotes(7)}}</div>
                    </div>
                    <div id="chart-active-users" class="chart-sm"></div>
                </div>
                </div>
            </div>
        </div>
      </div>
</div>
@endsection
