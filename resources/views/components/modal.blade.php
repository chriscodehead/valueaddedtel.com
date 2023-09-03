<div class="modal fade" tabindex="-1" role="dialog" id="{{$id}}">
    <div class="modal-dialog modal-dialog-centered {{$class ?? ''}}" role="document">

        <div class="modal-content">
            <div class="modal-body text-left">
                {{$slot}}
            </div>
        </div>
    </div>
</div>