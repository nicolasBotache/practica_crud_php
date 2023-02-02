<?php
   include("../../bd.php");

   if(isset($_GET['txtID'])){ 
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    //Buscar el archivo relacionado con el empleado
    $sentencia =$conexion->prepare("SELECT foto,cv FROM `tbl_empleados` WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

     if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != ""){
          if(file_exists("./".$registro_recuperado["foto"])){
            unlink("./".$registro_recuperado["foto"]);

          }

     }
     if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"] != ""){
        if(file_exists("./".$registro_recuperado["cv"])){
          unlink("./".$registro_recuperado["cv"]);

        }

   }
    $sentencia=$conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    header("location:index.php");
 }


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
                             class="img-fluid rounded" alt="">
                        </td>
                        <td><?php echo $registro['cv'];?></td>
                        <td><?php echo $registro['puesto'];?></td>
                        <td><?php echo $registro['fechadeingreso'];?></td>

                        <td class ="p-0">
                            <a name="" id="" class="btn btn-primary p-1" href="#" role="button">Carta</a> |

                            <a class="btn btn-info p-1" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a> | 

                            <a class="btn btn-danger p-1" href="index.php?txtID=<?php echo $registro['id']; ?>" role="button">Eliminar</a>
                        <td/>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<?php include("../../templates/footer.php");?>