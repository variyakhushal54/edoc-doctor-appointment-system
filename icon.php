<html>

<head>
    <style>
        a {
            color: #0A76D8;
            text-decoration: none;
        }

        .me {
            width: 400px;
            margin: 90px auto;
        }

        .me p,
        .me h1 {
            letter-spacing: 3px;
            text-align: center;
        }

        .me p {
            font-weight: 200;
        }

        .me span {
            font-weight: bold;
        }

        .social {
            color: #0A76D8;
            position: fixed;
            top: 45%;
        }

        .social ul {
            padding: 0px;
            transform: translate(-270px, 0);
        }

        .social ul li {
            display: block;
            margin: 30px;
            background: rgba(0, 0, 0, 0.36);
            width: 300px;
            text-align: right;
            padding: 12px;
            border-radius: 0 30px 30px 0;
            transition: all 1s;
        }

        .social ul li:hover {
            transform: translate(110px, 0);
            background: rgba(255, 255, 255, 0.4);
        }

        .social ul li:hover a {
            color: #0A76D8;
            font-weight: 500;
        }

        .social ul li:hover i {
            color: #fff;
            background: rgba(0, 0, 0, 0.36);
            transform: rotate(360deg);
            transition: all 1s;
        }

        .social ul li i {
            margin-left: 10px;
            color: #0A76D8;
            background: #fff;
            padding: 10px;
            border-radius: 40%;
            width: 40px;
            height: 40px;
            font-size: 22px;
            background: #ffffff;
            transform: rotate(0deg);
        }

        body {
            color: #fff;
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body>
    <div>


        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <nav class="social">
            <ul>
                <li><a href="">Facebook <i class="fa fa-facebook"></i></a></li>
                <li><a href="">Instagram <i class="fa fa-instagram"></i></a></li>
                <li><a href="">Linkedin <i class="fa fa-linkedin"></i></a></li>
                <li><a href="">Git-Hub <i class="fa fa-github"></i></a></li>
            </ul>
        </nav>

    </div>
</body>

</html>