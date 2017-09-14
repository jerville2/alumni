
@foreach($item->hr as $h)
    @if(($h->item->type==1) || ($h->item->type==2)  )
        <script>
            function obj() {

                this.cha = function(item_id,h_id,ch_id) {
                    if(($('#{{$item->id}}').val()=='') || $('#{{$item->id}}').val()=='{{$h->ch_id}}'  && !$('#{{$item->id}}').prop('disabled') ){
                        $('#{{$h->h_id}}').attr('disabled',true);

                        $('#textSelect{{$h->h_id}}').slideUp();
                            reload("{{$h->h_id}}");
                        }


                };
            };

            function act( oj,item_id) {
                this.name="{{$item->id}}";
                this.ch=function(){
                    oj.cha();
                    $('#{{$item->id}}').change(function () {
                        oj.cha();
                    });
                }
                this.cha=function(){
                    oj.cha();

                }

            }
            var o=new obj('{{$item->id}}','{{$h->h_id}}','{{$h->ch_id}}');
            var j=new act(o ,'{{$item->id}}' );
            actions.push(j);

        </script>

        @foreach($item->choices as $choice)
            @if($item->hr1($choice->id,$h->h_id)->count()==0)

                <script>
                    function obj() {

                        this.cha = function(item_id,h_id,ch_id) {

                         if($('#{{$item->id}}').val()=='{{$choice->id}}' && !$('#{{$item->id}}').prop('disabled')){

                             $('#{{$h->h_id}}').attr('disabled',false);
                             $('#textSelect{{$h->h_id}}').slideDown();
                             reload("{{$h->h_id}}");

                         }

                        };
                    };

                    function act( oj,item_id) {
                        this.name="{{$item->id}}";
                        this.ch=function(){
                            oj.cha();
                            $('#{{$item->id}}').change(function () {
                                oj.cha();
                            });
                        }
                        this.cha=function(){
                            oj.cha();

                        }
                    }
                    var o=new obj('{{$item->id}}','{{$h->h_id}}','{{$choice->id}}');
                    var j=new act(o ,'{{$item->id}}' );
                    actions.push(j);

                </script>

            @endif


        @endforeach
    @elseif($h->item->type==3)
        <script>
            function obj() {

                this.cha = function(item_id,h_id,ch_id) {
                    if(($('#{{$item->id}}').val()=='')  || ($('#{{$item->id}}').val()==null)||($('#{{$item->id}}').val()=='{{$h->ch_id}}' && !$('#{{$item->id}}').prop('disabled'))){
                        $('.sc{{$h->h_id}}').attr('disabled',true);

                        $('#check{{$h->h_id}}').slideUp();
                        reload("{{$h->h_id}}");
                    }

                };
            };

            function act( oj,item_id) {
                this.name="{{$item->id}}";
                this.ch=function(){
                    oj.cha();
                    $('#'+item_id).change(function () {
                        oj.cha();
                    });
                }
                this.cha=function(){
                    oj.cha();

                }
            }
            var o=new obj('{{$item->id}}','{{$h->h_id}}','{{$h->ch_id}}');
            var j=new act(o ,'{{$item->id}}' );
            actions.push(j);
        </script>
        @foreach($item->choices as $choice)
            @if($item->hr1($choice->id,$h->h_id)->count()==0)
                <script>
                    function obj() {

                        this.cha = function(item_id,h_id,ch_id) {

                            if(($('#{{$item->id}}').val()=='')  || $('#{{$item->id}}').val()=='{{$choice->id}}' && !$('#{{$item->id}}').prop('disabled')){

                                $('.sc{{$h->h_id}}').attr('disabled',false);
                                $('#check{{$h->h_id}}').slideDown();
                                reload("{{$h->h_id}}");
                            }
                        };
                    };

                    function act( oj,item_id) {
                        this.name="{{$item->id}}";
                        this.ch=function(){

                            oj.cha();
                            $('#'+item_id).change(function () {
                                oj.cha();

                            });
                        }
                        this.cha=function(){
                            oj.cha();

                        }
                    }
                    var o=new obj('{{$item->id}}','{{$h->h_id}}','{{$choice->id}}');
                    var j=new act(o ,'{{$item->id}}' );
                    actions.push(j);

                </script>
            @endif
        @endforeach
    @elseif($h->item->type==5)
        <script>
            function obj() {

                this.cha = function(item_id,h_id,ch_id) {
                    if(($('#{{$item->id}}').val()=='')  || $('#{{$item->id}}').val()=='{{$h->ch_id}}' && !$('#{{$item->id}}').prop('disabled')){
                        $('.dis{{$h->h_id}}').prop('checked', false);
                        $('.dis{{$h->h_id}}').attr('disabled',true);
                        reload("{{$h->h_id}}");
                        $('#options{{$h->h_id}}').slideUp();
                    }

                };
            };

            function act( oj,item_id) {
                this.name="{{$item->id}}";
                this.ch=function(){
                    oj.cha();
                    $('#'+item_id).change(function () {
                        oj.cha();
                    });
                }
                this.cha=function(){
                    oj.cha();

                }
            }
            var o=new obj('{{$item->id}}','{{$h->h_id}}','{{$h->ch_id}}');
            var j=new act(o ,'{{$item->id}}' );
            actions.push(j);
        </script>
        @foreach($item->choices as $choice)
            @if($item->hr1($choice->id,$h->h_id)->count()==0)
                <script>
                    function obj() {

                        this.cha = function(item_id,h_id,ch_id) {

                            if($('#{{$item->id}}').val()=='{{$choice->id}}' && !$('#{{$item->id}}').prop('disabled')){
                                reload("{{$h->h_id}}");
                                $('.dis{{$h->h_id}}').attr('disabled',false);
                                $('#options{{$h->h_id}}').slideDown();
                            }

                        };
                    };

                    function act( oj,item_id) {
                        this.name="{{$item->id}}";
                        this.ch=function(){

                            oj.cha();
                            $('#'+item_id).change(function () {
                                oj.cha();

                            });
                        }
                        this.cha=function(){
                            oj.cha();

                        }
                    }
                    var o=new obj('{{$item->id}}','{{$h->h_id}}','{{$choice->id}}');
                    var j=new act(o ,'{{$item->id}}' );
                    actions.push(j);

                </script>
            @endif
        @endforeach
    @elseif($h->item->type==4)
        <script>
            function obj() {

                this.cha = function(item_id,h_id,ch_id) {
                    if(($('#{{$item->id}}').val()=='')  || $('#{{$item->id}}').val()=='{{$h->ch_id}}' && !$('#{{$item->id}}').prop('disabled')){
                        $('.sv{{$h->h_id}}').prop('checked', false);
                        $('.sv{{$h->h_id}}').attr('disabled',true);
                        $('#survey{{$h->h_id}}').slideUp();
                        reload("{{$h->h_id}}");
                    }

                };
            };

            function act( oj,item_id) {
                this.name="{{$item->id}}";
                this.ch=function(){
                    oj.cha();
                    $('#'+item_id).change(function () {
                        oj.cha();
                    });
                }
                this.cha=function(){
                    oj.cha();

                }
            }
            var o=new obj('{{$item->id}}','{{$h->h_id}}','{{$h->ch_id}}');
            var j=new act(o ,'{{$item->id}}' );
            actions.push(j);
        </script>
        @foreach($item->choices as $choice)
            @if($item->hr1($choice->id,$h->h_id)->count()==0)
                <script>
                    function obj() {

                        this.cha = function(item_id,h_id,ch_id) {

                            if($('#{{$item->id}}').val()=='{{$choice->id}}' && !$('#{{$item->id}}').prop('disabled')){
                                $('.sv{{$h->h_id}}').attr('disabled',false);

                                $('#survey{{$h->h_id}}').slideDown();
                                reload("{{$h->h_id}}");
                            }

                        };
                    };

                    function act( oj,item_id) {
                        this.name="{{$item->id}}";
                        this.ch=function () {
                            oj.cha();
                            $('#{{$item->id}}').change(function () {
                                oj.cha();

                            });
                        };


                        this.cha=function(){
                            oj.cha();


                        }
                    }
                    var o=new obj('{{$item->id}}','{{$h->h_id}}','{{$choice->id}}');
                    var j=new act(o ,'{{$item->id}}' );
                    actions.push(j);

                </script>
            @endif
        @endforeach

    @endif
@endforeach