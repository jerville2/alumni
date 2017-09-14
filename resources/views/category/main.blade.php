<div class="container">

    <div class="row">
        <div class="col-md-4">
          @include('category.add-category')
        </div><!-- end of col-md-4-->
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading"><h4>Categories</h4></div>
                <div class="panel-body">
                    @include('gen.messages')
                    @include('category.category-table')
                </div>

            </div>
        </div>
    </div>
</div>