
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

    .access-denied {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 20px;
    }

    .no-access {
        width: 100%;
        max-width: 560px;
        background: #F5F1EE;
        padding: 40px 45px;
        border-radius: 18px;

        box-shadow: 
            0 10px 25px rgba(0, 0, 0, 0.08),
            inset 0 0 0 1px #C97C5D;
    }

    .welcome-message {
        text-align: center;
        color: #C97C5D;
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 18px;
    }

</style>
<div class="access-denied">
    <div class="no-access">
        <p class="welcome-message">
            Access Denied!
        </p>
    </div>
</div>