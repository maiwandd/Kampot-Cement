<!-- Include file for bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>
<!-- Checks if the user is logged in as an admin -->
<?php
if($_SESSION['Rights'] =='1') {
	header('location: profilepage.php');
}
elseif($_SESSION['Rights'] =='0') {
    $_SESSION['errorlog']="You have no rights to visit this webpage";
    header('location: index.php');
} ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>UserID</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Edit</th>

        </tr>
    </thead>
    <tbody>

        <?php
        $query = "SELECT * FROM Users ORDER by User_id";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>".$row['User_id']."</td>";
            echo "<td>".$row['Email']."</td>";
            echo "<td>".$row['Firstname']."</td>";
            echo "<td>".$row['Lastname']."</td>";
            echo "<td>".$row['Phonenumber']."</td>"; ?>
            <td><a href="edituser.php?user_id=<?php echo $row['User_id']?>" class="btn btn-primary">Edit</a></n>
            <a href="resetpassword.php?user_id=<?php echo $row['User_id']?>" class="btn btn-primary">Reset Password</a>
						<a href="deleteuser.php?user_id=<?php echo $row['User_id']?>" class="btn btn-danger">Delete user</a></td><?php
            echo "</tr>";
        }
        ?>

    </tbody>
