(function(){
    
    var app = angular.module("system", []);
    var base = "http://localhost/nikebot/web";
    
    app.controller("CartController", [ '$http', function($http){
      
      this.products = [];
      
        $http.get( base + '/store/getCartProducts').
            success(function(data,status,headers,config){
                this.products = data.products;
                console.log("success: " + JSON.stringify(data));
            }).
            error(function(data,status,headers,config){
                console.log("error: " + data);
            });
      
        this.remove = function(item){
            var id = item.id;
            var index = $scope.products.indexOf(item);
            
            this.products.splice(index,1);
        };
        
        
    }]);
    
})();