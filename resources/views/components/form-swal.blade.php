@php
    $val = $id ?? str()->random();
@endphp



<form action="{{$action}}" method="{{$method}}" class="{{$class ?? ''}}" id="{{$val}}">{{$slot}}</form>

<script>
    document.getElementById(`{{$val}}`).addEventListener('submit', (e) => {
        e.preventDefault()
    
        Swal.fire({
            title: `{{$warning ?? 'Are you sure you wish to proceed?'}}`,
            text: `{{$message ?? ''}}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Proceed!'
        }).then((result) => {
            if(result.isConfirmed){
                Notiflix.Block.init({
                    backgroundColor: 'rgba(255,255,255,0.6)',
                    svgColor: '#0160e0'
                })
                Notiflix.Block.standard('#{{$val}}')
                e.target.submit()
            }
        })
    }, false)
</script>