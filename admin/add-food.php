<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>

                <td>
                    <input type="text" name="title" placeholder=" Title of the Food">

                </td>
            </tr>
            <tr>
                   <td>Description:</td>
                   <td>
                       <textarea name="description"  cols="30" rows="5" placeholder="Description of the Food"></textarea>

                   </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">

                </td>
            </tr>
            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">

                          <?php
                            //Create PHP Code to display categories from Database
                            //1. Create SQL to get active categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            
                            //Execute Query
                            $res = mysqli_query($conn, $sql);

                            //Count rows to check whether we have categories or not 
                            $count = mysqli_num_rows($res);

                            //If count is greater than zero, we have categories else we do not have categories
                            if($count>0)
                            {
                                //We have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                     //get the deatails of categories
                                     $id = $row['id'];
                                     $title =$row['title'];
                                     ?>
                                         <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                     <?php

                                }
                            }
                            else
                            {
                                //We do not have category

                                ?>
                                <option value="0">No category Found</option>
                                <?php

                            }

                            //2.Display on Dropdown

                          ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured"value="No">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active"value="No">No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="sabmit" value="Add Food" class="btn-secondary">

                </td>
            </tr>


           
        </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>