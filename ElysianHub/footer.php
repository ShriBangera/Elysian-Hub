<!-- Start Footer  -->
    <footer>
        <div class="footer-main">
            <div class="container"><hr>
				<div class="row">
                    <?php
                if(!isset($_SESSION[employeeid]))
                {
                    if(!isset($_SESSION[customerid]))
                    {
                        if(!isset($_SESSION[comp_id]))
                        {
                ?>
					 <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>For Admin</h4>
                            <ul>
                                <li><a href="employeelogin.php">Admin login</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php
                        }
                    }
                }
                ?>

                <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-top-box">
                            <h3>Social Media</h3>
                            <p>Follow us on Social Media</p>
                            <ul>
                                <li><a href="https://www.facebook.com/Meat-zone-107644254316241"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="https://twitter.com/BeyondMeat"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.linkedin.com/company/meat-shop"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.instagram.com/meatzone_a_house_for_taste/?hl=en"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="https://in.pinterest.com/abhishekrajora/meat-shop/?autologin=true"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <!--<li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>-->
                            </ul>
                        </div>
                    </div>
					 <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                <li>
                                         <p><a href="ourlocation.php"><i class="fas fa-map-marker-alt"></i>Address: 2nd Floor, Hybe building <br>Eshwar Nagar <br>Konkan Road,<br> Chennai, 578708</a> </p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+91 9997768970</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">elysianhub@gmail.com</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
					
				</div>
                <?php /*
				<hr>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About Freshshop</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> 
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p> 							
                        </div>
                    </div>
                   <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-top-box">
                            <h3>Newsletter</h3>
                            <form class="newsletter-box">
                                <div class="form-group">
                                    <input class="" type="email" name="Email" placeholder="Email Address*" />
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <button class="btn hvr-hover" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                   <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-top-box">
                            <h3>Business Time</h3>
                            <ul class="list-time">
                                <li>Monday - Friday: 08.00am to 05.00pm</li> <li>Saturday: 10.00am to 08.00pm</li> <li>Sunday: <span>Closed</span></li>
                            </ul>
                        </div>
                    </div>
                </div>*/ ?>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2024 <a href="index.php">ElysianHub</a></p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/inewsticker.js"></script>
    <script src="js/bootsnav.js."></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
    
    <!--anwarcode starts-->
    <!--tryslider-->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--try slider ends-->
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
           var currentpage = location.pathname.substring(location.pathname.lastIndexOf('/')+1);
            if(currentpage=='')
        {
            window.location.href='index.php';
        }
       var url = window.location;
    // Will only work if string in href matches with location
        //$('ul.nav a[href="' + url + '"]').parent().addClass('active');
    // Will also work for relative and absolute hrefs
        $('ul.nav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active').parent().parent().addClass('active');
    });
</script>
<script>
    /*
    $(document).ready(function(){
    //filter_data();
    function filter_data()
    {
        //$('.productgallery').html('<div id="loading" style="" ></div>');
        var action = 'load-productgallery';
        //var minimum_price = $('#hidden_minimum_price').val();
        //var maximum_price = $('#hidden_maximum_price').val();
        var cat = get_filter('maincat');
        var subcat = get_filter('subcat');
        var squery = $('#searchquery').val();
        //var sorder = "htl";
        //var sorder = $(".sortbyselect").val();
        var sorder = $('.sortbyselect').find(":selected").val();
        //alert(sorder);
        $.ajax({
            url:"gridview.php",
            method:"POST",
            data:{action:action, cat:cat, subcat:subcat, squery:squery, sorder:sorder, },
            success:function(data){
                $('#gridview').html(data);
            }
        });

        $.ajax({
            url:"listview.php",
            method:"POST",
            data:{action:action, cat:cat, subcat:subcat, squery:squery, sorder:sorder, },
            success:function(data){
                $('#list-view').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }


 $(".sortbyselect").change(function(){
     //alert("AJAX request successfully completed");
     filter_data();
   });

    $('#searchquery').keyup(function(){
  var se = $('#searchquery').val();
  filter_data();
  //if(se!='')
  //{filter_data();}
});


    $('.common_selector').click(function(){
        filter_data();
    });

$('.subcat_selector').click(function(){
        filter_data();
    });


 $('#slider-range').slider({
        range:true,
        min:1000,
        max:65000,
        values:[1000, 65000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });


 
 

});
    */
</script>


<script>


 
    
    $(document).ready(function(){
    //filter_data();
    function filter_data()
    {
        //$('.productgallery').html('<div id="loading" style="" ></div>');
        var action = 'load-productgallery';
        var minimum_range = $('#minimum_range').val();
        var maximum_range = $('#maximum_range').val();
        //var cat = get_filter('maincat');
        //var subcat = get_filter('subcat');
        var cat = $('div.sub-men a.active2').attr('id');
        var subcat = $('a.active input[name=subcategoryid]').val();
        //alert($('a.active input[name=subcategoryid]').val());
        var squery = $('#searchquery').val();
        //var sorder = "htl";
        //var sorder = $(".sortbyselect").val();
        var sorder = $('.sortbyselect').find(":selected").val();
        //alert(sorder);
        $.ajax({
            url:"gridview.php",
            method:"POST",
            data:{action:action, cat:cat, subcat:subcat, squery:squery, sorder:sorder, minimum_range:minimum_range, maximum_range:maximum_range},
            success:function(data){
                $('#gridview').html(data);
            }
        });

        $.ajax({
            url:"listview.php",
            method:"POST",
            data:{action:action, cat:cat, subcat:subcat, squery:squery, sorder:sorder, minimum_range:minimum_range, maximum_range:maximum_range},
            success:function(data){
                $('#list-view').html(data);
            }
        });
        //$('#searchquery').val('');
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }


 $(".sortbyselect").change(function(){
     //alert("AJAX request successfully completed");
     filter_data();
   });

 $('#searchquery').keyup(function(){
  var se = $('#searchquery').val();
  filter_data();
  //if(se!='')
  //{filter_data();}

    //$('#sbutton').click(function(){
  //var se = $('#searchquery').val();
  //filter_data();
  //if(se!='')
  //{filter_data();}
});

   $( "#price_range" ).slider({
        range: true,
        min: 0,
        max: 5000,
        values:[0, 5000],
        step:50,
        slide:function(event, ui){
            $("#minimum_range").val(ui.values[0]);
            $("#maximum_range").val(ui.values[1]);
            var minval = $('#minimum_range').val();
            var maxval = $('#maximum_range').val();
            $("div.price-box-slider2 p#amount2").html("&#8377;" + minval + " - &#8377;" + maxval); 
            filter_data();
          
        }
    });




$("a#allcat").click(function () {
        if(!$(this).hasClass('active2'))
        {
            $(".subcatmenus .active").removeClass("active");
            $("a.catmenu").removeClass("active2");
            $(this).addClass("active2");        
        }
        filter_data();
    });

   $("a.catmenu").click(function () {
   var catid = $(this).attr("id");
   //alert("id: " + catid);
    //$("#sub-menu"+String(this.id)).css("background-color","yellow");
        if(!$("div.sub-men div#sub-menu"+String(this.id)).hasClass('show'))
        {   if($(this).hasClass('collapsed'))
            {
              $(this).removeClass("collapsed");
              //$(this).addClass("active");        
            }
            $("div.sub-men div.show").removeClass("show");
            $("a.catmenu[aria-expanded='true']").attr("aria-expanded", "false");
            $(".sub-men div#sub-menu"+String(this.id)).addClass("show");
            $(this).attr("aria-expanded", "true");
            //$(this).addClass("active2");        
        }
        else
        {
            $("div.sub-men div.show").removeClass("show");
            $("a.catmenu[aria-expanded='true']").attr("aria-expanded", "false");
            if(!$(this).hasClass('collapsed'))
            {
              //$(this).removeClass("collapsed");
              $(this).addClass("collapsed");        
            }//$(".sub-men div#sub-menu"+String(this.id)).addClass("show");
            //$(this).attr("aria-expanded", "true");
        }
    });

     $("a.subcatmenu").click(function () {
        if(!$(this).hasClass('active'))
        {
            $(".subcatmenus .active").removeClass("active");
            $(this).addClass("active");        
        }
        var subcatmenuid = $(this).attr("id");
        var result = subcatmenuid.slice(1); 
        //alert(result);
        $("a.catmenu").removeClass("active2");
        $("a#"+result).addClass("active2");
        //alert($('a.active input[name=subcategoryid]').val());
        filter_data();
    });


 $('#slider-range').slider({
        range:true,
        min:1000,
        max:65000,
        values:[1000, 65000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });


 
 

});
    
</script>

    <!--anwar code ends-->
</body>
</html>