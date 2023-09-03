<!-- JavaScript -->
<script src="./assets/js/bundle.js?ver=2.2.0"></script>
<script src="./assets/js/scripts.js?ver=2.2.0"></script>
<script src="./assets/js/charts/chart-crypto.js?ver=2.2.0"></script>

<!-- JavaScript code to display popup modal for pay with wallet -->
<script>
    $('#payWithWallet').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);

        // Find the input field inside the form in the modal and set its value to the ID value
        modal.find('form input[name="id"]').val(id);

        modal.find('#item-id').text(id); // Update the modal placeholder element with the ID value
    });
</script>

<!-- JavaScript code to display alert -->
@include('sweetalert::alert')

<!-- JavaScript code to display prompt for set PIN -->
@if($user['pin'] == null && !$user->isAdmin)
    <script>
        $(document).ready(function() {
            $('#set-pin-modal').modal('show');
        });
    </script>
@endif

<script>
    $('#network').on('change', function() {
        var params = $(this).val(); // set params to the selected value
        $.ajax({
            url: '/all-plans',
            method: 'GET',
            beforeSend: function() {
                $('#plan_type').html('<option value="">Loading...</option>'); // show loading state
            },
            success: function(response) {
                $('#plan_type').prop('disabled', false);
                $('#plan_type').empty();
                // Add default option before appending the response options
                $('#plan_type').prepend('<option value="" selected>Select Data Plan</option>');
                $.each(response, function(key, value) {
                    if (params === value.network) {
                        $('#plan_type').append('<option value="' + value.api_plan_id + '/' + value.plan_name + '" data-amount="' + value.amount + '">' + value.plan_name + ' - <b>₦‎' + value.amount + '</b></option>');
                    }
                });
                $('#plan_type').on('change', function() {
                    var amount = $(this).find(':selected').data('amount');
                    $('input[name="amount"]').val(amount);
                });
            }
        });
    });
</script>

<script>
    Alpine.start();
</script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

@stack('scripts')