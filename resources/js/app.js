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
    dateFormat: 'dd/mm/yy',
    defaultDate: '1/' + currentMonth + '/' + (new Date).getFullYear(),
});

$('#select-month').change(function () {
    let month = $(this).find("option:selected").val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: '/home',
        data: {
            month: month,
        },
        success: function (data) {
            location.reload();
        }
    });
});

$('#save-data-btn').click(function (e) {
    e.preventDefault();
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

                // add new row to table without reload after saving to DB
                let lastRow = $('#' + dataType + '-block').children('.custom-table-row').last();
                lastRow.after(addNewRow(date, title, sum));

                // update sum in table
                let sumBlock = $('#' + dataType + '-sum');
                let currentSum = parseInt(sumBlock.text());
                sumBlock.text(currentSum + parseInt(sum));

                // update fact balance
                let factBalanceEl = $('#fact-balance');
                let factBalance = parseInt(factBalanceEl.text());

                if (dataType === 'in') {
                    factBalanceEl.text(factBalance + parseInt(sum));
                } else if (dataType === 'out') {
                    factBalanceEl.text(factBalance - parseInt(sum));
                }

                $('#addData').modal('toggle');
            }
        });
    }
});

function addNewRow(date, title, sum) {

    return "" +
        "<div class='row justify-content-between custom-table-row'>" +
            "<div class='col-2'>" +
                "<span style=\"white-space:nowrap;\">" +
                    date.replace(new RegExp('/', 'g'), '-') +
                "</span>" +
            "</div>" +
            "<div class='col-6'>" + title +
            "</div>" +
            "<div class='col-1'>" + sum +
            "</div>" +
            "<div class='col-1'><b>-</b></div>"
        "</div>"
}