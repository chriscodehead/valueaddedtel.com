<div class="modal fade" id="deleteHistoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Are you Sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to proceed to delete this record?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                <form id="delete-history-form" action="{{ route('delete-history', '') }}" method="POST">
                    @csrf
                    @method('GET')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript code to display popup modal for confirm delete -->
<script>
    function showDeleteHistoryModal(id) {
        $('#delete-history-form').attr('action', '{{ route("delete-history", "") }}/' + id);
        $('#deleteHistoryModal').modal('show');
    }

    function submitForm() {
        $('#delete-history-form').submit();
    }
</script>