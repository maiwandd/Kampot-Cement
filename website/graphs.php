<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>
<?php include('inc/functions.php'); ?>
<html>

<!-- Javascript for getting iframes for different graphs -->
<script type="text/javascript">
function loadPage(clicked_id) {
     document.getElementById("iframe").src = clicked_id;
}
</script>

<!-- Different buttons for graphs -->
<input id="temp.php" type="button" value="Temperature" onclick="loadPage(this.id);"/>
<input id="wind.php" type="button" value="Wind Direction" onclick="loadPage(this.id);"/>
<input id="humi.php" type="button" value="Humidity" onclick="loadPage(this.id);"/>
<input id="rain.php"  type="button" value="Rainfall" onclick="loadPage(this.id);"/>
<input id="sun.php" type="button" value="Sunshine" onclick="loadPage(this.id);"/>


<!-- The iframe for showing the graphs -->
<iframe id="iframe" width="100%" height="90%" src="">

</html>
