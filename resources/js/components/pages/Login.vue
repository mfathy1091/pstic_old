<template>

    <body>
                        <div class="form-group input-field">
                            <input type="text" name="individual_id" class="form-control">
                            <label for="individual_id" class="mr-sm-2">Individual ID</label>

                        </div>
        <div class="container">
            <header>Login Form</header>
            <div class="input-field">
                <input type="text" required>
                <label>Email or Username</label>
            </div>
            <div class="input-field">
                <input type="password" required>
                <label>Password</label>
            </div>


            <div class="button">
                <div class="inner"></div>
                <button>Login</button>
            </div>
        </div>
    </body>

</template>
<style scoped>
    *{
        margin: 0;
        padding: 0;
        border-radius: 5px;
        box-sizing: border-box;
    }
    body{
        height: 100vh;
        display: flex;
        align-items: center;
        text-align: center;
        justify-content: center;
        background-color: azure;
    }
    .container{
        position: relative;
        width: 400px;
        background: white;
        padding: 60px 40px;
    }
    header{
        font-size: 40px;
        margin-bottom: 60px;
    }
    .input-field{
        margin: 25px 0;
        position: relative;
        height: 50 px;
        width: 100%;
    }
    .input-field input{
        height: 100%;
        width: 100%;
        border: 1px solid silver;
        padding-left: 15px;
        padding-top: 10px;
        padding-bottom: 10px;
        outline: none;
        font-size: 19px;
        transition: .04s;
    }
    input:focus{
        border: 1px solid #1DA1F2;
    }
    .input-field label{
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        pointer-events: none;
        color: grey;
        font-size: 18px;
        transition: 0.4s;
    }
    input:focus ~ label,
    input:valid ~ label{
        transform: translateY(-38px);
        background: white;
        font-size: 16px;
        color: #1DA1F2;
    }
    input:autofill {
        top: 50px
    }

</style>