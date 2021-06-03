<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/plugins/nice-select2.css">
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" type="text/css" href="/public/css/plugins/lightpick.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="/public/js/plugins/nice-select2.js"></script>
    <script src="/public/js/plugins/lightpick.js"></script>

    <title>Quotes</title>
</head>
<body>
   <div class="container">
       <h1 class="mt-5">Таблица котировок</h1>
       <div class="d-flex my-4 justify-content-between">
            <div class="d-flex align-items-center">
                <h5 class="me-3 mb-0">Диапазон:</h5>
                <input class="date" type="text" id="date">
            </div>
           <select name="code" id="code"></select>
           <div></div>
       </div>
       <table class="table">
           <thead>
           <tr>
               <th scope="col">Название</th>
               <th scope="col">Номинал</th>
               <th scope="col">Буквенный код</th>
               <th scope="col">Значение</th>
               <th scope="col">Дата</th>
           </tr>
           </thead>
           <tbody class="quotes__wrapper">

           </tbody>
       </table>
   </div>
   <script src="/public/js/main.js"></script>
</body>
</html>