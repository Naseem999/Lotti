<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include_once 'partial/head.php';
  ?>
  <title>Lotti</title>
</head>

<body>
  <?php
  include_once 'partial/header.php';
  ?>

  <div class="row" style="height: 100vh; background: url(img/undraw_winners_ao2o.svg) 50% 50% no-repeat;">
    <br>
    <br><br><br class="hide-on-med-and-down"><br class="hide-on-med-and-down">
    <div class="col s12 m12 l12 ">
      <div class="col m3 l3"></div>
      <div class="col s12 m6 l6 ">
        <div class="card z-depth-5" style="background-color: rgba(255, 235, 238, 0.4); border-radius: 10px; backdrop-filter: blur(15px); border: 1px solid transparent;">
          <div class="card-content">
            <div class="row">
              <p style="text-align: center; font-size: 8vh; color: #e57373 ; font-weight: bolder;">LOTTI</p>
              <hr style="width: 30px;">
              <p style="padding: 20px; text-align: center; font-size: 2.5vh; color: #ef5350 ;">Lotti is a Online Lottery System You can
                Place Bids On Numbers From 50 Numbers and Win Cash And Many More Exciting Prizes </p>

              <div class="row" style="margin-top: 3em;">
              <p style="text-align: center;"><a href="#start" class="btn-large waves-effect waves-light " style="background-color: #ee6e73">
                      Get Started
                    </a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col m3 l3"></div>
    </div>
  </div>


  <div class="row">
    <div class="col s12 m6 l6 " id="start">
      <div class="container z-depth-1 center" style="border-radius: 10px;">
        <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_E8O6Kf.json" background="transparent" speed="0.7" style="width:100%; height:60vh;" loop autoplay></lottie-player>
      </div>
    </div>
    <div class="col s12 m6 l6">
      <p style="font-size: 6vh; margin-bottom: 0px; margin-top:2vh; color:  #ee6e73; text-align: center;">ADD MONEY</p>
      <hr style="width: 20px;">
      <p style="font-size: 2.5vh; padding: 10px; color: gray; text-align: center;">If I win a lottery, I would buy a beautiful bungalow in a nice colony and lead a peaceful life. Buying a lottery ticket at least keeps our hopes alive of becoming rich overnight.
        Even if I don't win anything, there is no harm in living in the dream world for some days.</p>

    </div>
  </div>

  <div class="row">
    <div class="col s12 m6 l6">
      <p style="font-size: 6vh; margin-bottom: 0px; margin-top:2vh; color:  #ee6e73; text-align: center;">PLACE BID</p>
      <hr style="width: 20px;">
      <p style="font-size: 2.5vh; padding: 10px; color: gray; text-align: center;">If I win a lottery, I would buy a beautiful bungalow in a nice colony and lead a peaceful life. Buying a lottery ticket at least keeps our hopes alive of becoming rich overnight.
        Even if I don't win anything, there is no harm in living in the dream world for some days.</p>
      <?php
      if (isset($_SESSION['username'])) {
      ?>
        <p style="text-align: center;"><a href="user_dash.php" class="btn waves-effect waves-light " style="background-color: #ee6e73">
            place now
          </a></p>
      <?php
      } else {
      ?>
        <p style="text-align: center;"><a href="login.php" class="btn waves-effect waves-light " style="background-color: #ee6e73">
            place now
          </a></p>
      <?php
      }
      ?>
    </div>
    <div class="col s12 m6 l6 ">
      <div class="container z-depth-1 center" style="border-radius: 10px;">
        <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_zJSuaQ.json" background="transparent" speed="0.7" style="width:100%; height:60vh;" loop autoplay></lottie-player>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col s12 m6 l6 ">
      <div class="container z-depth-1 center" style="border-radius: 10px; padding: 30px;">
        <lottie-player src="https://assets2.lottiefiles.com/private_files/lf30_4uTjNk.json" background="transparent" speed="0.7" style="width:100%; height:60vh; border-radius: 10px;" loop autoplay></lottie-player>
      </div>
    </div>
    <div class="col s12 m6 l6">
      <p style="font-size: 6vh; margin-bottom: 0px; margin-top:2vh; color:  #ee6e73; text-align: center;">WIN PRIZES</p>
      <hr style="width: 20px;">
      <p style="font-size: 2.5vh; padding: 10px; color: gray; text-align: center;">If I win a lottery, I would buy a beautiful bungalow in a nice colony and lead a peaceful life. Buying a lottery ticket at least keeps our hopes alive of becoming rich overnight.
        Even if I don't win anything, there is no harm in living in the dream world for some days.</p>

    </div>
  </div>
  <?php
  include_once 'partial/footer.php';
  include_once 'partial/scripts.php';
  ?>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

</body>

</html>
<style>
  html {
  scroll-behavior: smooth;
}
</style>