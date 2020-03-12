<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <style>
        table {
          border-collapse: collapse;
          width: 100%;
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
        <caption>YURTA APP Presupuesto</caption>
        <br> 
     <table class="table">                    
        <thead>
            <tr>
                <th>Descripcion</th>
                <th>Proveedor</th>
                <th>Cantidad</th>
                <th>Unidad</th>                                 
                <th>Precio Uni</th>
                <th>Importe</th> 
            </tr>
        </thead>
 
            
        <tbody>       
            @for ($i = 0; $i < sizeof($resultado); $i++) 
             <tr>                       
                <td>{{$resultado[$i]->descripcion}}</td>
                <td>{{$resultado[$i]->razon_social}}</td>   
                <td>{{$materiales[$i]}}</td>
                <td>{{$resultado[$i]->unidad}}</td>
                <td>{{$resultado[$i]->precio_unitario}}</td> 
                <td>{{$cantidades[$i]}}</td>   
           </tr> 
           @endfor 
            <tr>
                <td>agua</td>
                    <td>----</td>   
                    <td>{{$t_agua}}</td>
                    <td>lts</td>
                    <td>---</td>  
            </tr>  

            <tr  >
                <td colspan=5></td>
                <td>Total: </td>
                <td>${{$total}}</td>
            </tr>
        </tbody> 
    </table>
    </div>
    
</body>
</html>