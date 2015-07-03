(function(){
    
    var app = angular.module("system", []);
    var base = "http://localhost/nikebot/web";
    
    app.controller("CartController", [ '$http', function($http){
      
//        this.products = [
//            {
//                title: "test prod",
//                price: 2.95,
//                quantity:1
//            },
//            {
//                title: "please work",
//                price: 98.99,
//                quantity: 1
//            }
//        ];

        var vm = this;
      
        vm.products = [];
      
        this.loadProducts = function(){
            console.log("loading products...");
            
            $http.get( base+'/store/getCartProducts').
            success(function(data,status,headers,config){
                vm.products =  data.products;
                console.log("loaded!");
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
        
        
    }]);
    
})();