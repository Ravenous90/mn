/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';

const app = new Vue({
    el: '#app',
});

$('#in-button, #out-button, #plan_out-button').click(function () {
    let param = $(this).attr('id').substr(0, $(this).attr('id').search('-'));
    $('#data-type').val(param);
});

$('#date').datepicker({
    dateFormat: 'dd/mm/yy'
});

$('#save-data-btn').click(function () {
    let dataType = $('#data-type').val();
    let title = $('#title').val();
    let sum = $('#sum').val();
    let date = $('#date').val();

    if (title === '' || sum === '' || date === '') {
        alert('enter data');
    } else {
        $('#data-type').val('');
        $('#title').val('');
        $('#sum').val('');
        $('#date').val('');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/home',
            data: {
                dataType: dataType,
                title: title,
                sum: sum,
                date: date,
            },
            success: function (data) {
                $('#addData').modal('toggle');
                console.info(data);
            }
        });
    }
});
