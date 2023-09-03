<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Are you Sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to proceed to delete this transaction record?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No, Cancel</button>
                <form id="delete-form" action="{{ route('delete-transaction', '') }}" method="POST">
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
    function showModal(description, id) {
        $('#transaction-purpose').text(description);
        $('#delete-form').attr('action', '{{ route("delete-transaction", "") }}/' + id);
        $('#deleteModal').modal('show');
    }

    function submitForm() {
        $('#delete-form').submit();
    }
</script>