<script>
    function load() {
        for (var i=0;i<=actions.length-1;i++){
            actions[i].ch();
        }
    }
    function reload(name) {
        for (var i=0;i<=actions.length-1;i++){
            if(actions[i].name==name){
                actions[i].cha();

            }
            console.log(actions[i].name);

        }
    }


</script>