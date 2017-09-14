@if(Session::has('messages'))
    <div class="row">
        <div class="çol-md-12 {{Session::pull('class')}}">
           <span class="help-block">{{\Illuminate\Support\Facades\Session::pull('messages')}}</span>
        </div>
    </div>
@endif
