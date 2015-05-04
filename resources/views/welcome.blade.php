<html>
	<head>
		<title>TC-JSON-API</title>

		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 300;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.version {
				font-size: 24px;
                font-weight: 400;
			}

            .credit {
                position: absolute;
                bottom: 30px;
                left: 45%;
            }
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content text-center">
				<div class="title">TrinityCore-JSON-API</div>
				<div class="version">Database version: <strong><?= $db_version ?></strong></div>
				<div class="credit">Created by <strong>ShinDarth</strong></div>
			</div>
		</div>
	</body>
</html>
