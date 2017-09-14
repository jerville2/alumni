<style>
    .modal-overlay {
        background: #000000;
        opacity: 0.6;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=60)";
        filter: alpha(opacity=60);
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
    }

    #ajaxLoadingBox {
        position: fixed;
        top: 50%;
        left: 50%;
        height: 60px;
        width: 60px;
        background: #333 url('../img/loader.gif') no-repeat;
        border-radius: 10px;
    }
</style>
<div id="show" style="display: none">
    <div class="modal-overlay"></div>
    <div id="ajaxLoadingBox" >
        <img src="/image/giphy.gif">
    </div>
</div>
<script>

    $( "form" ).submit(function( event ) {

        $('#show').show();
    });
</script>