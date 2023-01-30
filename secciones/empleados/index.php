<?php
   include("../../bd.php");


   $sentencia =$conexion->prepare("SELECT *,
   (SELECT nombredelpuesto FROM tbl_puestos 
   WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto
   FROM `tbl_empleados`");
   $sentencia->execute();
   $lista_tbl_empleados=$sentencia->fetchALL(PDO::FETCH_ASSOC);




?>   



<?php include("../../templates/header.php");?>

<br/>
<div class="card">
    <div class="card-header">
        
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Cv</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">

                    <?php foreach($lista_tbl_empleados as $registro) {?>

                        <td><?php echo $registro['id'];?></td>
                        <td scope="row">
                            <?php echo $registro['primernombre'];?>
                            <?php echo $registro['segundonombre'];?>
                            <?php echo $registro['primerapellido'];?>
                            <?php echo $registro['segundoapellido'];?>
                        </td>

                        <td>
                            <img width="50" src="<?php echo $registro['foto'];?>" 
                             alt="">
                        </td>
                        <td><?php echo $registro['cv'];?></td>
                        <td><?php echo $registro['puesto'];?></td>
                        <td><?php echo $registro['fechadeingreso'];?></td>

                        <td><a name="" id="" class="btn btn-primary" href="#" role="button">Carta</a>|
                        <a name="" id="" class="btn btn-info" href="#" role="button">Editar</a>|
                        <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<?php include("../../templates/footer.php");?>