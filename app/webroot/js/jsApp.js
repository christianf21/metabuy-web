(function(){
    
    var app = angular.module("system", []);
    
    var base = "http://localhost/nikebot/web";
    
    app.controller("CartController", function(){
        
        this.products = [
            {
                title: "Un Producto",
                price: 2.95,
                quantity: 1,
                icon: base+"/img/icon-complete.png"
            },
            {
                title: "Otro Producto",
                price: 7.95,
                quantity: 4,
                icon: base+"/img/icon-basic.png"
            },
            {
                title: "Cuanto mas Producto",
                price: 7.95,
                quantity: 4,
                icon: base+"/img/icon-basic.png"
            }
        ];
        
        this.remove = function(item){
            var id = item.id;
            var index = this.products.indexOf(item);
            
            this.products.splice(index,1);
        };
        
        
    });
    
})();