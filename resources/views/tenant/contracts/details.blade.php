@extends('tenant.layouts.master')
@section('contract_active', 'active')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/cratract_details.css') }}">
    <style>
        .full-width-line {
            border-bottom: 2px solid white;
        }
    </style>
@endpush



@section('content')
    <div class="content-wrapper">
        <div class="container-fluid contract-view-container">
            <!-- Contract Header -->
            <div class="contract-header mb-3">
                <h1>Contract: {{ $contract->pub_ref }}</h1>
                <p class="store-info">STORE: {{ $contract->stores->store_name }}</p>
                <span class="badge badge-secondary">{{ strtoupper($contract->contract_type) }}</span>
            </div>

            <!-- Contract Details -->
            <div class="contract-details-grid">
                {{-- Left Column --}}
                <div class="left-column">
                    {{-- Customer Information Section --}}
                    <div class="section-block">
                        <div class="customer-info-header editable-field">
                            <div class="customer-avatar" onclick="openPhotoModal()"><i class="fas fa-user"></i></div>
                            <h2 class="customer-name" id="customerName">
                                {{ $contract->customer->last_name ?? 'HARLOW' }},
                                {{ $contract->customer->first_name ?? 'DAVID' }}
                            </h2>
                            <i class="fas fa-pen edit-icon" data-field-id="Customer Name"
                                data-fields='["firstName","lastName"]' data-labels='["First Name","Last Name"]'
                                data-types='["text","text"]'
                                data-values='["{{ $contract->customer->first_name ?? "DAVID" }}","{{ $contract->customer->last_name ?? "HARLOW" }}"]'
                                onclick="openEditModal(this)"></i>
                        </div>
                        <div class="section-divider"></div>
                        <ul class="info-list">
                            <li class="editable-field">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="info-label">Address:</span>
                                <span class="info-value" id="customerAddress">
                                    {{ $contract->customer->address ?? '45 N MAIN ST BRISTOL, CT 06010' }}
                                </span>
                                <i class="fas fa-pen edit-icon" data-field-id="Customer Address"
                                    data-fields='["addr1","addr2","city","state","zip"]'
                                    data-labels='["Address Line 1","Address Line 2","City","State","Zip"]'
                                    data-types='["text","text","text","text","text"]'
                                    data-values='["{{ $contract->customer->street ?? "45 N MAIN ST" }}","{{ $contract->customer->suite ?? "" }}","{{ $contract->customer->city ?? "BRISTOL" }}","{{ $contract->customer->state ?? "CT" }}","{{ $contract->customer->zip ?? "06010" }}"]'
                                    onclick="openEditModal(this)"></i>
                            </li>
                            <li class="editable-field">
                                <i class="far fa-calendar-alt"></i>
                                <span class="info-label">DOB:</span>
                                <span class="info-value" id="customerDOB">
                                    {{ isset($contract->customer->dob) ? \Carbon\Carbon::parse($contract->customer->dob)->format('m/d/Y') : '05/23/1993' }}
                                </span>
                                <i class="fas fa-pen edit-icon" data-field-id="Customer DOB" data-fields='["dob"]'
                                    data-labels='["Date of Birth"]' data-types='["date"]'
                                    data-values='["{{ isset($contract->customer->dob) ? \Carbon\Carbon::parse($contract->customer->dob)->format("Y-m-d") : "1993-05-23" }}"]'
                                    onclick="openEditModal(this)"></i>
                            </li>
                            <li class="editable-field">
                                <i class="fas fa-id-card"></i>
                                <span class="info-label">SSN (Last 4):</span>
                                <span class="info-value" id="customerSSN">
                                    {{ isset($contract->customer->ssn) ? substr($contract->customer->ssn, -4) : '8001' }}
                                </span>
                                <i class="fas fa-pen edit-icon" data-field-id="Customer SSN" data-fields='["ssn4"]'
                                    data-labels='["SSN (Last 4)"]' data-types='["text"]'
                                    data-values='["{{ isset($contract->customer->ssn) ? substr($contract->customer->ssn, -4) : "8001" }}"]'
                                    onclick="openEditModal(this)"></i>
                            </li>
                            <li class="editable-field">
                                <i class="fas fa-envelope"></i>
                                <span class="info-label">Email:</span>
                                <span class="info-value" id="customerEmail">
                                    {{ $contract->customer->email ?? 'DAVIDHARLOWB@GMAIL.COM' }}
                                </span>
                                <i class="fas fa-pen edit-icon" data-field-id="Customer Email" data-fields='["email"]'
                                    data-labels='["Email"]' data-types='["email"]'
                                    data-values='["{{ $contract->customer->email ?? "DAVIDHARLOWB@GMAIL.COM" }}"]'
                                    onclick="openEditModal(this)"></i>
                            </li>
                            <li class="editable-field">
                                <i class="fas fa-phone"></i>
                                <span class="info-label">Phone:</span>
                                <span class="info-value" id="customerPhone">
                                    {{ $contract->customer->phone ?? '(860) 750-3870' }}
                                </span>
                                <i class="fas fa-pen edit-icon" data-field-id="Customer Phone" data-fields='["phone1"]'
                                    data-labels='["Phone"]' data-types='["tel"]'
                                    data-values='["{{ $contract->customer->phone ?? "(860) 750-3870" }}"]'
                                    onclick="openEditModal(this)"></i>
                            </li>
                            <li class="editable-field">
                                <i class="fas fa-mobile-alt"></i>
                                <span class="info-label">Phone 2:</span>
                                <span class="info-value" id="customerPhone2">
                                    {{ $contract->customer->phone2 ?? '--' }}
                                </span>
                                <i class="fas fa-pen edit-icon" data-field-id="Customer Phone2" data-fields='["phone2"]'
                                    data-labels='["Phone 2"]' data-types='["tel"]'
                                    data-values='["{{ $contract->customer->phone2 ?? "" }}"]'
                                    onclick="openEditModal(this)"></i>
                            </li>
                        </ul>
                    </div>

                    {{-- Device Information Section --}}
                    <div class="section-block">
                        <div class="section-divider"></div>
                        <ul class="info-list full-width device-details">
                            <li><span class="info-label">Device:</span> <span
                                    class="info-value">{{ $contract->device_model ?? 'MOTOROLA motorola razr plus 2023' }}</span>
                            </li>
                            <li><span class="info-label">Serial Number:</span> <span
                                    class="info-value">{{ $contract->imei_serial ?? '21ZCPNFWVU' }}</span></li>
                            <li><span class="info-label">MDN 1:</span> <span
                                    class="info-value">{{ $contract->mdn1 ?? '1956387815' }}</span></li>
                            <li><span class="info-label">IMEI 1:</span> <span
                                    class="info-value">{{ $contract->imei1 ?? '35023377443373' }}</span></li>
                            <li><span class="info-label">SERIAL #:</span> <span
                                    class="info-value">{{ $contract->serial_number ?? '21ZCPNFWVU' }}</span></li>
                            <li><span class="info-label">SIM #:</span> <span
                                    class="info-value">{{ $contract->sim_number ?? '8602610731W0' }}</span></li>
                            <li><span class="info-label">Guarantee Status:</span> <span
                                    class="info-value">{{ $contract->guarantee_status ?? 'Disabled' }}</span></li>
                            <li><span class="info-label">Device Memory:</span> <span
                                    class="info-value">{{ $contract->device_memory ?? '257 GB' }}</span></li>
                            <li><span class="info-label">Lock Status:</span> <span
                                    class="info-value status-active-unlocked">{{ $contract->lock_status ?? 'Active - Unlocked' }}</span>
                            </li>
                            <li><span class="info-label">DCS ID:</span> <span
                                    class="info-value">{{ $contract->dcs_id ?? 'Aeris MT-FMG-eY5130-9dbb170081' }}</span>
                            </li>
                            <li><span class="info-label">Lock Date:</span> <span
                                    class="info-value date-text">{{ $contract->lock_date ?? 'Tuesday, November 04, 2023 9:00 AM' }}</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Merchandise Condition Section --}}
                    <div class="section-block">
                        <div class="section-divider"></div>
                        <ul class="info-list full-width">
                            <li class="editable-field">
                                <i class="fas fa-hand-sparkles"></i>
                                <span class="info-label">Merchandise Condition:</span>
                                <span class="info-value"
                                    id="merchandiseCondition">{{ $contract->merchandise_condition ?? 'Used' }}</span>
                                <i class="fas fa-pen edit-icon" data-field-id="Merchandise Condition"
                                    data-fields='["condition"]' data-labels='["Condition"]' data-types='["select"]'
                                    data-values='["{{ $contract->merchandise_condition ?? "Used" }}"]'
                                    data-options='["New","Used","Refurbished","Damaged"]' onclick="openEditModal(this)"></i>
                            </li>
                            <li class="editable-field">
                                <i class="fas fa-info-circle"></i>
                                <span class="info-label">Merchandise Description:</span>
                                <span class="info-value"
                                    id="merchandiseDescription">{{ $contract->merchandise_description ?? 'MOTOROLA MOTOROLA RAZR PLUS 2023 GSM 21ZCPNFWVU IMEI 35023377443373' }}</span>
                                <i class="fas fa-pen edit-icon" data-field-id="Merchandise Description"
                                    data-fields='["description"]' data-labels='["Description"]' data-types='["textarea"]'
                                    data-values='["{{ $contract->merchandise_description ?? "MOTOROLA MOTOROLA RAZR PLUS 2023 GSM 21ZCPNFWVU IMEI 35023377443373" }}"]'
                                    onclick="openEditModal(this)"></i>
                            </li>
                        </ul>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="section-divider"></div>
                    <div class="action-buttons">
                        <button class="btn btn-outline-danger btn-sm"><i class="fas fa-times-circle mr-1"></i> Cancel
                            Contract</button>
                        <button class="btn btn-outline-primary btn-sm" id="rescheduleButton"><i
                                class="fas fa-calendar mr-1"></i>
                            Reschedule</button>
                    </div>
                </div>

                {{-- Right Column (Billing Info) --}}
                <div class="right-column">
                    <div class="billing-title-row d-flex justify-content-between align-items-center mb-3">
                        <h2 class="billing-title">Billing Info</h2>
                    </div>

                    <div class="row">

                        <div class="col-6">
                            <div class="billing-details-grid">

                                <span class="label">Contract Start Date:</span>
                                <span
                                    class="value">{{ isset($contract->first_payment_date) ? \Carbon\Carbon::parse($contract->first_payment_date)->format('m/d/Y') : '07/16/2025' }}</span>

                                <span class="label">Retail Value:</span>
                                <span class="value">${{ number_format($contract->retail_value, 2) }}</span>

                                <span class="label">Down Payment:</span>
                                <span class="value">${{ number_format($contract->down_payment, 2) }}</span>

                                <span class="label">Org Contract Amount:</span>
                                <span class="value">${{ number_format($contract->total_contract_value, 2) }}</span>

                                <span class="label">Reschedule Fees:</span>
                                <span class="value">${{ number_format($contract->reschedule_fees, 2) }}</span>

                                <span class="label">Total Contract Value:</span>
                                <span
                                    class="value">${{ number_format(($contract->total_contract_value ?? 0) + ($contract->down_payment ?? 0) + ($contract->reschedule_fees ?? 0), 2) }}</span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="billing-details-grid">

                                <span class="label">Billing Status:</span>
                                <span class="value">{{ $contract->status ?? 'Active' }}</span>

                                <span class="label">Rental Factor:</span>
                                <span class="value">{{ $contract->rental_factor ?? '2.50' }}</span>

                                <span class="label">Lease Type:</span>
                                <span class="value">{{ ucfirst($contract->payment_frequency) ?? 'Biweekly' }}</span>

                                <span class="label">Term:</span>
                                <span class="value">{{ $contract->lease_term_string ?? '36 Months' }}</span>

                                <span class="label">Type:</span>
                                <span class="value">{{ ucfirst($contract->contract_type) ?? 'Lock' }}</span>

                                <span class="label">Payments Collected:</span>
                                <span class="value">${{ number_format($contract->paid_till_now, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="full-width-line my-3"></div>
                    <div class="row">

                        <div class="col-6">
                            <div class="billing-details-grid">

                                <span class="label highlight-value">Outstanding Balance:</span>
                                <span class="value highlight-value">${{ number_format($contract->payment_left, 2)  }}</span>

                                <span class="label">
                                    Contract Cost:
                                    <i class="fas fa-pen" style="padding-left:20px;cursor:pointer;"
                                        data-field-id="Contract Cost" data-fields='["contractCost"]'
                                        data-labels='["Contract Cost"]' data-types='["number"]'
                                        data-values='["{{ $contract->contract_cost ?? 0.00 }}"]'
                                        onclick="openEditModal(this)"></i>
                                </span>
                                <span class="value"
                                    id="contractCost">${{ number_format($contract->contract_cost ?? 0.00, 2) }}</span>

                                <span class="label">Back Market Cost:</span>
                                <span class="value">${{ number_format($contract->back_market_cost ?? 362.00, 2) }}</span>

                                <span class="label editable-field">
                                    POS Inv #:
                                    <i class="fas fa-pen" style="padding-left:20px;cursor:pointer;" data-field-id="Pos Inv"
                                        data-fields='["posInv"]' data-labels='["POS Inv #"]' data-types='["text"]'
                                        data-values='["{{ $contract->pos_inv ?? "--" }}"]'
                                        onclick="openEditModal(this)"></i>
                                </span>
                                <span class="value" id="posInv">{{ $contract->pos_inv ?? '--' }}</span>


                            </div>
                        </div>

                        <div class="col-6">
                            <div class="billing-details-grid">

                                <span class="label">Next Amount Due:</span>
                                <span class="value">${{ number_format($contract->next_due_amount ?? 20.39, 2) }}</span>

                                <span class="label">Next Due Date:</span>
                                <span
                                    class="value">{{ isset($contract->next_due_date) ? \Carbon\Carbon::parse($contract->next_due_date)->format('m/d/Y') : '11/21/2025' }}</span>
                                <span class="label">Early Payoff Option:</span>
                                <span class="value">{{ $contract->early_payoff_policy ?? '90 EPO' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Tabs Section -->
            <div class="contract-tabs">
                <ul class="nav nav-tabs" id="contractTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="make-payment-tab" data-toggle="tab" href="#make-payment" role="tab"
                            aria-controls="make-payment" aria-selected="true">
                            <i class="fas fa-credit-card mr-1"></i> MAKE PAYMENT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="abp-management-tab" data-toggle="tab" href="#abp-management" role="tab"
                            aria-controls="abp-management" aria-selected="false">
                            <i class="fas fa-cog mr-1"></i> ABP MANAGEMENT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="journal-tab" data-toggle="tab" href="#journal" role="tab"
                            aria-controls="journal" aria-selected="false">
                            <i class="fas fa-book mr-1"></i> JOURNAL
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="activities-tab" data-toggle="tab" href="#activities" role="tab"
                            aria-controls="activities" aria-selected="false">
                            <i class="fas fa-tasks mr-1"></i> ACTIVITIES
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="contractTabsContent">
                    <!-- MAKE PAYMENT Tab -->
                    @include('tenant.contracts.partial.details.payment_tab')
                    @include('tenant.contracts.partial.details.abp_management_tab')
                    @include('tenant.contracts.partial.details.journal_tab')
                    @include('tenant.contracts.partial.details.activiites_tab')
                </div>
            </div>
        </div>
    </div>



    @include('tenant.contracts.partial.details.modals')
    @include('tenant.contracts.partial.details.reschedule_modals')


@endsection

@push('script')

    <script>
        let currentFieldId = '';
        let currentConfig = null; // stores {fieldId, fields[], labels[], types[], options[]}
        // Example jQuery/JavaScript logic for Modal 2 selection
        $(document).ready(function () {
            $('input[name="leaseTermOption"]').on('change', function () {
                const selectedOption = $(this).parent().find('span:first').text().replace(':', '');
                const pmt = $(this).data('pmt');
                const interest = $(this).data('interest');

                $('#selectedTerm').text(selectedOption);
                $('#selectedPMT').text('$' + pmt);
                $('#selectedInterest').text('$' + interest);
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const button = document.getElementById('rescheduleButton');
            const modalElement = document.getElementById('rescheduleContractModal');

            if (button && modalElement) {
                // Create a Bootstrap Modal instance
                const rescheduleModal = new bootstrap.Modal(modalElement);

                button.addEventListener('click', function () {
                    // Logic can go here (e.g., fetch the latest contract balance)

                    // Show the modal
                    rescheduleModal.show();
                });
            }
        });










        function openPhotoModal() {
            $('#photoUploadModal').modal('show');
        }

        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = () => {
                const previewEl = document.getElementById(previewId);
                previewEl.outerHTML = `<img src="${reader.result}" class="preview-image" id="${previewId}">`;
            };
            reader.readAsDataURL(event.target.files[0]);
        }


        function openEditModal(elem) {
            // elem is the <i> icon
            const fieldId = elem.dataset.fieldId;
            const fields = JSON.parse(elem.dataset.fields || '[]');
            const labels = JSON.parse(elem.dataset.labels || '[]');
            const types = JSON.parse(elem.dataset.types || '[]');
            const values = JSON.parse(elem.dataset.values || '[]');
            const options = elem.dataset.options ? JSON.parse(elem.dataset.options) : [];

            currentFieldId = fieldId;
            currentConfig = { fieldId, fields, labels, types, options };

            // If values not provided, try to infer from DOM
            const populatedValues = values.length ? values.slice() : inferValuesFromDOM(fieldId, fields);

            // Set modal title
            const modal = $('#editModal');
            document.getElementById('editModalLabel').textContent = `Edit ${fieldId}`;
            // document.getElementById('fieldLabel').textContent = labels.length ? labels.join(' / ') : fieldId;

            const container = document.getElementById('inputContainer');
            container.innerHTML = '';

            // Build inputs
            fields.forEach((f, idx) => {
                const label = labels[idx] || f;
                const type = types[idx] || 'text';
                const val = populatedValues[idx] !== undefined ? populatedValues[idx] : '';

                let inputHtml = '';

                if (type === 'textarea') {
                    inputHtml = `<label>${escapeHtml(label)}</label><textarea class="form-control mb-2" id="edit_${escapeHtml(f)}" rows="3">${escapeHtml(val)}</textarea>`;
                } else if (type === 'select') {
                    const opts = options.length ? options : [];
                    let optsHtml = '';
                    opts.forEach(opt => {
                        const sel = (opt == val) ? 'selected' : '';
                        optsHtml += `<option value="${escapeHtml(opt)}" ${sel}>${escapeHtml(opt)}</option>`;
                    });
                    inputHtml = `<label>${escapeHtml(label)}</label><select class="form-control mb-2" id="edit_${escapeHtml(f)}">${optsHtml}</select>`;
                } else {
                    // normal input, including date, email, tel, number
                    let inputType = type;
                    if (!['text', 'email', 'tel', 'number', 'date'].includes(inputType)) inputType = 'text';
                    inputHtml = `<label>${escapeHtml(label)}</label><input type="${escapeHtml(inputType)}" class="form-control mb-2" id="edit_${escapeHtml(f)}" value="${escapeHtml(val)}">`;
                }

                container.insertAdjacentHTML('beforeend', inputHtml);
            });

            modal.modal('show');

            // focus first input
            setTimeout(() => {
                const first = container.querySelector('input, textarea, select');
                if (first) first.focus();
            }, 250);
        }

        function saveChanges() {
            if (!currentConfig) return;
            const { fieldId, fields, types } = currentConfig;

            // collect values
            const collected = fields.map((f, idx) => {
                const el = document.getElementById('edit_' + f);
                return el ? el.value.trim() : '';
            });

            // Special formatting for known fields
            if (fieldId === 'customerName') {
                const first = collected[0] || '';
                const last = collected[1] || '';
                document.getElementById(fieldId).textContent = `${last.toUpperCase()}, ${first.toUpperCase()}`.trim();
                showToast('Name updated');
            } else if (fieldId === 'customerAddress') {
                const [a1, a2, city, state, zip] = collected;
                let full = a1 || '';
                if (a2) full += ` ${a2}`;
                if (city) full += ` ${city}`;
                if (state || zip) full += `, ${state || ''} ${zip || ''}`.trim();
                document.getElementById(fieldId).textContent = full.trim();
                showToast('Address updated');
            } else {
                // For single-field fields, just display the first (or joined values)
                let newText = '';
                if (fields.length === 1) newText = collected[0];
                else newText = collected.join(' ');

                // If field looks like currency (number type and original had $), keep $ formatting
                const displayEl = document.getElementById(fieldId);
                if (displayEl) {
                    // If original had $ and type is number, format
                    if (types && types[0] === 'number') {
                        // try numeric
                        const n = parseFloat(collected[0]);
                        if (!isNaN(n)) newText = `$${n.toFixed(2)}`;
                    }

                    displayEl.textContent = newText;
                }

                showToast('Field updated');
            }

            // hide modal
            $('#editModal').modal('hide');
            currentConfig = null;
            currentFieldId = '';
        }

        function inferValuesFromDOM(fieldId, fields) {
            // fallback when data-values not provided
            if (fieldId === 'customerName') {
                const txt = document.getElementById(fieldId).textContent.trim();
                const parts = txt.split(',').map(s => s.trim());
                return [parts[1] || '', parts[0] || '']; // first, last
            }

            if (fieldId === 'customerAddress') {
                const txt = document.getElementById(fieldId).textContent.trim();
                // try to parse: addr1 [addr2] CITY, ST ZIP
                const regex = /^(.*?)\s+(.*?),\s+([A-Z]{2})\s+(\d{5})$/;
                const match = txt.match(regex);
                if (match) {
                    // match[1] may contain addr1 (and maybe addr2 + city?), simple split by last space before city
                    // As fallback put whole prefix into addr1
                    const prefix = match[1];
                    return [prefix, '', match[2], match[3], match[4]];
                }
                return [txt, '', '', '', ''];
            }

            // generic: try read values from sibling elements or innerText
            const el = document.getElementById(fieldId);
            if (!el) return fields.map(() => '');
            const text = el.textContent.trim();
            if (fields.length === 1) return [text];
            // split by comma or pipe or space
            const parts = text.split(/[,|]\s*|\s{2,}/).map(s => s.trim()).filter(Boolean);
            // fill
            const out = [];
            for (let i = 0; i < fields.length; i++) out.push(parts[i] || '');
            return out;
        }

        function formatDateForInput(dateString) {
            // Convert MM/DD/YYYY to YYYY-MM-DD for date input
            if (!dateString) return '';
            if (dateString.includes('/')) {
                const parts = dateString.split('/');
                return `${parts[2]}-${parts[0].padStart(2, '0')}-${parts[1].padStart(2, '0')}`;
            }
            // try parse ISO
            return dateString;
        }

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'alert alert-success alert-dismissible fade show position-fixed';
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 250px;';
            toast.innerHTML = `\n                ${escapeHtml(message)}\n                <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n                    <span aria-hidden="true">&times;</span>\n                </button>\n            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        // simple HTML-escape to avoid XSS in inserted HTML
        function escapeHtml(str) {
            if (str === null || str === undefined) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
        }

        // Wire Enter key inside modal to save
        document.addEventListener('keydown', function (e) {
            const modalOpen = document.querySelector('#editModal.show');
            if (modalOpen && e.key === 'Enter') {
                const active = document.activeElement;
                // avoid submitting when focused on textarea
                if (active && active.tagName.toLowerCase() === 'textarea') return;
                e.preventDefault();
                saveChanges();
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            // nothing else for now
        });
    </script>
@endpush