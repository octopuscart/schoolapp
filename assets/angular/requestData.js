Admin.controller('requestDataController', function ($scope, $http, $timeout, $interval) {
    $scope.resultData = {"tablename": gbltablename, "url": gblurl, "status": "0", "list": []};
    $scope.getData = function () {
        $scope.resultData.status = '1';
        $scope.checkUnseenData();
        $http.get($scope.resultData.url + "/" + gbltablename).then(function (resultdata) {
            $scope.resultData.status = '0';
            $scope.resultData.list = resultdata.data;

        }, function () {
            $scope.resultData.status = '0';
        });
    }


    $scope.approveData = function (post_id, tablename) {
        Swal.fire({
            title: 'Prcessing...',
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        });
        $http.get($scope.resultData.url + "Get/" + post_id + "/" + tablename).then(function () {
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

    $scope.approveDataSingle = function (post_id) {
        $scope.approveData(post_id, gbltablename);
    }


    $scope.deleteDataSingle = function (postid) {
        $scope.deleteData(postid, gbltablename, $scope.resultData.url + "Delete/" + postid + "/" + gbltablename);
    }


 $scope.deleteDataAll = function (postid, tablename) {
        $scope.deleteData(postid, tablename, rootBaseUrl + "localApi/classDataDelete/" + postid + "/" + tablename);
    }

    $scope.deleteData = function (postid, tablename, deleteurl) {
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
                $scope.doDelete(postid, tablename, deleteurl);
            }
        })
    }

    $scope.deleteDataTable = function (postid) {
        $scope.deleteData(postid, gbltablename, gbdeleteurl + "/" + postid + "/" + gbltablename);
    }

    $scope.deleteDataTable2 = function (postid, tablename) {
        $scope.deleteData(postid, gbltablename, gbdeleteurl + "/" + postid + "/" + tablename);
    }


    $scope.doDelete = function (post_id, tablename, deleteurl) {
        Swal.fire({
            title: 'Prcessing...',
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        })
        $http.get(deleteurl).then(function () {
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
    $scope.selected = {};

    $scope.detailPost = function (postobj) {
        $("#modal-dialog").modal("show")
        $scope.selected = postobj
    }
})









Admin.controller('galleryController', function ($scope, $http, $timeout, $interval) {




    $scope.resultData = {"tablename": gbltablename, "url": gblurl, "status": "0", "list": []};
    $scope.getData = function () {
        $scope.resultData.status = '1';
        $scope.checkUnseenData();
        $http.get($scope.resultData.url).then(function (resultdata) {
            $scope.resultData.status = '0';
            $scope.resultData.list = resultdata.data;
            $timeout(function () {
                new CBPGridGallery(document.getElementById('gallery'));
            }, 1000)

        }, function () {
            $scope.resultData.status = '0';
        });
    }


    $scope.approveData = function (post_id, tablename) {
        Swal.fire({
            title: 'Prcessing...',
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        });
        $http.get($scope.resultData.url + "Get/" + post_id + "/" + tablename).then(function () {
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

    $scope.approveDataSingle = function (post_id) {
        $scope.approveData(post_id, gbltablename);
    }


    $scope.deleteDataSingle = function (postid) {
        $scope.deleteData(postid, gbltablename, $scope.resultData.url + "Delete/" + postid + "/" + gbltablename);
    }


   




    $scope.deleteData = function (postid, tablename, deleteurl) {
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
                $scope.doDelete(postid, tablename, deleteurl);
            }
        })
    }

    $scope.deleteDataTable = function (postid) {
        console.log(gbdeleteurl);
        $scope.deleteData(postid, gbltablename, gbdeleteurl + "/" + postid + "/" + gbltablename);
    }

    $scope.deleteDataTable2 = function (postid, tablename) {
        $scope.deleteData(postid, gbltablename, gbdeleteurl + "/" + postid + "/" + tablename);
    }


    $scope.doDelete = function (post_id, tablename, deleteurl) {
        Swal.fire({
            title: 'Prcessing...',
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        })
        $http.get(deleteurl).then(function () {
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
    $scope.selected = {};

    $scope.detailPost = function (postobj) {
        $("#modal-dialog").modal("show")
        $scope.selected = postobj
    }
})
