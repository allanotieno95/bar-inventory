<?php include 'header.php' ;?>
    <!--Main body Content-->
        <div class="container main-body" ng-app="MyApp" ng-controller="MyController" >
            <div class="row">
                <div class="col-md-12">
                   <form role="form" ng-submit="submitForm()">
                       <div class="container">
                       <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input type="text" name="item_date" class="form-control icon" placeholder="Date" value="<?php echo"$today" ;?>" readonly>
                        </div>
                            <span ng-show="errorItemDate" class="error">{{errorItemDate}}</span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-glass"></i></span>
                            <select ng-model="sales.pname" ng-change="showSelectValue(sales.pname)" name="pname" class="form-control icon">
                                <option value="" >Select Drink</option> 
                                <option  ng-repeat="x in products" value="{{ x.pid }}" >{{ x.pname }}</option> 
                            </select>
                        </div>
                            <span ng-show="errorPName" class="error" >{{errorPName}}</span> 
                        </div>
                       </div><br>
                        
                       <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-stats"></i></span>
                            <input ng-model="sales.noinstock" type="text" name="noinstock"  ng-change="calculateTotal()" class="form-control icon" placeholder="Opening Stock" readonly>
                        </div>
                            <span ng-show="errorNoinStock" class="error" >{{errorNoinStock}}</span> 
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-plus"></i></span>
                            <input ng-model="sales.addstock" type="text" class="form-control icon" name="addstock"
ng-change="calculateTotal()" placeholder="Add Stock">
                        </div>
                            <span ng-show="errorAddStock" class="error" >{{errorAddStock}}</span> 
                        </div>
                       </div><br>
                       
                       <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-gift"></i></span>
                            <input ng-model="sales.totalinstock" type="text" name="totalinstock" class="form-control icon" placeholder="Total in Stock" readonly>
                        </div>
                            <span ng-show="errorTotalinStock" class="error" >{{errorTotalinStock}}</span> 
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-equalizer"></i></span>
                            <input ng-model="sales.closingstock" type="text" name="closingstock" class="form-control icon" placeholder="Closing Stock"  ng-change="calculateSales()">
                        </div>
                            <span ng-show="errorClosingStock" class="error" >{{errorClosingStock}}</span> 
                        </div>
                       </div><br>
                       
                       <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-shopping-cart"></i></span>
                            <input ng-model="sales.sales" type="text" name="sales" class="form-control icon" placeholder="Total Sales" ng-change="calculateSales()" readonly>
                        </div>
                            <span ng-show="errorSales" class="error" >{{errorSales}}</span> 
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-usd"></i></span>
                            <input ng-model="sales.priceperunit" type="text" name="priceperunit" class="form-control icon" placeholder="Price Per Unit" readonly>
                        </div> 
                            <span ng-show="errorPricePerUnit" class="error" >{{errorPricePerUnit}}</span>
                        </div>
                       </div><br>
                       
                       <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-usd"></i></span>
                            <input ng-model="sales.totalsales" type="text" name="totalsales" class="form-control icon" placeholder="Total Amount" readonly>
                        </div> 
                            <span ng-show="errorTotalSales" class="error" >{{errorTotalSales}}</span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="input-group">
                            <span class="input-group-addon icon"><i class="glyphicon glyphicon-blackboard"></i></span>
                            <select ng-model="sales.remarks" name="remarks" class="form-control icon">
                                <option value="">Remarks</option>
                                <option value="good">Good</option>
                                <option value="average">Average</option>
                                <option value="poor">Poor</option>
                            </select>
                        </div> 
                            <span ng-show="errorRemarks" class="error" >{{errorRemarks}}</span>
                        </div>
                       </div><br>
                           <div class="form-group">
                            <input type="submit" class="btn blue-btn" value="Update" name="update">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>  
    <!--End of Naun body Content-->
    <!--Including the footer-->
    <?php require_once('footer.php');?>