<script>
    function loadItems() {
        $.ajax({
            'url':'/loadItems/'+$('#cat').val(),
            data: { route:"{{Route::currentRouteName()}}" },
            'method':'GET'
        }).done(function (data) {
            $('#items').html(data)
        }).fail(function () {
            console.log("nonte");
        });

    }
    $(document).ready(function () {
        loadItems();
        $('#cat').change(function(){
            loadItems();
        });
    })
</script>