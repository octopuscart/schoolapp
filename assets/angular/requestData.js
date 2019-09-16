Admin.controller('requestDataController', function ($scope, $http, $timeout, $interval) {
    $scope.resultData = {"tablename": gbltablename, "url": gblurl, "status": "0", "list": []};
    $scope.getData = function () {
        $scope.resultData.status = '1';
        $http.get($scope.resultData.url + "/" + gbltablename).then(function (resultdata) {
            $scope.resultData.status = '0';
            $scope.resultData.list = resultdata.data;
        }, function () {
            $scope.resultData.status = '0';
        });
    }

    $scope.approveData = function (post_id) {
        Swal.fire({
            title: 'Prcessing...',
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        });
        var formData = new FormData();
        formData.append('post_id', post_id);
        formData.append('table_name', gbltablename);
        $http.post($scope.resultData.url, formData).then(function () {
            Swal.fire({
                title: 'Approved',
                type: 'success',
                timer: 1500,
                showConfirmButton: false,
                animation: true,
                onClose: () => {
                    $scope.getData();
                }
            })
        }, function () {
            Swal.fire({
                title: 'Erro 500',
                type: 'error',
                timer: 1500,
                showConfirmButton: false,
            })
        })
    }




    $scope.deleteData = function (postid) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $scope.doDelete(postid);
            }
        })
    }


    $scope.doDelete = function (post_id) {

        Swal.fire({
            title: 'Prcessing...',
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        })
        var formData = new FormData();
        formData.append('post_id', post_id);
        formData.append('table_name', gbltablename);
        $http.post($scope.resultData.url + "Delete", formData).then(function () {
            Swal.fire({
                title: 'Deleted',
                type: 'success',
                timer: 1500,
                showConfirmButton: false,
                animation: true,
                onClose: () => {
                    $scope.getData();
                }
            })
        }, function () {

            Swal.fire({
                title: 'Erro 500',
                type: 'error',
                timer: 1500,
                showConfirmButton: false,
            })
        })

    }




    $scope.getData();
})




