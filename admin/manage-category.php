<?php include('partials/menu.php') ?>

<div class="main-content">
           <div class="wrapper">
               <h1>Manage Category</h1>

               <br /><br />

               <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);

                    }
                ?>
                <br><br>
               <!--Button to Add Admin --->
               <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
               <br /><br />
               <table class="tbl-full">
                   <tr>
                   <th>S.N</th>
                   <th>Full Name</th>
                   <th>User Name</th>
                   <th>Actions</th>
                    </tr>

                     <tr>
                         <td>

                         </td>
                         <td>

                         </td>
                         <td>

                         </td>        
                        <td>
              
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a> 
                        </td>
                        </tr>
                         
                   
               </table>
        </div>
</div>
<?php include('partials/footer.php') ?>