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
        
        function updateTotal()
        {
            vm.total = 0;
            $.each(vm.products, function(i, item) {
                    vm.total += parseFloat(vm.products[i].price);
            });
        }
        
    }]); // FIN checkout controller
    
    
})();