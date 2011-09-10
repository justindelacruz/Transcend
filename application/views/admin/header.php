<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title ?> | Control Panel | Transcend Online Translator Test</title>

		<style type="text/css">

			::selection{ background-color: #E13300; color: white; }
			::moz-selection{ background-color: #E13300; color: white; }
			::webkit-selection{ background-color: #E13300; color: white; }

			body {
				background-color: #fff;
				margin: 40px;
				font: 13px/20px normal Helvetica, Arial, sans-serif;
				color: #4F5155;
			}

			a {
				color: #003399;
				background-color: transparent;
			}

			#logo {
				text-align: right;
				margin: 15px 15px 0px 0px;
				border: 0px;
			}

			h1 {
				color: #444;
				background-color: transparent;
				border-bottom: 1px solid #D0D0D0;
				font-size: 19px;
				font-weight: normal;
				margin: 0 0 14px 0;
				padding: 0px 15px 10px 15px;
			}

			h2 {
				color: #444;
				background-color: transparent;
				border-bottom: 1px solid #D0D0D0;
				font-size: 16px;
				font-weight: normal;
				margin: 0 0 14px 0;
				padding: 14px 15px 10px 0px;
			}

			input {
				width: 10.5em;
			}

			td, th {
				padding: 3px 8px 3px 8px;
				white-space: nowrap;
			}

			.alternate {
				background-color: #f9f9f9;
			}

			.message {
				padding: 1.1em;
				font-size: 1.4em;
				border-radius: 3px;
			}

			.message.success {
				color: #FFF;
				background-color: #78b433;
				/* Generated at http://gradients.glrzad.com/ */
				background-image: -webkit-gradient(
					linear,
					left bottom,
					left top,
					color-stop(0, rgb(76,126,18)),
					color-stop(0.77, rgb(120,180,51))
					);
				background-image: -moz-linear-gradient(
					center bottom,
					rgb(76,126,18) 0%,
					rgb(120,180,51) 77%
					);
			}

			.message.error {
				color: #111;
				border: 1px solid red;
			}

			.back {
				text-align: right;
			}

			code {
				font-family: Consolas, Monaco, Courier New, Courier, monospace;
				font-size: 12px;
				background-color: #f9f9f9;
				border: 1px solid #D0D0D0;
				color: #002166;
				display: block;
				margin: 14px 0 14px 0;
				padding: 12px 10px 12px 10px;
			}

			#body{
				margin: 0 15px 0 15px;
			}

			p.footer{
				text-align: right;
				font-size: 11px;
				border-top: 1px solid #D0D0D0;
				line-height: 32px;
				padding: 0 10px 0 10px;
				margin: 20px 0 0 0;
			}

			#container{
				margin: 10px;
				border: 1px solid #D0D0D0;
				-webkit-box-shadow: 0 0 8px #D0D0D0;
			}
		</style>
	</head>
	<body>

		<div id="container">

			<div id="logo"><a href="http://www.transcend.net"><img src="<?php echo(base_url("assets/logo.png")) ?>" /></a></div>

			<h1>
				Translator Exam Control Panel
			</h1>

			<div id="body">

				<?php if ($this->input->get('updated') !== false) { ?>
					<div class="message success">
						Update successful.
					</div>
				<?php }
				if ($this->input->get('error') !== false) { ?>
					<div class="message error">
						There was a problem with your input. Please check and try again.
					</div>
				<?php } ?>