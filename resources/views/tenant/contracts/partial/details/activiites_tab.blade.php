<!-- ACTIVITIES Tab -->
<div class="tab-pane fade" id="activities" role="tabpanel" aria-labelledby="activities-tab">
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <!-- Header -->
            <div class="activities-header px-3 py-2 d-flex justify-content-between align-items-center border-bottom">
                <span class="activities-title font-weight-bold">Activities</span>
                <div class="activities-actions">
                    <i class="fas fa-search mr-2"></i>
                    <i class="fas fa-print mr-2"></i>
                    <i class="fas fa-filter mr-3"></i>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addActivityModal">
                        <i class="fas fa-plus mr-1"></i> Add Activity
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped mb-0" id="activitiesTable">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 80px;">Actions</th>
                            <th>Type</th>
                            <th>Assigned To</th>
                            <th>Description</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="noDataRow">
                            <td colspan="5" class="text-center py-5 text-muted">Sorry, no matching records found</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right p-2 border-top">
                                <small class="text-muted mr-3">Rows per page: 10</small>
                                <small class="text-muted mr-3" id="rowCount">0-0 of 0</small>
                                <i class="fas fa-chevron-left text-muted mr-2"></i>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Activity Modal -->
<div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="addActivityModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="addActivityForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addActivityModalLabel">Add Activity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="editRowIndex" value="">
                <div class="form-group">
                    <label for="activityType">Type</label>
                    <input type="text" class="form-control" id="activityType" placeholder="Enter activity type"
                        required>
                </div>
                <div class="form-group">
                    <label for="assignedTo">Assigned To</label>
                    <input type="text" class="form-control" id="assignedTo" placeholder="Enter assignee" required>
                </div>
                <div class="form-group">
                    <label for="activityDescription">Description</label>
                    <textarea class="form-control" id="activityDescription" rows="3" placeholder="Enter description"
                        required></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Activity</button>
            </div>
        </form>
    </div>
</div>

@push('script')
    <script>
        const activitiesTableBody = document.querySelector('#activitiesTable tbody');
        const rowCountLabel = document.getElementById('rowCount');
        let editRow = null;

        function updateRowCount() {
            const totalRows = activitiesTableBody.querySelectorAll('tr').length;
            rowCountLabel.textContent = `1-${totalRows} of ${totalRows}`;
        }

        function createActionButtons(row) {
            // Clear any existing content in the first cell
            const actionCell = row.children[0];
            actionCell.innerHTML = '';

            // Create a container for buttons
            const btnContainer = document.createElement('div');
            btnContainer.className = 'd-inline-flex'; // Inline flex to keep buttons in same line

            // Edit button
            const editBtn = document.createElement('button');
            editBtn.className = 'btn btn-sm btn-link text-primary mr-1 p-0';
            editBtn.innerHTML = '<i class="fas fa-pen"></i>';
            editBtn.addEventListener('click', () => {
                editRow = row;
                document.getElementById('activityType').value = row.children[1].textContent;
                document.getElementById('assignedTo').value = row.children[2].textContent;
                document.getElementById('activityDescription').value = row.children[3].textContent;
                $('#addActivityModal').modal('show');
            });

            // Delete button
            const deleteBtn = document.createElement('button');
            deleteBtn.className = 'btn btn-sm btn-link text-danger p-0';
            deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
            deleteBtn.addEventListener('click', () => {
                row.remove();
                updateRowCount();
                if (activitiesTableBody.querySelectorAll('tr').length === 0) {
                    activitiesTableBody.innerHTML = `<tr id="noDataRow">
                        <td colspan="5" class="text-center py-5 text-muted">Sorry, no matching records found</td>
                    </tr>`;
                } else {
                    updateRowCount();
                }
            });

            // Append buttons to container
            btnContainer.appendChild(editBtn);
            btnContainer.appendChild(deleteBtn);

            // Append container to action cell
            actionCell.appendChild(btnContainer);
        }

        document.getElementById('addActivityForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const type = document.getElementById('activityType').value;
            const assignedTo = document.getElementById('assignedTo').value;
            const description = document.getElementById('activityDescription').value;
            const createdAt = new Date().toLocaleString();

            if (editRow) {
                // Update existing row
                editRow.children[1].textContent = type;
                editRow.children[2].textContent = assignedTo;
                editRow.children[3].textContent = description;
                editRow.children[4].textContent = createdAt;
                editRow = null;
            } else {
                // Remove no data row if exists
                const noDataRow = document.getElementById('noDataRow');
                if (noDataRow) noDataRow.remove();

                const tr = document.createElement('tr');
                tr.innerHTML = `
                            <td></td>
                            <td>${type}</td>
                            <td>${assignedTo}</td>
                            <td>${description}</td>
                            <td>${createdAt}</td>
                        `;
                activitiesTableBody.appendChild(tr);
                createActionButtons(tr);
            }

            updateRowCount();
            this.reset();
            $('#addActivityModal').modal('hide');
        });
    </script>
@endpush