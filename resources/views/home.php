<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>Codepi test</title>
    </head>
    <body>
        <main class="container mt-4">
            <div id="app">
                <component
                    v-bind:is="chooseComponent"
                    :product="currentProduct"
                    @template="template"
                    @product="product"
                ></component>
            </div>
        </main>
    <script src="js/app.js"></script>
    </body>
</html>
