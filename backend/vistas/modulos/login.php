<div class="login-box">

  <div class="login-logo" style="postion:relative;margin:auto;width:50%;">

    <img src="http://studio24.com.pe/simpleFrontend/img/logo.png" class="img-responsive" style="padding: 5px;">

  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    <p class="login-box-msg" style="font-size: 30px;font-weight: 700;">Ingresar al sistema</p>

    <form method="post">

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="ingEmail" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat" style="background:#EC8A27;border: 1px solid #EC8A27;">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>

      <?php

        $login = new ControladorAdministradores();
        $login->ctrIngresoAdministrador();


      ?>

    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->