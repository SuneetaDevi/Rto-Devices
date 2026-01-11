@extends('tenant.layouts.master')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('tenant.contract.index', request()->route('tenant_domain')) }}">Contracts</a>
    </li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('shop/cotracts/steps.css') }}">
@endpush

@section('content')
    @php
        $states = [
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
        ];
    @endphp

    <div class="content-wrapper">
        <div class="content py-5">
            <div class="container">
                <div class="creation-container">
                    <form method="POST" action="{{ tenant_route('tenant.contract.step4', [$contract->pub_ref]) }}">
                        @csrf
                        <input type="hidden" name="contract_id" value="{{ $contract->id }}">

                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            @for ($i = 1; $i <= 8; $i++)
                                <div class="step-circle @if($i <= 3) active @endif">{{ $i }}</div>
                            @endfor
                        </div>

                        <h3 class="text-center mb-5">ID Verification</h3>

                        <!-- ID Info -->
                        <div class="form-row mb-5">
                            <div class="form-group col-md-4">
                                <label for="idType">ID Type</label>
                                <select class="form-control form-control-minimal" id="idType" name="document_type">
                                    <option value="">Select ID Type</option>
                                    <option value="drivers_license" {{ old('document_type', $contract->document_type) == "drivers_license" ? "selected" : "" }}>State Issued
                                        Driver's License</option>
                                    <option value="passport" {{ old('document_type', $contract->document_type) == "passport" ? "selected" : "" }}>Passport</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="idState">State</label>
                                <select class="form-control form-control-minimal" id="idState" name="document_state">
                                    <option value="">Select State</option>
                                    @foreach($states as $abbr => $state)
                                        <option value="{{ $abbr }}" {{ old('document_state', $contract->document_state) == $abbr ? 'selected' : '' }}>
                                            {{ $state }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="idNumber">ID Number</label>
                                <input type="text" class="form-control form-control-minimal" id="idNumber"
                                    name="document_number" value="{{ old('document_number', $contract->document_number) }}">
                            </div>
                        </div>

                        <!-- Link Upload -->
                        <div class="text-center mb-5">
                            <h5 class="mb-4">How would you like to receive a link to upload images of the customer's ID?
                            </h5>

                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-4">
                                    <label for="sendLinkVia">Send Link via</label>
                                    <select class="form-control form-control-minimal" id="sendLinkVia" name="link_via">
                                        <option value="">Select method</option>
                                        <option value="phone" {{ old('link_via') == 'phone' ? 'selected' : '' }}>Phone
                                        </option>
                                        <option value="email" {{ old('link_via') == 'email' ? 'selected' : '' }}>Email
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="customPhone" id="contactLabel">Please enter phone</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text border-0 bg-light"><i
                                                    class="flag-icon flag-icon-us"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-minimal" id="contactValue"
                                            name="contact_value" placeholder="Enter contact information">
                                        <div class="input-group-append">
                                            <button type="button" id="sendLinkBtn" class="btn btn-info text-white">Send
                                                Link</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Counter -->
                        <div class="text-center mb-3">
                            <div class="badge badge-primary p-2" id="uploadCounter">{{ $contractDocumentsCount ?? 0 }}/3
                                uploaded</div>
                        </div>

                        <!-- Image Upload -->
                        <div class="form-row justify-content-center mb-5">
                            @php
                                $uploads = [
                                    ['id' => 'idFront', 'label' => 'I.D. Front', 'key' => 'id_front'],
                                    ['id' => 'idBack', 'label' => 'I.D. Back', 'key' => 'id_back'],
                                    ['id' => 'customerPhoto', 'label' => 'Customer', 'key' => 'customer']
                                ];
                            @endphp

                            @foreach($uploads as $upload)
                                <div class="form-group col-md-4 text-center">
                                    <div class="image-upload-box" id="{{ $upload['id'] }}Box"
                                        onclick="document.getElementById('{{ $upload['id'] }}').click()">
                                        <i class="fas fa-camera"
                                            style="{{ isset($contractDocuments[$upload['key']]) && $contractDocuments[$upload['key']] ? 'display:none;' : '' }}"></i>
                                        @if(isset($contractDocuments[$upload['key']]) && $contractDocuments[$upload['key']])
                                            <img src="{{ asset($contractDocuments[$upload['key']]) }}" class="img-preview">
                                        @else
                                            <img src="" class="img-preview d-none">
                                        @endif
                                        <input type="file" id="{{ $upload['id'] }}" name="{{ $upload['key'] }}" class="d-none"
                                            accept="image/*">
                                    </div>
                                    <div class="image-upload-label mt-2">{{ $upload['label'] }}</div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between action-buttons border-top pt-4">
                            <a href="{{ tenant_route('tenant.contract.step2', [$contract->pub_ref]) }}"
                                class="btn btn-outline-secondary">Back</a>
                            <div>
                                <button type="button" class="btn btn-danger mr-2" id="cancelBtn">Cancel & Delete</button>
                                <button type="submit" id="continueBtn" class="btn btn-primary" {{ ($contractDocumentsCount ?? 0) == 3 ? '' : 'disabled' }}>
                                    Continue {{ ($contractDocumentsCount ?? 0) == 3 ? '✓' : '' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Update contact label based on selected method
        document.getElementById('sendLinkVia').addEventListener('change', function () {
            const label = document.getElementById('contactLabel');
            const input = document.getElementById('contactValue');

            if (this.value === 'phone') {
                label.textContent = 'Please enter phone';
                input.placeholder = 'Phone Number';
            } else if (this.value === 'email') {
                label.textContent = 'Please enter email';
                input.placeholder = 'Email Address';
            }
        });

        // Live preview on file selection
        @foreach($uploads as $upload)
            document.getElementById('{{ $upload['id'] }}').addEventListener('change', function (event) {
                const box = document.getElementById('{{ $upload['id'] }}Box');
                const img = box.querySelector('.img-preview');
                const icon = box.querySelector('i');

                if (event.target.files && event.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        img.src = e.target.result;
                        img.classList.remove('d-none');
                        if (icon) icon.style.display = 'none';
                        updateUploadCounter();
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }
            });
        @endforeach

        // Update upload counter
        function updateUploadCounter() {
            const previews = document.querySelectorAll('.img-preview:not(.d-none)');
            const validPreviews = Array.from(previews).filter(img => img.src && img.src !== '');
            const counter = document.getElementById('uploadCounter');
            const continueBtn = document.getElementById('continueBtn');

            counter.textContent = `${validPreviews.length}/3 uploaded`;

            // Enable continue button if all 3 are uploaded
            if (validPreviews.length === 3) {
                continueBtn.disabled = false;
                continueBtn.innerHTML = "Continue ✓";
            } else {
                continueBtn.disabled = true;
                continueBtn.innerHTML = "Continue";
            }

            return validPreviews.length;
        }

        // Initialize upload counter on page load
        document.addEventListener('DOMContentLoaded', function () {
            // Hide icons for already uploaded images
            @foreach($uploads as $upload)
                @if(isset($contractDocuments[$upload['key']]) && $contractDocuments[$upload['key']])
                    const box{{ $upload['id'] }} = document.getElementById('{{ $upload['id'] }}Box');
                    const icon{{ $upload['id'] }} = box{{ $upload['id'] }}.querySelector('i');
                    if (icon{{ $upload['id'] }}) {
                        icon{{ $upload['id'] }}.style.display = 'none';
                    }
                @endif
            @endforeach

            updateUploadCounter();
        });

        // Send link via AJAX
        document.getElementById('sendLinkBtn').addEventListener('click', function () {
            const idType = document.getElementById('idType');
            const idState = document.getElementById('idState');
            const idNumber = document.getElementById('idNumber');
            const sendVia = document.getElementById('sendLinkVia');
            const contactValue = document.getElementById('contactValue');
            const contractId = "{{ $contract->id }}";
            const pubRef = "{{ $contract->pub_ref }}";

            // Validation
            if (!idType.value || !idState.value || !idNumber.value || !sendVia.value || !contactValue.value) {
                alert('Please fill in all ID information and contact details');
                return;
            }

            let data = {
                contract_id: contractId,
                document_type: idType.value,
                document_state: idState.value,
                document_number: idNumber.value,
                via: sendVia.value,
                value: contactValue.value,
            };

            // Disable button to prevent spam
            const sendBtn = this;
            sendBtn.disabled = true;
            sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

            // Send request to backend
            fetch("{{ tenant_route('tenant.contract.documentRequest', [$contract->pub_ref]) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        alert('Upload link sent successfully!');
                        sendBtn.innerHTML = 'Sent ✓';

                        // Start polling for uploaded documents
                        startPollingUploads(contractId);
                    } else {
                        alert('Failed to send link: ' + res.message);
                        sendBtn.disabled = false;
                        sendBtn.innerHTML = 'Send Link';
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Failed to send link");
                    sendBtn.disabled = false;
                    sendBtn.innerHTML = 'Send Link';
                });
        });

        function startPollingUploads(contractId) {
            const interval = setInterval(() => {
                fetch("{{ tenant_route('tenant.contract.checkUploadedDocs', [$contract->pub_ref]) }}?contract_id=" + contractId)
                    .then(res => res.json())
                    .then(res => {
                        if (res.success && res.files) {
                            // Show uploaded images
                            const files = res.files;

                            // Map backend keys to frontend element IDs
                            const keyMap = {
                                'id_front': 'idFront',
                                'id_back': 'idBack',
                                'customer': 'customerPhoto'
                            };

                            // Update each uploaded image
                            Object.entries(files).forEach(([key, url]) => {
                                if (url && keyMap[key]) {
                                    const boxId = keyMap[key];
                                    const box = document.getElementById(boxId + 'Box');
                                    if (box) {
                                        const img = box.querySelector('.img-preview');
                                        const icon = box.querySelector('i');

                                        if (img) {
                                            img.src = url;
                                            img.classList.remove('d-none');
                                        }

                                        if (icon) {
                                            icon.style.display = 'none';
                                        }
                                    }
                                }
                            });

                            // Update the uploaded count
                            const uploadedCount = res.uploaded || 0;
                            const counter = document.getElementById('uploadCounter');
                            counter.textContent = `${uploadedCount}/3 uploaded`;

                            // Enable continue button if all uploaded
                            if (uploadedCount === 3) {
                                clearInterval(interval);
                                const continueBtn = document.getElementById('continueBtn');
                                continueBtn.disabled = false;
                                continueBtn.innerHTML = "Continue ✓";
                            }
                        }
                    })
                    .catch(err => {
                        console.error('Polling error:', err);
                    });
            }, 5000); // 5 seconds
        }

        // Cancel button
        document.getElementById('cancelBtn').addEventListener('click', function () {
            if (confirm('Are you sure you want to cancel and delete this contract?')) {
                window.location.href = "{{ route('tenant.contract.index', request()->route('tenant_domain')) }}";
            }
        });
    </script>
@endpush