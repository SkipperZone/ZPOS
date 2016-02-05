(function(){
    var app = angular.module('tutapos', [ ]);
app.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });
 
                event.preventDefault();
            }
        });
    };
});

    app.controller("SearchItemCtrl", [ '$scope', '$http', function($scope, $http) {
        $scope.items = [ ];
        $http.get('api/item').success(function(data) {
            $scope.items = data;
        });
        $scope.saletemp = [ ];
        $scope.newsaletemp = { };
        $http.get('api/saletemp').success(function(data, status, headers, config) {
            $scope.saletemp = data;
        });

        $scope.onKeyPressResult = "";
        $scope.searchKeyword    = "";
        // Utility functions

        var getKeyboardEventResult = function (keyEvent, keyEventDesc)
        {
          return keyEventDesc + " (keyCode: " + (window.event ? keyEvent.keyCode : keyEvent.which) + ")";
        };
    
        $scope.getValue = function ($event) {
          if (event.keyCode == 13) {
            $http.get('api/scan/' + $scope.searchKeyword ).success(function(data) {
                $scope.items = data;
                
                angular.forEach($scope.items, function(item, key){
                    $http.post('api/saletemp', { item_id: item.id, cost_price: item.cost_price, selling_price: item.selling_price }).
                    success(function(data, status, headers, config) {
                        $scope.saletemp.push(data);
                        $http.get('api/saletemp').success(function(data) {
                        $scope.saletemp = data;
                        });
                    });
                 });
            
                });
            $scope.searchKeyword = '';
            }
        }

        $scope.addSaleTempBar = function($event) {
             $scope.onKeyPressResult = getKeyboardEventResult($event, "Key press");
            // alert('Hello World! ' + $scope.searchKeyword);
            // alert('Hello World! ' + $scope.searchKeyword);
            if (event.keyCode == 13) {
                // loadItems($scope.mysearch);
                alert('Hello World! ' + $scope.mysearch);
            }

            // $http.get('api/scan/' + $scope.searchKeyword ).success(function(data) {
            //     $scope.items = data;
            //    angular.forEach($scope.items, function(item, key){
            //     // if(value.id == "1")
            //     //     console.log("username is thomas");
            // $http.post('api/saletemp', { item_id: item.id, cost_price: item.cost_price, selling_price: item.selling_price }).
            // success(function(data, status, headers, config) {
            //     $scope.saletemp.push(data);
            //         $http.get('api/saletemp').success(function(data) {
            //         $scope.saletemp = data;
            //         });
            // });
            //      });
            
            // });
        }
        $scope.addSaleTemp = function(item, newsaletemp) {
            $http.post('api/saletemp', { item_id: item.id, cost_price: item.cost_price, selling_price: item.selling_price }).
            success(function(data, status, headers, config) {
                $scope.saletemp.push(data);
                    $http.get('api/saletemp').success(function(data) {
                    $scope.saletemp = data;
                    });
            });
        }
        $scope.updateSaleTemp = function(newsaletemp) {
            
            $http.put('api/saletemp/' + newsaletemp.id, { quantity: newsaletemp.quantity, total_cost: newsaletemp.item.cost_price * newsaletemp.quantity,
                total_selling: newsaletemp.item.selling_price * newsaletemp.quantity }).
            success(function(data, status, headers, config) {
                
                });
        }
        $scope.removeSaleTemp = function(id) {
            $http.delete('api/saletemp/' + id).
            success(function(data, status, headers, config) {
                $http.get('api/saletemp').success(function(data) {
                        $scope.saletemp = data;
                        });
                });
        }
        $scope.sum = function(list) {
            var total=0;
            angular.forEach(list , function(newsaletemp){
                total+= parseFloat(newsaletemp.selling_price * newsaletemp.quantity);
            });
            return total;
        }

    }]);
})();