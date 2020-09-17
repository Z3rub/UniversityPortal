
<form action="" method="post">
    <h2>Universities View</h2>
    <br>
    <table id="tbl_show"></table>           
<script>
    window.onload = show();
    function show(){
        var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   document.getElementById("tbl_show").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "show.php", true);
            xhttp.send();
    }

    function my_fun(id) {
        var str = '';
        var pass = '';
        while(str == '') //|| isNaN(str)
            str = window.prompt("Enter University Title");
        while(pass == '')
            pass = window.prompt("Enter Password");

        var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   show();
                }
            };
            xhttp.open("GET", "my_fun.php?id="+id+"&str="+str+"&pass="+pass, true);
            xhttp.send();
    }
</script>
</form>
