@push('scripts')
    @once
<script>
    function showWarning(e){
        e.preventDefault()
        const href = e.target.href
        const anchor = event.target.closest("a");   // Find closest Anchor (or self)
        if (!anchor) console.log("Please ensure that the compoenent is wrapped around an anchor link");
        
        Swal.fire({
            title: 'Are you sure you wish to proceed with this action?',
            text: `{{$message ?? ''}}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Proceed!'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = anchor.getAttribute('href')
            }
        })
    }
</script>
@endonce
@endpush

<a href="{{$href}}" class="{{$class ?? ''}}" onclick="showWarning(event)">{{$slot}}</a>