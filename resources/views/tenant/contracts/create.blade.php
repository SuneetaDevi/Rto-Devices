@extends('tenant.layouts.master')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('tenant.contract.index', request()->route('tenant_domain')) }}">Contracts</a>
    </li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@push('style')
    <style>
        .creation-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .main-question {
            font-size: 1.4rem;
            font-weight: 300;
            line-height: 1.4;
        }

        .contract-option {
            border: 2px solid #e9ecef;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .contract-option:hover {
            border-color: #007bff;
            background-color: #f8f9fa;
        }

        .contract-option.selected {
            border-color: #007bff;
            background-color: #e7f3ff;
        }

        .custom-radio {
            width: 20px;
            height: 20px;
            border: 2px solid #6c757d;
        }

        .contract-option.selected .custom-radio {
            border-color: #007bff;
            background-color: #007bff;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center py-5">
                    <div class="col-md-8 creation-container">
                        <form method="post" action="{{ tenant_route('tenant.contract.step1') }}">
                            @csrf

                            <h1 class="main-question text-center text-muted mb-5">
                                Do you want to create a new contract or pickup where you left off previously?
                            </h1>

                            {{-- Store Selection --}}
                            <div class="form-group mb-4">
                                <label for="store_id"
                                    class="form-label text-uppercase small font-weight-bold text-muted mb-2">
                                    SELECT STORE *
                                </label>
                                <select class="form-control form-control-lg" id="store_id" name="store_id" required>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}" {{ $currentUserStoreId == $store->id ? "selected" : "" }}>{{ $store->store_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Contract Options --}}
                            <div class="contract-options mb-5">
                                <div class="contract-option" onclick="selectOption('new')">
                                    <div class="d-flex align-items-center">
                                        <div class="custom-radio rounded-circle mr-3"></div>
                                        <div>
                                            <h5 class="mb-1">Create New Contract</h5>
                                            <p class="text-muted mb-0 small">Start a brand new contract from scratch</p>
                                        </div>
                                    </div>
                                    <input type="radio" name="contract_action" value="new" class="d-none">
                                </div>

                                <div class="contract-option" onclick="selectOption('resume')">
                                    <div class="d-flex align-items-center">
                                        <div class="custom-radio rounded-circle mr-3"></div>
                                        <div>
                                            <h5 class="mb-1">Resume Contract</h5>
                                            <p class="text-muted mb-0 small">Continue working on a draft contract</p>
                                        </div>
                                    </div>
                                    <input type="radio" name="contract_action" value="resume" class="d-none">
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                <button type="button" class="btn btn-link text-muted px-0" onclick="window.history.back()">
                                    <i class="fas fa-arrow-left mr-2"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-primary px-4" id="continueBtn" disabled>
                                    Continue <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function selectOption(value) {
            // Remove selected class from all options
            document.querySelectorAll('.contract-option').forEach(option => {
                option.classList.remove('selected');
            });

            // Add selected class to clicked option
            event.currentTarget.classList.add('selected');

            // Set the radio value
            document.querySelector(`input[value="${value}"]`).checked = true;

            // Enable continue button
            if (value == 'new') {

                document.getElementById('continueBtn').disabled = false;
            } else {
                document.getElementById('continueBtn').disabled = true;

            }
        }
    </script>
@endpush