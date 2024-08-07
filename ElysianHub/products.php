<?php
include 'header.php';
?>
<!-- ANWAR CSS starts-->
<style type="text/css">
    .active2{
        font-weight: bold;
        border-style: solid none solid solid;
}
    a:hover {
 cursor:pointer;
}
</style>
<!-- ANWAR CSS ends-->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Shop</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left">
                                <div class="toolbar-sorter-right">
                                    <span>Sort by </span>
                                   <select id="basic" class="selectpicker show-tick form-control sortbyselect" data-placeholder="$ USD">
                                    <option data-display="Select">Nothing</option>
                                    <option value="htl">High Price → Low Price</option>
                                    <option value="lth">Low Price → High Price</option>
                                </select>
                                </div>
                                <p>Buy, What you need!</p>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                                <ul class="nav nav-tabs ml-auto">
                                    <li>
                                        <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row" id="gridview">
                                       
                                  
                                        
                                      <?php
$sql = "SELECT product.*,category.categorytype,seller.compname FROM product LEFT JOIN category ON product.categoryid=category.categoryid LEFT JOIN seller ON seller.comp_id=product.comp_id WHERE product.status='Active'";
if($_GET[categoryid] != "")
{
    $sql = $sql . " AND product.categoryid='$_GET[categoryid]'";
}
if($_GET[searchquerywrong] != "")
{
    $sql = $sql ." AND product.title LIKE '%$_GET[searchquerywrong]%'";
}
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
        $sqledit = "SELECT * FROM product_image WHERE productid='$rs[0]'";
        $qsqledit = mysqli_query($con,$sqledit);
        $rsedit = mysqli_fetch_array($qsqledit);
        if($rsedit[imgpath] == "")
        {
            $imgproduct = "themes/images/No-image-found.jpg";
        }
        else if(file_exists("imgproduct/".$rsedit[imgpath]))
        {
            $imgproduct = "imgproduct/".$rsedit[imgpath];
        }
        else
        {
            $imgproduct = "themes/images/No-image-found.jpg";
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
                                    } ?>
                                      
                                    
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="list-view">
                                    
                                  
                                    <?php
$sql = "SELECT product.*,category.categorytype,seller.compname FROM product LEFT JOIN category ON product.categoryid=category.categoryid LEFT JOIN seller ON seller.comp_id=product.comp_id WHERE product.status='Active'";
if($_GET[categoryid] != "")
{
    $sql = $sql . " AND product.categoryid='$_GET[categoryid]'";
}
if($_GET[searchquerywrong] != "")
{
    $sql = $sql ." AND product.title LIKE '%$_GET[searchquery]%'";
}
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
        $sqledit = "SELECT * FROM product_image WHERE productid='$rs[0]'";
        $qsqledit = mysqli_query($con,$sqledit);
        $rsedit = mysqli_fetch_array($qsqledit);
        if($rsedit[imgpath] == "")
        {
            $imgproduct = "themes/images/No-image-found.jpg";
        }
        else if(file_exists("imgproduct/".$rsedit[imgpath]))
        {
            $imgproduct = "imgproduct/".$rsedit[imgpath];
        }
        else
        {
            $imgproduct = "themes/images/No-image-found.jpg";
        }

                                   echo "<div class='list-view-box'>
                                        <div class='row' style='border:1px solid rgba(0,0,0,0.5);'>
                                            <div class='col-sm-6 col-md-6 col-lg-4 col-xl-4'>
                                                <div class='products-single fix'>
                                                    <div class='box-img-hover'>
                                                        <div class='type-lb'>
                                                        </div>
                                                        <img src='$imgproduct' class='img-fluid' alt='Image' style='height:270px;'>
                                                        <div class='mask-icon'>
                                                            <ul>
                                                                <li><a href='product-detail.php?productid=$rs[productid]' data-toggle='tooltip' data-placement='right' title='View'><i class='fas fa-eye'></i></a></li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-sm-6 col-md-6 col-lg-8 col-xl-8'>
                                                <div class='why-text full-width' style='overflow-wrap: break-word;'>
                                                   <h4>$rs[title]</h4>
                                                    <h5> ₹<del>$rs[costbd]</del>₹$rs[costad]</h5>
                                                    <h3>Seller-<b>$rs[compname]</b></h3>
                                                    <p>$rs[description]</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                                   } ?> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                       <div class="search-product">
                                <input class="form-control" placeholder="Search here..." value="" type="text" id="searchquery">
                                <button type="submit" id="sbutton"> <i class="fa fa-search"></i> </button>
                        </div>

                   <!-- <div class="row">
                <div class="col-md-2">
                    <input type="text" name="minimum_range" id="minimum_range" class="form-control" value="<?php echo $minimum_range; ?>" />
                </div>
                <div class="col-md-8" style="padding-top:12px">
                    <div id="price_range"></div>
                </div>
                <div class="col-md-2">
                    <input type="text" name="maximum_range" id="maximum_range" class="form-control" value="<?php echo $maximum_range; ?>" />
                </div>
            </div>-->

            <div class="filter-price-left2">
                            <div class="title-left">
                                <h3>Price</h3>
                            </div>
                            <div class="price-box-slider2">
                                <div id="price_range"></div>
                                <input type="hidden" name="minimum_range" id="minimum_range" class="form-control" value="0" readonly style="border:0; color:#fbb714; font-weight:bold;background-color:white;"/>
                                <input type="hidden" name="maximum_range" id="maximum_range" class="form-control" value="5000" readonly style="border:0; color:#fbb714; font-weight:bold;background-color:white;"/>
                                <p id="amount2" readonly style="border:0; color:#fbb714; font-weight:bold;background-color:white;width: auto;">&#8377;0 - &#8377;5000</p>
                            </div>
                           
</div>


              


 <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Categories</h3>
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                <div class="list-group-collapse sub-men">
                                    <a id="allcat" class="list-group-item list-group-item-action catmenu<?php if($_GET[categoryid] == ""){echo" active2";}?>" data-toggle="collapse" aria-expanded="<?php if($_GET[categoryid] == ""){echo"true";} else{echo"false";}?>">ALL <small class="text-muted"></small>
                                </a>
                                </div>
                                 <?php
                                $result1 = mysqli_query($con, "SELECT * FROM category WHERE status = 'Active'");
                                $c = 0;
                                while($row1=mysqli_fetch_array($result1))
                                { $c++;
                                ?>
                                <div class="list-group-collapse sub-men">
                                    <a id="<?php echo $row1[categoryid];?>" class="list-group-item list-group-item-action catmenu<?php if($_GET[categoryid] == $row1[categoryid]){echo" active2";}?>" href="#sub-men1" data-toggle="collapse" aria-expanded="<?php if($_GET[categoryid] == $row1[categoryid]){echo"true";} else{echo"false";}?>" aria-controls="sub-men<?php echo $c;?>"><?php echo $row1[categorytype];?>
                                </a>
                                    <div class="collapse subcatmenus<?php if($_GET[categoryid] == $row1[categoryid]){echo" show";}?>" id="sub-menu<?php echo $row1[categoryid];?>" data-parent="#list-group-men">
                                        <div class="list-group">
                                             <a id="a<?php echo $row1[categoryid];?>" class="list-group-item list-group-item-action subcatmenu<?php if($_GET[categoryid] == $row1[categoryid]){echo" active";}?>">All <input type="hidden" name="subcategoryid" value="allsubcat"> </a>
                                               <?php
                                            $result2 = mysqli_query($con, "SELECT * FROM sub_category WHERE status = 'Active' AND categoryid=$row1[categoryid]");
                                            $listcount = 0;
                                            while($row2=mysqli_fetch_array($result2))
                                            { 
                                            ?>
                                            <a id="a<?php echo $row1[categoryid];?>" class="list-group-item list-group-item-action subcatmenu" ><?php echo $row2[subcategorytype];?> <input type="hidden" name="subcategoryid" value="<?php echo $row2[subcategoryid];?>"> </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                               <?php } ?>
                              
                            </div>
                        </div>





















                         <?php /* <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Categories</h3>
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                <?php
                                $result1 = mysqli_query($con, "SELECT * FROM category WHERE status = 'Active'");
                                $c = 0;
                                while($row1=mysqli_fetch_array($result1))
                                { $c++;
                                ?>
                                <div class="list-group-collapse sub-men">
                                    <a class="list-group-item list-group-item-action" href="#sub-men1" data-toggle="collapse" <?php if($_GET[categoryid]==$row1[categoryid]){echo"aria-expanded='true'";} else{echo "aria-expanded='false'";}?> aria-controls="<?php echo "sub-men$c"; ?>"><?php echo $row1[categorytype];?> <small class="text-muted">(100)</small>
                                </a>
                                    <div <?php if($_GET[categoryid]==$row1[categoryid]){echo"class='collapse show'";} else{echo"class='collapse'";} ?> id="sub-men1" data-parent="#list-group-men">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action active"> <small class="text-muted">All </small></a>
                                            <?php
                                            $result2 = mysqli_query($con, "SELECT * FROM sub_category WHERE status = 'Active' AND categoryid=$row1[categoryid]");
                                            $listcount = 0;
                                            while($row2=mysqli_fetch_array($result2))
                                            { 
                                            ?>
                                            <a href="#" class="list-group-item list-group-item-action"> <small class="text-muted"><?php echo $row2[subcategorytype]; ?> (50)</small></a>
                                            <?php } ?>
                                            <!--<a href="#" class="list-group-item list-group-item-action">Fruits 2 <small class="text-muted">(10)</small></a>-->
                                           
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="list-group-collapse sub-men">
                                    <a class="list-group-item list-group-item-action" href="#sub-men2" data-toggle="collapse" aria-expanded="false" aria-controls="sub-men2">Vegetables 
                                <small class="text-muted">(50)</small>
                                </a>
                                    <div class="collapse" id="sub-men2" data-parent="#list-group-men">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action">Vegetables 1 <small class="text-muted">(10)</small></a>
                                            <a href="#" class="list-group-item list-group-item-action">Vegetables 2 <small class="text-muted">(20)</small></a>
                                            <a href="#" class="list-group-item list-group-item-action">Vegetables 3 <small class="text-muted">(20)</small></a>
                                        </div>
                                    </div>
                                </div>-->
                                <?php } ?>
                            </div>
                        </div> <?php */ ?>

                       <?php /* <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Categories</h3>
                            </div>
                           <div class="list-group">
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <?php
                    $query = "SELECT * FROM category WHERE status = 'Active'";
                    $qsql = mysqli_query($con,$query);
                            while($rs = mysqli_fetch_array($qsql))
                    
                    {
                    echo "<div class='list-group-item checkbo'>";
                    if($_GET[categoryid] != "")
                    {    
                    if($_GET[categoryid] != $rs[categoryid])
                        { echo "<label><input type='checkbox' class='common_selector maincat' value='$rs[categorytype]'> 
                            $rs[categorytype]</label>"; 
                        }
                        else
                        {
                            echo "<label><input type='checkbox' class='common_selector maincat' value='$rs[categorytype]' checked> 
                $rs[categorytype]</label>";
                        }
                    } 
                else{
                echo "<label><input type='checkbox' class='common_selector maincat' value='$rs[categorytype]' checked> 
                $rs[categorytype]</label>";
                     }
                    echo "</div>";
                     }
                    ?>
                    </div>
                </div>
                        </div>

                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Sub Categories</h3>
                            </div>
                           <div class="list-group">
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;" id="subcatlist">
                    <?php
                    $subcatquery = "SELECT * FROM sub_category WHERE status = 'Active'";
                    if($_GET[categoryid] != "")
                    {
                        $subcatquery = $subcatquery . " AND categoryid = $_GET[categoryid]";
                    }
                    $qsubcatquery = mysqli_query($con,$subcatquery);
                            while($rs2 = mysqli_fetch_array($qsubcatquery))
                    
                    {
                    echo "<div class='list-group-item checkbox'>";
                    echo "<label><input type='checkbox' class='subcat_selector subcat' value='$rs2[subcategorytype]' checked>$rs2[subcategorytype]</label>";
                    echo "</div>";
                     }
                    ?>
                    </div>
                </div>  
                        </div> */?>

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
    
<?php
include 'ourpartners.php';
include 'footer.php';
?>