<?php
  include 'koneksi1.php';
  session_start();
  if (!isset($_SESSION['username'])){
    header('location:login_user.php');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="" href="">
  <title>Web</title>
  <!--online-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="fontawesome/css/all.css">
  <style>
    .circle {
      border-radius: 50%;
      width: 320px;
      height: 300px;
      padding: 20px;
      border: solid 2px black;
    }
  </style>
</head>

<body>
  <!--Navbar-->
  <header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" src="Images/logomakanan.png"
          class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="Images/logomakanan.png" alt="" width="38px" height="38px"
            style="border-radius: 50%; background-color:black;">
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
          <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
          <li><a href="#aboutus" class="nav-link px-2 text-white">About</a></li>
          <li><a href="Contact.php" class="nav-link px-2 text-white">Contact Me</a></li>
          <li><a href="cart_views.php"><i class="fas fa-solid fa-cart-shopping mt-3 px-2" style="color: white;"></i></a></li>
        </ul>
        

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..."
            aria-label="Search">
        </form>
        <div class="text-end">
          <a href="logout_user.php"><button type="button" class="btn btn-warning">Logout</button></a>
        </div>
      </div>
    </div>
  </header>
  <!--Header-->
  <header class="container-fluid bg-primary text-black"
    style="justify-content: center; background-size: cover; background-position: center; height: 90vh; background:url(Images/Background3.jpg) ; background-repeat: no-repeat; background-size: cover;">
    <div data-aos="fade-up" data-aos-duration="3000">
      <div class="container col-lg-6"
        style="height:100%; display: flex; justify-content: center; align-items: center; color:white;">
        <div class="row text-center">
          <h2 class="display-1">Selamat datang</h2>
          <p class="lead">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            Dolore error ad aliquam, tenetur temporibus iusto aliquid fugiat perferendis a quidem
            veniam esse! Unde, officia ducimus eum molestias provident quaerat adipisci perferendis nobis qu
            as soluta harum, id veritatis reiciendis mollitia laudantium expedita cumque nesciunt animi ex odio autem
            culpa in sint!</p>
        </div>
      </div>
    </div>
    </div>
  </header>
  <!--About Us-->
  <div class=" row mt-5" id="aboutus"
    style="justify-content: center; background-size: cover; background-position: center; height: 130vh; background:url(Images/Background3.jpg) ; background-repeat: no-repeat; background-size: cover;">
    <h3 style="text-align: center;">About us</h3>
    <div class="col-12 col-md-6 border rounded p-4 text-light">
      <h1 class="mb-4">Makanan Kekinian yang sehat</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam fuga blanditiis modi!
        Deserunt dolorum excepturi fugit ex eius veniam, magnam, consequatur maxime quam deleniti,
        officiis temporibus quas ipsa non porro!</p>

      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi dolorum id nemo blanditiis
        molestias recusandae, vel architecto veritatis provident, ad alias quasi porro, accusantium
        a ea ipsum consequuntur placeat eos!</p>

      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo commodi ducimus qui,
        corporis, natus sequi atque necessitatibus exercitationem optio ipsa perspiciatis pariatur
        eius consequuntur impedit repellendus, eum praesentium odio vitae.</p>
    </div>
  </div>

  <div class="row gap-4 m-3">
    
    <?php
      include "koneksi1.php";
      $query = "SELECT * FROM kue";
      $result = mysqli_query($koneksi, $query);
      while($data=mysqli_fetch_array($result)){
      ?>
    <!-- <div class="item" style="border: 2px solid #fff"> -->   
      <div class="card" style="width: 18rem;">
        <form method="post" action="cart_views.php?id=<?=$data['kode_kue']?>">
      <img src="Images/<?=$data['foto']?>" class="card-img-top" alt="...">
      <div class="card-body">
        <div class="caption">
          <h3>
            <?=$data['nama_kue'];?>
          </h3>
        </div>
        <h5>Rp.
          <?php echo $data['harga_kue'];?>
        </h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
          content.</p>
          <a href="formco.php?id=<?=$data['kode_kue']?>" class="btn btn-primary">Buy</a>
          <input type="number" name="quantity" class="form-control" value="1">
          <input type="hidden" name="hidden_name" value="<?=$data['nama_kue']?>">
          <input type="hidden" name="hidden_price" value="<?=$data['harga_kue']?>">
          <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" value="Add to Cart">
        </form>
        </div>
    </div>

    <?php }?>
    
    <!-- </div> -->
    <!--<img src="Images/Qroissants.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h2 class="card-title">Croissants</h2>
        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit explicabo voluptate voluptatum ea at, autem laborum assumenda reprehenderit, sed quia temporibus praesentium. Molestiae reiciendis unde beatae quos eveniet nihil est.</p>
        <h4>Price : 10.000</h4>
        <button>Beli disini</button>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary">Last updated 5 month ago</small>
      </div> -->
  </div>
  <!--footer-->
  <footer class="container-fluid bg-dark text-white text-center">
    <div class="center">
      <img src="images/footerimg.jpg" class="circle" alt="">
    </div>
    <div class="row">
      <div class="col-12 py-4">
        &copy; 2023 Tugas Membuat Web
      </div>
      <h1 id="slogan">"Toko yang menyediakan semua makanan hanya ada disini,Pastinya murah dan kenyang"</h1>
      <br><br>
      <hr class="text-info">
      <div class="col-2">
        <h5>Contact Person:</h5>
        081234567890-Aditya
      </div>
      <div class="col-2">
        <h5>Sosial :</h5>
        <a href="Youtube.com">Youtube</a><br>
        <a href="Facebook.com">Facebook</a><br>
        <a href="Instagram.com">Instagram</a>
      </div>
      <div class="col-2">
        <p class="mb-1">&copy; 2017-2023 ACakes</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </div>
    </div>
    </div>
  </footer>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script src="fontawesome/js/all.min.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>