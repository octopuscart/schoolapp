/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Admin.controller('rootController', function ($scope, $http, $timeout, $interval) {
    var notify_url = rootBaseUrl + "localApi/notificationUpdate";
    $scope.rootData = {'notifications': []};
    $http.get(notify_url).then(function (rdata) {
        $scope.rootData.notifications = rdata.data;
    }, function () {})

    $scope.orderGlobleCheck = {
        "unssen": 0,
        "unssenmail": 0,
        "unseenorder": 0,
        "unseenemail": 0,
        "unseendata": "", "sound": "",
        "unseenemail": [],
        "allNotifications": []};


    $scope.orderGlobleCheck.sound = new Howl({
        src: [rootAssetUrl + 'assets/sound/sendemail.mp3']
    });




    $scope.checkUnseenOrder = function () {
         var notificationlist = [];
        var order_status_url = rootBaseUrl + "localApi/checkUnseenOrder";
        $http.get(order_status_url).then(function (rdata) {
            $scope.orderGlobleCheck.unseendata = rdata.data;
            $scope.orderGlobleCheck.unseenorder = rdata.data.length;
            if (rdata.data.length) {
                $scope.orderGlobleCheck.unseen = 1;
                for (nt2 in rdata.data) {
                    var temp1 = rdata.data[nt2]; 
                    var tempdata = {
                        'title':"Order No. #"+temp1.id,
                        'description':"You have new order from "+temp1.order_source,
                        'tag':"order",
                        'data':temp1,
                    }
                    notificationlist.push(tempdata);
                }

            } else {
                $scope.orderGlobleCheck.unseen = 0;
            }
            var inboxOrderMail = rootBaseUrl + "localApi/inboxOrderMailIndb";
            $http.get(inboxOrderMail).then(function (rmdata) {
                $scope.orderGlobleCheck.unseenemail = rmdata.data;
                $scope.orderGlobleCheck.unssenmail = rmdata.data.length;
                if (rmdata.data.length) {
                    $scope.orderGlobleCheck.unssenmail = 1;
                    for (nt1 in rmdata.data) {
                       
                        var temp2 = rmdata.data[nt1]; 
                        var tempdata2 = {
                        'title':"New Email Received",
                        'description':""+temp2.subject,
                        'tag':"email",
                        'data':temp2,
                    }
                    notificationlist.push(tempdata2);
                        
                    }
                } else {
                    $scope.orderGlobleCheck.unssenmail = 0;
                }
                
                $scope.orderGlobleCheck.allNotifications = [];
               $scope.orderGlobleCheck.allNotifications = notificationlist;
                console.log($scope.orderGlobleCheck);
                console.log($scope.orderGlobleCheck.unseen, $scope.orderGlobleCheck.unssenmail);
                if (($scope.orderGlobleCheck.unseen == 1) || ($scope.orderGlobleCheck.unssenmail == 1)) {
//                    $("#modal-notification").modal("show");
                    var messgage = "";
                    var totalnotify = $scope.orderGlobleCheck.unseenorder + $scope.orderGlobleCheck.unssenmail;
                    if ($scope.orderGlobleCheck.unseenorder) {
                        messgage = messgage + "" + $scope.orderGlobleCheck.unseenorder + " order(s) for review.";
                    }

                    if ($scope.orderGlobleCheck.unseenemail) {
                        messgage = messgage + "\n" + "" + $scope.orderGlobleCheck.unssenmail+ " unread email(s).";

                    }

                    messgage = messgage + "\n Click here to view details.";

                    var text = messgage;
                    var notification = new Notification('You have ' + totalnotify + ' unseen notification(s).', {body: text, image: globlelogo, icon: globleicon});
                    notification.onclick = function (event) {
                        event.preventDefault(); // prevent the browser from focusing the Notification's tab

                        window.location = rootBaseUrl + "Messages/notifications"
                    }
                } else {
//                    $("#modal-notification").modal("hide");

                }
            })
        })

        var inboxOrderMail = rootBaseUrl + "localApi/inboxOrderMail";
        $http.get(inboxOrderMail).then(function (rdata) {
        })

    }





    $scope.pouseSound = function () {
        $scope.orderGlobleCheck.sound.pause();
    }

    $scope.playSound = function () {
        $scope.orderGlobleCheck.sound.play();

    }

    contextgbl.resume().then(() => {
        console.log('Playback resumed successfully');
    });
    $("#soundButton").click()





    var orderpath = window.location.pathname;
    var orderlist = orderpath.split("orderdetails")
    if (orderlist.length == 2) {
    } else {
        $interval(function () {
            $scope.checkUnseenOrder();
        }, 10000)
        $scope.checkUnseenOrder();
    }

})


window.addEventListener('load', function () {
    // At first, let's check if we have permission for notification
    // If not, let's ask for it
    if (window.Notification && Notification.permission !== "granted") {
        Notification.requestPermission(function (status) {
            if (Notification.permission !== status) {
                Notification.permission = status;
            }
        });
    }
    if (Notification.permission == 'denied') {
        Notification.requestPermission(function (status) {

        });
    }


    var button = document.getElementsByTagName('button')[0];

    button.addEventListener('click', function () {
        // If the user agreed to get notified
        // Let's try to send ten notifications
        if (window.Notification && Notification.permission === "granted") {
            var i = 0;
            // Using an interval cause some browsers (including Firefox) are blocking notifications if there are too much in a certain time.
            var interval = window.setInterval(function () {
                // Thanks to the tag, we should only see the "Hi! 9" notification 
                var n = new Notification("Hi! " + i, {tag: 'soManyNotification'});
                if (i++ == 9) {
                    window.clearInterval(interval);
                }
            }, 200);
        }

        // If the user hasn't told if he wants to be notified or not
        // Note: because of Chrome, we are not sure the permission property
        // is set, therefore it's unsafe to check for the "default" value.
        else if (window.Notification && Notification.permission !== "denied") {
            Notification.requestPermission(function (status) {
                // If the user said okay
                if (status === "granted") {
                    var i = 0;
                    // Using an interval cause some browsers (including Firefox) are blocking notifications if there are too much in a certain time.
                    var interval = window.setInterval(function () {
                        // Thanks to the tag, we should only see the "Hi! 9" notification 
                        var n = new Notification("Hi! " + i, {tag: 'soManyNotification'});
                        if (i++ == 9) {
                            window.clearInterval(interval);
                        }
                    }, 200);
                }

                // Otherwise, we can fallback to a regular modal alert
                else {
                    alert("Hi!");
                }
            });
        }

        // If the user refuses to get notified
        else {
            // We can fallback to a regular modal alert
            alert("Hi!");
        }
    });
});




