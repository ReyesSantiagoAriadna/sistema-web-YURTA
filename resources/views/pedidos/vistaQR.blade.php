<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <style>
        table {
          border-collapse: collapse;
          width: 80%;
          box-align: center;
          padding-top: 20px;
        }
        
        th, td {
          text-align: left;
          padding: 8px;
        }
        th {
            background-color: #F2692E;
            color: white;
            }
            caption {
                text-align: center;
            padding: 0.3em;
            }
        tr:nth-child(even) {background-color: #f2f2f2;}
        </style>
</head>
<body>    
    <div style="overflow-x:auto;">
        <caption>YURTA APP Pedido N. {{$id_pedido}}</caption>
        <br>   
        <label for="">Nombre Obra: </label>
        <label for="">{{$obra_p->descripcion}}</label> 
        <br>
        <label for="">Dependencia: </label>
        <label for="">{{$obra_p->dependencia}}</label> 
        <br>
        <label for="">Fecha Confirmacion: </label>
        <label for="">{{$obra_pedido->fecha_conf}}</label> 
 
        <br>
    <table class="table">                    
        <thead>
            <tr>
                    <th>#</th>
                    <th>Material</th>  
                    <th>Requerido</th> 
            </tr>
        </thead>
 
            
        <tbody>       
            @for ($i = 0; $i < sizeof($materiales_p); $i++) 
             <tr>                   
                                  
                <td>{{$materiales_p[$i]->id}}</td>  
                <td>{{$materiales_p[$i]->descripcion}}</td>   
                <td>{{$cantidades[$i]}}</td> 
           </tr> 
           @endfor 
             
        </tbody> 
    </table>     
        <img src="../public/qrcodes/qrcode.png" style="max-width:100%;width:auto;height:auto;">  
    </div> 
   
        
    
</body>
</html>