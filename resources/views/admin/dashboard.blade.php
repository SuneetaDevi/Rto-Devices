@extends('admin.layouts.master')
@section('dashboard', 'active')

@section('title') {{ $data['title'] ?? '' }} @endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $data['title'] ?? __('messages.common.dashboard') }}</h1>
                        <div>{{ __('messages.Welcome_Back') }}, {{ Auth::user()->name }}</div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.dashboard') }}">{{__('messages.common.dashboard')}}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <!-- Tenant Card -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $data['tenants']->count() }}</h3>
                                <p>Total Tenants</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-home"></i>
                            </div>
                            <a href="{{ route('admin.tenant.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Demo Request Card -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $data['demo_requests']->count() }}</h3>
                                <p>Demo Requests</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-email"></i>
                            </div>
                            <a href="{{ route('admin.request-demo.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Subscriber Card -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $data['subscribers']->count() }}</h3>
                                <p>Subscribers</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('admin.newsletter.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- Contact Card -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $data['contacts']->count() }}</h3>
                                <p>Contacts</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-contacts"></i>
                            </div>
                            <a href="{{ route('admin.contact.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
                <div class="clearfix hidden-md-up"></div>
            </div>
        </div>
    </div>
@endsection