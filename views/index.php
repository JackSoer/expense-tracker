<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Expense Tracker</title>
    </head>
    <body>
        <div class="home">
            <h1 class="home__title">Expense Tracker</h1>
            <form action="/transactions" class="home__form" method="post" enctype="multipart/form-data">
                <label for="transactions" class="home__upload-input-label">Upload .csv file</label>
                <input type="file" name="transactions[]" id="transactions" class="home__upload-input" multiple>
                <button type="submit" class="home__submit">Show</button>
            </form>
        </div>
    </body>
</html>
