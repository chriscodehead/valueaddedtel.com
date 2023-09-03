<?php

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Route;

if (Route::currentRouteName() == "airtime") {
    $charge = GeneralSetting::where('title', 'airtime_charge')->first('value');
} elseif (Route::currentRouteName() == "buy-data") {
    $charge = GeneralSetting::where('title', 'data_charge')->first('value');
} else {
    $charge['value'] = null;
}

?>
<div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4> You will be charged <span class="amount"></span> for this transaction<br><br> Are you sure you want to proceed?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="cancel-btn" data-dismiss="modal">No, Cancel</button>
                <button type="submit" onclick="event.target.disabled = true; document.getElementById('cancel-btn').disabled = true; Notiflix.Block.standard('#my-form');" class="btn btn-primary" id="confirm-btn">Yes, Confirm</button>
                
                
            </div>
        </div>
    </div>
</div>

<script>
    // Get the form and the submit button
    const form = document.querySelector('#my-form');
    const submitBtn = document.querySelector('#submit-btn');
    const amountSpan = document.querySelector('.amount');

    // Show the confirmation modal when the submit button is clicked
    submitBtn.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent the form from submitting

        // Get the amount from the input field and update the modal text
        const amount = parseFloat(document.querySelector('#amount').value);
        const chargedAmount = amount + (amount * <?php echo $charge['value']; ?>);
        amountSpan.textContent = "NGN " + amount.toFixed(2);

        $('#confirmation-modal').modal('show'); // Show the modal using jQuery
    });

    // Submit the form when the user confirms
    document.querySelector('#confirm-btn').addEventListener('click', () => {
        form.submit(); // Submit the form
    });
</script>