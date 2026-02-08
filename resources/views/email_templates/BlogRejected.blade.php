<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Blog Rejected</title>
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

            .blog-rejected-email-container {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 60px 20px;
            }

            .blog-rejected-mail {
                width: 100%;
                max-width: 560px;
                background: #F5F1EE;
                padding: 40px 45px;
                border-radius: 18px;

                box-shadow: 
                    0 10px 25px rgba(0, 0, 0, 0.08),
                    inset 0 0 0 1px #C97C5D;
            }

            .blog-name {
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

            .blog-details {
                text-align: center;
            }

            .blog-details p {
                color: #4A4A4A;
                font-size: 18px;
                line-height: 1.6;
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="blog-rejected-email-container">
            <div class="blog-rejected-mail">
                <div class="blog-name">
                    Hello {{$blogger_name}}!
                </div>
                <p class="welcome-message">
                    Your Blog has been rejected. Kindly contact the Admin!
                </p>
                <div class="blog-details">
                    <p>
                        {{$blog_id}} : {{$blog_name}}
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>