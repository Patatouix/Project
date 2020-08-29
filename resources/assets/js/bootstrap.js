
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo'

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.private('notification.admin')
    .listen('NotificationAdminEvent', (e) => {
        toastr.success(e.message, 'Message');
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "user/session",
            dataType: "json",
            data: {'rdv':e.rdv,'reservation':e.reservation},
            success: function(data) {
                $('.notifications-total').html(data.total);
                $('.notifications-rdvs-attente').html(data.rdvsAttente);
                $('.notifications-rdvs-confirme').html(data.rdvsConfirme);
                $('.notifications-reservations').html(data.reservations);
            }
        })
    });

window.Echo.private('notification.user.' + window.Laravel.user)
    .listen('NotificationUserEvent', (e) => {
        toastr.success(e.message, 'Message');
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "user/session",
            dataType: "json",
            data: {'rdv':e.rdv,'reservation':e.reservation},
            success: function(data) {
                $('.notifications-total').html(data.total);
                $('.notifications-rdvs').html(data.rdvs);
                $('.notifications-reservations').html(data.reservations);
            }
        })
    });

window.Echo.join('chat')
    .here((users) => {
        users.forEach(function(element){
            if(element.admin) {
                $('.user_list').append('<li id="user' + element.id + '" style="color:red;"><i class="fas fa-user-cog"></i> ' + element.name + ' ' + element.prenom + ' (admin)</li>');
            }
            else {
                $('.user_list').append('<li id="user' + element.id + '"><i class="fas fa-user"></i> ' + element.name + ' ' + element.prenom + '</li>');
            }
        });
    })
    .joining((user) => {
        if(user.admin) {
            $('.user_list').append('<li id="user' + user.id + '" style="color:red;"><i class="fas fa-user-cog"></i> ' + user.name + ' ' + user.prenom + ' (admin)</li>');
        }
        else {
            $('.user_list').append('<li id="user' + user.id + '"><i class="fas fa-user"></i> ' + user.name + ' ' + user.prenom + '</li>');
        }
    })
    .leaving((user) => {
        $('#user' + user.id).remove();
    })
    .listen('NewMessageEvent', (e) => {
        if(e.data.admin) {
            $( "#messages" ).append( "<strong style='color:red;'><i class='fas fa-user-cog'></i> "+e.data.user+" (admin) :</strong><p>"+e.data.message+"</p>" );
        }
        else {
            $( "#messages" ).append( "<strong><i class='fas fa-user'></i> "+e.data.user+" :</strong><p>"+e.data.message+"</p>" );
        }
        $('.div-scroll').scrollTop(999999999);
    });

$(document).on('click', '.send-msg', function(e){
    e.preventDefault();
    var token = $("input[name='_token']").val();
    var user = $("input[name='user']").val();
    var admin = $("input[name='admin']").val();
    var msg = $(".msg").val();
    if(msg != ''){
        $.ajax({
            type: "POST",
            url: "sendmessage",
            dataType: "json",
            data: {'_token':token,'message':msg,'user':user,'admin':admin}
        })
        .done(function(data){
            $(".msg").val('');
        });
    }else{
        alert("Message vide");
    }
})