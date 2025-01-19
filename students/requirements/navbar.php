<style>
  /*============================ sidebar-menu style starts here ==============================*/

      .sidbtn{
        position: absolute;
        top: 15px;
        left: 15px;
        height: 45px;
        width: 45px;
        text-align: center;
        background: black;
        border-radius: 3px;
        cursor: pointer;
        transition: left 0.4s ease;
      }
      .sidbtn.click{
        left: 5%;   
      }
      .sidbtn span{
        color: white;
        font-size: 28px;
        line-height: 45px;
      }
      .sidbtn.click span:before{
        content: '\f00d';
      }
      .sidebar{
        position: fixed;
        width: 200px;
        height: 100%;
        right: -200px;
        background: black;
        transition: left 0.4s ease;
      }
      .sidebar.show{
        left: 0px; 
      }
      .sidebar .text{
        color: whitesmoke;
        font-size: 25px;
        font-weight: 600;
        line-height: 65px;
        text-align: center;
        background: #lelele;
        letter-spacing: 1px;
      }

      nav ul{
        background: black;
        height: 100%;
        width: 100%;
        list-style: none;
      }
      nav ul li{
        line-height: 60px;
        border-bottom: 1px solid rgb(122, 117, 117);
        margin-left: -40px;
      }
      nav ul li:last-child{
        border-bottom: 1px solid rgb(255, 255, 255);
      }
      nav ul li a{
        position: relative;
        color: whitesmoke;
        text-decoration: none;
        font-size: 18px;
        padding-left: 40px;
        font-weight: 500;
        display: block;
        width: 100%;
        border-left: 10px solid transparent;
      }
      nav ul li:hover a{
        color: cyan;
        background: #lelele;
        border-left-color: cyan;
        text-decoration: none;
      }

      .header-logo img{
        height: 180px;
        width: 420px;
      }

      @media(max-width: 700px){
        .header-logo img{
          height: 150px;
          width: 250px;
          margin-top: -47px;
          margin-left: -20px;
        }
      }
      /*=================== sidebar-menu style ends here ====================*/

</style>

<nav class="navbar navbar-expand-lg sticky-top" style="background: black; height: 80px;">
  <div class="sidbtn">
    <span class="fa fa-bars"></span>
  </div>

  <a href="#" class="navbar-brand header-logo" style="margin-left: 50px;">
    <img src="images/logo/header-logo.png">
    <!--<?php echo $pagename; ?>-->
  </a>

  <!--<h3 style="color: cyan; margin-left: 1%;"><?php echo $pagename; ?></h3>-->
</nav>

    

    <!--Code for Sidebar Menu-->
    <nav class="sidebar">
      <div class="text" style="line-height: 35px;">Hello, <br><?php echo $_SESSION['student_name']; ?></div>
      <ul>
        <li>
          <a href="dashboard.php"><i class="fa fa-qrcode"></i> Dashboard</a>
        </li>

        <li>
          <a href="profile.php"><i class="fa fa-user"></i> Profile</a>
        </li>

        <li>
          <a href="requirements/logout.php"><i class="fa fa-power-off"></i> Logout</a>
        </li>
      </ul>

    </nav>

    <!--JavaScript code for sidebar menu-->
    <script>
      $('.sidbtn').click(function(){
          $(this).toggleClass("click");
          $('.sidebar').toggleClass("show");
      });
      
      $('nav ul li').click(function(){
          $(this).addClass("active").siblings().removeClass("active");
      });
    </script>

    