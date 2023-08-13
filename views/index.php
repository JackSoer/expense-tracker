<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Expense Tracker</title>
        <style>
            * {
                margin: 0;
                padding: 0;
            }

            body {
                width: 100%;
                min-height: 100vh;
            }

            .home   {
                width: 100%;
                min-height: 100vh;

                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            } 

            .home__title {
                color: green;
                font-weight: 700;
                font-size: 43px;
                margin-bottom: 30px;
            }

            .home__form {
                padding: 15px;
                border-radius: 10px;
                display: flex;
                flex-direction: column;
                box-shadow: 0 0 5px 5px green;
            }

            .home__submit {
                width: 100%;
                background-color: green;
                color: white;
                padding: 5px;
                font-size: 20px;
                font-weight: 500;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                transition: 0.3s all ease;  
                margin-top: 30px; 
            } 

             .home__submit:hover {
                background-color: lightgreen;
             }

             .home__csv-example-text {
                font-size: 25px;
                color: white;
                text-align: center;
             }

             .example {
                position: fixed;
                top: 0;
                right: 0;
                background-color: green;
                padding: 15px;
                border-bottom-left-radius: 10px;
             }

             .home__upload-input-label {
                color: green;
                font-weight: 500;
                margin-bottom: 8px; 
             }
        </style>
    </head>
    <body>
        <div class="home">
            <h1 class="home__title">Expense Tracker</h1>
            <form action="/transactions" class="home__form" method="post" enctype="multipart/form-data">
                <label for="transactions" class="home__upload-input-label">Upload transactions .csv files: </label>
                <input type="file" name="transactions[]" id="transactions" class="home__upload-input" multiple>
                <button type="submit" class="home__submit">Show expense info</button>
            </form>

            <div class="example">
                <p class="home__csv-example-text">You can download a sample of transaction file<a href="/download" class="home__csv-example"> here</a>.</p>
            </div>
    </body>
</html>
