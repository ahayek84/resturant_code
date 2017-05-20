<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Admin Section Login</title>

	<!-- Bootstrap -->
	<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

  <link href="./style.css" rel="stylesheet">

  </head>

  <body>

  	<div class="container">
  		<div class="row">

        <!-- right side coulumn -->
				<div class="col-md-3 remove-padding right-side-column">
  			<div class="first-header">
  				<h5 class="text-center color-white"></h5>
  			</div>

         <?php include_once 'primarynavigation.php' ?>


  			</div>

  			<div class="col-md-9 remove-padding">
       <!-- 
  			<div class="first-header right-side-column">
  				<h4 class="add-margin-left"><strong class="color-white">Admin Section</strong> <span style="color:#e74c3c; font-size: 14px; float:right;"> <?php $today = date("F j, Y"); echo $today; ?></span></h4>
  			</div>
        -->

				<!-- banner section -->
        <div class="business-header">  </div>

  			<!-- Add user button -->
  			<div class="row add-margin">
  				<div class="col-md-12">
  				  <a href="adduser">
  				    <button type="submit" class="btn btn-primary btn-lg">
  				    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Add User
  				    </button></a>
  				</div>
  			</div>

  			<!-- table section -->
  			<div class="row pad-left">
  				<div class="col-md-12">

  				   <table class="table  table-bordered">
  				       <thead>
  				           <tr style="background-color: #1674b3;">
                                <th>Number</th>
                                <th>Username</th>
                                <th>Email</th>
																<th>Address</th>
																<th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php

                        if(isset($users)){

                        	foreach($users as $user){ ?>

                        		  <tr>
																    <td><?php if(isset($user->id)) echo $user->id; ?></td>
                                    <td><?php if(isset($user->username)) echo $user->username; ?></td>
                                    <td><?php if(isset($user->email)) echo $user->email; ?></td>
																		<td><?php if(isset($user->address)) echo $user->address; ?></td>
																		<td><?php if(isset($user->phone_number)) echo $user->phone_number; ?></td>

                                    <td><a href="edituser/<?php if(isset($user->id)) echo $user->id ?>"><span class="glyphicon glyphicon-edit color-white" aria-hidden="true"></span></a>
                                    <a href="userdelete/<?php if(isset($user->id)) echo $user->id ?>"><span class="glyphicon glyphicon-trash color-red mDelete" aria-hidden="true"></span></a></td>
                              </tr>
                        <?php
                        	}
                        }
                        ?>
                        </tbody>

                   </table>
  				</div>
  			</div>

  			</div>
  		</div>

  	</div>

  	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<!-- Include all compiled plugins (below), or include individual files as needed -->
  	<script src="./bootstrap/js/bootstrap.min.js"></script>
  	<script src="./bootstrap/js/npm.js"></script>
  	<script src="./bootstrap/js/js.js"></script>

  </body>
  </html>
