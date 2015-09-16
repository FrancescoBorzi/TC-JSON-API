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
                font-weight: 500;

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
                font-family: 'Lato';
            }

            .item {
                font-size: 24px;
                font-weight: 400;
                margin: 10px;
            }

            .item strong {
                font-weight: 900;
            }

            .credit {
                font-weight: 700;
                position: absolute;
                bottom: 30px;
                left: 45%;
                font-family: 'Lato';
            }

            .credit a {
                text-decoration: none;
                color: grey;
            }

            .credit strong {
                font-weight: 900;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content text-center">
                <div class="title">TrinityCore-JSON-API</div>
                <div class="item">API version: <strong>0.6</strong></div>
                <div class="item">Database version: <strong><?= $db_version ?></strong></div>
                <!-- We worked for free to build this software, please do not remove the credit! -->
                <div class="credit">Created by <a target="_blank" href="https://github.com/ShinDarth"><strong>ShinDarth</strong></a> && <a target="_blank" href="https://github.com/Helias"><strong>Helias</strong></a></div>
            </div>
        </div>
        <a target="_blank" href="https://github.com/ShinDarth/TC-JSON-API"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/a6677b08c955af8400f44c6298f40e7d19cc5b2d/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677261795f3664366436642e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png"></a>
    </body>
</html>
