(function(){
    
    var app = angular.module("system", []);
    var base = "http://localhost/nikebot/web";
    //var base = "http://primenikebot.com";
    
    app.controller("CartController", [ '$http', function($http){
        var vm = this;
        vm.products = [];
      
        this.loadProducts = function(){
            $http.get( base+'/store/getCartProducts').
            success(function(data,status,headers,config){
                vm.products =  data.products;
            }).
            error(function(data,status,headers,config){
                console.log("error: " + data);
            });
            
        };
      
        this.remove = function(item){
            var id = item.id;
            var index = vm.products.indexOf(item);
            
            vm.products.splice(index,1);
            
            $http.post( base+'/store/removeCartItem',{productid:id}).
            success(function(data,status,headers,config){
                console.log("success deletion of cart item");
            }).
            error(function(data,status,headers,config){
                console.log("error: " + data);
            });
            
        };
    }]); // FIN cart controller
    
    
    app.controller("CheckoutController", [ '$http', function($http){
        
        var vm = this;
        vm.products = [];
        vm.total = 0;
        vm.terms = false;
        
        this.updateTerms = function(){
            
            if(vm.terms === true)
                vm.terms = false;
            else
                vm.terms = true;
        };
        
        this.loadProducts = function(){
            
            $http.get( base+'/store/getCartProducts').
            success(function(data,status,headers,config){
                vm.products =  data.products;
                updateTotal();
            }).
            error(function(data,status,headers,config){
                console.log("error: " + data);
            });
        };
        
        this.remove = function(item){
            var id = item.id;
            var index = vm.products.indexOf(item);
            
            vm.products.splice(index,1);
            
            $http.post( base+'/store/removeCartItem',{productid:id}).
            success(function(data,status,headers,config){
                console.log("success deleting checkout product");
                updateTotal();
            }).
            error(function(data,status,headers,config){
                console.log("error: " + data);
            });
        };
        
        this.doCheckout = function () {
            
            if(!$("input[name='terms-check']:checked").length>0)
            {
                sweetAlert("Oops...", "You need to accept our Terms to continue!", "error");
            }
            else
            {
                $.blockUI({ message: "Just a moment...we're redirecting you to Paypal!" });
                var url = $("#checkout-location-url").val();
                window.location.href = url;
            }
            
        };
        
        this.processCheckout = function(){
            $.blockUI({ message: "We're authorizing your actions with Paypal, will take a few seconds!" });
        };
        
        function updateTotal()
        {
            vm.total = 0;
            $.each(vm.products, function(i, item) {
                    vm.total += parseFloat(vm.products[i].price);
            });
        }
        
    }]); // FIN checkout controller
    
    
})();