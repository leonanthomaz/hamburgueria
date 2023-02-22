
const handleLogin = () => {
    $("#register-form").hide()
    $("#login-form").hide()
}

const login = () => {
    $("#tab-login").toggleClass("active")
    $("#tab-register").removeClass("active")

    $("#login-form").show('fast')
    $("#register-form").hide()
}

const register = () => {
    $("#tab-register").toggleClass("active")
    $("#tab-login").removeClass("active")

    $("#register-form").show('fast')
    $("#login-form").hide()

}