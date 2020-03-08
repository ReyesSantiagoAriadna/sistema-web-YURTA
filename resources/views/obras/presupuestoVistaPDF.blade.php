<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <h2>Presupuesto</h2>
    <style>
        .table{
            width: 100%;
            border: 1px  solid #999999;
        } 
    </style>
</head>
<body>
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

        </tbody> 
    </table>
    <div style="float:right;" >
        Total: $ 
        <label for="">{{$total}}</label>
    </div>
</body>
</html>