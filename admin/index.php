<?php include('partials/menu.php') ?>


    <!-- Main content section starts-->
        <div class="main-content">
           <div class="wrapper">
               <h1> DASHBOARD</h1>
                <br><br>
                <?php   
               if(isset($_SESSION['login']))
             {
                 echo $_SESSION['login'];
                 unset($_SESSION['login']);
                 
             }
               ?>
                <br><br> 
               <div class="col-4 text-center">
                       <h5>5</h5>
                       <br />
                       Categories
                   </div>
                   
                   <div class="col-4 text-center">
                       <h5>5</h5>
                       <br />
                       Categories
                   </div>

                   <div class="col-4 text-center">
                       <h5>5</h5>
                       <br />
                       Categories
                   </div>

                   <div class="col-4 text-center">
                       <h5>5</h5>
                       <br />
                       Categories
                   </div>
                   <div class="clearfix"></div>
            </div>
        </div>
    <!--Main content section Ends-->
    <?php include('partials/footer.php') ?>