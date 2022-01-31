<!DOCTYPE html>
<html>

<head>
    @foreach ($data as $page)
    <link href='https://fonts.googleapis.com/css?family={{$page->page_text_font}}' rel='stylesheet'>
    @endforeach
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            /* font-family: Arial, Helvetica, sans-serif; */
            margin: 0;
        }

        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .column {
            float: left;
            width: 33.3%;
            margin-bottom: 16px;
            padding: 0 8px;
        }

        .card {
            /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); */
            margin: 8px;
        }

        .about-section {
            padding: 50px;
            text-align: center;
            background-color: #474e5d;
            color: white;
        }

        .container {
            padding: 0 16px;
        }

        .container::after,
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .title {
            /* color: grey; */
        }

        .button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            /* color: white; */
            /* background-color: #000; */
            text-align: center;
            cursor: pointer;
            width: 100%;
        }

        .button:hover {
            /* background-color: #555; */
        }

        @media screen and (max-width: 650px) {
            .column {
                width: 100%;
                display: block;
            }
        }

    </style>
</head>

<body>

    <div class="about-section">
        @foreach ($data as $page)
        
        <h1>{{$page->page_title}}</h1>
        <p style="font-family: {{$page->page_text_font}}">{{$page->page_description}}</p>
        <center><button style="background:{{$page->button_background_color}}; background:{{$page->button_text_color}}">{{$page->button_text}}</button></center>
    </div>
    @endforeach
    </div>
</body>
</html>
