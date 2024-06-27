<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Vacantes</title>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.19.1/js/uikit.min.js" integrity="sha512-vFi9G4t82KENdGzcl3wMaHGBsxPO/dtPPgCuLB7zNmbRa3jqcMh1XFMzUx1E5Ccxxmxu44LHj66zwJyx/m2Z1Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.19.1/css/uikit-core-rtl.min.css" integrity="sha512-yewVTraqvhTD0tHJwnSvihwkxOA8tAXyALdV4dd8HH2DfnAB4iqLqPFJnZYRqK4nKv/X9hyKEWBwCkctgtNFSw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css" integrity="sha384-b1vbLQXJHv0hBLW1gI+5kGQOFLJf5fuTtcBHTOKjQcPD6JbqFq2bTtr1o5iq2DkT" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVl5WgST9SYw5SNpPTOpG7R2ffjU9FPIGhD/J6SL5I/6Q" crossorigin="anonymous">
    

</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Buscador de Vacantes</h1>
        
            <div class="input-group mb-3 searchContainer">
                <div class="uk-width-1-1">
                <input class="uk-input" id="inputSearchVacantes" type="text" placeholder="Escribir Categoria..." aria-label="Escribir categoria...">
                </div>
                <div class="containerBtnUK">
                <button type="button" class="uk-button primary buttonUK" onclick="search()" class="btn btn-primary"><i class="fas fa-search"></i> BUSCAR</button>
                </div>
           
            </div>
    </div>


    
    
    
    </div>
</body>
<script src="server.js"></script>
</html>
