<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Prodovi</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
        <style>
    @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&family=Black+Han+Sans&display=swap');
    </style>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body >
        <div >
       
            <div class="wrapper">
                <div class="nav">
                  <a href="#" class="link" id="logo"><img src="img/logoblanco.png" alt=""></a>
                  
                  <a href="{{ route('login') }}" class="link" >Iniciar Sesión</a>
                </div>
                <div class="about">
                  <p>
                     Nos encargamos del manejo publicitario de tu negocio
                  </p>
                  <p id="p2" style="font-family: Arial, Helvetica, sans-serif" >Accede a los mejores planes y haz crecer a tu empresa</p>
                  
                  
                </div>
          
                <div class="wrapper-img">
                  <div class="box">
                      
                  </div>
                  <div>
                   
                    <img
                      class="image"
                      src="assets/g.png"
            
                    />
                  </div>
                </div>
                <div class="sub-header">
                  <a href="#" class="contact-link">&#8618; +591 79561365</a>
                  <a href="#" class="work-link">GESTIÓN DE REDES SOCIALES</a>
                  <a href="#" class="work-link">PLANES</a>
                  <a href="#" class="aboutme"
                    >Acerca de la empresa </a
                  >
                </div>
              </div>
              <div class="container">
                <div class="loader">Bienvenido</div>
                <div class="overlay">
                  <div class="block block-1"></div>
                  <div class="block block-2"></div>
                  <div class="block block-3"></div>
                  <div class="block block-4"></div>
                  <div class="block block-5"></div>
                  <div class="block block-6"></div>
                  <div class="block block-7"></div>
                  <div class="block block-8"></div>
                  <div class="block block-9"></div>
                  <div class="block block-10"></div>
                  <div class="block block-11"></div>
                  <div class="block block-12"></div>
                  <div class="block block-13"></div>
                  <div class="block block-14"></div>
                  <div class="block block-15"></div>
                  <div class="block block-16"></div>
                  <div class="block block-17"></div>
                  <div class="block block-18"></div>
                  <div class="block block-19"></div>
                  <div class="block block-20"></div>
                </div>
              </div>
          
              <script>
                TweenMax.staggerFrom(
                  ".block",
                  0.8,
                  {
                    width: "0%",
                    ease: Power1.easeIn,
                    delay: 2,
                  },
                  0.04
                );
          
                TweenMax.to(".loader", 1, {
                  x: 2,
                  opacity: 0,
                  ease: Expo.easeInOut,
                  delay: 1.6,
                });
          
                TweenMax.staggerFrom(
                  ".nav > a, .about p,h1, .sub-header > a",
                  2,
                  {
                    opacity: 0,
                    y: 30,
                    ease: Expo.easeInOut,
                    delay: 3,
                  },
                  0.06
                );
          
                TweenMax.to(".box", 0.2, {
                  opacity: 1,
                  ease: Expo.easeInOut,
                  delay: 3.8,
                });
          
                TweenMax.to("img", 0.2, {
                  opacity: 1,
                  ease: Expo.easeInOut,
                  delay: 4,
                });
          
                TweenMax.to(".box", 2.4, {
                  y: "-100%",
                  ease: Expo.easeInOut,
                  delay: 4,
                });
              </script>
              <style>
                .black-han-sans-regular {
  font-family: "Black Han Sans", sans-serif;
  font-weight: 400;
  font-style: normal;
}
.archivo-black-regular {
  font-family: "Archivo Black", sans-serif;
  font-weight: 400;
  font-style: normal;
}


* {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Rocinante Titling", Arial, Helvetica, sans-serif;

}

html, body {
      width: 100%;
      height: 100vh;
      background: #F28705;
}

#logo img{
      width: 150px;
      height: auto;
}
.wrapper {
      position: absolute;
      width: 100% !important;
      height: 100vh;
      z-index: 2;
}

.nav {
      display: flex;
      justify-content: space-between;
}

.nav a {
      text-decoration: overline;
      color: #F28705;
      letter-spacing: -1px;
      font-size: 20px;
      margin: 2.3em;
      font-family: Helvetica, sans-serif;
}
.nav a:hover{
      color: #9502f8;
}

.nav a:first-child {
      color: #ffae00;
}

.about p {
      width: 30%;
     font-family: "Archivo Black", sans-serif;
      font-weight: 300;
      color: #969696;
     font-size: 40px;
      margin: 1.6em;
}
.about  #p2{
      font-size: 20px;
      padding-left: 40px
}

.wrapper-img {
      overflow: hidden;
      position: absolute;
      top: 15% !important;
      right: 10%;
      transform: translate(-0%, 5%);
      width: 28%;
      height: 90vh;
      border-radius: 70px;
    }
   
    
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0;
    }
    
    .box {
      background: #000;
      opacity: 0;
      position: absolute;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
      z-index: 2;
    }

.sub-header {
      position: absolute;
      bottom: 1em;
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      
}

.sub-header a {
      text-decoration: none;
      text-transform: uppercase;
      font-family: Helvetica, sans-serif;
      font-weight: 300;
      color: #969696;
}
.sub-header a:hover{
      color: #F28705;
}

a.contact-link {
      color: #bdbdbd;
      letter-spacing: -3px;
      font-family: "Rocinante Titling", Arial, Helvetica, sans-serif;
      font-size: 24px;
      margin-left: 2em;
}

a.aboutme {
      width: 30%;
}

.loader {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-transform: uppercase;
      font-size: 2vw;
      font-family: "Archivo Black", sans-serif;
      color: #fffcfc;
}
.about img{
      margin-left: 2.9em;
      width: 410px;
}


.overlay {
      width: 100%;
      height: 100vh;
}

.block {
      position: fixed;
      width: 5%;
      height: 100vh;
      background: #000;
}

.block-1 {
      left: 0;
}

.block-2 {
      left: 5%;
}

.block-3 {
      left: 10%;
}

.block-4 {
      left: 15%;
}

.block-5 {
      left: 20%;
}

.block-6 {
      left: 25%;
}

.block-7 {
      left: 30%;
}

.block-8 {
      left: 35%;
}

.block-9 {
      left: 40%;
}

.block-10 {
      left: 45%;
}

.block-11 {
      left: 50%;
}

.block-12 {
      left: 55%;
}

.block-13 {
      left: 60%;
}

.block-14 {
      left: 65%;
}

.block-15 {
      left: 70%;
}

.block-16 {
      left: 75%;
}

.block-17 {
      left: 80%;
}

.block-18 {
      left: 85%;
}

.block-19 {
      left: 90%;
}

.block-20 {
      left: 95%;
}

@media(max-width: 900px) {
      .about p {
            width: 100%;
      }
}
              </style>
            
               
            </div>
        </div>
    </body>
</html>
