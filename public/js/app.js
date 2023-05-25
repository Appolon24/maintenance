$(function () {
$('#register').hide()
    $('#login').show()
    $('#btn_go_login').click(function () {
        $('#register').hide()
        $('#login').show()
    })
    $('#btn_go_register').click(function () {
        $('#register').show()
        $('#login').hide()
    })
    $('#second').hide()
    $('#first').show()
    $('#next').click(function () {
        $('#second').show()
        $('#first').hide()
    })
})
