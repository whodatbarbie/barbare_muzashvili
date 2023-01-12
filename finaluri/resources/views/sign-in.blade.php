<!DOCTYPE html>
<html lang="en" class="bg-dark h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body >
    <p>Enter your email and password to login.</p>

     <form method="POST" action="/login">
         @csrf
         <div  method="POST" action="/login">
             <label for="email-input">email</label>
             <input name="email" type="text" class="form-control" id="username-input">
         </div>
         <div >
             <label for="exampleInputPassword1">Password</label>
             <input name="password" type="password" id="exampleInputPassword1">
         </div>
         <button type="submit" >Login</button>
     </form>

      
</body>
</html>