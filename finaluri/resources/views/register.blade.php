<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
</head>
<body>
    <section>
        <div >

           <form method="POST" action="/sign-up">
             @csrf
          
              <input name="name" placeholder="Full name" type="text">
           

              <input name="email" placeholder="E-Mail" type="email">
               
              <input name="password" placeholder="Create password" type="password">
            
              <input name="password_confirmation" placeholder="Repeat password" type="password">
              <button type="submit" > Create Account </button>
             </div>
               <a href="/sign-in">Log In</a>
             </p>
           </form>
        
        </div>
     </section>

   
</body>
</html>