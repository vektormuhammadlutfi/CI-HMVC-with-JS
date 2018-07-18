var loginForm = $("#login-form"),
    loginButton = $(".btn-login"),
    Login = function() {
        return {
            init: function() {
                Login.main()
            },
            main: function() {
                loginForm.submit(function() {
                    return Login.submitForm(), !1
                }), $("#login-form input").keypress(function(n) {
                    if (13 == n.which) return $(".btn-login").click(), !1
                })
            },
            submitForm: function() {
                Helper.validateForm(loginForm, {
                    identity: {
                        required: !0,
                        email: !0
                    },
                    password: {
                        required: !0
                    }
                }), loginForm.valid() && (loginButton.attr("disabled", !0), Helper.ajax(Helper.baseUrl("auth/login"), "post", "json", loginForm.serialize()).error(function(n) {
                    loginButton.attr("disabled", !1)
                }).success(function(n) {
                    n.status ? window.location = Helper.baseUrl("dashboard") : ($("#login-form").addClass("animated shake"), $(".wrong-password", $("#login-form")).show(), loginButton.attr("disabled", !1))
                }))
            }
        }
    }();
jQuery(document).ready(function() {
    Login.init()
});