@if (Session::has('flash_message'))
    <div class="container" id="message-container" style="margin-left: 202px; position: absolute;">
        <div class="row">
            <div class="col-md-10">
                <div class="alert alert-success" style="text-align: center">
                    {{Session::get('flash_message')}}
                </div>
            </div>
        </div>
    </div>
@endif
@if (Session::has('flash_message_cancel'))
    <div class="container" id="message-container" style="margin-left: 202px; position: absolute;">
        <div class="row">
            <div class="col-md-10">
                <div class="alert alert-danger" style="text-align: center">
                    {{Session::get('flash_message_cancel')}}
                </div>
            </div>
        </div>
    </div>
@endif

<script>

setTimeout(function() {
    document.getElementById("message-container").remove();
}, 5000);
</script>
