<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>CSS Form - Gazpo.com</title>

<style TYPE="text/css" >
    <!--
	* { margin: 0; padding: 0; }
	body {font-family: Verdana, Arial; font-size: 12px; line-height: 18px; }
	a { text-decoration: none; }
	.container{margin: 20px auto; width: 900px; background: #fff;}
	h3 { margin-bottom: 15px; font-size: 22px; text-shadow: 2px 2px 2px #ccc; }

	#contactform {

	width: 500px;
	padding: 20px;
	background: #f0f0f0;
	overflow:auto;

	border: 1px solid #cccccc;
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;

	-moz-box-shadow: 2px 2px 2px #cccccc;
	-webkit-box-shadow: 2px 2px 2px #cccccc;
	box-shadow: 2px 2px 2px #cccccc;

	}

	.field{margin-bottom:7px;}

	label {
	font-family: Arial, Verdana;
	text-shadow: 2px 2px 2px #ccc;
	display: block;
	float: left;
	font-weight: bold;
	margin-right:10px;
	text-align: right;
	width: 120px;
	line-height: 25px;
	font-size: 15px;
	}

	.input{
	font-family: Arial, Verdana;
	font-size: 15px;
	padding: 5px;
	border: 1px solid #b9bdc1;
	width: 300px;
	color: #797979;
	}

	.input:focus{
	background-color:#E7E8E7;
	}

	.textarea {
	height:150px;
	}

	.hint{
	display:none;
	}

	.field:hover .hint {
	position: absolute;
	display: block;
	margin: -30px 0 0 455px;
	color: #FFFFFF;
	padding: 7px 10px;
	background: rgba(0, 0, 0, 0.6);

	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;
	}

	.button{
	float: right;
	margin:10px 55px 10px 0;
	font-weight: bold;
	line-height: 1;
	padding: 6px 10px;
	cursor:pointer;
	color: #fff;

	text-align: center;
	text-shadow: 0 -1px 1px #64799e;

	/* Background gradient */
	background: #a5b8da;
	background: -moz-linear-gradient(top, #a5b8da 0%, #7089b3 100%);
	background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#a5b8da), to(#7089b3));

	/* Border style */
  	border: 1px solid #5c6f91;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;

	/* Box shadow */
	-moz-box-shadow: inset 0 1px 0 0 #aec3e5;
	-webkit-box-shadow: inset 0 1px 0 0 #aec3e5;
	box-shadow: inset 0 1px 0 0 #aec3e5;

	}

	.button:hover {
	background: #848FB2;
    cursor: pointer;
	}
    -->
   </style>


</head>

<body>
<div class="container">

<form id="contactform" class="rounded" method="post" action="">
<h3>Contact Form</h3>
<div class="field">
	<label for="name">Name:</label>
  	<input type="text" class="input" name="name" id="name" />
	<p class="hint">Enter your name.</p>
</div>

<div class="field">
	<label for="email">Email:</label>
  	<input type="text" class="input" name="email" id="email" />
	<p class="hint">Enter your email.</p>
</div>

<div class="field">
	<label for="message">Message:</label>
  	<textarea class="input textarea" name="message" id="message"></textarea>
	<p class="hint">Write your message.</p>
</div>


<input type="submit" name="Submit"  class="button" value="Submit" />
</form>
<br />
<h3>Questions?:</h3>
<p>If you have any questions related to this, please visit the tutorial and drop comment there. Thanks.</p>
<p>Link to the tutorial <a href="http://gazpo.com/2011/02/form/">Gazpo.com</a>.</p>

</div>
</body>

</html>
