<?php
include("../../bd.php");
if(isset($_GET['txtID'])){ 
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $usuario=$registro["usuario"];
    $password=$registro["password"];
    $correo=$registro["correo"];
 }
 if($_POST){
    // recolectar los datos del metodo post
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
     //preparar la inserccion de los datos
    $sentencia=$conexion->prepare("UPDATE tbl_usuarios SET 
    usuario=:usuario, 
    password=:password,
    correo=:correo 
    WHERE id=:id");
    //asignar valores que tienen: nombre de las variables
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    header("location:index.php");
   }
?>



<?php include("../../templates/header.php");?>
<br/>
<div class="card">
    <div class="card-header">
        Datos del usuario
    </div>
    <div class="card-body">
        
        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
          <label for="txtID" class="form-label">ID</label>
          <input type="text"
          value="<?php echo $txtID;?>"
            class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
        </div>

            <div class="mb-3">
              <label for="" class="form-label">Nombre del usuario</label>
              <input type="text"
              value="<?php echo $usuario;?>"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
            <div/>
            <div class="mb-3">
              <label for="password" class="form-label"> Password</label>
              <input type="password"
              value="<?php echo $password;?>"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
              
            </div>
            <div class="mb-3">
              <label for="correo" class="form-label">correo</label>
              <input type="correo"
              value="<?php echo $correo;?>"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
            </div>

             <br/>
            <button type="submit" class="btn btn-success">Agregar</button>  
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

 </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php");?>