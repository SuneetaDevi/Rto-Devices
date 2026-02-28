@extends('tenant.layouts.master')
@section('device_provisioning_active', 'active')
@push('style')
    <style>
        .device-input-card {
            max-width: 500px;
            margin: 0 auto;
        }

        .devices-table {
            border-radius: 0.375rem;
            overflow: hidden;
        }

        .devices-table th {
            background-color: #343a40;
            color: white;
            font-weight: 600;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .action-buttons {
            max-width: 900px;
            margin: 0 auto;
        }

        .btn-action {
            min-width: 120px;
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid py-4">
                {{-- Page Header --}}
                <div class="row mb-5">
                    <div class="col-12">
                        <h2 class="h3 font-weight-light text-center text-muted">
                            Select device type, then enter the IMEI and/or Serial Number, then click ADD.
                        </h2>
                    </div>
                </div>

                {{-- Device Input Form --}}
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="card device-input-card">
                            <div class="card-body">
                                <form id="deviceForm">
                                    <div class="form-group">
                                        <label for="deviceType" class="form-label">Device Type</label>
                                        <select class="form-control" id="deviceType" name="device_type" required>
                                            <option value="">Select Device Type</option>
                                            <option value="Android Phone">Android Phone</option>
                                            <option value="iOS Phone">iOS Phone</option>
                                            <option value="Tablet">Tablet</option>
                                            <option value="Hotspot">Hotspot</option>
                                            <option value="Wearable">Wearable</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="imeiInput" class="form-label">
                                            IMEI <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="imeiInput" name="imei" required
                                            placeholder="Enter IMEI number">
                                    </div>

                                    <div class="form-group">
                                        <label for="snInput" class="form-label">Serial Number</label>
                                        <input type="text" class="form-control" id="snInput" name="serial_number"
                                            placeholder="Enter serial number">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block py-2">
                                        <i class="fas fa-plus-circle mr-2"></i>ADD DEVICE
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Devices Table --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card devices-table">
                            <div class="card-body p-0">
                                <table class="table table-hover mb-0" id="deviceTable">
                                    <thead>
                                        <tr>
                                            <th width="100">Action</th>
                                            <th>Device Type</th>
                                            <th>IMEI</th>
                                            <th>Serial #</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="noDataRow">
                                            <td colspan="5" class="text-center text-muted py-4">
                                                No devices added yet.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <form id="submitProvisioningForm" action="{{ tenant_route('tenant.device-provisioning.store') }}"
                    method="POST">
                    @csrf
                    <input type="hidden" name="store" value="Site 1">
                    <input type="hidden" name="devices" id="devicesInput">
                </form>

                {{-- Action Buttons --}}
                <div class="row">
                    <div class="col-12">
                        <div class="action-buttons d-flex justify-content-end gap-3">
                            <button type="button" class="btn btn-success btn-action" id="continueBtn" disabled>
                                <i class="fas fa-paper-plane mr-2"></i>CONTINUE
                            </button>
                            <button type="button" class="btn btn-primary btn-action" id="nextBtn" disabled>
                                NEXT <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let devices = [];
    
        const deviceForm = document.getElementById('deviceForm');
        const deviceTableBody = document.querySelector('#deviceTable tbody');
        const continueBtn = document.getElementById('continueBtn');
        const nextBtn = document.getElementById('nextBtn');

        document.addEventListener('DOMContentLoaded', function () {

    updateActionButtons();

    const imeiInput = document.getElementById('imeiInput');

    if (!imeiInput) return;

    function isValidImei(imei) {
        if (!/^\d{15}$/.test(imei)) return false;

        let sum = 0;

        for (let i = 0; i < imei.length; i++) {
            let digit = parseInt(imei.charAt(i));

            if ((imei.length - i) % 2 === 0) {
                digit *= 2;
                if (digit > 9) digit -= 9;
            }

            sum += digit;
        }

        return sum % 10 === 0;
    }

    imeiInput.addEventListener('input', function () {
        const imei = imeiInput.value.trim();

        if (imei.length === 0) {
            imeiInput.style.border = "";
            return;
        }

        if (isValidImei(imei)) {
            imeiInput.style.border = "2px solid green";
        } else {
            imeiInput.style.border = "2px solid red";
        }
    });

});



        deviceForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const deviceType = document.getElementById('deviceType').value;
            const imei = document.getElementById('imeiInput').value.trim();
            const serial = document.getElementById('snInput').value.trim();



            if (!deviceType || !imei) {
                alert('Please fill in all required fields (Device Type and IMEI).');
                return;
            }

            if (!isValidIMEI(imei)) {
                alert('Please enter a valid IMEI number (15-16 digits).');
                return;
            }

            if (isDuplicateIMEI(imei)) {
                alert('This IMEI has already been added.');
                return;
            }

            const device = {
                id: Date.now(),
                deviceType: deviceType,
                imei: imei,
                serialNumber: serial,
                status: 'Pending Verification',
                timestamp: new Date().toISOString()
            };

            devices.push(device);
            updateDevicesTable();
            deviceForm.reset();
            updateActionButtons();
        });

        function updateDevicesTable() {
        deviceTableBody.innerHTML = '';

        if (devices.length === 0) {
            deviceTableBody.innerHTML = `
                <tr id="noDataRow">
                    <td colspan="5" class="text-center text-muted py-4">
                        No devices added yet.
                    </td>
                </tr>
            `;
            return;
        }

        devices.forEach(device => {
            const tr = document.createElement('tr');

            tr.innerHTML = `
                <td>
                    <button class="btn btn-sm btn-outline-primary me-1"
                            onclick="editDevice(${device.id})">
                        <i class="far fa-edit"></i>
                    </button>

                    <button class="btn btn-sm btn-outline-danger"
                            onclick="deleteDevice(${device.id})">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </td>

                <td>${device.deviceType}</td>
                <td>${device.imei}</td>
                <td>${device.serialNumber || '--'}</td>
                <td>
                    <span class="status-badge status-pending">
                        ${device.status}
                    </span>
                </td>
            `;

            deviceTableBody.appendChild(tr);
        });
    }


        function deleteDevice(deviceId) {
            if (!confirm('Remove this device?')) return;

            devices = devices.filter(d => d.id !== deviceId);
            updateDevicesTable();
            updateActionButtons();
        }



        function editDevice(deviceId) {
            const device = devices.find(d => d.id === deviceId);
            if (!device) return;

            document.getElementById('deviceType').value = device.deviceType;
            document.getElementById('imeiInput').value = device.imei;
            document.getElementById('snInput').value = device.serialNumber;

            // Remove old record
            devices = devices.filter(d => d.id !== deviceId);

            updateDevicesTable();
            updateActionButtons();
        }


        function updateActionButtons() {
            const hasDevices = devices.length > 0;
            continueBtn.disabled = !hasDevices;
            nextBtn.disabled = !hasDevices;
        }

        function isValidIMEI(imei) {
            const imeiRegex = /^\d{15,16}$/;
            return imeiRegex.test(imei);
        }

        function isDuplicateIMEI(imei) {
            return devices.some(device => device.imei === imei);
        }

        continueBtn.addEventListener('click', function () {
            if (devices.length === 0) return;

            continueBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>PROCESSING...';
            continueBtn.disabled = true;

            // Put devices array into hidden input
            document.getElementById('devicesInput').value = JSON.stringify(devices);
            sessionStorage.removeItem('provisioningDevices');

            // Submit to Laravel
            document.getElementById('submitProvisioningForm').submit();
        });


        nextBtn.addEventListener('click', function () {
            if (devices.length === 0) return;

            sessionStorage.setItem('provisioningDevices', JSON.stringify(devices));
            // window.location.href = '/provisioning/verify';
            // window.location.href = "{{ tenant_route('tenant.device.verify', ['batch' => '__BATCH__']) }}".replace('__BATCH__', batchId);
        });

        window.addEventListener('load', function () {
            const savedDevices = sessionStorage.getItem('provisioningDevices');
            if (savedDevices) {
                devices = JSON.parse(savedDevices);
                updateDevicesTable();
                updateActionButtons();
            }
        });
    </script>
@endpush