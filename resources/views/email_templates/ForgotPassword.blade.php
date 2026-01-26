<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Forgot Password</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                background-color: #f7f4f1;
                font-family: 'Segoe UI', Arial, sans-serif;
            }

            .registration-completed-email-container {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 60px 20px;
            }

            .forgot-password-email {
                width: 100%;
                max-width: 560px;
                background: #F5F1EE;
                padding: 40px 45px;
                border-radius: 18px;

                box-shadow: 
                    0 10px 25px rgba(0, 0, 0, 0.08),
                    inset 0 0 0 1px #C97C5D;
            }

            .blogger-name {
                text-align: center;
                color: #C97C5D;
                font-size: 32px;
                font-weight: 600;
                margin-bottom: 18px;
            }

            .welcome-message {
                color: #4A4A4A;
                font-size: 20px;
                line-height: 1.6;
                text-align: center;
                margin-bottom: 25px;
            }

            .welcome-message span {
                color: #C97C5D;
                font-weight: 700;
            }

            .blogger-new-password {
                text-align: center;
            }

            .blogger-new-password p {
                color: #4A4A4A;
                font-size: 18px;
                line-height: 1.6;
                margin-bottom: 30px;
            }

        </style>
    </head>
    <body>
        <div class="forgot-password-email-container">
            <div class="forgot-password-email">
                <div class="blogger-name">
                    Hello {{$blogger_name}}!
                </div>
                <p class="welcome-message">
                    Please use the given password to log in to <span>BlogSphere</span>.
                </p>
                <div class="blogger-new-password">
                    <p>
                        {{$blogger_new_password}}
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>