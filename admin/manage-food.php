<?php include('partials/menu.php') ?>

<div class="main-content">
           <div class="wrapper">
               <h1>Manage Food</h1>
        
            <br /><br />
           

             <!--Button to Add Food-->
             <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

             <br /> <br /> <br />

            <?php
               if(isset($_SESSION['add']))
               {
                   echo $_SESSION['add'];
                   unset($_SESSION['add']);
                   
               }
            ?>
        
            </div>
</div>
<?php include('partials/footer.php') ?>