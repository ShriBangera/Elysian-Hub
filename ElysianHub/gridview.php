<?php 
include("dbconnection.php");
?>
<?php
if(isset($_POST["action"]))
{
 $query = "
  SELECT product.*,category.categorytype,sub_category.subcategorytype,seller.compname FROM product LEFT JOIN category ON product.categoryid=category.categoryid LEFT JOIN sub_category ON product.subcategoryid=sub_category.subcategoryid LEFT JOIN seller ON seller.comp_id=product.comp_id WHERE product.status='Active'";
if(isset($_POST["minimum_range"], $_POST["maximum_range"]) && !empty($_POST["minimum_range"]) && !empty($_POST["maximum_range"]))
 {
  $query .= "
   AND costad BETWEEN '".$_POST["minimum_range"]."' AND '".$_POST["maximum_range"]."'";
 }
 if(isset($_POST["cat"]))
 {
  if ($_POST["cat"] !='allcat') {
    $cat_filter = $_POST["cat"];
    $query .= " AND category.categoryid = $cat_filter";
  }
 }
 if(isset($_POST["subcat"]))
 {
 if ($_POST["subcat"] !='allsubcat') 
    {
    $subcat_filter = $_POST["subcat"];
    $query .= " AND sub_category.subcategoryid = $subcat_filter";
    }
 }

if(isset($_POST["squery"]))
{
 $search = mysqli_real_escape_string($con, $_POST["squery"]);
 $query .= " AND (category.categorytype LIKE '%".$search."%'
  OR product.title LIKE '%".$search."%' 
  OR product.description LIKE '%".$search."%')";
}

if(isset($_POST["sorder"]))
{
  $sortingorder = $_POST["sorder"];
  if($sortingorder=='htl')
     {$query .= " ORDER BY product.costad DESC";}
   else if($sortingorder=='lth') {$query .= " ORDER BY product.costad ASC";}  
}

 $qsql = mysqli_query($con,$query);
while($rs = mysqli_fetch_array($qsql))
{
        $sqledit = "SELECT * FROM product_image WHERE productid='$rs[0]'";
        $qsqledit = mysqli_query($con,$sqledit);
        if(mysqli_num_rows($qsqledit)>=1)
        {
            $rsedit = mysqli_fetch_array($qsqledit);
            if(file_exists('imgproduct/'.$rsedit['imgpath']))
            {
                $imgproduct = 'imgproduct/'.$rsedit['imgpath'];
            }
            else
            {               
                $imgproduct = 'themes/images/No-image-found.jpg';
            }

        }   
         
        else
        {               
            $imgproduct = 'themes/images/No-image-found.jpg';
        }

    

         echo "<div class='col-sm-6 col-md-6 col-lg-4 col-xl-4'>
                                            <div class='products-single fix'>
                                                <div class='box-img-hover'>
                                                    <div class='type-lb'>
                                                    </div>
                                                    <img src='$imgproduct' style='height:300px;object-fit:contain;' class='img-fluid' alt='Image'>
                                                    <div class='mask-icon'>
                                                        <ul>
                                                            <li><a href='product-detail.php?productid=$rs[productid]' data-toggle='tooltip' data-placement='right' title='View'><i class='fas fa-eye'></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class='why-text' style='overflow-wrap: break-word;'>
                                                     <h4>$rs[title]</h4>
                                                     <h3>$rs[compname]</h3>
                                                     <h5>₹<del>$rs[costbd]</del>₹$rs[costad]</h5>
                                                </div>
                                            </div>
                                        </div>";
}
}
?>

