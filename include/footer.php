<script type="text/javascript">
var menuIcon = document.getElementById('menu-icon'),
      dropDown = document.getElementById('nav-dropdown');

menuIcon.onclick = function() {
    if(dropDown.style.display == "none"){
        dropDown.style.display = "block";
        console.log("change to block");
    }else{
        dropDown.style.display = "none";
        console.log("change to none");
    }
}
</script>
</body>
</html>
