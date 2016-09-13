        
        
        
    <!--Including javascript files to the site-->
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
	<script type="text/javascript" src="js/jquery.1.11.1.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
    <!--Datepicker code -->
    <script>
        $(document).ready(function(){
            var date_input=$('input[name="date1"]'); //our date input has the name "date"
            var date_input2=$('input[name="date2"]'); //our date input has thr name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'yyyy/mm/dd',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
            date_input2.datepicker({
                format: 'yyyy/mm/dd',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
        })
    </script>
    </body>
</html>