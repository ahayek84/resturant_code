<div class="logo">
    <p><img class="center-block" alt="Site logo" src="images/userprofile.png" /></p>
    <p class="text-center color-white">Hi <?php echo $_SESSION['user_name'] ?> </p>
    <p class="text-center color-white"><?php $today = date("F j, Y"); echo $today; ?></p>
</div>

<div class="nav">
  <ul class="nav nav-stacked">

    <li role="presentation" class="active second-background">
        <a href="dashboard"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Dashboard</a>
    </li>
 
    <?php if ($_SESSION['role'] == 1): ?>

    <li role="presentation" class="second-background">
        <a href="user"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View User</a>
    </li>

    <li role="presentation" class="active second-background">
        <a href="menu"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Menu Category</a>
    </li>

    <li role="presentation" class="active second-background">
        <a href="menuitem"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Menu Item</a>
    </li>

    <li role="presentation" class="active second-background">
        <a href="order"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Order</a>
    </li>

    <?php else: ?>

    <li role="presentation" class="active second-background">
        <a href="menu"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Menu Category</a>
    </li>

    <li role="presentation" class="active second-background">
        <a href="menuitem"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Menu Item</a>
    </li>

    <li role="presentation" class="active second-background">
        <a href="order"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Order</a>
    </li>
         
    <li role="presentation" class="active second-background">
        <a href="aboutus/<?php if(isset($_SESSION['restaurant_id'])) echo $_SESSION['restaurant_id'] ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> About Us</a>
    </li>

    <?php endif ?>

    <li role="presentation" class="second-background">
        <a href="logout"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Logout</a>
    </li>
    <!-- <li role="presentation" class="second-background">
        <a href="reset"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Reset</a>
    </li> -->

    </ul>

</div>
