<!-- Edit Modal -->
<div class="modal fade edit-modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <div id="inputContainer">
                            <!-- Dynamic input will be inserted here -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="saveChanges()">Save Changes</button>
            </div>
        </div>
    </div>
</div>


<!-- Photo Modal -->
<!-- Photo Upload Modal -->
<div class="modal fade" id="photoUploadModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Customer Photos</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="form-row justify-content-center mb-4">

                    @php
                        $uploads = [
                            ['id' => 'idFront', 'label' => 'I.D. Front', 'image' => $contract->id_front ?? null],
                            ['id' => 'idBack', 'label' => 'I.D. Back', 'image' => $contract->id_back ?? null],
                            ['id' => 'customerPhoto', 'label' => 'Customer', 'image' => $contract->customer_photo ?? null],
                        ];
                    @endphp

                    @foreach($uploads as $upload)
                        <div class="form-group col-md-4 text-center">

                            <div class="image-upload-box" onclick="document.getElementById('{{ $upload['id'] }}').click()">

                                @if($upload['image'])
                                    <img src="{{ asset($upload['image']) }}" id="{{ $upload['id'] }}Preview"
                                        class="preview-image">
                                @else
                                    <i class="fas fa-camera" id="{{ $upload['id'] }}Preview"></i>
                                @endif

                                <input type="file" id="{{ $upload['id'] }}" class="d-none" accept="image/*"
                                    onchange="previewImage(event, '{{ $upload['id'] }}Preview')">
                            </div>

                            <div class="image-upload-label">{{ $upload['label'] }}</div>
                        </div>
                    @endforeach

                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button class="btn btn-primary btn-sm">Save Changes</button>
            </div>

        </div>
    </div>
</div>